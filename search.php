<?php get_header(); ?>




    <section class="section_photo_slide" style="top:-50px">
    <div class="photo_slide_container  photo_slide_size_small">
            <div class="photo_slide_content">
            <h1><?php echo __('Search Results for ', 'webfactor' ); ?> "<?php echo $_GET['s']; ?>"</h1>
            </div>
            <div class="parallax photo_slide " style="background-image: url('<?php echo home_url(); ?>/wp-content/uploads/2017/06/drybulk1.jpg');"></div>
            <div class="photo_gradient"></div>
    </div>
    </section>


	<section class="container">
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
	</section>



<?php get_footer(); ?>
