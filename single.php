<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package axishouse
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		

			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<section class="main-content">
				<div class="row ">
				<div class="text-center">
				<a class="large-blue-btn" href="<?php echo bloginfo('url');?>/projects/">Return to Projects</a>
				</div>
				</div>
         
            <div class="row">


				<div class="entry-content">
					<div class="entry-intro">
						<?php the_content(); ?>
						
					</div>
					<div  class="project_spec_box">
					<?php
						if( have_rows('spec_box') ){ 
					?>
					<div class="project_spec_box_inner">
					<?php 
					   while( have_rows('spec_box') ): the_row();  ?>
					   <div class="project_spec_box_row">
					   <div><?php echo get_sub_field('spec_label'); ?>: </div>
					   <div><?php echo get_sub_field('spec_desc'); ?></div>
					   </div>

					    <?php 
						endwhile;  ?>
					</div>

					<?php

						}
					?>
						
					</div>
				</div>
			</div>
			</section>

<?php if( have_rows('showcase') ){ ?>



<div id='sync1' class='owl-carousel'> 
<?php 
   while( have_rows('showcase') ): the_row();  
      $image = get_sub_field('showcase_img'); // Return object/array
      $thumb = $image['sizes']['showcase'];
?>
<div class='item' style="background-image:url('<?php echo $thumb; ?>')">

    <?php if ( get_sub_field('showcase_title') || get_sub_field('showcase_desc') ){ ?> 
   <div class='row'>

   <div class='plus'>
   
     </div>
   
     </div>
   
      <div class='popup-box'>
      <div class='popup-inner'>
      <div class='popup-close'>
      </div>
   
      <div class='popup-content'>
      <h3>
      <?php echo get_sub_field('showcase_title'); ?> </h3>
      <?php echo get_sub_field('showcase_desc'); ?>
      </div>
      </div>
   </div>
   <?php } ?>
   </div>
   <?php 
	endwhile;  ?>
   </div>
   <?php
} ?>


<div class='slideshow'> 
<?php 
if( have_rows('showcase') ){
?>
<div id='sync2' class='owl-carousel'> 
<?php
   while( have_rows('showcase') ): the_row();  
   
?>
<div class='item'>
<?php
      $image = get_sub_field('showcase_img');
      $thumb = $image['sizes']['showcase-thumb'];
 ?>
 <img src="<?php echo $thumb; ?>">

</div>
<?php
	endwhile; 
?>
</div>
<?php
} 
?>
</div>

<?php if( have_rows('systems') ){ ?>
<section class="no-padding">
<div class="row">
<?php 
   while( have_rows('systems') ): the_row();  
  
?>
<?php

   if(get_sub_field('product')){
   	$new_desc = get_sub_field('prod_desc');
      $post = get_sub_field('product');
      setup_postdata($post);
      ?>
      <div class="post_system">
      <?php
            
            $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
            if(!$prod_featured_img){
               $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'full' ); 
            }
            ?>

         
           <?php $logo_header = get_field('logo_header'); ?>
             <div class="thumb-featured"><img src="<?php echo $prod_featured_img[0]; ?>" ></div>
             <div class='prod-info'>
             
            <!--<img src="<?php echo $logo_header['url']; ?>" alt="<?php  echo get_the_title(); ?> ">-->
            <h3><?php echo get_the_title(); ?></h3>
            <p><?php if ($new_desc) echo $new_desc; else  echo get_field('intro_paragraph'); ?></p>

            <a class='large-blue-btn' href="<?php echo  get_the_permalink(); ?>">View Product</a>
            
            </div>
            

         </div>
         
      
      <?php 
      wp_reset_postdata();   
   } ?> 





<?php
endwhile;
?>
</div>
</section>
<?php
}

?>
<?php  
$more_projects = get_field('more_projects');

if ($more_projects ){
	$cats = array();
foreach(wp_get_post_categories($post->ID) as $c)
{
	$cat = get_category($c);
	array_push($cats,$cat->name);
}

if(sizeOf($cats)>0)
{
	$post_categories = $cats[0];
} 

	?>
				<section class="more_projects gray_bg">
				<div class="row">
					<div class="">
					
					<h3> More Projects
					<?php if ($post_categories) { echo "in ".$post_categories; } ?>

					</h3>	
					<div>
					    <?php foreach( $more_projects as $post): // variable must be called $post (IMPORTANT) ?>
					    	 <?php setup_postdata($post); ?>
					       <div class="single-case-study">
            
              <?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
 $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'case-study-thumb' ); ?>
 
 <img src="<?php echo $image[0]; ?>">
 



<?php }else{
?>
 <img src="<?php echo get_template_directory_uri(); ?>/img/project-default.jpg">
 

<?php

	} ?> 
           <?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
         
            <?php echo "<p>".get_intramatting_excerpt(get_the_excerpt(), 5)."</p>"; 
            ?>
           <?php if (get_field('read_more_link') ){ ?>
            <a class="large-blue-btn"  href="<?php the_permalink() ?>">Read more</a>
            
	
				
         <?php
         }
         ?>
         
</div>
					      
					    <?php endforeach; ?>
					    </div>
					</div>

					</div>
				</section>
	<?php
	wp_reset_postdata();


}


?>




		
</article><!-- #post-## -->

				
			<?php endwhile; ?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php 
function get_intramatting_excerpt($excerpt, $limit ){
  if (str_word_count($excerpt , 0) > $limit) {
          $words = str_word_count($excerpt , 2);
          $pos = array_keys($words);
          $excerpt  = substr($excerpt , 0, $pos[$limit]) . '...';
      }
      return $excerpt ;


}

?>
