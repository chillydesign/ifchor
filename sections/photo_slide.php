<?php $image =  get_sub_field('image'); ?>
<?php $background_image =  get_sub_field('background_image'); ?>


	<div class="photo_slide_content">
		<?php echo get_sub_field('content'); ?>
	</div>

	<div class="parallax photo_slide " style="background-image: url(<?php echo $background_image['url']; ?>);"></div>
