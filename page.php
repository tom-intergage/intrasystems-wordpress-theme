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

	<div id="primary" class="inner-width content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>
            <section >
            <div class="row" id="default-styling">
            	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				</div>
				</section>
			<?php endwhile; ?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
