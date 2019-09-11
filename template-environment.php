<?php
/*
Template name: Environment
*/

get_header(); ?>

<?php
$cycle_title = get_field('cycle_title');
$cycle_desktop = get_field('cycle_desktop');
$cycle_mobile = get_field('cycle_mobile');

?>
	<div class="secondary-bg">
	<section>
<div class="row inner-width text-center">
<?php

// check if the repeater field has rows of data
if( have_rows('top_icons') ):

 	// loop through the rows of data
    while ( have_rows('top_icons') ) : the_row();
?>
<div class="featured-icons ">
<?php

        // display a sub field value
        $image = get_sub_field('icon_image');
        echo wp_get_attachment_image( $image , 'full' );
        echo "<p class='icon-label'>";
        the_sub_field('icon_label');
        echo "</p>";
?>
</div>

<?Php

    endwhile;

else :

    // no rows found

endif;


?>	
</div>
</section>
	</div>
	<div id="primary" class="inner-width content-area">

		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
            <section >
            <div class="row">
				<?php get_template_part( 'template-parts/content', 'page' );

							
				 ?>
				</div>
				</section>
			<?php endwhile; ?>

		</main>
	</div>

	<div class="secondary-bg text-center">
		
		<section>
		<div class="row ">
				<?php 

				if ($cycle_title){
					echo "<h2>".$cycle_title."</h2>";
				}
				if($cycle_desktop){
					?>
					<div class="show-for-large-up">

					<?php
					echo wp_get_attachment_image( $cycle_desktop, 'full' );

					
					?>
					</div>

					<?php
				}
				if($cycle_mobile){
					?>
					<div class="hide-for-large-up">

					<?php
					echo wp_get_attachment_image( $cycle_mobile, 'full' );
					?>
					</div>
					<?php
				}				
				 ?>
				</div>
		</section>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
