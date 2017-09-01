<?php $item_count =  sizeof(  get_sub_field('service')  ); ?>
<?php $item_class =  count_to_bootstrap_class(  $item_count ); ?>
<?php $i = 1; ?>

<div class="container">

  <div class="slick_slider">

<?php for ($count_sliders=0; $count_sliders < 10; $count_sliders++) { ?>
    <?php while ( have_rows('service') ) : the_row(); ?>
        <?php $primary_class = ( $count_sliders ==0) ? ' service_container_primary  ' : ''; ?>
        <div class="service_container service_container_<?php echo  $i;  ?>  <?php echo  $primary_class; ?>  "  >
          <?php $link = '#'; if(get_sub_field('link')) : ?>
            <?php $link = get_sub_field('link'); ?>
          <?php endif; ?>
          <a  class="service_inner  " href="<?php echo $link; ?>">
          <?php if(get_sub_field('icon')) : ?>
            <?php $icon =  get_sub_field('icon'); ?>
          <img src="<?php echo $icon['url']; ?>" alt=""/>
          <?php endif ?>
          <?php if(get_sub_field('title')) : ?>
            <h4><?php echo get_sub_field('title'); ?></h4>
          <?php endif ?>
          </a>
        </div>
        <?php $i++; ?>
    <?php endwhile; ?>

  <?php } ?>




  </div> <!-- END OF ROW -->


</div><!--  END OF CONTAINER -->
