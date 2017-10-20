<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>




        <?php if (is_home()): ?>

            <div class="row single_post">
                <div class="col-sm-9">

                    <div class="clearfix single_flex">
                        <div class="date_container">
                          <span class="day"><?php echo get_the_date('d'); ?></span>
                          <span class="month"><?php echo get_the_date('M y'); ?></span>
                        </div>
                        <div class="post_text_container">
                            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            <div class="single-content"><p><?php echo get_the_excerpt(); ?></p></div>
                        </div>
                    </div>


                </div>
                <?php if  ( has_post_thumbnail()) : ?>
                    <?php $image =  thumbnail_of_post_url(get_the_ID(),  'medium'); ?>
                    <div class="col-sm-3">
                        <a class="post_image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img src="<?php echo $image; ?>" alt="" />
                        </a>
                    </div>
                <?php endif; ?>

            </div>

        <?php else: ?>

            <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
        <?php endif; ?>

        <?php // html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

        <?php // edit_post_link(); ?>



    </article>
    <!-- /article -->

<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article class="">
        <h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>
    </article>
    <!-- /article -->

<?php endif; ?>
