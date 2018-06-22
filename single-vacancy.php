<?php get_header(); ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php $post_id =  get_the_ID(); ?>
    <?php $locations = get_the_terms( $post_id , 'vacancy_location' ); ?>
    <?php $location_string = terms_to_name_string($locations); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="section_photo_slide" style="margin-top:-50px">
            <div class="photo_slide_content">
                <h1><?php the_title(); ?></h1>
                <a href="<?php echo home_url(); ?>/careers" class="back_to_vacancies">Careers</a>
            </div>
            <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                <?php $image = thumbnail_of_post_url(get_the_ID(), 'full'); ?>
            <?php else:
                $image = get_home_url() . '/wp-content/uploads/2017/06/drybulk1.jpg';
            endif; ?>
            <div class="parallax photo_slide " style="background-image: url('<?php echo $image; ?>');"></div>
            <div class="photo_gradient"></div>
        </section>

        <section class="container">

            <div class="clearfix single_flex">
                <div class="date_container">
                    <span class="day">Job</span>
                    <span class="month">Offer</span>
                </div>
                <div class="post_text_container">
                    <h3 style="padding:0;"><?php the_title(); ?></h3>
                    <p class="meta">
                        <?php if ($locations) : ?> Location: <?php echo ($location_string); ?>. <?php endif; ?>
                        Posted: <?php echo get_the_date('d M Y'); ?>.
                        </p>

                    <div class="single-content"><?php the_content(); ?></div>

                    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>
                </div>
            </div>
        </section>

        <!-- <h2 class="apply_title"><div class="container">Something here</div></h2> -->

        <section class="apply_for_job" id="application">
            <div class="container">
                <h2>Apply for this position</h2>
                <p>Enter your details in the form below to apply for this position. <br>
                Please note that all fields marked with an asterisk (*) are required.</p>


                <?php if (isset($_GET['message'])) : ?>
                    <?php $message = $_GET['message']; ?>
                    <?php if ($message == 'missing'): ?>
                        <p class="alert alert-danger">You are missing a field.</p>
                    <?php elseif ($message == 'error'): ?>
                        <p class="alert alert-danger">Something went wrong. Sorry. Please try again.</p>
                    <?php elseif ($message == 'success'): ?>
                        <p class="alert alert-success">Thank you for submitting your application.</p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($_COOKIE['applicant_details'])) :
                    $applicant_string = stripslashes($_COOKIE['applicant_details']);
                    $applicant_details = json_decode( $applicant_string );
                    $first_name = $applicant_details->first_name;
                    $last_name = $applicant_details->last_name;
                    $email = $applicant_details->email;
                    $telephone = $applicant_details->telephone;
                    $message = $applicant_details->message;
                else:
                    $first_name = $last_name = $email =  $telephone = $message = '';
                endif; ?>

                <form id="application_form"  action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="first_name"><?php _e( 'First Name', 'webfactor' ); ?>*</label>
                            <input type="text" value="<?php echo $first_name; ?>" id="first_name" name="first_name" autocomplete='given-name' />
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name"><?php _e( 'Last Name', 'webfactor' ); ?>*</label>
                            <input type="text" value="<?php echo $last_name; ?>" id="last_name" name="last_name" autocomplete='family-name' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email"><?php _e( 'Email', 'webfactor' ); ?>*</label>
                            <input type="text" value="<?php echo $email; ?>" id="email" name="email" autocomplete='email' />
                        </div>
                        <div class="col-sm-6">
                            <label for="telephone"><?php _e( 'Telephone', 'webfactor' ); ?></label>
                            <input type="text" value="<?php echo $telephone; ?>" id="telephone" name="telephone" autocomplete='tel-national' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cv"><?php _e( 'CV', 'webfactor' ); ?></label>
                            <input type="file" name="cv" id="cv" />
                        </div>
                        <div class="col-sm-6">
                            <label for="additional_document"><?php _e( 'Additional document', 'webfactor' ); ?></label>
                            <input type="file" name="additional_document" id="additional_document" />
                        </div>
                    </div>

                    <div>
                        <label for="message"><?php _e( 'Message', 'webfactor' ); ?></label>
                        <textarea name="message" id="message" cols="30" rows="4" placeholder="Your message here"><?php echo $message; ?></textarea>
                    </div>
                    <div>
                        <label class="checkbox_label" for="terms_conditions">
                            <input type="checkbox" value="agree" id="terms_conditions" name="terms_conditions" /><span> I acknowledge that IFCHOR SA has the right to collect, store and process the data I upload with my application, for the purpose of potential employment only.</span>
                        </label>

                    </div>
                    <div>
                        <input type="hidden" name="position" value="<?php echo $post_id; ?>" />
                        <input type="hidden" name="action" value="jobapplication_form" />
                        <input id="application_submit_button" type="submit" value="<?php _e( 'Submit', 'webfactor' ); ?>" />
                    </div>




                </form>




            </div>


        </section>

    </article>
    <!-- /article -->

<?php endwhile; ?>

<?php else: ?>



    <section id="top_section">
        <h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>
    </section>



<?php endif; ?>

<?php get_footer(); ?>
