
<?php $background_image =  get_sub_field('background_image'); ?>
<?php $size =  get_sub_field('size'); ?>
<?php if (is_array($size) ) $size = $size[0]; ?>

<div class="photo_slide_container  photo_slide_size_<?php echo $size;  ?>">

		<div class="photo_slide_content">
			<?php echo get_sub_field('content'); ?>
		</div>

		<div class="parallax photo_slide " style="background-image: url(<?php echo $background_image['url']; ?>);"></div>
		<div class="photo_gradient"></div>

</div>
