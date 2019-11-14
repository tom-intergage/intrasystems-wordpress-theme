<?php

$sustainableGoals = get_field('sustainable_goals', 'option');

$image = $sustainableGoals["background_image"]["url"];
$lineOne = $sustainableGoals["header_line_one"];
$lineTwo = $sustainableGoals["header_line_two"];

//FOREST OVERWRITE FOR CUSTOM FIELD ON DEV SERVER
$image = get_template_directory_uri().'/img/forest.jpg';

$output = "";

$output .= '<section class="sustainable-goals" style="background-image:url(\''.$image.'\')">';


$output .= '<div class="row">';

$output .= '<h2>'.$lineOne.'<span>'.$lineTwo.'</span></h2>';

$output .= '<p><a class="button button--primary button--large" href="'.get_site_url().'/sustainability/">Learn More</a></p>';

$output .= '<div class="sustainable-goals__icons">';
$output .= '<div class="sustainable-goals__icons__icon"><img src="'.get_template_directory_uri().'/img/econyl-logo-white.png"/></div>';
$output .= '<div class="sustainable-goals__icons__icon"><img src="'.get_template_directory_uri().'/img/svg/alu.svg"/></div>';
$output .= '</div>';

$output .= '</div>';

$output .= '</section>';

echo $output;
