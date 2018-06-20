<?php get_header(); ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php $post_id =  get_the_ID(); ?>
    <?php $locations = get_the_terms( $post_id , 'vacancy_location' ); ?>
    <?php $location_names =   array_map( function($location) { return $location->name; },  $locations  );  ?>
    <?php $location_string = implode( $location_names, ', '); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="section_photo_slide" style="margin-top:-50px">
            <div class="photo_slide_content">
                <h1><?php the_title(); ?></h1>
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
                        <?php if (sizeof($location_names) >0 ) : ?> Location: <?php echo ($location_string); ?>. <?php endif; ?>
                        Posted: <?php echo get_the_date('d M Y'); ?>.
                        </p>

                    <div class="single-content"><?php the_content(); ?></div>

                    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>
                </div>
            </div>
        </section>

        <!-- <h2 class="apply_title"><div class="container">Something here</div></h2> -->

        <section class="apply_for_job">
            <div class="container">
                <h2>Apply for this position</h2>
                <p>Enter your details in the form below to apply for this position. <br>
                Please note that all fields marked with an asterisk (*) are required.</p>


                <form id="application_form"  action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="first_name"><?php _e( 'First Name', 'webfactor' ); ?>*</label>
                            <input type="text" id="first_name" name="first_name" autocomplete='given-name' />
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name"><?php _e( 'Last Name', 'webfactor' ); ?>*</label>
                            <input type="text" id="last_name" name="last_name" autocomplete='family-name' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email"><?php _e( 'Email', 'webfactor' ); ?>*</label>
                            <input type="text" id="email" name="email" autocomplete='email' />
                        </div>
                        <div class="col-sm-6">
                            <label for="telelphone"><?php _e( 'Telephone', 'webfactor' ); ?>*</label>
                            <input type="text" id="telelphone" name="telelphone" autocomplete='tel-national' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cv"><?php _e( 'CV', 'webfactor' ); ?>*</label>
                            <input type="file" name="cv" id="cv" />
                        </div>
                        <div class="col-sm-6">
                            <label for="additional_documents"><?php _e( 'Additional documents', 'webfactor' ); ?>*</label>
                            <input type="file" name="additional_documents" id="additional_documents" />
                        </div>
                    </div>

                    <div>
                        <label for="message"><?php _e( 'Message', 'webfactor' ); ?>*</label>
                        <textarea name="message" id="message" cols="30" rows="4" placeholder="Your message here"></textarea>
                    </div>
                    <div>
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
