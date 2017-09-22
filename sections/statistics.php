
<div class="container">
<ul class="statistics_list">
    <?php while ( have_rows('statistics') ) : the_row(); ?>
            <?php $end_sign = get_sub_field('end_sign'); ?>
            <?php $number = get_sub_field('number'); ?>
            <?php $text = get_sub_field('text'); ?>

            <li class="statistic">

              <div class="statistic_amount"  data-from="0" data-to="<?php echo $number; ?>">
              <?php echo $number; ?>
              </div>
              <div class="after_stat"><?php echo $end_sign; ?></div>

              <div class="statistic_description">
              <?php echo $text; ?>
              </div>
            </li>


      <?php endwhile; ?>





</ul>

</div>
