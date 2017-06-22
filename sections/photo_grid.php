<?php $item_count =  sizeof(  get_sub_field('item')  ); ?>
<?php $i = 1; ?>


<?php if ( $item_count == 3  ) {
  $item_class = 'col-sm-4';
  $new_row = '';
} else {
  $item_class = 'col-sm-6';
  $new_row = '</div><div class="row">';
} ?>


<div class="container-fluid">
  <div class="row">

    <?php while ( have_rows('item') ) : the_row(); ?>
      <div class="photo_grid_item <?php echo $item_class ; ?>">



        <div class="photo_slide_content">

          <?php $link = false; if(get_sub_field('link')) : ?>
            <?php $link = get_sub_field('link'); ?>
            <a href="<?php echo $link; ?>">
            <?php endif; ?>
            <?php if(get_sub_field('title')) : ?>
              <h4><?php echo get_sub_field('title'); ?></h4>
            <?php endif ?>

            <?php if(get_sub_field('content')) : ?>
              <p><?php echo get_sub_field('content'); ?></p>
            <?php endif ?>


            <?php if ($link) : ?>
            </a>
          <?php endif; ?>

        </div>

        <?php $background_image =  get_sub_field('background_image'); ?>
        <div class="photo_slide " style="background-image: url(<?php echo $background_image['url']; ?>);"></div>
        <div class="photo_overlay"></div>



      </div>
      <?php $i++;  if ($i % 2 == 1) echo $new_row; ?>
    <?php endwhile; ?>
  </div> <!-- END OF ROW -->


</div><!--  END OF CONTAINER -->
