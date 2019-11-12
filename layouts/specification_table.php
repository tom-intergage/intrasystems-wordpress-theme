<?php

$output = '';

if( have_rows('table') ):

  $output .= '<section class="layout layout--specification-table">';

  $output .= '<div class="pad-around">';

  $output .= '<h2>Specification Guidelines</h2>';

  $output .= '<div class="row"><div class="layout--specification-table__table">';

    while ( have_rows('table') ) : the_row();

        $output .= '<div class="layout--specification-table__table__row">';
          $output .= '<div class="layout--specification-table__table__row__title">'.get_sub_field('row_title').'</div>';
          $output .= '<div class="layout--specification-table__table__row__content">'.get_sub_field('row_content').'</div>';

        $output .= '</div>';
    endwhile;

    $output .= '</div></div></div>';

    $output .= '</section>';

endif;

echo $output;
