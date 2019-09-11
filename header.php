<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package axishouse
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

  <!-- Google Tag Manager -->

  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start':

          new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],

        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =

        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);

    })(window, document, 'script', 'dataLayer', 'GTM-58ZZXWD');
  </script>

  <!-- End Google Tag Manager -->

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/img/favicons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicons/manifest.json">
  <meta name="msapplication-TileColor" content="#3f5666">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicons/ms-icon-144x144.png">
  <meta name="theme-color" content="#3f5666">
  <meta name="google-site-verification" content="RESfIyAf4KgWU3d31CTCxqdAIQJbKbgvnk6WQ8VddI4" />

  <?php wp_head(); ?>

  <?php

  $bg_header = get_field('bg_header');

  if ($bg_header) {
    $bg_header_url = $bg_header['url'];
  } else {
    $bg_header_url =   get_template_directory_uri() . "/img/intramatting-header-bg-default.jpg";
  }

  if (is_404()) {
    $bg_header_url =   get_template_directory_uri() . "/img/intramatting-header-bg-default.jpg";
  }

  if ('products' == get_post_type() || 'news' == get_post_type()) {

    $logo_header = get_field('logo_header');
    $intro_paragraph = get_field('intro_paragraph');
    $post_id = get_the_ID();
    $prod_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'prod_featured');

    if (!$prod_featured_img) {
      $prod_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
    }
  } else {

    $title = get_field('title');
    $subhead = get_field('subhead');
  }

  if ('products' == get_post_type()) {
    $bg_header = "background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('" . $bg_header_url . "');";
  } else {

    $bg_header_url = $_SERVER['REQUEST_URI'] == '/projects/' ? get_template_directory_uri() . "/img/project-default.jpg" : $bg_header_url;

    $bg_header = "background-image:url(' " . $bg_header_url . "');";
  }

  $header_class = '';

  if (is_page_template('page-shape-selector.php')) {

    $header_class = 'short-header';
  }

  /* - - - - - - - SCHEMA - - - - - - - */
  if ('products' == get_post_type()) {

    $schema_desc = str_replace('<p>', '', $intro_paragraph);
    $schema_desc = str_replace('</p>', '', $schema_desc);

    ?>

    <script type='application/ld+json'>
      {

        "@context": "http://www.schema.org",

        "@type": "product",

        "brand": "INTRAmatting",

        "logo": "https://www.intrasystems.co.uk/wp-content/themes/axishouse/img/intrasystems-logo.png",

        "name": "<?php echo get_field('alt_text'); ?>",

        "category": "Entrance Matting",

        "image": "<?php echo $prod_featured_img[0]; ?>",

        "description": "<?php echo $schema_desc; ?>"

      }
    </script>

  <?php

  } else {

    ?>

    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "INTRAmatting",
        "description": "Entrance Matting manufacturers, suppliers & installers specialising in 21st Century Design using the latest technologies for long lasting heavy duty matting.",
        "legalName": "INTRAmatting",
        "url": "https://www.intrasystems.co.uk/",
        "logo": "https://www.intrasystems.co.uk/wp-content/themes/axishouse/img/logo-intramatting-white.png",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "14 Salisbury Road, Headlands Business Park",
          "addressLocality": "Ringwood",
          "addressRegion": "Hampshire",
          "postalCode": "BH24 3PB",
          "addressCountry": "UK"
        },
        "contactPoint": {
          "@type": "ContactPoint",
          "contactType": "customer support",
          "telephone": "+44(0)1425 472000",
          "email": "info@intrasystems.co.uk"
        },
        "sameAs": [
          "https://www.facebook.com/IntrasystemsUK/",
          "https://twitter.com/intrasystemsuk",
          "https://www.linkedin.com/company/intrasystems-integrated-flooring-solutions/",
          "https://www.instagram.com/intrasystems/"
        ]
      }
    </script>

  <?php

  }

  ?>

  <!--
<script type="text/javascript" src="https://www.22-trk-srv.com/js/81975.js" ></script>
<noscript><img src="https://www.22-trk-srv.com/81975.png" style="display:none;" /></noscript>
-->
<meta name="google-site-verification" content="riNo2wgbZuTKzATyliKbXNd8R8hI9kcZ-T7E3JlU3JQ" /> 
</head>

<body <?php body_class(); ?>>

  <script type="text/javascript" src="https://secure.leadforensics.com/js/81975.js"></script>
  <noscript><img src="https://secure.leadforensics.com/81975.png" style="display:none;" /></noscript>

  <!-- Google Tag Manager (noscript) -->

  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58ZZXWD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

  <!-- End Google Tag Manager (noscript) -->

  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'axishouse'); ?></a>

  <div id="header" style="<?php echo $bg_header; ?>" class="<?php echo $header_class; ?>">

    <header id="masthead" class="site-header">

      <div class="site-branding">
        <div>
          <a href="http://www.intrasystems.co.uk/">
            <img src="<?php echo get_template_directory_uri(); ?>/img/intrasystems-logo.png" alt="<?php bloginfo('name'); ?>">
          </a>
        </div><!-- .site-branding -->
      </div>

      <div class="header-navigation">

        <div class="ah-top-bar-section">

          <div class="row">

            <?php





            ?>

            <nav class="ah-main-navigation">
              <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => 'div')); ?>
            </nav><!-- #site-navigation -->

          </div>

        </div>

        <div class="mobile-nav">

          <div class="menu-btn" id="menu-btn">
            <div></div>
            <span></span>
            <span></span>
            <span></span>
          </div>

          <div class="responsive-menu">

            <nav id="site-navigation" class="ah-main-navigation">
              <?php wp_nav_menu(array('theme_location' => 'mobile', 'menu_id' => 'mobile-menu', 'container' => '')); ?>
            </nav><!-- #site-navigation -->

          </div>

        </div>

      </div>
    </header><!-- #masthead -->
    <div class="header-content">
      <?php

      /* - - - - - - - PRODUCT HEADER - START - - - - - - - */

      if ('products' == get_post_type()) {

        ?>
        <div class="header-prod">

          <div class="row">

            <div class="info">
              <?php

              if ($logo_header) {

                ?>
                <img src="<?php echo $logo_header['url']; ?>">
              <?php

              } else {

                ?>
                <p class='raleway-font'><?php echo get_field('alt_text'); ?></p>
              <?php

              }

              ?>
              <?php echo $intro_paragraph; ?>




              <?php

              $sample_url = $site_url . "/request-free-samples/#" . $post->post_name;
              $sample_btn_txt = 'Request Free Sample';
              $sample_btn_class = '';

              if (get_field('accessories')) {

                $sample_url = '#';
                $sample_btn_txt = 'Read More';
                $sample_btn_class = ' accessories-btn';
              }

              if (get_field('intrashape_content')) {

                ?>
                <a class="yellow-btn yellow-solid-btn" href="/shape-selector/" target="_self" style="width:100%;max-width:420px;">Download PSD to Create Your Own Design</a>
                <a class="blue-btn blue-solid-btn free-samples" href="#free-samples" target="_self" style="width:100%;max-width:420px;">Request Free Sample</a>




              <?php

              } else {

                ?>

                <a class="blue-btn blue-solid-btn<?php echo $sample_btn_class; ?>" href="<?php echo $sample_url; ?>"><?php echo $sample_btn_txt; ?></a>
              <?php

              }

              ?>
            </div>

            <div class="prod-img">
              <img src="<?php echo $prod_featured_img[0]; ?>">
            </div>

          </div>

        </div>

      <?php

      }

      /* - - - - - - - PRODUCT HEADER - END - - - - - - - - */ elseif (is_archive() && single_cat_title('', true)) {

        ?>

        <div class="header-page">

          <h1 class="header-title"><?php single_cat_title('', true); ?></h1>

        </div>

      <?php



        /* - - - - - - - PROJECTS LISTING HEADER - START - - - - - - - - */

      } elseif (is_home()) {

        ?>

        <div class="header-page">
          <h1 class="header-title">Projects</h1>
        </div>

      <?php

      } 

      elseif ('news' == get_post_type() && is_archive()) {

        ?>

        <div class="header-page">
          <h1 class="header-title">News</h1>
        </div>

      <?php

      } 

    
      
      elseif ('news' == get_post_type() && !is_archive()) {
        ?>
        <div class="header-page">

          <?php

          if (get_the_title()) {

            ?>

            <p class="header-title"><?php echo get_the_title() ?></p>

          <?php

          }

          ?>
        </div>
      <?php
      }


      /* - - - - - - - PROJECTS LISTING HEADER - END - - - - - - - - - */



      /* - - - - - - - PROJECTS INDIVIDUAL HEADER - START - - - - - - - - */ elseif ('post' == get_post_type()) {

        if (is_404()) {

          ?>

          <div class="header-page">
            <h1 class="header-title">404</h1>
            <p class="header-subtitle">The page you are looking for cannot be found</p>
          </div>

        <?php

        } else {

          ?>
          <div class="header-page">
            <div class="row">
              <?php the_title('<h1 class="header-title">', '</h1>'); ?>
            </div>
          </div>
        <?php

        }
      } else {

        /* - - - - - - - PROJECTS INDIVIDUAL HEADER - END - - - - - - - - - */



        /* - - - - - - - STANDARD HEADER - START - - - - - - - - */

        ?>
        <div class="header-page">

          <?php

          if ($title) {

            ?>

            <p class="header-title"><?php echo $title; ?></p>

          <?php

          }

          if ($subhead) {

            ?>

            <p class="header-subtitle"><?php echo $subhead; ?></p>

          <?php

          }

          ?>

        </div>
      <?php

      }

      /* - - - - - - - STANDARD HEADER - END - - - - - - - - - */

      ?>



      <div class="btn--container">
        <?php if (get_field('intrashape_content')) {
          ?>
          <div class="row rowdisclaimer" style="text-align:left;">
            <p class="disclaimer">INTRAshape is protected by design rights and pending patent protection</p>
          </div>
        <?php } ?>
        <!--<button id="btn-down"><i class="fa fa-chevron-down home-down"></i></button>-->
      </div>

    </div> <!-- #added extra div -->



  </div>

  <!--<div id="scroll-down"></div>-->

  <div id="page" class="hfeed site">

    <div id="content" class="site-content">

      <!--  <button id="btn-top"><i class="fa fa-chevron-up"></i> <br> Back <br> to Top</button> -->