
<?php $posts = get_posts( array( 'posts_per_page' => 3, 'post_type' => 'post' ) ); ?>
<div class="container">
    <ul class="posts_slider">

        <?php foreach ($posts as $post) : setup_postdata( $post );  ?>

            <li>

                <div class="row">


                    <?php if  ( has_post_thumbnail()) : ?>
                        <?php $image =  thumbnail_of_post_url(get_the_ID(),  'large'); ?>
                        <div class="col-sm-6 col-sm-push-6">
                            <h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo get_the_excerpt( ); ?></p>
                        </div>
                        <div class="col-sm-6 col-sm-pull-6">
                            <img src="<?php echo $image; ?>" alt="" />
                        </div>

                    <?php else:  ?>


                        <div class="col-sm-8 col-sm-push-2">
                            <h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo get_the_excerpt( ); ?></p>
                        </div>


                    <?php endif; ?>



                </div>


            </li>


        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
</div>
