<?php 
/*
Template name: Free samples
*/
get_header();?>
 
<?php
while(have_posts())
{
  the_post();
  $img = get_post_thumbnail_id();
  $img = wp_get_attachment_image_src($img, 'original');
  $any = get_post_meta(get_the_ID(), 'Any fabric text', true);
  $samples = get_post_meta(get_the_ID(), 'Samples text', true);
?>

  <section class="padding">
    <div class="row">
    <div class="excerpt-width">
    
     
      
        <?php the_content();?>
      
        </div>
      
      </div> 
      </section>
  
<section class="secondary_bg grey-bg">
  
  
  <div class="row ">
  
    <div class="excerpt-width box_chose_sample">
      <h1><?php the_title();?></h1>
   
    </div>
    </div>
      <div class="row"><ul class="list_chose_sample">
            
      </ul> 
      <p class="sample-message" >Select your preferred samples below</p> 
      </div>      
<div class="row">
      <a class="large-blue-btn  " href="javascript:void(0);"  id="order">Order samples</a>
       <a class="large-blue-btn  sample-request-form" href="#block-form2"  id="trigger-block-form2">trigger</a>
    
      </div>


 
<button class="btn--order--samples" id="trigger-block-form2" style="display:none;">View Selected Samples and Order</button>



  </section>

    <?php
  $args = array(
         'post_type' => 'products',
         'posts_per_page'=>'-1',
      );


$the_query = new WP_Query($args);
      if ( $the_query->have_posts() ) { 

         ?> 
         <section>
       <div class="row">
       <form>
       <div class="form-options">
         <?php 
         while ( $the_query->have_posts() ) {
            $the_query->the_post();

            ?>
          
            <?php 
            $post_id = get_the_ID();
           // echo $post_id."  ".get_the_title();

            if( !get_field('accessories') ){

            ?>
   <div class="styled_checkbox_wrapper">
   <li  class="prod_id_<?php echo $post_id; ?>"><input class="input-checkbox styled_checkbox" id="prod_<?php echo $post_id; ?>" type="checkbox" name="term_prod_style[]" value="<?php echo $post_id; ?>" checked /><span class="fake_checkbox"></span> <label for="prod_<?php echo $post_id ?>" ><?php echo get_the_title(); ?></label></li>
   </div> 
<?php

        }

}
?>
</div>
<div class="form-buttons">

  <input type="checkbox" id="checkAll" checked><label for="checkAll">Clear All Selected</label>
</div>

</form>
</div>
</section>
<?php
}
wp_reset_postdata();

?>

<?php
}
?>

  <div class="container">
  

<?php $output =""; ?>
  <div class="sample_options">
   
   <?php
      $args = array(
         'post_type' => 'products',
         'posts_per_page'=>'-1',
      );
      $the_query = new WP_Query($args);
      if ( $the_query->have_posts() ) { 

         ?> 
         
       
         <?php 
         while ( $the_query->have_posts() ) {
            $the_query->the_post();

            ?>
            <div class=""><div class="row">

            <?php $prod_title = $post->post_name; ?>
            <a id="<?php echo $prod_title; ?>" style="height:12px;display:inline-block;width:100%;"></a>
            
            <?php 
            $post_id = get_the_ID();
            $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'prod_featured-small' ); 
            if(!$prod_featured_img){
               $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' ); 
            }

            ?>

            <?php if (get_field('show_variations')){ ?>
            <div class="row row_prod fullWidth_prod" id="box_prod_<?php echo $post_id; ?>">
            <div class="main_prod">
            <div class=""><img src="<?php echo $prod_featured_img[0]; ?>" ></div>
            <?php 
           
         
            $logo_black = get_field('logo_black');
            ?>
            
           
            <?php
            if($logo_black){
            ?>
            <img src="<?php echo $logo_black['url']; ?>" alt="<?php echo $logo_black['alt']; ?>">
            <?php
            }
            else{
               ?><p class='raleway-font'><?php echo get_the_title(); ?></p>
            <?php  
            }
            ?>
            </div>


            <?php 
            $var_finish_opc = array('Standard', 'Black Finish', 'Bronze Finish', 'Single Module', 'Double Module');
            ?>
<div class="variation_options">
            <?php

            foreach ($var_finish_opc as $v_opc){
              $counter2 = 0;

              ?>
<div >

            <?php
 while( have_rows('prod_var') ){ the_row(); ?>
 <?php 

  $variations = get_sub_field('variations');

  if($variations){
    if(get_sub_field('var_cat')){ ?>

  <?php }

  $counter = 0;
 

      foreach($variations as $v){

        

       // echo $v->name;
       // echo "<br>";

         
       //  echo get_term_link($v);
                       $args  = array(
              'post_type' => 'variations',
              'tax_query' => array(
                  array(
                  'taxonomy' => 'var_prod',
                  'field' => 'id',
                  'terms' => $v->term_id
                   ),
                 array(
                  'taxonomy' => 'var_finish',
                  'field' => 'name',
                  'terms' => $v_opc
                   ),
                )
              );
       //  print_r($args);

         $var_query = get_posts($args);
         if($var_query){


          
        
        
 
           foreach ($var_query as $vq) { 
                  
         if($counter2 == 0){ ?>
        <h3 class="main-category"> <?php echo $v_opc; ?></h3>
          <?php }
          if ($counter == 0){
 if(get_sub_field('var_cat')){ ?>
  <h3><?php echo get_sub_field('var_cat'); ?></h3>
  <?php }

        }
        $counter = 1;

      
        $counter2 = 1;

               $var_id = $vq->ID;
               $var_img = get_the_post_thumbnail( $var_id , 'variations-thumb');
               $var_label = get_field('var_label', $var_id);

               ?>
             <li class="variation sample-<?php echo $var_id; ?>" >

               <div class="var_img"><?php echo $var_img; ?></div>
                  <a href="javascript:void(0);"  onclick="add_sample(<?php echo $var_id;?>, '<?php echo $v->name; ?>', '<?php echo $v_opc; ?>')" class="sample_add"></a>
                 <a href="javascript:void(0);"  onclick="remove_sample(<?php echo $var_id;?>);" style="display:none;" class="chose"></a>
               <span class="var_desc"><?php echo get_field('var_label', $var_id); ?></span>

               
               </li>
               <?php 
        
            }
         }
       //  wp_reset_postdata();

    }

  } //---End if $variations
   
  } // -- End while prod_var
  ?> </div> <!-- // end variation_options -->
              <?php
            }
            ?>





  </div>









  </div>

  <?php } ?>
  </div></div>
  <?php   } // -- End products query
   ?>

 

         <?php
     
      } 
   //   wp_reset_postdata();
   ?>
    </div>
    
 
</div>

    
    <div class="clear"></div>

  
  </div>
  
<script src="<?php bloginfo('template_url');?>/js/free-samples.js">
</script>  


<div id="block-form2" class='popup-form-download' style='display:none;'>

   <div>
    
      <div class="form_box">

                  <?php echo do_shortcode('[contact-form-7 id="3133" title="Free Sample Request"]');?>

 
      </div>
   </div>

   <div class="overlay "></div>

</div>


<?php get_footer();?>