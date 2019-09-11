<?php
/**
 * The template for displaying all single posts.
 *
 * @package axishouse
 */

get_header(); ?>


<?php
$output           =  "";
$features         =  get_field('features' ); 
$specification    =  get_field('specification' ); 
$f_operational    =  get_field('operational' ); 
$f_maintenance    =  get_field('maintenance' ); 
$cad_download     =  get_field('cad_download' ); 

$typical_spec     =  get_field('typical_specification' ); 
$manufacturer     =  get_field('manufacturer' ); 
$prod_ref         =  get_field('product_reference' ); 
$prod_desc        =  get_field('product_description' ); 




if( have_rows('profile') ){
   $counter = 0;
   while( have_rows('profile') ): the_row(); 
      $profile[$counter]['tbl'] =  get_sub_field('profile_table'); 
      $profile[$counter]['img'] = get_sub_field('profile_image'); 
      $counter++;
	endwhile; 
} 
//print_r($profile);

if ($manufacturer){
   $post = $manufacturer;
	setup_postdata( $post );    
   $m_tel = get_field('tel' ); 
   $m_fax = get_field('fax' ); 
   $m_email = get_field('email' ); 
   $m_address_1 = get_field('address_1' );
   $m_address_2 = get_field('address_2' );
   $m_city = get_field('city');
   $m_zipcode = get_field('zipcode');
   wp_reset_postdata();  
}

if( have_rows('product_variations') ){
   $counter = 0;
   while( have_rows('product_variations') ): the_row(); 
      $prod_variations[$counter]['title'] =  get_sub_field('title'); 
   if( have_rows('variations') ){
      $counter2 = 0;
      while( have_rows('variations') ): the_row(); 
         $prod_variations[$counter]['variation'][$counter2]['img'] = get_sub_field('image'); 
         $prod_variations[$counter]['variation'][$counter2]['label'] = get_sub_field('label'); 
         $counter2++;
      endwhile;    
   }
      $counter++;
	endwhile; 
} 


//HTML Generation
if ($features){  
   $output .= "<div class='features'><h1>INTRAflex XT Features</h1>";
   $output .= $features;
   $output .= "</div>";
   
}

if ($profile){
   $output .= "<div class='profile'>";
   foreach ($profile as $p){
      $output .= "<div class='profile_tbl'>";
      $output .= $p['tbl'];
      $output .= "</div>";
      $output .= "<div class='profile_img'>";
      $output .= $p['img']['url'];
      $output .= "</div>";      
   }
   $output .= "</div>";
}

if ($specification){ 
   $output .= "<div class='specification'>";  
   $output .= "<h2>Specification</h2>";  
   $output .= $specification;
   $output .= "</div>";   
}
$counter3 = 0;
$counterStarts = 0;
$counterValue = 0;
$content_var ="";
if ($prod_variations){ 
   $output .= "<div class='variations'>";
   

 function recursive($array){
    global $counter3;
    global $counterStarts;
    global $counterValue;
    $counterValue = 0;
    global $content_var;
    
    
    foreach($array as $key => $value){
       
        //If $value is an array.
        if(is_array($value)){
            //We need to loop through it.
           //echo "<div>Start ".$counterStarts;
           $content_var .= "<div>";
           $counterStarts++;
            recursive($value);
           $counterStarts--;
           $content_var .= "</div>";
        } else{
           
           if ($counterStarts == 1){
              $content_var .= "<h3>".$counterValue.": ".$value ."</h4>";
           }else{
              if ($counterValue == 0){
                 $image = wp_get_attachment_image_src($value);
                 $content_var .="<img src='". $image[0]."' >";
              }else{
              
            $content_var .= "<p>".$counterValue.": ".$value ."</p>";
              }
              
           }
           $counterValue++;
       
        }
    }
    return $content_var;
}  
   
$output .= recursive($prod_variations);
   

   
   
   $output .= "</div>";   
}
//print_r($prod_variations);

echo $output;


if ($f_operational || $f_maintenance){ 
   $output .= "<div class='downloads'>"; 
   $output .= "Downloads";
   if ($f_operational){ 
      $output .= "<a href='".$f_operational."'>";
      $output .= "<class='download'>";
      $output .= "Operational Manual";
      $output .= "</div>"; 
      $output .= "</a>";
   }
   if ($f_operational){ 
      $output .= "<a href='".$f_operational."'>";
      $output .= "<class='download'>";
      $output .= "Maintenance Manual";
      $output .= "</div>"; 
      $output .= "</a>";
   }   
   $output .= "</div>"; 
}

$output .= "<div class='prod_footer'>";
if ($typical_spec){
   $output .= "<div>";
   $output .= "<h4>Typical Specification:</h4>";
   $output .= $typical_spec;
   $output .= "</div>";
   
}
if ($typical_spec){
   $output .= "<div>";
   $output .= "<h4>Manufacturer:</h4>";
   $output .= $typical_spec;
   $output .= "</div>";
}
if ($prod_ref){
   $output .= "<div>";
   $output .= "<h4>Product Reference:</h4>";
   $output .= $prod_ref;
   $output .= "</div>";
}
if ($prod_desc){
   $output .= "<div>";
   $output .= "<h4>Product Description:</h4>";
   $output .= $prod_desc;
   $output .= "</div>";
}
$output .= "</div>";
 //  echo $output;  
?>

   

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			

			<?php
				// If comments are open or we have at least one comment, load up the comment template.

			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
