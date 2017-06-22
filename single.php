<?php get_header(); ?>



	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<section id="top_section">
				<h1><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					<?php $image = thumbnail_of_post_url(get_the_ID(), 'full'); ?>
				<div class=" photo_slide " style="background-image: url(<?php echo $image; ?>);"></div>
				<?php endif; ?>
			</section>

			<section class="container">



			<p class="meta"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></p>


			<?php the_content(); // Dynamic Content ?>



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
