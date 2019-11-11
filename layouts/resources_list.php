<?php

$output = "";

$resources = get_sub_field('resources');
$size = 'medium';


//BUILD OUTPUT
$output .= '<section class="layout layout--resources-list">';
$output .= '<div class="row">';

$output .= '<div class="layout--resources-list__grid">';

if( $resources ):
    foreach( $resources as $resource ):
          //wp_get_attachment_image( $resource["image"]["ID"], $size )
            $output .= '<div class="layout--resources-list__grid__item">';
              $output .= '<span class="layout--resources-list__grid__item__image">'.wp_get_attachment_image( $resource["image"]["ID"], $size).'</span>';
              $output .= '<div class="layout--grid-gallery__grid__item__content">';
              $output .= '<p class="layout--resources-list__grid__item__title">'.$resource["title"].'</p>';
              $output .= '<p class="layout--resources-list__grid__item__description">'.$resource["description"].'</p>';
              $output .= '<p class="layout--resources-list__grid__item__download"><a class="button" target="_blank" href="'.$resource["file"]["url"].'">Download</a></p>';
              $output .= '</div>';
            $output .= '</div>';
    endforeach;
endif;

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
