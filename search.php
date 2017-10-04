<?php get_header(); ?>


	<!-- section -->
	<section id="top_section">
		<h1><?php echo __('Search Results for ', 'webfactor' ); ?> "<?php echo $_GET['s']; ?>"</h1>
	</section>

	<section class="container">
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
	</section>



<?php get_footer(); ?>
