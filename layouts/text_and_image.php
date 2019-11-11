<?php
$output = "";

$text = get_sub_field('text');
$image = get_sub_field('image');
$size = "large";


$output .= '<section class="layout layout--text-and-image">';
$output .= '<div class="row">';

$output .= '<div class="layout--text-and-image__text textarea">';

$output .= $text;

$output .= '</div>';

$output .= '<div class="layout--text-and-image__image image image--blue-drop">';

$output .= wp_get_attachment_image( $image['ID'], $size );

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
