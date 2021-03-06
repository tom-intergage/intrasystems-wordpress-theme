<?php

$output = "";

$type = get_sub_field('type');
$title = get_sub_field('title');
$content = get_sub_field('content');
$images = get_sub_field('gallery');
$size = 'medium';

$cta_text = get_sub_field('cta_text');
$cta_link = get_sub_field('cta_link');


//BUILD OUTPUT
$output .= '<section class="layout layout--gallery-with-text">';
$output .= '<div class="row">';

$output .= '<div class="layout--gallery-with-text__gallery gallery">';

if( $images ):
    $output .= '<ul>';
    foreach( $images as $image ):

            $output .= '<li><span>'.wp_get_attachment_image( $image['ID'], $size ).'</span></li>';
    endforeach;
    $output .= '</ul>';
endif;

$output .= '</div>';

$output .= '<div class="layout--gallery-with-text__text">';

$output .= '<div>';

$output .= '<h2 class="heading--boxed">'.$title.'</h2>';

$output .= '<div class="layout__content">';
$output .= '<p>'.$content.'</p>';

if ($cta_link && $cta_text) {

  $output .= '<p><a class="button button--primary" href="'.$cta_link["url"].'">'.$cta_text.'</a></p>';
}

$output .= '</div>';

$output .= '</div>';

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
