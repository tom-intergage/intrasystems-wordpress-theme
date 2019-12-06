<?php

$introductionText = get_sub_field('introduction_text');
$form = get_sub_field('form');
$image = get_sub_field('image');
$footerText = get_sub_field('footer_text');
$action = get_sub_field('action');
$file = get_sub_field('file');
$page = get_sub_field('page');
$size = 'large';

 ?>

<div class="form-area">
    <section>
      <div class="row">
        <div class="excert-width">
          <?php echo $introductionText; ?>
        </div>
      </div>
    </section>
    <section>
      <div class="row">
        <div class="form-area__form">
          	<div id='form-download' class='popup-form-download'>
              <?php echo do_shortcode($form); ?>
              <p id='file_url1' style='display:none;'>Thanks! Click <a href='<?php echo $file ?>' target="_blank">here</a> to download your file.</a></p>
            </div>
        </div>
        <div class="form-area__image">
              <?php echo wp_get_attachment_image( $image['ID'], $size ) ?>
        </div>
      </div>
    </section>
    <section>
      <div class="row">
        <div>
          <?php echo $footerText; ?>
        </div>
      </div>
    </section>
</div>
