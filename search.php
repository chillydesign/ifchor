<?php get_header(); ?>


	<!-- section -->
	<section id="top_section">
		<h1><?php echo sprintf( __( '%s Search Results for ', 'webfactor' ), $wp_query->found_posts );?>"<?php echo get_search_query(); ?>"</h1>
	</section>

	<section class="container">
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
	</section>



<?php get_footer(); ?>
