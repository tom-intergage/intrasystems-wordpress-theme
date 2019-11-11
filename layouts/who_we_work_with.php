<?php

$output = "";

//GET VALUES OF ITEMS
$title = get_sub_field('title');
$content = get_sub_field('content');
$ctas = get_sub_field('ctas');


//BUILD OUTPUT
$output .= '<section class="layout layout--who-we-work-with" style="background-image:url(\''.get_template_directory_uri().'/img/svg/hatched-background.svg\')"><div>';
$output .= '<h2 class="layout--who-we-work-with__title">'.$title.'</h2>';
$output .= '<div class="layout--who-we-work-with__introduction">'.$content.'</div>';


if( have_rows('ctas') ):

  $output .= '<div class="row"><div class="layout--who-we-work-with__ctas">';

    while ( have_rows('ctas') ) : the_row();

        $output .= '<div class="layout--who-we-work-with__ctas__cta cta" style="background-image:url(\''.get_sub_field('cta_image')['url'] .'\')">';
        $output .= '<article><p>'.get_sub_field('cta_title') .'</p><a class="button button--primary" href="'.get_sub_field('cta_link')['url'] .'">Learn More</a></article>';
        $output .= '</div>';

    endwhile;

    $output .= '</div></div>';

else :


endif;


$output .= '</div></section>';

echo $output;
