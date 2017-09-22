
<div class="container">
    <ul class="languages_list">
        <?php while ( have_rows('languages') ) : the_row(); ?>
            <?php $image = get_sub_field('image'); ?>
            <?php $name = get_sub_field('name'); ?>

            <li class="language">
                <img src="<?php echo $image['url']; ?>" alt="">
                <p><?php echo $name; ?></p>
            </li>


        <?php endwhile; ?>





    </ul>

</div>
