<?php

$output = "";

$images = get_sub_field('gallery');
$size = 'medium';


//BUILD OUTPUT
$output .= '<section class="layout layout--grid-gallery">';
$output .= '<div class="row">';

$output .= '<div class="layout--grid-gallery__grid gallery">';

if( $images ):
    foreach( $images as $image ):
          $image_attributes = wp_get_attachment_image_src( $image["image"]["ID"], "large" );
          $image_attributes_med = wp_get_attachment_image_src( $image["image"]["ID"], $size);
          //wp_get_attachment_image( $image["image"]["ID"], $size )

            $output .= '<div class="layout--grid-gallery__grid__item lightbox-image">';
              $output .= '<a class="light" data-link="'.$image["link"]["url"].'" title="'.$image["title"].'" href="'.$image_attributes[0].'">';
                $output .= '<span class="layout--grid-gallery__grid__item__image"><img title="<a href=\''.$image["link"]["url"].'\'>'.$image["title"].'</a>" alt="'.$image["title"].'"src="'.$image_attributes_med[0].'"/>"</span>';
                //'.$image["link"]["url"].'
              $output .= '</a>';
              $output .= '<div class="layout--grid-gallery__grid__item__content"><p class="layout--grid-gallery__grid__item__title"><a href="'.$image["link"]["url"].'">'.$image["title"].'</a></p></div>';
            $output .= '</div>';
    endforeach;
endif;

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
