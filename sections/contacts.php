
		<?php $tdu = get_template_directory_uri(); ?>

<?php if(get_sub_field('type') == 'offices'){ ?>
<!-- IF OFFICES -->
<div class="container">

<?php $offices = get_sub_field('offices'); ?>

<?php foreach ($offices as $value) {

	 $value->post_title;
	 $id = $value->ID;

?>
<div class="office_list">

	<ul class="people city">
			<li class="person">
					<div class="profile_picture">
							<div class="image_from_background" style="background-image: url('<?php echo get_field('flag', $id)['url']; ?>"></div>
					</div>
					<div class="profile_details">
							<h2><?php echo get_field('suburb', $id); ?></h2>
							<p>
								<?php if (get_field('address', $id)) { echo get_field('address', $id) . ', ';} ?>
								<?php if (get_field('postcode', $id)) { echo get_field('postcode', $id);} ?>
								 <?php echo get_field('suburb', $id); ?> - <?php echo get_field('country', $id); ?> <br />
								 <?php if (get_field('telephone', $id)) { echo 'TEL : ' . get_field('telephone', $id);} ?>
								 <?php if (get_field('telephone', $id) && get_field('fax', $id)) { echo ' - ';} ?>
								 <?php if (get_field('fax', $id)) { echo 'FAX : ' . get_field('fax', $id);} ?><br />
								<?php if (get_field('email', $id)) { echo '<a href="' . get_field('email', $id) . '">' . get_field('email', $id) . '</a>';} ?>
								</p>
							</div>

					</li>

			</ul>
			<ul class="people row">
				<?php $post_count = 1; ?>

<?php $args = array(
'post_type' => 'person',
'meta_query' => array(
        array(
            'key' => 'office',
            'value' => $id,
            'compare' => 'LIKE'
        )
			));
query_posts($args); while (have_posts()) : the_post(); ?>

<?php $post_id = get_the_ID(); ?>
<li class="person col-sm-4">
	<div class="profile_details">
		<h2><?php the_title(); ?></h2>
		<p>
		<?php if (get_field('telephone', $post_id)) { echo '&#9743; Phone: ' . get_field('telephone', $post_id) .  ' <br>';} ?>
		<?php if (get_field('mobile', $post_id)) { echo '&#9990;	 Mobile: ' . get_field('mobile', $post_id) .  ' <br>';} ?>
		<?php if (get_field('email', $post_id)) { echo '&#9993; Email: ' . get_field('email', $post_id) .  ' <br>';} ?>

		</p>
	</div>
</li>
<?php if($post_count % 3 == 0){echo "</ul><ul class='people row'>";} ?>

<?php $post_count++; ?>
<?php endwhile; ?>
</ul>

</div>


<?php } ?>
</div>
</div>
<?php }



// END OF OFFICES
// BEGINNING OF PEOPLE

 elseif(get_sub_field('type') == 'people'){ ?>
	 <div class="contacts_az">

	 	<div class="contact_list">
	 		<div class="container">
	 <ul class="people row">
	 	<?php $post_count = 1; ?>
		<?php $firstletter = ""; ?>


<?php $letters = array('A'=>false, 'B'=>false, 'C'=>false, 'D'=>false, 'E'=>false, 'F'=>false, 'H'=>false, 'I'=>false, 'J'=>false, 'K'=>false, 'L'=>false, 'M'=>false, 'N'=>false, 'O'=>false, 'P'=>false, 'Q'=>false, 'R'=>false, 'S'=>false, 'T'=>false, 'U'=>false, 'V'=>false, 'W'=>false, 'X'=>false, 'Y'=>false, 'Z'=>false); ?>



		<?php $args = array(
		'post_type' => 'person',
		'posts_per_page' => -1,
		'meta_key'			=> 'surname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
		query_posts($args); while (have_posts()) : the_post(); ?>
		<?php $old_firstletter = $firstletter ?>
		<?php $surname = get_field('surname'); ?>
		<?php $surname = preg_replace('/\s+/', '', $surname); ?>
		<?php $firstletter = substr($surname, 0, 1); ?>
		<?php if($firstletter != $old_firstletter){
			$post_count = 1;
			echo '</ul><div class="people_letter" id="' . $firstletter .'">' . $firstletter . '</div><ul class="people row">';

			$letters[$firstletter]=true;

		} ?>

		<?php $post_id = get_the_ID(); ?>
		<li class="person col-sm-4">
			<div class="profile_details">
				<h2><?php the_title(); ?></h2>
				<p>
				<?php if (get_field('telephone', $post_id)) { echo '&#9743; Phone: ' . get_field('telephone', $post_id) .  ' <br>';} ?>
				<?php if (get_field('mobile', $post_id)) { echo '&#9990;	 Mobile: ' . get_field('mobile', $post_id) .  ' <br>';} ?>
				<?php if (get_field('email', $post_id)) { echo '&#9993; Email: ' . get_field('email', $post_id) .  ' <br>';} ?>

				</p>
			</div>
		</li>
		<?php if($post_count % 3 == 0){echo "</ul><ul class='people row'>";} ?>

		<?php $post_count++; ?>
		<?php endwhile; ?>

	 </ul>

 </div>
 </div>

	<div class="alphabet">
		<div class="container">
			<ul>
				<?php foreach($letters as $letter => $active) { ?>
					<li>
						<?php if($active){echo '<a href ="#' . $letter .'">' . $letter .'</a>';}
						else{echo $letter; } ?>
					</li>
				<?php }?>
			</ul>
		</div>
	</div>
 </div>
	<?php } elseif(get_sub_field('type') == 'function'){ ?>

	<div class="container">

	<?php $offices = get_sub_field('offices'); ?>
<?php $count = 1; ?>
	<?php foreach ($offices as $value) {

		 $value->post_title;
		 $id = $value->ID;

	?>
	<div class="office_list">
<?php if($count == 1){ ?>
		<ul class="people city">
				<li class="person">
						<div class="profile_picture">
								<div class="image_from_background" style="background-image: url('<?php echo get_field('flag', $id)['url']; ?>"></div>
						</div>
						<div class="profile_details">
								<h2><?php echo get_field('function', $id); ?></h2>
								<p>
									<?php if (get_field('address', $id)) { echo get_field('address', $id) . ', ';} ?>
									<?php if (get_field('postcode', $id)) { echo get_field('postcode', $id);} ?>
									 <?php echo get_field('suburb', $id); ?> - <?php echo get_field('country', $id); ?> <br />
									 <?php if (get_field('telephone', $id)) { echo 'TEL : ' . get_field('telephone', $id);} ?>
									 <?php if (get_field('telephone', $id) && get_field('fax', $id)) { echo ' - ';} ?>
									 <?php if (get_field('fax', $id)) { echo 'FAX : ' . get_field('fax', $id);} ?><br />
									<?php if (get_field('email', $id)) { echo '<a href="' . get_field('email', $id) . '">' . get_field('email', $id) . '</a>';} ?>
									</p>
								</div>

						</li>

				</ul>
				<?php } else { ?>
					<ul class="people city">
						<li class="person">
						<div class="profile_details">
								<h2><?php echo get_field('function', $id); ?></h2>
								<p>
									 <?php if (get_field('telephone', $id)) { echo 'TEL : ' . get_field('telephone', $id);} ?>
									 <?php if (get_field('telephone', $id) && get_field('fax', $id)) { echo ' - ';} ?>
									 <?php if (get_field('fax', $id)) { echo 'FAX : ' . get_field('fax', $id);} ?><br />
									<?php if (get_field('email', $id)) { echo '<a href="' . get_field('email', $id) . '">' . get_field('email', $id) . '</a>';} ?>
									</p>
								</div>
							</li>

					</ul>

				<?php } ?>
				<ul class="people row">
					<?php $post_count = 1; ?>

	<?php $args = array(
	'post_type' => 'person',
	'meta_query' => array(
	        array(
	            'key' => 'office',
	            'value' => $id,
	            'compare' => 'LIKE'
	        )
				));
	query_posts($args); while (have_posts()) : the_post(); ?>

	<?php $post_id = get_the_ID(); ?>
	<li class="person col-sm-4">
		<div class="profile_details">
			<h2><?php the_title(); ?></h2>
			<p>
			<?php if (get_field('telephone', $post_id)) { echo '&#9743; Phone: ' . get_field('telephone', $post_id) .  ' <br>';} ?>
			<?php if (get_field('mobile', $post_id)) { echo '&#9990;	 Mobile: ' . get_field('mobile', $post_id) .  ' <br>';} ?>
			<?php if (get_field('email', $post_id)) { echo '&#9993; Email: ' . get_field('email', $post_id) .  ' <br>';} ?>

			</p>
		</div>
	</li>
	<?php if($post_count % 3 == 0){echo "</ul><ul class='people row'>";} ?>

	<?php $post_count++; ?>
	<?php endwhile; ?>
	</ul>

	</div>

	<?php $count++; ?>
	<?php } ?>
	</div>
	</div>

	<?php } ?>

<?php wp_reset_query(); ?>
