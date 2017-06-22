<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="row single_post">
			<div class="col-sm-9">
				<h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h2>

				<p class="meta"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></p>

				<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

				<?php edit_post_link(); ?>

			</div>
			<div class="col-sm-3">
				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
					<?php $image = thumbnail_of_post_url(get_the_ID(), 'small'); ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image_from_background"  style="background-image: url(<?php echo $image; ?>);"></a>
				<?php endif; ?>
				<!-- /post thumbnail -->

			</div>
		</div>




	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article class="">
		<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
