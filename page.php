<?php get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article>
			<section class="section_photo_slide">
			<?php $background_image =  get_field('background_image'); ?>
			<?php $size =  get_field('size'); ?>
			<?php if (is_array($size) ) $size = $size[0]; ?>

			<div class="photo_slide_container  photo_slide_size_<?php echo $size;  ?>">

					<div class="photo_slide_content">
						<?php echo get_field('content'); ?>
					</div>

					<?php if(get_field('video')){ ?>
						<video id="vidbg" autoplay="autoplay" loop="loop" >
							<source src="<?php echo get_field('video-mp4')['url']; ?>" />
							<source src="<?php echo get_field('video-ogv')['url']; ?>" />
						</video>
					<?php } ?>
					<div class="parallax photo_slide " style="background-image: url(<?php echo $background_image['url']; ?>);"></div>
					<div class="photo_gradient"></div>

			</div>
		</section>




			<?php include('section-loop.php'); ?>
		</article>
		<!-- /article -->

	<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article class="container">

		<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>

	</article>
	<!-- /article -->

<?php endif; ?>



<?php edit_post_link(); ?>
<?php get_footer(); ?>
