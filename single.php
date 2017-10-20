<?php get_header(); ?>



	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<section class="section_photo_slide" style="margin-top:-50px">
							<div class="photo_slide_content">
									<h1>Ifchor News</h1>
							</div>
							<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
								<?php $image = thumbnail_of_post_url(get_the_ID(), 'full'); ?>
							<?php else:
								$image = get_home_url() . '/wp-content/uploads/2017/06/drybulk1.jpg';

							endif; ?>
							<div class="parallax photo_slide " style="background-image: url('<?php echo $image; ?>');"></div>
							<div class="photo_gradient"></div>
			</section>

			<section class="container">

				<div class="clearfix single_flex">
					<div class="date_container">
						<span class="day"><?php echo get_the_date('d'); ?></span>
						<span class="month"><?php echo get_the_date('M y'); ?></span>
					</div>
					<div class="post_text_container">
						<h3><?php the_title(); ?></h3>
						<div class="single-content"><?php the_content(); ?></div>
					</div>
				</div>



			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>


		</section>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>



			<section id="top_section">
				<h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>
			</section>



	<?php endif; ?>

<?php get_footer(); ?>
