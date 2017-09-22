<?php $item_count =  sizeof(  get_sub_field('service')  ); ?>
<?php $i = 1; ?>

<div class="container">
  <div class="services_container">

    <div class="service_box">
      <a href="<?php the_sub_field('link1'); ?>">
        <?php include('drybulk.svg'); ?>
          <h4><?php the_sub_field('title1'); ?></h4>
      </a>
    </div>

    <div class="service_box">
      <a href="<?php the_sub_field('link2'); ?>">
        <?php include('tankers.svg'); ?>
          <h4><?php the_sub_field('title2'); ?></h4>
      </a>
    </div>

    <div class="service_box">
      <a href="<?php the_sub_field('link3'); ?>">
        <?php include('sale-purchase.svg'); ?>
          <h4><?php the_sub_field('title3'); ?></h4>
      </a>
    </div>

    <div class="service_box">
      <a href="<?php the_sub_field('link4'); ?>">
        <?php include('ship-finance.svg'); ?>
          <h4><?php the_sub_field('title4'); ?></h4>
      </a>
    </div>

    <div class="service_box">
      <a href="<?php the_sub_field('link5'); ?>">
        <?php include('research.svg'); ?>
          <h4><?php the_sub_field('title5'); ?></h4>
      </a>
    </div>


  </div>
</div><!--  END OF CONTAINER -->
