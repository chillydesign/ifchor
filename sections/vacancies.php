<?php
$vacancies_args = array(
    'post_type' => 'vacancy',
    'posts_per_page' =>  -1
);
$vacancies = new WP_Query( $vacancies_args );

$vacancy_categories = get_terms('vacancy_category');
$vacancy_locations = get_terms('vacancy_location');


?>
<section id="vacancy_section">
    <div class="container">


        <div id="vacancies_header">
            <h2>Vacancies</h2>
            <form action="">
                <div class="vacancy_filter">
                    <label for="vacancy_category">Category</label>
                    <select name="vacancy_category" id="vacancy_category">
                        <option value="">All categories</option>
                        <?php foreach ($vacancy_categories as $category) : ?>
                            <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="vacancy_filter">
                    <label for="vacancy_location">Location</label>
                    <select name="vacancy_location" id="vacancy_location">
                        <option value="">All locations</option>
                        <?php foreach ($vacancy_locations as $location) : ?>
                            <option value="<?php echo $location->slug; ?>"><?php echo $location->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>




        <?php if ( $vacancies->have_posts() ) :  ?>
            <div class="vacancies_container">
                <?php for ($i=0; $i < 3 ; $i++) { ?>        <?php  } ?>
                <?php while($vacancies->have_posts()) : $vacancies->the_post();  ?>
                    <?php $id = get_the_ID() ; ?>
                    <?php $locations = get_the_terms( $id, 'vacancy_location' ); ?>
                    <?php $locations_data = terms_to_name_data($locations); ?>
                    <?php $location_string = terms_to_name_string($locations); ?>
                    <?php $cats = get_the_terms( $id, 'vacancy_category' ); ?>
                    <?php $cats_data = terms_to_name_data($cats); ?>
                    <div class="single_vacancy" data-categories='<?php echo $cats_data; ?>'  data-locations='<?php echo $locations_data; ?>'>
                        <?php $permalink = get_the_permalink();  ?>
                        <h3><a href="<?php echo $permalink; ?>" title="<?php the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <footer><?php echo $location_string; ?></footer>
                    </div>
                <?php  endwhile; ?>


            </div>

            <div id="no_vacancies_message" style="display:none">
                <p>Sorry. No vacancies currently.</p>
                <p>We always like getting cvs though. Please send yours to <a href="mailto:person@email.com">person@email.com</a> and we might consider you. </p>
            </div>

        <?php else: ?>
            <div id="no_vacancies_message">
                <p>Sorry. No vacancies currently.</p>
                <p>We always like getting cvs though. Please send yours to <a href="mailto:person@email.com">person@email.com</a> and we might consider you. </p>
            </div>

        <?php endif;  ?>
        <?php wp_reset_query(); ?>
    </div>
</section>
