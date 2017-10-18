<?php get_header(); ?>

<section id="top_section">
<h1>Latest Posts</h1>
<div class=" photo_slide " style="background-image: url('<?php echo home_url(); ?>/wp-content/uploads/2017/06/drybulk1.jpg');"></div>

</section>




		<!-- section -->
		<section  class="container">


			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->


<?php get_footer(); ?>
