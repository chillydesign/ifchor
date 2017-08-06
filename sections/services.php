<?php $item_count =  sizeof(  get_sub_field('service')  ); ?>
<?php $item_class =  count_to_bootstrap_class(  $item_count ); ?>
<?php $i = 1; ?>

<div class="container">

  <div class="slick_slider">

    <?php while ( have_rows('service') ) : the_row(); ?>


        <div class="service_container service_container_<?php echo  $i;  ?>  "  >
            <div class="service_inner  ">
          <?php $link = false; if(get_sub_field('link')) : ?>
            <?php $link = get_sub_field('link'); ?>
              <a href="<?php echo $link; ?>">
          <?php endif; ?>


          <?php if(get_sub_field('icon')) : ?>
            <?php $icon =  get_sub_field('icon'); ?>
          <img src="<?php echo $icon['url']; ?>" alt=""/>
          <?php endif ?>
          <?php if(get_sub_field('title')) : ?>
            <h4><?php echo get_sub_field('title'); ?></h4>
          <?php endif ?>

          <?php if(get_sub_field('content')) : ?>
            <!-- <p><?php echo get_sub_field('content'); ?></p> -->
          <?php endif ?>

          <?php if ($link): ?>
          </a>
          <?php endif; ?>
        </div>
        </div>
        <?php $i++; ?>




    <?php endwhile; ?>
  </div> <!-- END OF ROW -->


</div><!--  END OF CONTAINER -->
