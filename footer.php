<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package axishouse
 */

?>

<?php
if ( get_post_status ( 153 ) == 'publish' ) {

$footer_tel = get_field('tel', 153 );
$footer_fax = get_field('fax', 153 );
$footer_email = get_field('email', 153 );
$footer_address_1 = get_field('address_1', 153 );
$footer_address_2 = get_field('address_2', 153 );
$footer_city = get_field('city', 153 );
$footer_zipcode = get_field('zipcode', 153 );

}?>


	</div>

	<footer id="colophon" class="site-footer">

	<div class="footer-black">

		<div class="footer-middle">

			<div class="row">

			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div id="footer-widget-1" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div id="footer-widget-2" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div id="footer-widget-3" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			<?php endif; ?>

			<div class="clearfix"></div>

		</div>

		</div>

		<div class="footer-bottom">

			<div class="row">

		<div class="footer-copyright">
		   <p>&copy; <?php echo date('Y'); ?> IntraSystems</p>
		</div>

		<div class="footer-navigation">
		   <nav>
			   <?php axishouse_footer_links(); ?>
		   </nav>
		</div>

		<div class="footer-intergage">
			<a href="https://intergage.co.uk" rel="noopener" target="_blank" name="Intergage"><img src="<?php echo get_template_directory_uri() ?>/img/svg/intergage.svg" alt-"intergage logo"/></a>
		</div>

		</div>
	</div>
</div>
	</footer>

	<?php

if ( is_user_logged_in() ) {
?>

<div id="sample-basket-outer">
	<div id="sample-basket" class="sample-basket" data-url="<?php echo get_site_url() ?>">
		<div>
			<div class="sample-basket__progress">
				<div class="sample-basket__progress__stage type">
					<article>
						<span class="sample-basket__progress__stage__number">1</span>
						<span class="sample-basket__progress__stage__title">Select Type</span>
					</article>
				</div>
				<div class="sample-basket__progress__stage product">
					<article>
						<span class="sample-basket__progress__stage__number">2</span>
						<span class="sample-basket__progress__stage__title">Select Product</span>
					</article>
				</div>
				<div class="sample-basket__progress__stage finish">
					<article>
						<span class="sample-basket__progress__stage__number">3</span>
						<span class="sample-basket__progress__stage__title">Select Finishes</span>
					</article>
				</div>
				<div class="sample-basket__progress__stage checkout">
					<article>
						<span class="sample-basket__progress__stage__number">4</span>
						<span class="sample-basket__progress__stage__title">Submit Request</span>
					</article>
				</div>
			</div>
			<div class="sample-basket__close">
				<span>Close</span>
			</div>
			<div class="sample-basket__content">
				<div class="sample-basket__content__stage">
					<div class="sample-basket__content__types">
						<h2>Sample Select Tool</h2>

						<p class="loading">Loading Sample Select Tool</p>

						<p>Our sample select tool allows you to order samples of any of our products. It's a new feature that we're working on - if you're having any issues please give us a call on <a href="tel:+441425472000">+44(0)1425 472000</a> or email on <a href="mailto:info@intrasystems.co.uk">info@intrasystems.co.uk</a></p>
						<div class="sample-basket__content__types__list">


							<article class="sample-basket__content__types__type" data-product-category="464" data-product-type="matting">
								<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/09/INTRAflex-XT-172x134.png" alt="Ceilings Image"/>

								<p>Matting</p>
							</article>
							<article class="sample-basket__content__types__type" data-product-category="465" data-product-type="grilles">
										<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/08/INFD231-172x107.png" alt="Ceilings Image"/>
								<p>Grilles</p>
							</article>
							<article class="sample-basket__content__types__type" data-product-category="466" data-product-type="ceilings">
								<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/08/IN32B31-172x107.png" alt="Ceilings Image"/>

								<p>Ceilings</p>
							</article>
						</div>

					</div>
					<div class="sample-basket__content__products">
						<h2>Select a Product</h2>
						<div class="sample-basket__content__products__list">

						</div>
					</div>
					<div class="sample-basket__content__variants">
						<h2>Select Finishes</h2>
						<div class="sample-basket__content__variants__list">

						</div>
					</div>
					<div class="sample-basket__content__basket">

						<h2>Submit Request</h2>
<p>Please complete the form below tosubmit your request. We will be in touch as soon as possible to confirm your selection.</p>
							<?php echo do_shortcode('[contact-form-7 id="3133" title="Free Sample Request"]'); ?>

					</div>
				</div>

			</div>
			<div class="sample-basket__items__wrapper">
				<div class="sample-basket__items"></div>
				<div id="go-to-basket"><span>Request Samples</span></div>
			</div>

		</div>
	</div>
</div>
	<div id="sample-basket-tab"><p>Request a Sample</p></div>

	<?php

	}

		 ?>

</div>

<?php wp_footer(); ?>

<?php get_template_part( 'template-parts/content', 'popup' ); ?>

</body>
</html>
