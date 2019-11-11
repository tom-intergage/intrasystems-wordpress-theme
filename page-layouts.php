<?php

/* Template Name: Page Builder Page  */

/**
 *  IntraSystems Home Page Template
 *
 * This is the September 2019 Home Page Template
 *
 * @package axishouse
 */
get_header();

while (have_posts()) :

  the_post();

$id = get_the_ID();



if ( have_rows( 'layouts', $id ) ) :

    while ( have_rows( 'layouts', $id ) ) :

      the_row();

        get_template_part( 'layouts/' . get_row_layout() );

    endwhile;

endif;

endwhile;

?>



<?php

get_sidebar();
get_footer();
