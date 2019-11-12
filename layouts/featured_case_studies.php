<?php
$output = "";

$caseStudies = get_sub_field('case_study');
$textArea = get_sub_field('text_area');
$size = 'medium';
$category = get_sub_field('post_list_category');

if($caseStudies):

$output .= '<section class="layout layout--featured-case-studies">';
$output .= '<div class="row pad-around">';

$output .= '<span class="white-dot"></span>';

$output .= '<h3>Who We Work With</h3>';

  $output .= '<div class="layout--featured-case-studies__case-studies">';

  if( have_rows('case_study') ):
    while ( have_rows('case_study') ) : the_row();

$caseStudies = get_sub_field('case_study');


foreach( $caseStudies as $caseStudy ):

        $featured_img_url = get_the_post_thumbnail_url($caseStudy->ID,'large');

        $output .= '<div class="layout--who-we-work-with__ctas__cta cta" style="background-image:url(\''.$featured_img_url .'\')">';
        $output .= '<article><p>'.get_the_title( $caseStudy->ID ) .'</p><a class="button button--primary" href="'.get_permalink($caseStudy->ID ).'">Learn More</a></article>';
        $output .= '</div>';

endforeach;

          endwhile;
      else :
          // no rows found
      endif;


$output .= '</div>';

//$output .= '<div class="layout--featured-case-studies__text-area"><h3>All Projects</h3><article>'.$textArea.'</article></div>';

if ($category) {

  $args = array(
    'cat' => $category,
     'order'           => 'ASC',
     'orderby'         => 'menu_order',
     'posts_per_page'  => '-1'
  );

$output .= '<div class="layout--featured-case-studies__text-area"><h3>All Projects</h3>';
$output .= '<article><ul>';

$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
while ($the_query->have_posts()) {
$the_query->the_post();

$output .= '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

}
}

wp_reset_postdata();

$output .= '</ul></article>';
$output .= '</div>';


}


$output .= '</div>';
$output .= '</section>';

endif;

echo $output;
