<?php /* Template Name: News Page Template */ get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article>
			<section class="section_photo_slide">
			<?php $background_image =  get_field('background_image'); ?>


			<div class="photo_slide_container  photo_slide_size_medium">

					<div class="photo_slide_content">
						<?php echo get_field('content'); ?>
					</div>

					<?php if(get_field('video')){ ?>
					<div class="video-container">
						<video id="vidbg" autoplay="autoplay" loop="loop" >
							<source src="<?php echo get_field('video-mp4')['url']; ?>" />
							<source src="<?php echo get_field('video-ogv')['url']; ?>" />
						</video>
					</div>
					<?php } ?>
					<div class="parallax photo_slide " style="background-image: url(<?php if(!empty($background_image['url'])){echo $background_image['url'];} else {echo home_url() .  '/wp-content/uploads/2017/06/drybulk1.jpg';} ?>);"></div>
					<div class="photo_gradient"></div>

			</div>
		</section>

			<?php include('section-loop.php'); ?>
		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<!-- section -->
	<section  class="container">

		<?php $my_query = new WP_Query( 'posts_per_page=10' ); ?>

		<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

						<div style="margin-bottom:50px" class="clearfix single_flex">
							<div class="date_container">
								<span class="day"><?php echo get_the_date('d'); ?></span>
								<span class="month"><?php echo get_the_date('M y'); ?></span>
							</div>
							<div class="post_text_container">
								<h3><a style="text-align:left" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<div class="single-content"><p><?php echo get_the_excerpt(); ?></p></div>
							</div>
						</div>

		<?php endwhile; ?>



		<?php get_template_part('pagination'); ?>

	</section>
	<!-- /section -->

<?php else: ?>

	<!-- article -->
	<article class="container">

		<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>

	</article>
	<!-- /article -->

<?php endif; ?>



<?php // edit_post_link(); ?>
<?php get_footer(); ?>
