
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

    <?php $address = get_field('address', $id); ?>
    <?php $postcode = get_field('postcode', $id); ?>
    <?php $telephone = get_field('telephone', $id); ?>
    <?php $email = get_field('email', $id); ?>
    <?php $fax = get_field('fax', $id); ?>

    <?php if ($address) { echo $address  . ', ';} ?>
    <?php if ($postcode) { echo $postcode; } ?>
    <?php echo get_field('suburb', $id); ?> - <?php echo get_field('country', $id); ?> <br />
    <?php if ($telephone) { echo 'TEL : <a href="tel:' . $telephone . '">'. $telephone.'</a>' ;} ?>
    <?php if ($telephone && $fax) { echo ' - ';} ?>
    <?php if ($fax) { echo 'FAX : <a href="tel:' . $fax . '">'. $fax.'</a>'; }; ?><br />
    <?php if ($email) { echo '<a href="mailto:' . $email . '">' . $email . '</a>';} ?>
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
        <?php
        $telephone = get_field('telephone', $post_id);
        $mobile = get_field('mobile', $post_id);
        $email = get_field('email', $post_id);
         ?>
		<p>
        <?php if ($telephone) { echo '&#9743; Tel: <a href="tel:'. $telephone.'">' . $telephone .  '</a> <br>';} ?>
        <?php if ($mobile) { echo '&#9990;	 Mobile: <a href="tel:'. $mobile.'">' . $mobile .  '</a> <br>';} ?>
        <?php if ($email) { echo '&#9993; Email: <a href="mailto:' . $email . '">' . $email .  '</a> <br>';} ?>

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
        <?php $letters = array('A'=>false, 'B'=>false, 'C'=>false, 'D'=>false, 'E'=>false, 'F'=>false, 'G' =>false , 'H'=>false, 'I'=>false, 'J'=>false, 'K'=>false, 'L'=>false, 'M'=>false, 'N'=>false, 'O'=>false, 'P'=>false, 'Q'=>false, 'R'=>false, 'S'=>false, 'T'=>false, 'U'=>false, 'V'=>false, 'W'=>false, 'X'=>false, 'Y'=>false, 'Z'=>false); ?>



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
                    <?php
                    $telephone = get_field('telephone', $post_id);
                    $mobile = get_field('mobile', $post_id);
                    $email = get_field('email', $post_id);
                     ?>
				<?php if ($telephone) { echo '&#9743; Tel: <a href="tel:'. $telephone.'">' . $telephone .  '</a> <br>';} ?>
				<?php if ($mobile) { echo '&#9990;	 Mobile: <a href="tel:'. $mobile.'">' . $mobile .  '</a> <br>';} ?>
				<?php if ($email) { echo '&#9993; Email: <a href="mailto:' . $email . '">' . $email .  '</a> <br>';} ?>

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

    <?php $address = get_field('address', $id); ?>
    <?php $postcode = get_field('postcode', $id); ?>
    <?php $telephone = get_field('telephone', $id); ?>
    <?php $email = get_field('email', $id); ?>
    <?php $fax = get_field('fax', $id); ?>


	<?php if ($address) { echo $address  . ', ';} ?>
	<?php if ($postcode) { echo $postcode; } ?>
	 <?php echo get_field('suburb', $id); ?> - <?php echo get_field('country', $id); ?> <br />
     <?php if ($telephone) { echo 'TEL : <a href="tel:' . $telephone . '">'. $telephone.'</a>' ;} ?>
     <?php if ($telephone && $fax) { echo ' - ';} ?>
     <?php if ($fax) { echo 'FAX : <a href="tel:' . $fax . '">'. $fax.'</a>'; }; ?><br />
     <?php if ($email) { echo '<a href="mailto:' . $email . '">' . $email . '</a>';} ?>
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
<?php $telephone = get_field('telephone', $id); ?>
<?php $email = get_field('email', $id); ?>
<?php $fax = get_field('fax', $id); ?>


<?php if ($telephone) { echo 'TEL : <a href="tel:' . $telephone . '">'. $telephone.'</a>' ;} ?>
<?php if ($telephone && $fax) { echo ' - ';} ?>
<?php if ($fax) { echo 'FAX : <a href="tel:' . $fax . '">'. $fax.'</a>'; }; ?><br />
<?php if ($email) { echo '<a href="mailto:' . $email . '">' . $email . '</a>';} ?>
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

    <?php
    $telephone = get_field('telephone', $post_id);
    $mobile = get_field('mobile', $post_id);
    $email = get_field('email', $post_id);
     ?>
    <?php if ($telephone) { echo '&#9743; Tel: <a href="tel:'. $telephone.'">' . $telephone .  '</a> <br>';} ?>
    <?php if ($mobile) { echo '&#9990;	 Mobile: <a href="tel:'. $mobile.'">' . $mobile .  '</a> <br>';} ?>
    <?php if ($email) { echo '&#9993; Email: <a href="mailto:' . $email . '">' . $email .  '</a> <br>';} ?>



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
