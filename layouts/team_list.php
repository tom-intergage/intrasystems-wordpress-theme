<?php

$output = "";
$teamMembers = get_field('team', 'option');
$size = 'medium';
//get_sub_field('teamMember');

//BUILD OUTPUT
$output .= '<section class="layout layout--team-list">';
$output .= '<div class="row">';

$output .= '<div class="layout--team-list__grid">';

if( $teamMembers ):
    foreach( $teamMembers as $teamMember ):
          //wp_get_attachment_image( $teamMember["image"]["ID"], $size )
            $output .= '<div class="layout--team-list__grid__item">';
              $output .= '<span class="layout--team-list__grid__item__image">'.wp_get_attachment_image( $teamMember["image"]["ID"], $size).'</span>';
              $output .= '<div class="layout--grid-gallery__grid__item__content">';
              $output .= '<p class="layout--team-list__grid__item__title">'.$teamMember["name"].'</p>';
              $output .= '<p class="layout--team-list__grid__item__description">'.$teamMember["role"].'</p>';
              $output .= '<p class="layout--team-list__grid__item__location">'.$teamMember["location"].'</p>';
              $output .= '<p class="layout--team-list__grid__item__link"><a class="button" target="_blank" href="'.$teamMember["linkedin"].'">LinkedIn</a></p>';
              $output .= '</div>';
            $output .= '</div>';
    endforeach;
endif;

$output .= '</div>';

$output .= '</div>';
$output .= '</section>';

echo $output;
