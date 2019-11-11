<?php /* Template Name: Home page */ ?>
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
<?php
$output           = "";
$show_block_icons = get_field('block_icons');


?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">


        <?php while (have_posts()) : the_post();

            ?>

            <!-- POST INTRODUCTION AREA-->

            <section>
                <div class="row">
                    <div class="excerpt-width">
                        <?php echo the_content(); ?>
                    </div>
                </div>
            </section>

            <section>

                <div class="row">
                    <?php
                        $args = array(
                            'post_type'       => 'products',
                            'order'           => 'ASC',
                            'orderby'         => 'menu_order',
                            'posts_per_page'  => '-1'
                        );
                        $the_query = new WP_Query($args);
                        # echo '<pre>';
                        # print_r($the_query);
                        # exit;
                        if ($the_query->have_posts()) :
                            $output .= "<div class='prod_list'>";
                            while ($the_query->have_posts()) :
                                $the_query->the_post();
                                if (get_field('entrancemattinghomeproduct')) {
                                    $output .= "<div>";
                                    $post_id = get_the_ID();
                                    $prod_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'prod_featured-small');
                                    if (!$prod_featured_img) {
                                        $prod_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
                                    }
                                    $output .= "<div class='thumb-featured'><img src='" . $prod_featured_img[0] . "' ></div>";
                                    $logo_black = get_field('logo_black');
                                    $output .= "<div class='prod-info'>";
                                    if ($logo_black) {
                                        $output .= "<img src='" . $logo_black['url'] . "' alt='" . $logo_black['alt'] . "'>";
                                    } else {
                                        $output .= "<p class='raleway-font'>" . get_the_title() . "</p>";
                                    }

                                    $my_excerpt = "<p>" . get_the_excerpt() . "</p>";
                                    $output .= $my_excerpt;
                                    $output .= "<a class='small-blue-btn' href='" . get_the_permalink() . "'>Read more</a>";
                                    $output .= "</div></div>";
                                }
                            endwhile;
                            $output .= "</div>";
                            echo $output;
                        #echo '<a class="small-blue-btn" href="">Read more</a>';
                        endif;
                        wp_reset_postdata();
                        ?>

                </div>
            </section>

            <section>
                <div class="row">
                    <div class="excerpt-width">
                        <a class="blue-btn" href="/products">See All Products</a>
                    </div>
                </div>
            </section>

            <?php

                if ($show_block_icons) :
                    ?>
                <section class="secondary_bg hidden-for-small-only">
                    <div class="row">
                        <?php
                                $args = array(
                                    'post_type' => 'icon_blocks',
                                    'posts_per_page' => '-1',
                                );

                                $the_query = new WP_Query($args);

                                // The Loop
                                if ($the_query->have_posts()) :

                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $icon = get_field("icon", $the_query->ID);

                                        echo '<div class="block-icon ' . $icon . '">';
                                        echo '<div class="blk-title">' . get_the_title() . '</div>';
                                        if (get_field("message_1", $the_query->ID)) {
                                            echo '<div class="blk-warning">' . get_field("message_1", $the_query->ID) . '</div>';
                                        }
                                        if (get_field("message_2", $the_query->ID)) {
                                            echo '<div class="blk-check">' . get_field("message_2", $the_query->ID) . '</div>';
                                        }
                                        echo '</div>';
                                    endwhile;
                                endif;
                                ?>
                    </div>
                </section>

                <section id="gripfit-section">
                    <div class="row">
                        <div class="excerpt-width">
                            <img src="/wp-content/uploads/2016/11/GripFit-Box-lg.png" alt="" />
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/LU0VfV2Mr1g" frameborder="0" allowfullscreen></iframe>
                            <p>The safest and most effective surface mounted Entrance Matting solution for retro-fit applications, providing a safe and viable alternative to traditional loose lay matting options.</p>
                            <a class="large-blue-btn" href="/products/gripfit/">Read more</a>
                        </div>
                    </div>
                </section>

                <?php

                    endif;


                    wp_reset_postdata();

                    if (have_rows('home_sections')) :

                        while (have_rows('home_sections')) : the_row();

                            //SOMETHING BETWEEN HERE

                            $extraClass       = "";
                            $section_title  =  get_sub_field('section_title');
                            $section_desc  =  get_sub_field('section_desc');
                            $page_link  =  get_sub_field('page_link');
                            $project_section  =  get_sub_field('project_section');

                            $block_img_1   =  get_sub_field('block_img_1');
                            $block_img_2   =  get_sub_field('block_img_2');
                            $block_img_3   =  get_sub_field('block_img_3');
                            $size_thumb = 'showcase-thumb';
                            $block_img_thumb_1 = "";





                            if ($block_img_1) {

                                $block_img_thumb_1 = $block_img_1['sizes'][$size_thumb];
                                if (!$block_img_thumb_1) $block_img_thumb_1 = $block_img_1['sizes']['full'];
                            }

                            $block_img_thumb_2 = "";
                            if ($block_img_2) {

                                $block_img_thumb_2 = $block_img_2['sizes'][$size_thumb];

                                if (!$block_img_thumb_2) $block_img_thumb_2 = $block_img_2['sizes']['full'];
                            }

                            $block_img_thumb_3 = "";
                            if ($block_img_3) {

                                $block_img_thumb_3 = $block_img_3['sizes'][$size_thumb];

                                if (!$block_img_thumb_3) $block_img_thumb_3 = $block_img_3['sizes']['full'];
                            }

                            $parallax_img  =  get_sub_field('block_parallax');
                            $parallax_thumb = "";

                            if ($parallax_img) {
                                $size = 'parallax';
                                $parallax_thumb = $parallax_img['sizes'][$size];

                                if (!$parallax_thumb) $parallax_thumb = $parallax_img['sizes']['full'];
                            }

                            //PARALLAX THUMBNAIL

                            if ($parallax_thumb) { ?>
                        <div class="page-header parallax-window" data-parallax="scroll" data-position-y="bottom" data-image-src="<?php echo $parallax_thumb;  ?>">

                            <?php if (strpos($page_link, 'guides')) { ?>
                                <?php $extraClass = " guides_blk"; ?>

                                <section class="<?php echo $extraClass; ?>">
                                    <div class="row">
                                        <div>
                                            <div class="excerpt-width">
                                                <?php if ($section_title) {
                                                                        echo "<h3>" . $section_title . "</h3>";
                                                                    } ?>
                                                <?php if ($section_desc) {
                                                                        echo "<div>" . $section_desc . "</div>";
                                                                    } ?>
                                                <?php if ($page_link) { ?>

                                                    <a class="large-blue-btn" href="<?php echo $page_link; ?>">Read more</a>
                                                <?php } ?>
                                            </div>

                                            <?php if ($block_img_thumb_1 || $block_img_thumb_2 || $block_img_thumb_3) { ?>


                                                <div class='thumb-imgs'>

                                                    <div class='sync_single owl-carousel'>
                                                        <?php if ($block_img_thumb_1) { ?>
                                                            <div class='item'>
                                                                <img src="<?php echo $block_img_thumb_1; ?>" alt="">
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($block_img_thumb_2) { ?>
                                                            <div class='item'>
                                                                <img src="<?php echo $block_img_thumb_2; ?>" alt="">
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($block_img_thumb_3) { ?>
                                                            <div class='item'>
                                                                <img src="<?php echo $block_img_thumb_3; ?>" alt="">
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        </div>
                                    </div>
                                </section>
                            <?php } ?>


                        </div>
                    <?php }

                                if (strpos($page_link, 'sectors')) {
                                    $extraClass = " gray_bg";
                                }
                                if (strpos($page_link, 'install')) {
                                    $extraClass = " secondary_bg";
                                }
                                if ($project_section) {
                                    $extraClass = " project_section";
                                }

                                if (!strpos($page_link, 'guides')) { ?>

                        <section class="<?php echo $extraClass; ?>">
                            <div class="row">
                                <div>

                                    <div class="excerpt-width">
                                        <?php

                                                        if ($section_title) echo "<h3>" . $section_title . "</h3>";
                                                        if ($section_desc)  echo "<div>" . $section_desc . "</div>";

                                                        if ($project_section && $page_link) {
                                                            echo '<a class="large-blue-btn" href="' . $page_link . '">All Projects</a>';
                                                        } else {
                                                            if ($page_link) echo '<a class="large-blue-btn" href="' . $page_link . '>">Read more</a>';
                                                        }

                                                        ?>
                                    </div>

                                    <?php if (strpos($page_link, 'sectors'))
                                                        echo '<img class=" hidden-for-small-only" src="' . get_template_directory_uri() . '/img/intramatting-case-studies.jpg" alt="">';
                                                    ?>

                                </div>
                            </div>
                        </section>

            <?php }


                    //AND HERE BROKEN


                    endwhile;

                endif;

                ?>

        <?php
        endwhile;
        ?>


    </main>
</div>

<?php

get_sidebar();
get_footer();
function get_intramatting_excerpt($excerpt, $limit)
{
    if (str_word_count($excerpt, 0) > $limit) {
        $words = str_word_count($excerpt, 2);
        $pos = array_keys($words);
        $excerpt  = substr($excerpt, 0, $pos[$limit]) . '...';
    }
    return $excerpt;
}

?>
