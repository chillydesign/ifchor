
<?php $posts = get_posts( array( 'posts_per_page' => 3, 'post_type' => 'post' ) ); ?>
<div class="container">
  <h2 style="text-align:center;">News</h2>
    <ul class="posts_slider">

        <?php foreach ($posts as $post) : setup_postdata( $post );  ?>

            <li class="single_post">

                <div class="row">

                  <?php if  ( has_post_thumbnail()) : ?>
                      <?php $image =  thumbnail_of_post_url(get_the_ID(),  'large'); ?>

                        <div class="col-sm-9">

                        <div class="clearfix">
                          <div class="date_container">
                            <span class="day">6</span>
                            <span class="month">Jul 17</span>
                          </div>
                          <div class="post_text_container">
                            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            <div class="single-content"><p><?php echo get_the_excerpt(); ?></p></div>
                          </div>
                        </div>

                        </div>

                        <div class="col-sm-3">
                            <img src="<?php echo $image; ?>" alt="" />
                        </div>

                    <?php else: ?>

                      <div class="col-sm-8 col-sm-push-2">

                      <div class="clearfix single_flex">
                        <div class="date_container">
                          <span class="day"><?php echo get_the_date('d'); ?></span>
                          <span class="month"><?php echo get_the_date('M y'); ?></span>
                        </div>
                        <div class="post_text_container">
                          <h3><a style="text-align:left" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                          <div class="single-content"><p><?php echo get_the_excerpt(); ?></p></div>
                        </div>
                      </div>

                      </div>

                    <?php endif; ?>



                </div>


            </li>


        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
</div>
