<?php

$output = "";

//GET VALUES OF ITEMS
$type = get_sub_field('type');
$content = get_sub_field('content');

//BUILD OUTPUT
$output .= '<section class="layout layout--text-area layout--text-area--'.$type.'">';
$output .= '<div class="row"><div>';
$output .= $content;
$output .= '</div></div>';

if ($type == "lead") {
  $output .= '<div class="layout--text-area--lead__motif" style="background-image:url(\''.get_template_directory_uri().'/img/svg/motif.svg\')"></div>';
  }

$output .= '</section>';

echo $output;
