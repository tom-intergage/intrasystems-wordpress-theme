<?php
/*
Template name: Spec Guides
*/

get_header(); ?>
 <?php 
			

				if(have_rows('spec_tables')){
					$tabs = "";
					$content ="";
					$counter = 1;
					?>
				

					<?php
					while(have_rows('spec_tables')){
						the_row();
						$title = get_sub_field('title');
						$spec_table = get_sub_field('spec_table');
						if($counter === 1){
							$extraClass = " active"; 
						}
						else{
							$extraClass = "";
						}
						$tabs .= '<li class="tab-title '.$extraClass.'"><a href="#panel_'.$counter.'">'.$title.'</a></li>';
						$content .= ' <div class="content '.$extraClass.'" id="panel_'.$counter.'"><div class="specification">';
						$content .= $spec_table;
						$content .= ' </div></div>';

						$counter++;

					}

					?>
			<section class="no-bottom">
				<div class="row">
				<div class="text-center">
					<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><br>
	</div>
				<div class="small-12 column">

					<ul class="tabs vertical" data-tab>
					  <?php  	echo $tabs; 	?>
					
					</ul>
					<div class="tabs-content">
					  <?php echo $content;	  ?>
					</div>
					</div>
				</div>
				</section>

					<?php

				}

				 
				?>
	<div id="primary" class="inner-width content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			


            <section >
            <div class="row">
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				</div>
				</section>
			<?php endwhile; ?>

		</main>
	</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
