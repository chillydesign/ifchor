<?php get_header(); ?>


            <section class="section_photo_slide" style="margin-top:-50px">
            <div class="photo_slide_container  photo_slide_size_large">
                    <div class="photo_slide_content">
                        <h1><?php _e( 'Page not found', 'webfactor' ); ?></h1>
        				<p>
        					<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'webfactor' ); ?></a>
        				</p>
                    </div>
                    <div class="parallax photo_slide " style="background-image: url('<?php echo home_url(); ?>/wp-content/uploads/2017/06/drybulk1.jpg');"></div>
                    <div class="photo_gradient"></div>
            </div>
            </section>




<?php get_footer(); ?>
