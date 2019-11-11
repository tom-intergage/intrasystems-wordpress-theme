<?php

$output = "";

$type = get_sub_field('type');
$images = get_sub_field('gallery');
$size = 'medium';


//BUILD OUTPUT
$output .= '<section class="layout layout--thumbnail-gallery">';
$output .= '<div class="row">';

$output .= '<div class="layout--thumbnail-gallery__gallery gallery owl-carousel gallery-carousel">';

if( $images ):

    foreach( $images as $image ):

            $output .= '<div class="item"><span>'.wp_get_attachment_image( $image['ID'], $size ).'</span></div>';
    endforeach;

endif;

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
