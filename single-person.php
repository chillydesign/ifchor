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

				<div class="profile_details">
					<h2><?php the_title(); ?></h2>
			        <?php
			        $telephone = get_field('telephone', $post_id);
			        $mobile = get_field('mobile', $post_id);
			        $email = get_field('email', $post_id);
			        $email2 = get_field('email2', $post_id);
			        $position = get_field('position', $post_id);
			         ?>
					<p>
							<?php if ($position) { echo '<strong>' . $position . '</strong><br>';} ?>
			        <?php if ($telephone) { echo '&#9743; Tel: <a href="tel:'. $telephone.'">' . $telephone .  '</a> <br>';} ?>
			        <?php if ($mobile) { echo '&#9990;	 Mobile: <a href="tel:'. $mobile.'">' . $mobile .  '</a> <br>';} ?>
			        <?php if ($email) { echo '&#9993; Email: <a href="mailto:' . $email . '">' . $email .  '</a><br>';} ?>
			        <?php if ($email2) { echo '&#9993; Email: <a href="mailto:' . $email2 . '">' . $email2 .  '</a> <br>';} ?>

					</p>
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
