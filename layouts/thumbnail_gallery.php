<?php

$output = "";

$type = get_sub_field('type');
$images = get_sub_field('gallery');
$size = 'thumbnail';


//BUILD OUTPUT
$output .= '<section class="layout layout--thumbnail-gallery">';
$output .= '<div class="row">';

$output .= '<div class="layout--thumbnail-gallery__gallery gallery owl-carousel gallery-carousel">';

if( $images ):

    foreach( $images as $image ):

        $theimage = wp_get_attachment_image_src( $image['ID'], "large" );

            $output .= '<div class="item"><a href="'.$theimage[0].'">'.wp_get_attachment_image( $image['ID'], $size ).'</a></div>';
    endforeach;

endif;

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
