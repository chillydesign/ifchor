<?php get_header(); ?>


<!-- section -->
<section  class="container">

    <h1><?php _e( 'Contacts', 'webfactor' ); ?></h1>

    <ul class="people">


        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <li class="person">

                <div class="profile_picture">
                    <!-- post thumbnail -->
                    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                        <?php $image = thumbnail_of_post_url(get_the_ID(), 'small'); ?>
                        <div class="image_from_background"  style="background-image: url(<?php echo $image; ?>);"></div>
                    <?php else: ?>
                        <div class="image_from_background" style="background-color: #f1f1f1;"></div>
                    <?php endif; ?>
                    <!-- /post thumbnail -->
                </div>
                <div class="profile_details">
                    <h2><?php the_title(); ?></h2>
                    <p>Phone: 12345 <br />
                    Email: email@website.com</p>
                </div>

            </li>


        <?php endwhile;endif; ?>
    </ul>

    <?php get_template_part('pagination'); ?>

</section>
<!-- /section -->



<?php get_footer(); ?>
