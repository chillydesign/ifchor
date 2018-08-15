<?php


// GET POSTED DATA FROM FORM
// TO DO REMAME FUNCTION
add_action( 'admin_post_nopriv_jobapplication_form',    'process_jobapplication_form'   );
add_action( 'admin_post_jobapplication_form',  'process_jobapplication_form' );



function have_required_fields() {
    return (
          isset( $_POST['position'] )  &&
          isset( $_POST['first_name'] )  &&
          isset( $_POST['last_name'] ) &&
          isset( $_POST['email'] ) &&
          isset( $_POST['terms_conditions'] ) &&
          $_POST['first_name'] != '' &&
          $_POST['last_name'] != '' &&
          $_POST['email'] != '' &&
          $_POST['terms_conditions'] == 'agree'

      );
}

function process_jobapplication_form() {

    $referer = $_SERVER['HTTP_REFERER'];
    $referer =  explode('?',   $referer)[0];

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'jobapplication_form'   ) :


        if (  have_required_fields() ) :


        $fullname = $_POST['first_name'] . ' ' . $_POST['last_name'];

        $post = array(
            'post_title'     => $fullname,
            'post_status'    => 'publish',
            'post_type'      => 'jobapplication',
            'post_content'   => '',
            'post_parent' =>  $_POST['position']
        );
        $new_jobapplication = wp_insert_post( $post );

        if ($new_jobapplication == 0) {
            wp_redirect( $referer . '?message=error' );
        } else {


            $fields = all_jobapplication_fields();

            foreach ($fields as $field => $translation ) {
                if (isset($_POST[$field])){
                    add_post_meta($new_jobapplication, $field,  $_POST[$field] , true);
                }
            }


            //if filesize of upload is greater than 0 bytes, ie it exists
            // add or replace the file already there
            $cv_file = $_FILES['cv'];
            if ($cv_file['size'] > 0 ) {
                $cv_id = jobapplication_add_file_upload( $cv_file, $new_jobapplication );
                update_field( 'cv', $cv_id,  $new_jobapplication  );
            };
            $additional_document_file = $_FILES['additional_document'];
            if ($additional_document_file['size'] > 0 ) {
                $additional_id = jobapplication_add_file_upload( $additional_document_file, $new_jobapplication );
                update_field( 'additional_document', $additional_id,  $new_jobapplication  );
            };




            // get raw post data, and convert properties and values to nice string
            $data = convert_post_to_data($new_jobapplication, $_POST, $cv_file, $additional_document_file);


            // SEND EMAILS TO THE ADMIN AND THE PERSON WHO SUBMITTED
            send_jobapplication_emails( $data );


            wp_redirect( $referer . '?message=success#application' );
        }


        exit;



        else :  // end of have all required fields

            // save applicants form details in cookie so can repopulate form again
            $applicant_details =  new stdClass();
            $applicant_details->first_name = $_POST['first_name'];
            $applicant_details->last_name = $_POST['last_name'];
            $applicant_details->email = $_POST['email'];
            $applicant_details->telephone = $_POST['telephone'];
            $applicant_details->message = $_POST['message'];
            setcookie( 'applicant_details', json_encode($applicant_details), time() + 3600, '/'  );
            wp_redirect( $referer . '?message=missing#application' );
        endif; // end of dont have all required fields
    else :  // end of did post jobapplication_form
         wp_redirect( $referer . '?message=missing#application' );
    endif;


}



function send_jobapplication_emails($data){



    $headers = 'From: Ifchor HR <onlineapplication@ifchor.com>' . "\r\n";
    $emailheader = file_get_contents(dirname(__FILE__) . '/emails/email_header.php');
    $emailfooter = file_get_contents(dirname(__FILE__) . '/emails/email_footer.php');
    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

    $paragraph_for_admin = '<p>A job application for '. $data['position'] . ' has been made.</p><br />';
    $email_subject_for_admin = 'Job application for ' . $data['position'] . ' - IFCHOR';
    $app_summary_for_admin = generate_jobapplication_summary( $data);
    $email_content_for_admin = $emailheader  . $paragraph_for_admin .  $app_summary_for_admin . $emailfooter;
    wp_mail( 'hr@ifchor.com' , $email_subject_for_admin, $email_content_for_admin, $headers );



        $paragraph_for_user =
        "Dear " . $_POST['first_name'] . " " . $_POST['last_name'] . ",<br><br>

        We acknowledge receipt of your resume and application for the position of " .  $data['position'] . " at IFCHOR and sincerely appreciate your interest in our company.<br><br>

        We will screen all applicants and select candidates whose qualifications seem to meet our needs. We will carefully consider your application during the initial screening and will contact you if you are selected to continue in the recruitment process.<br><br>

        We wish you every success.<br><br>

        IFCHOR <br><br><br> <hr> <br><br><br><strong>Application summary:</strong><br><br>";


    $email_subject_for_user = ('Your job application to IFCHOR');
    $data_for_user = $data;
    // remove cv and additional document for user email
    //$data_for_user['cv'] = '';
    //$data_for_user['additional_document'] = '';
    $app_summary_for_user = generate_jobapplication_summary(  $data_for_user);
    $email_content_for_user = $emailheader . $paragraph_for_user .  $app_summary_for_user . $emailfooter;

    wp_mail( $_POST['email'], $email_subject_for_user, $email_content_for_user, $headers );



    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );



}




function generate_jobapplication_summary(  $data ) {



    $body = '';

    foreach (all_jobapplication_fields() as $field => $translation) {
        if ( isset($data[$field]) && $data[$field] != '' ) {

            if ($field == 'terms') {
                // dont show terms

            } else {
                $body .= '<p><strong>' . __($translation, 'webfactor') . '</strong>: <br /> ';

                if (  is_array( $data[$field] )   ) {
                    $body .=    implode($data[$field], ', ') ;
                } else {
                    $body .=   nl2br($data[$field]) ;
                }



                $body .= '</p>';
            }

        }
    }



    return $body;


}




function convert_post_to_data($jobapplication_id, $post, $cv_file, $additional_document_file) {
    global $wpdb;

    foreach ($post as $key => $value) {

         if ( $key == 'position') {
             $position_id = $value;
             $position = get_post($value);
             $position_title = $position->post_title;
             $post['position'] = $position_title;

         }
    }


    // IF they uploaded an insurance doc, or a photo, show the link to it
    if ( $cv_file['size'] > 0 ) {
        $cv_id = get_field( 'cv', $jobapplication_id  );
        $cv_link = $wpdb->get_row( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE ID =  %d ", $cv_id ) );
        // $post['cv'] = $cv_link->guid;echo '<br><br>';
        // var_dump($post['cv']); echo '<br><br>';
        // var_dump($cv_id);echo '<br><br>';
        // echo($cv_id['url']);echo '<br><br>';
        // var_dump($cv_link);
        $post['cv']=$cv_id['url'];
    } else {
      $cv_link = "";
    }
    if ( $additional_document_file['size'] > 0 ) {
        $additional_doc_id = get_field( 'additional_document', $jobapplication_id  );
      //  $additional_doc_link = $wpdb->get_row( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE ID =  %d ", $additional_doc_id ) );
        //$post['additional_document'] = $additional_doc_link->guid;
        $post['additional_document'] = $additional_doc_id['url'];
    } else {
      $additional_doc_link = "";
    }








    return $post;
}




function all_jobapplication_fields(){

    return array(
        'position' => 'Position',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'telephone' => 'Phone',
        'message' => 'Message',
        'cv' => 'CV',
        'additional_document' => 'Additional Document'

    );

};



function jobapplication_add_file_upload($file, $parent){
    $upload = wp_upload_bits($file['name'], null, file_get_contents( $file['tmp_name'] ) );
    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
    $wp_upload_dir = wp_upload_dir();


    $attachment = array(
        'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $upload['file'] ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $upload['file'], $parent );


    return $attach_id;

}


// add_action( 'manage_posts_extra_tablenav', 'add_download_link'  );
// function add_download_link($which){
//
//     if ( is_post_type_archive('jobapplication') ) {
//         if($which == 'bottom'){
//             $download_link = get_home_url() . '/api/v1/?jobapplications';
//             echo '<div class="alignleft actions"><a class="action button-primary button" href="'. $download_link .'">Télécharger CSV</a></div>';
//         }
//     }
// }


?>
