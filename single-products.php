<?php
/**
 * The template for displaying all single posts.
 *
 * @package axishouse
 */
#$page_id = get_queried_object_id();
#echo $page_id;
#exit;
get_header(); ?>

<?php
$_POST['test_prod'] = get_the_ID();
$postid = get_the_ID();
?>
<div class="page_id product-page" data-title="<?php echo get_the_title()?>" id="<?php echo get_the_ID();?>" >
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

<?php
$output           =  "";
$features         =  get_field('features' );
$specification    =  get_field('specification' );
$f_operational    =  get_field('operational' );
$f_maintenance    =  get_field('maintenance' );

$typical_spec     =  get_field('typical_specification' );
$manufacturer     =  get_field('manufacturer' );
$prod_ref         =  get_field('product_reference' );
$prod_desc        =  get_field('product_description' );
$prod_title       =  $post->post_name;
$site_url         = get_site_url();

$additional_info = get_field('additional_info' );


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


$output .= "<div id='prod-mobile-intro'>";

$sample_url = "#sample-request-tool";
$sample_btn_txt = 'Request Free Sample';
$sample_btn_class = '';

if( get_field('accessories') ){

 $sample_url = '#';
 $sample_btn_txt = 'Read More';
 $sample_btn_class = ' accessories-btn';

}

$output .= get_field('intro_paragraph');

if( get_field('intrashape_content') ){

   $output .= "<a class='yellow-btn yellow-solid-btn' href='/shape-selector/' target='_self'>Download PSD to Create Your Own Design</a>
   <a class='blue-btn blue-solid-btn free-samples' href='#sample-request-tool' target='_self' style='width:100%'>Request Free Sample</a>";
   $output .= "<p style='font-style: italic;font-family: Arial,Helvetica Neue,Helvetica,sans-serif; '>INTRAshape is protected by design rights and pending patent protection</p>";

} else if( get_field('intralux_grafic_content') ){

   $output .= "<a class='blue-btn blue-solid-btn" . $sample_btn_class . "' href='" . $sample_url . "'>" . $sample_btn_txt . "</a>";
   $output .= "<a class='blue-btn blue-solid-btn free-sample-folder' href='#free-sample-folder' target='_self' style='width:100%'>Request FREE Sample Folder</a>";

} else {

   $output .= "<a class='blue-btn blue-solid-btn" . $sample_btn_class . "' href='" . $sample_url . "'>" . $sample_btn_txt . "</a>";

}

$output .= "</div>";




//HTML Generation
if ($features){

   $output .="<section class='secondary_bg'>";
   $output .= "<div class='features'><div>";

   if( get_the_title() != 'Gripfit' && !get_field('accessories') ){

      $output .= "<h1>".get_the_title()." Features</h1>";

   } else {

      if( get_field('accessories') ){

         $output .= "<h1>".get_the_title()."</h1>";

      }

   }

   $output .= $features;
   $output .= "</div></div>";
   $output .="</section>";

}


/* START NEW DOWNLOADS SECTIONS */
//if ($specification  || $f_operational || $f_maintenance ){
   if ($specification  == "TEMPORARY MEASURE" ){
   $output .= "<section class='downloads_area'>";
	$output .= "<div class='row'>";
	 //BREAK AWAY
	 if ($f_operational || $f_maintenance || have_rows('other_docs')){
			$output .= "<div>";

			$output .= "<div class='downloads'>";

			if ($f_operational){
				 $output .= "<a href='".$f_operational."' target='_blank'>";
				 $output .= "<div class='download'>";
				 $output .= "<p>Operational Manual</p>";
				 $output .= "</div>";
				 $output .= "</a>";
			}
			if ($f_maintenance){
				 $output .= "<a href='".$f_maintenance."' target='_blank'>";
				 $output .= "<div class='download'>";
				 $output .= "<p>Maintenance Manual</p>";
				 $output .= "</div>";
				 $output .= "</a>";
			}

			if( have_rows('other_docs') ){
				 while( have_rows('other_docs') ): the_row();

	 #echo '<pre>';print_r(get_fields());
	 #exit;
				 if(get_sub_field('popup_info_request')){

						$file_download = get_sub_field('doc');
						$file_label = get_sub_field('doc_label');
						//$output .="<a class=' various small-grey-btn fancybox.iframe' href='/form-to-download?file=".$file_download."' >";
						 $output .="<a class=' various small-grey-btn form-download' href='#form-download' onclick=\"file_to_download('".$file_download."', '".$file_label."');\">";

						$output .= "<div class='download'>";
						$output .= "<p>". get_sub_field('doc_label')."</p>";
						$output .= "</div>";
						$output .= "</a>";

				 }

				 elseif(get_sub_field('url')){



						$file_download = (get_sub_field('url')) ? get_sub_field('url') : get_sub_field('doc');
						$file_label = get_sub_field('doc_label');
						//$output .="<a class=' various small-grey-btn fancybox.iframe' href='/form-to-download?file=".$file_download."' >";
						 $output .="<a class=' various small-grey-btn form-download' href='#form-download' onclick=\"file_to_download('".$file_download."', '".$file_label."');\">";

						$output .= "<div class='download'>";
						$output .= "<p>". get_sub_field('doc_label')."</p>";
						$output .= "</div>";
						$output .= "</a>";

				 }

				 elseif( get_field('intrashape_content') )
	 {
		 #info@intrasystems.co.uk
						$file_download = get_sub_field('doc');
						$file_label = get_sub_field('doc_label');
						//$output .="<a class=' various small-grey-btn fancybox.iframe' href='/form-to-download?file=".$file_download."' >";
						 $output .="<a class=' various small-grey-btn brochure-download' href='#brochure-download' onclick=\"file_to_download('".$file_download."', '".$file_label."');\">";

						$output .= "<div class='download'>";
						$output .= "<p>". get_sub_field('doc_label')."</p>";
						$output .= "</div>";
						$output .= "</a>";
				 }

	 else
	 {

		 $output .= "<a href='". get_sub_field('doc')."' target='_blank'>";
						$output .= "<div class='download'>";
						$output .= "<p>". get_sub_field('doc_label')."</p>";
						$output .= "</div>";
						$output .= "</a>";
	 }
				 endwhile;
			}

	 }
	  $output .= "</div>";
	 $output .= "</div>";  // end class=specification
	 $output .= "</section>";
}
/* END NEW DOWNLOADS SECTIONS */
echo $output;

 if( get_field('intrashape_content') ){ ?>

		<div id="triangle-examples-gallery" class="gallery-holder" style="display:block">
						<?php
							$galleryArray = array();

	 						$dataArray = ['triangle_example_images','square_example_images','rectangle_example_images','diamond_example_images','hexagon_example_images'];
							foreach($dataArray as $d)
							{
								while( have_rows($d) ): the_row();
									$data = array();
									$data['order'] = get_sub_field('gallery_priority');
									$image = get_sub_field('image');
									$data['image_main'] = $image['sizes']['showcase'];
									$data['image_thumb'] = $image['sizes']['shape-selector-thumb'];
									$data['description'] = get_sub_field('image_description');
									$data['title'] = get_sub_field('image_title');
									$galleryArray[] = $data;
								endwhile;
							}

	 						$order = array();
							foreach ($galleryArray as $key => $row)
							{
								$order[$key] = $row['order'];
							}
							array_multisort($order, SORT_ASC, $galleryArray);

	 						#echo '<pre>';
							#print_r($galleryArray);
                     $output = '';
							 $output .="<div class='row'><div id='sync1' class='owl-carousel owl-main-image'> ";
							 foreach($galleryArray as $data)
							 {


									$output .="<div class='item' style='background-image:url(\"".$data['image_main']."\");background-position: bottom center;'>";
									$output .= "<div class='row'>";
									$output .= "<div class='plus'>";
									$output .= "</div>";
									$output .= "</div>";
									$output .= "<div class='popup-box'>";
									$output .= "<div class='popup-inner'>";
									$output .= "<div class='popup-close'>";
									$output .= "</div>";
									$output .= "<div class='popup-content'>";
									$output .= "<h3>".$data['title']."</h3>";
									$output .= "<p>".$data['description']."</p>";
									$output .= "</div>";
									$output .= "</div>";
									$output .= "</div>";
									$output .="</div>";

							 }
							  $output .="</div></div>";


						   //Thumbnails
						   $output .= "<div class='slideshow'>";

							 $output .="<div id='sync2' class='owl-carousel owl-thumb-images'> ";
	 						foreach($galleryArray as $data)
							 {


								 $output .="<div class='item'>";
								 $output .= "<img src='". $data['image_thumb']."' >";
								 $output .="</div>";

							 }
							  $output .="</div>";

						   $output .= "</div>"; // Closing div of prod_info
							echo $output;
						?>
					</div>


         <!-- - - - INTRAShape Content START - - - -->

               <div id="intrashape-version">

                  <section id="shape-selector-step-1">

                     <div class="iv-grey-bg">

                        <div class="row">

                           <div class="excert-width">

                              <h2 class="entry-title">Choose your shape</h2>

                              <p>Select a shape or pattern from the section below to view our specially selected examples. These examples feature patterns and colours availble for your preferred shape. In addition you will also find a downloadable Photoshop document resource for selecting your own colour configerations</p>

                              <ul id="shape-options">
                                 <li>
                                    <a href="#" id="triangle" data-examples="triangle-examples" data-downloads="triangle-downloads" data-shape="triangle">
                                       <span class="shape"><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/triangle.png" alt="Triangle Shape Carpets"></span>
                                       <span class="txt">Triangle</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" id="square" data-examples="square-examples" data-downloads="square-downloads" data-shape="square">
                                       <span class="shape"><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/square.png" alt="Square Shape Carpets"></span>
                                       <span class="txt">Square</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" id="rectangle" data-examples="rectangle-examples" data-downloads="rectangle-downloads" data-shape="rectangle">
                                       <span class="shape"><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/rectangle.png" alt="Rectangle Shape Carpets"></span>
                                       <span class="txt">Rectangle</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" id="diamond" data-examples="diamond-examples" data-downloads="diamond-downloads" data-shape="diamond">
                                       <span class="shape"><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/diamond.png" alt="Diamond Shape Carpets"></span>
                                       <span class="txt">Diamond</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" id="hexagon" data-examples="hexagon-examples" data-downloads="hexagon-downloads" data-shape="hexagon">
                                       <span class="shape"><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/hexagon.png" alt="Hexagon Shape Carpets"></span>
                                       <span class="txt">Hexagon</span>
                                    </a>
                                 </li>
                              </ul>

                           </div>

                        </div>

                     </div>

                     <div class="row">

                        <div class="excert-width">

                           <div class="example-wrapper" rel="triangle-examples">

                              <div id="triangle-examples" class="example-images">

                                 <div class="shape-intro">

                                    <div class="large-shape">

                                       <div><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/triangle-large.png" alt="Triangle Shape Carpets"></div>

                                    </div>

                                    <div class="shape-intro-txt">

                                       <h3>Triangle</h3>

                                       <p>As seen in these superb renders, the triangle shape is a bold shape that creates a very powerful pattern. The three exact sized edges add a grand sense of presence that makes for iconic entrances for many buildings to come.</p>

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>

                                 <hr/>

                                 <div class="tesselation-examples">

                                    <div class="tesselation-txt">

                                       <h3>Tesselation Examples</h3>

                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Product Reference</th>
                                                <th>INTRAshape Entrance Matting</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>Shape</td>
                                                <td>
                                                   Small Triangle  230mm<br/>
                                                   Large Triangle  460mm
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

										<a class="yellow-btn yellow-solid-btn" href="/shape-selector/" target="_self" style="width:100%;max-width:420px;">Download PSD to Create Your Own Design</a>
										<a class="blue-btn blue-solid-btn free-samples" href="#free-samples" target="_self" style="width:100%;max-width:420px;margin-top:20px;">Request Free Sample</a>

                                    </div>

                                    <div class="tesselation-img">

                                       <img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/triangle-shapes.png" alt="Triangle Shape Carpets" id="triangle-shapes">

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>


									 <div style="clear:both"></div>

								</div>
							</div>
						</div>
					</div>


					<div class="row">

                        <div class="excert-width">

                           <div class="example-wrapper" rel="square-examples">

							  <div id="square-examples" class="example-images">

                                 <div class="shape-intro">

                                    <div class="large-shape">

                                       <div><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/square-large.png" alt="Square Shape Carpets"></div>

                                    </div>

                                    <div class="shape-intro-txt">

                                       <h3>Square</h3>

                                       <p>In geometry the most identifiable shape in its simplest form can be used to create the most interesting patterns that tesselate together on any sides. The brick, checkerboard and staggered square are just some of the examples of how this simple shape can form effective entrances and enhance the reception.</p>

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>

                                 <hr/>

                                 <div class="tesselation-examples">

                                    <div class="tesselation-txt">

                                       <h3>Tesselation Examples</h3>

                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Product Reference</th>
                                                <th>INTRAshape Entrance Matting</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>Shape</td>
                                                <td>
                                                   Small Square  230mm x 230mm<br/>
                                                   Large Square  480mm x 480mm
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

                                       <a class="yellow-btn yellow-solid-btn" href="/shape-selector/" target="_self" style="width:100%;max-width:420px;">Download PSD to Create Your Own Design</a>
										<a class="blue-btn blue-solid-btn free-samples" href="#free-samples" target="_self" style="width:100%;max-width:420px;margin-top:20px;">Request Free Sample</a>

                                    </div>

                                    <div class="tesselation-img">

                                       <img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/square-shapes.png" alt="Square Shape Carpets" id="square-shapes">

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>

                                </div>
							</div>
						</div>
					</div>

					<div class="row">

                        <div class="excert-width">

                           <div class="example-wrapper" rel="rectangle-examples">

                              <div id="rectangle-examples" class="example-images">

                                 <div class="shape-intro">

                                    <div class="large-shape">

                                       <div><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/rectangle-large.png" alt="Rectangle Shape Carpets"></div>

                                    </div>

                                    <div class="shape-intro-txt">

                                       <h3>Rectangle</h3>

                                       <p>The simple but highly efficient rectangle is our most adaptable shape. The possibilities are endless, herringbone, chevron and basket weave are just some of the stunning designs that can be created using this shape. What will you make?</p>

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>

                                 <hr/>

                                 <div class="tesselation-examples">

                                    <div class="tesselation-txt">

                                       <h3>Tesselation Examples</h3>

                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Product Reference</th>
                                                <th>INTRAshape Entrance Matting</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>Shape</td>
                                                <td>
                                                   XS Rectangle  115mm x 345mm<br/>
                                                   Small Rectangle  230mm x 460mm<br/>
                                                   Medium Rectangle - 230mm x 690mm<br/>
                                                   Medium Slim Rectangle - 115mm x 690mm<br/>
                                                   Large Rectangle  460mm x 690mm
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

                                       <a class="yellow-btn yellow-solid-btn" href="/shape-selector/" target="_self" style="width:100%;max-width:420px;">Download PSD to Create Your Own Design</a>
										<a class="blue-btn blue-solid-btn free-samples" href="#free-samples" target="_self" style="width:100%;max-width:420px;margin-top:20px;">Request Free Sample</a>
                                    </div>

                                    <div class="tesselation-img">

                                       <img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/rectangle-shapes.png" alt="Rectangle Shape Carpets" id="rectangle-shapes">

                                    </div>

                                    <div style="clear:both"></div>

								</div>
							</div>
						  </div>
					  </div>
				</div>

				<div class="row">

                        <div class="excert-width">

                           <div class="example-wrapper" rel="diamond-examples">

                              <div id="diamond-examples" class="example-images">

                                 <div class="shape-intro">

                                    <div class="large-shape">

                                       <div><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/diamond-large.png" alt="Diamond Shape Carpets"></div>

                                    </div>

                                    <div class="shape-intro-txt">

                                       <h3>Diamond</h3>

                                       <p>Again, found in nature, a diamond is elegance at its finest. It can be used to create 3D cubes where this shape is placed in a classic composition to help form the illusion of depth and direction in a two - dimensional floor. This shape oozes class.</p>

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>

                                 <hr/>

                                 <div class="tesselation-examples">

                                    <div class="tesselation-txt">

                                       <h3>Tesselation Examples</h3>

                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Product Reference</th>
                                                <th>INTRAshape Entrance Matting</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>Shape</td>
                                                <td>
                                                   Small Diamond  230mm x 230mm<br/>
                                                   Medium Slim Diamond  115mm x 575mm (45&deg; Angle)<br/>
                                                   Large Diamond  460mm  460mm (60&deg; Angle)
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

                                       <a class="yellow-btn yellow-solid-btn" href="/shape-selector/" target="_self" style="width:100%;max-width:420px;">Download PSD to Create Your Own Design</a>
										<a class="blue-btn blue-solid-btn free-samples" href="#free-samples" target="_self" style="width:100%;max-width:420px;margin-top:20px;">Request Free Sample</a>
                                    </div>

                                    <div class="tesselation-img">

                                       <img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/diamond-shapes.jpg" alt="Diamond Shape Carpets" id="diamond-shapes">

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>



							</div>
						</div>
					</div>
				</div>
				<div class="row">

                        <div class="excert-width">

                           <div class="example-wrapper" rel="hexagon-examples">

                              <div id="hexagon-examples" class="example-images">

                                 <div class="shape-intro">

                                    <div class="large-shape">

                                       <div><img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/hexagon-large.png" alt="Hexagon Shape Carpets"></div>

                                    </div>

                                    <div class="shape-intro-txt">

                                       <h3>Hexagon</h3>

                                       <p>Inspired by mother nature herself, and found in several areas in life, the Hexagon is an instantly recognisable pattern that brings a level of sophistication to any interior, tessellating on any direction and any angle this shape adds versatility to your designs.</p>

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>

                                 <hr/>

                                 <div class="tesselation-examples">

                                    <div class="tesselation-txt">

                                       <h3>Tesselation Examples</h3>

                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Product Reference</th>
                                                <th>INTRAshape Entrance Matting</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>Shape</td>
                                                <td>
                                                   Small Hexagon  230mm
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

                                       <a class="yellow-btn yellow-solid-btn" href="/shape-selector/" target="_self" style="width:100%;max-width:420px;">Download PSD to Create Your Own Design</a>
										<a class="blue-btn blue-solid-btn free-samples" href="#free-samples" target="_self" style="width:100%;max-width:420px;margin-top:20px;">Request Free Sample</a>
                                    </div>

                                    <div class="tesselation-img">

                                       <img src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/hexagon-shapes.png" alt="Hexagon Shape Carpets" id="hexagon-shapes">

                                    </div>

                                    <div style="clear:both"></div>

                                 </div>



                              </div>
                              </div>
                              </div>
                              </div>


                  </section>

               </div>

         <!-- - - - INTRAShape Content END - - - -->

         <?php }
$output = "";
if( get_field('accessories') ){

   //accessories start
   $output .= "<section><div id='accessories-content'>";

   //left col
   $output .= "<div class='col'><h2>Matwell Framing</h2>";

   $output .= "<div class='accessory-listing accessory-listing-space'><h3>INT019</h3><img src='" . get_stylesheet_directory_uri() . "/img/accessories/int019.png' alt='INT019' class='int-img int019' /><p>Supplied in 2.4m length</p></div>";

   $output .= "<div class='accessory-listing accessory-listing-space'><h3>INT014</h3><img src='" . get_stylesheet_directory_uri() . "/img/accessories/int014.png' alt='INT014' class='int-img int019' /><p>Supplied in 2.4m length</p></div>";

   $output .= "<div class='accessory-listing'><h3>INTR012</h3><img src='" . get_stylesheet_directory_uri() . "/img/accessories/intr012.png' alt='INTR012' class='int-img intr012' /><p>Supplied in 2.7m length</p></div>";



   //right col
   $output .= "</div><div class='col'><h2>Dividing T-bar Profiles</h2>";

   $output .= "<div class='accessory-listing'><h3>INTB165</h3><img src='" . get_stylesheet_directory_uri() . "/img/accessories/intb165.png' alt='INTB165' class='int-img intb165' /><p>Supplied in 2.4m length</p></div>";

   $output .= "<div class='accessory-listing'><h3>INTB011</h3><img src='" . get_stylesheet_directory_uri() . "/img/accessories/intb011.png' alt='INTB011' class='int-img intb011' /><p>Supplied in 2.4m length</p></div>";

   $output .= "<p>Used to create a clean division between matwell sections where required. (see Installation page opposite)</p>";

   $output .= "<div id='further-options'><h2>Further Options</h2><p><strong>INTF019 & INTF014</strong>  21mm and 14mm Formable versions, to suit curved applications<br/><strong>INTS020</strong>  Stainless Steel 20 x 20 x 3mm angle for individual applications<br/><strong>INTR016 & INTR018</strong>  Ramped aluminium framing to suit 16 and 18mm deep matting systems</p><p>Bespoke Stainless Steel Options made to suit INTRAgrille product</p></div>";



   //accessories end
   $output .= "</div><div style='clear:both'></div></section>";

} else {

   //Profile section

   if ($profile){
        $output .= "<section>";

      foreach ($profile as $p){

         $output .= "<div class='profile'>";
         $output .= "<div class='profile_tbl'>";
         $output .= $p['tbl'];
         $output .= "</div>";
         $output .= "<div class='profile_img'>";
         if($p['img']){
            $output .= "<img src='".$p['img']['url']."'>";
         }


         $output .= "</div>";
         $output .= "</div>";
      }



      if( get_field('product_video') ){

         $output .= "<div id='prod-video-wrapper'>
         <iframe width='100%' height='315' src='https://www.youtube.com/embed/" . get_field('product_video') . "' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen>
         </iframe>
         </div>";

      }

      $output .= "</section>";
   }

   if ($additional_info) {
      $output .= "<section><div class='profile additional-information'><div class='profile_tbl' style='width:100%!important'>". $additional_info."</div></div></section>";
   }

   // Intragrill extra information
   if($postid === 2481){

        $output .= "<section>";



         $output .= "<div class='profile'>";
         $output .= "<div class='profile_tbl'>";
         $output .= "<p></p>";
         $output .= "</div>";
         $output .= "<div class='profile_img'>";



         $output .= "<div class='row special-product'>";
         $output .= "  <div class='small-12 large-push-4 large-8 columns'>";
         $output .= "    <img src='http://intrasystems.co.uk/wp-content/uploads/2016/03/intragrille-profiles.png'>";
         $output .= "    </div> ";
         $output .= "  <div class='small-12 large-pull-8 large-4 columns'>";
         $output .= "    <table class='intra_tbl_profiles'>";
         $output .= "      <thead>";
         $output .= "      <tr>";
         $output .= "      <td colspan='4'>";
         $output .= "      <span>A</span> Triangular profiles";
         $output .= "      </td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "        <td>Profile</td>";
         $output .= "        <td>Width</td>";
         $output .= "        <td>Height</td>";
         $output .= "        <td>Weight</td>";
         $output .= "      </tr>";
         $output .= "      </thead>";
         $output .= "      <tbody>";
         $output .= "      <tr>";
         $output .= "          <td>18S</td>";
         $output .= "          <td>1.5mm</td>";
         $output .= "          <td>2.5mm</td>";
         $output .= "          <td>20g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>22S</td>";
         $output .= "          <td>1.8mm</td>";
         $output .= "          <td>3.7mm</td>";
         $output .= "          <td>35g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>28S</td>";
         $output .= "          <td>2.2mm</td>";
         $output .= "          <td>4.5mm</td>";
         $output .= "          <td>53g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>40A</td>";
         $output .= "          <td>3.0mm</td>";
         $output .= "          <td>6.0mm</td>";
         $output .= "          <td>79g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>42S</td>";
         $output .= "          <td>3.4mm</td>";
         $output .= "          <td>6.8mm</td>";
         $output .= "          <td>121g/m</td>";
         $output .= "      </tr>";
         $output .= "      </tbody>";
         $output .= "";
         $output .= "    </table>";
         $output .= "";
         $output .= "  </div> ";
         $output .= "</div> ";
         $output .= "<div class='row'>";
         $output .= "  <div class='small-12 large-4 columns'>";
         $output .= "    <table class='intra_tbl_profiles'>";
         $output .= "      <thead>";
         $output .= "      <tr>";
         $output .= "      <td colspan='4'>";
         $output .= "      <span>B</span> Support profiles";
         $output .= "      </td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "        <td>Profile</td>";
         $output .= "        <td>Width</td>";
         $output .= "        <td>Height</td>";
         $output .= "        <td>Weight</td>";
         $output .= "      </tr>";
         $output .= "      </thead>";
         $output .= "      <tbody>";
         $output .= "      <tr>";
         $output .= "          <td>Q35</td>";
         $output .= "          <td>3mm</td>";
         $output .= "          <td>5mm</td>";
         $output .= "          <td>95g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>Q53</td>";
         $output .= "          <td>5mm</td>";
         $output .= "          <td>3mm</td>";
         $output .= "          <td>95g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>10 x 3</td>";
         $output .= "          <td>3mm</td>";
         $output .= "          <td>10mm</td>";
         $output .= "          <td>210g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>25 x 3</td>";
         $output .= "          <td>3mm</td>";
         $output .= "          <td>25mm</td>";
         $output .= "          <td>558g/m</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>35 x 3</td>";
         $output .= "          <td>3mm</td>";
         $output .= "          <td>35mm</td>";
         $output .= "          <td>793g/m</td>";
         $output .= "      </tr>";
         $output .= "      </tbody>";
         $output .= "    </table>";
         $output .= "  </div> ";
         $output .= "  <div class='small-12 large-8 columns'>";
         $output .= "    <table class='intra_tbl_profiles wider'>";
         $output .= "      <thead>";
         $output .= "      <tr>";
         $output .= "      <td colspan='5'>";
         $output .= "      Some typical constructions";
         $output .= "      </td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "        <td><span>A</span>Triangular Profiles</td>";
         $output .= "        <td><span>B</span>Support Profiles</td>";
         $output .= "        <td><span>C</span>Slot Opening</td>";
         $output .= "        <td class='cell-wider'><span>D</span>Pitch Support Profiles</td>";
         $output .= "        <td>Maximum Dimension</td>";
         $output .= "      </tr>";
         $output .= "      </thead>";
         $output .= "      <tbody>";
         $output .= "      <tr>";
         $output .= "          <td>18S</td>";
         $output .= "          <td>Q35</td>";
         $output .= "          <td>1.8mm</td>";
         $output .= "          <td>90mm</td>";
         $output .= "          <td>1500mm x 1500mm</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>22S</td>";
         $output .= "          <td>10 x 3</td>";
         $output .= "          <td>2.2mm</td>";
         $output .= "          <td>90mm</td>";
         $output .= "          <td>2900mm x 3000mm</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>28S</td>";
         $output .= "          <td>10 x 3</td>";
         $output .= "          <td>6.0mm</td>";
         $output .= "          <td>90mm</td>";
         $output .= "          <td>2900mm x 3000 mm</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>40A</td>";
         $output .= "          <td>10 x 3</td>";
         $output .= "          <td>3.0mm</td>";
         $output .= "          <td>70mm</td>";
         $output .= "          <td>2900mm x 3000 mm</td>";
         $output .= "      </tr>";
         $output .= "      <tr>";
         $output .= "          <td>42S</td>";
         $output .= "          <td>25 x 3</td>";
         $output .= "          <td>3.4mm</td>";
         $output .= "          <td>50mm</td>";
         $output .= "          <td>2900mm x 3000 mm</td>";
         $output .= "      </tr>";
         $output .= "      </tbody>";
         $output .= "      <tfoot>";
         $output .= "      <tr>";
         $output .= "        <td colspan='5'>Standard Stainless Steel allow grades: 304 &amp; 316L</td>";
         $output .= "      </tr>";
         $output .= "      </tfoot>";
         $output .= "";
         $output .= "    </table>";
         $output .= "  </div>";
         $output .= "</div>";





         $output .= "</div>";
         $output .= "</div>";


      $output .= "</section>";

   }




   //************* Product Imagery - slider *****************
   // Big image

   if( have_rows('showcase') ){
     $output .="<div class='row'><div id='sync1' class='owl-carousel'> ";
      while( have_rows('showcase') ): the_row();
         $image = get_sub_field('showcase_img'); // Return object/array
         $thumb = $image['sizes']['large'];
         $output .="<div class='item' style='background-image:url(\"".$thumb."\");'>";
        // $output .= "<img src='". $thumb."' >";
         $output .= "<div class='row'>";
         $output .= "<div class='plus'>";

         $output .= "</div>";

         $output .= "</div>";

         $output .= "<div class='popup-box'>";
         $output .= "<div class='popup-inner'>";
         $output .= "<div class='popup-close'>";
         $output .= "</div>";

         $output .= "<div class='popup-content'>";
         $output .= "<h3>".get_sub_field('showcase_title')."</h3>";
         $output .= get_sub_field('showcase_desc');
         $output .= "</div>";
         $output .= "</div>";
      $output .= "</div>";
      $output .="</div>";
   	endwhile;
      $output .="</div></div>";
   }

   //Thumbnails
   $output .= "<div class='slideshow'>";
   if( have_rows('showcase') ){
     $output .="<div id='sync2' class='owl-carousel'> ";
      while( have_rows('showcase') ): the_row();

         $output .="<div class='item'>";
         $image = get_sub_field('showcase_img');
         $thumb = $image['sizes']['showcase-thumb'];
         $output .= "<img src='". $thumb."' >";
         $output .="</div>";
   	endwhile;
      $output .="</div>";
   }
   $output .= "</div>"; // Closing div of prod_info

   //********Specification section (half section)*********
   $output .= "<section>";
   $output .= "<div class='prod_info'>";
   if ($specification || $f_operational || $f_maintenance ){
      $output .= "<div class='specification'>";
      $output .= "<div id='zoom-img'>";
      $output .= "</div>";

      if ($specification){
         $output .= "<h3>Specification</h3>";
         $output .= $specification;
      }
      if ($f_operational || $f_maintenance || have_rows('other_docs')){
         $output .= "<div>";
         $output .= "<div class='downloads_title'>";
         $output .= "<p>Downloads</p>";
         $output .= "</div>";
         $output .= "<div class='downloads'>";

         if ($f_operational){
            $output .= "<a href='".$f_operational."' target='_blank'>";
            $output .= "<div class='download'>";
            $output .= "<p>Operational Manual</p>";
            $output .= "</div>";
            $output .= "</a>";
         }
         if ($f_maintenance){
            $output .= "<a href='".$f_maintenance."' target='_blank'>";
            $output .= "<div class='download'>";
            $output .= "<p>Maintenance Manual</p>";
            $output .= "</div>";
            $output .= "</a>";
         }

         if( have_rows('other_docs') ){
            while( have_rows('other_docs') ): the_row();

			#echo '<pre>';print_r(get_fields());
         #exit;

         if( get_sub_field('url') ){

            $url  = get_sub_field('url');

            $output .="<a class=' various small-grey-btn' href='" . $url . "' target='_blank'><div class='download'><p>" . get_sub_field('doc_label') . "</p></div></a>";


         } else if( get_sub_field('popup_info_request') || get_sub_field('popup_info_request_bim_rfa') || get_sub_field('popup_info_request_bim_ifc') || get_sub_field('popup_info_request_nbs') ){

            $file_download = get_sub_field('doc');
            $file_label = get_sub_field('doc_label');

            if( get_sub_field('popup_info_request') ){

               $output .="<a class=' various small-grey-btn form-download' href='#form-download' onclick=\"file_to_download('".$file_download."', '".$file_label."');\">";

            }

            if(get_sub_field('popup_info_request_bim_rfa')){

               $output .="<a class=' various small-grey-btn form-download' href='#bim-rfa-form-download' onclick=\"file_to_download_bim_rfa('".$file_download."', '".$file_label."');\">";

            }

            if(get_sub_field('popup_info_request_bim_ifc')){

               $output .="<a class=' various small-grey-btn form-download' href='#bim-ifc-form-download' onclick=\"file_to_download_bim_ifc('".$file_download."', '".$file_label."');\">";

            }

            if(get_sub_field('popup_info_request_nbs')){

               $output .="<a class=' various small-grey-btn form-download' href='#nbs-form-download' onclick=\"file_to_download_nbs('".$file_download."', '".$file_label."');\">";

            }

            $output .= "<div class='download'>";
            $output .= "<p>". get_sub_field('doc_label')."</p>";
            $output .= "</div>";
            $output .= "</a>";

         } elseif( get_field('intrashape_content') ){

            $file_download = get_sub_field('doc');
            $file_label = get_sub_field('doc_label');
            //$output .="<a class=' various small-grey-btn fancybox.iframe' href='/form-to-download?file=".$file_download."' >";
             $output .="<a class=' various small-grey-btn brochure-download' href='#brochure-download' onclick=\"file_to_download('".$file_download."', '".$file_label."');\">";

            $output .= "<div class='download'>";
            $output .= "<p>". get_sub_field('doc_label')."</p>";
            $output .= "</div>";
            $output .= "</a>";
         } else {

            $output .= "<a href='". get_sub_field('doc')."' target='_blank'>";
            $output .= "<div class='download'>";
            $output .= "<p>". get_sub_field('doc_label')."</p>";
            $output .= "</div>";
            $output .= "</a>";
         }

         endwhile;

      }

      $output .= "</div>";
      $output .= "</div>";
   }
   $output .= "</div>";  // end class=specification
}

if( have_rows('prod_var') || get_field('spec_img') ){

   $output .= "<div class='prod_variations'>";

   $small_msn ="";

   //$count = count( get_field('finishes') );

   //if ($count > 1){
      //$small_msn = " <small>Select insert option to view detail image</small>";
   //}

   $output .= "<h3>".get_field('var_main_title').$small_msn. "</h3>";



   if(get_field('show_variations')){

      //$output .= "<p><span class='prod_std'>Standard</span> | <span class='prod_black'>Black Anodised</span> | <span class='prod_bronze'>Bronze Anodised</span> </p>";
      $output .=variations_filter(get_field('finishes'));
      $output .= "<div class='prod_thumbs'>";

      while( have_rows('prod_var') ): the_row();

         $output .= "<div class='prod_variation'>";

         $output .= "<h3>".get_sub_field('var_cat')."</h3>";

         $variations = get_sub_field('variations');

         if($variations){

            foreach($variations as $v){

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
                   'terms' => 'Standard'
                    ),
                 )
               );

               $var_query = new WP_query($args);
               if($var_query->have_posts()){
                  while($var_query->have_posts()){

                     $var_query->the_post();
                     $post_id = get_the_ID();
                     $var_img = get_the_post_thumbnail( $post_id , 'variations-thumb');
                     $var_img_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
                    $output .= "<div class='variation' onMouseEnter='changeImage(\"".$var_img_full[0]."\")' onMouseLeave='hideImage()'>";

                     $output .= "<div class='var_img'>".$var_img."</div>";
                     $output .= get_field('var_label');
                     $output .= "</div>";
                  }

               }
               wp_reset_postdata();

            }

         }

         $output .= "<div style='clear:both;'><p>".get_sub_field('availability')."</p><div>";
         $output .= "</div>"; //end class=Prod_variation

      endwhile;

      $output .= "<div style='clear:both;'>";

      if( get_field('intrashape_content') ){

         $output .= "<a class='yellow-btn yellow-solid-btn' href='/shape-selector/' target='_self' style='width:100%;max-width:420px;'>Download PSD to Create Your Own Design</a>
      <a class='blue-btn blue-solid-btn free-samples' href='#sample-request-tool'  style='width:100%;max-width:420px;margin-top:0px;'>Request Free Samples</a>";

      } else if( get_field('intralux_grafic_content') ){

         $output .= "<a class='blue-btn' href='#sample-request-tool".($prod_title)."'>Request Free Samples</a>";

      } else {

         $output .= "<a class='blue-btn' href='#sample-request-tool'>Request Free Samples</a>";

      }

      $output .= "<div></div>";

   }

   if(get_field('spec_img')){
      $spec_img = get_field('spec_img');
      $output .= "<img src='".$spec_img['url']."' >";
   }

   $output .= "</div>"; //end class=prod_variations
   $output .= "</div>"; // end class=prod_info
   $output .= "</section>";

}



   $output .= "<section>";
   $output .= "<div class='further-details'>";
   $output .= "<div>";
   if ($typical_spec){
      $output .= "<div>";
      $output .= "<h4>Typical Specification:</h4>";
      $output .= $typical_spec;
      $output .= "</div>";

   }

   if ( get_post_status ( 153 ) == 'publish' ) {

      $footer_tel = get_field('tel', 153 );
      $footer_fax = get_field('fax', 153 );
      $footer_email = get_field('email', 153 );
      $footer_address_1 = get_field('address_1', 153 );
      $footer_address_2 = get_field('address_2', 153 );
      $footer_city = get_field('city', 153 );
      $footer_zipcode = get_field('zipcode', 153 );

      $output .= "<div>";
      $output .= "<h4>Manufacturer:</h4>";
      $output .= "<p>".$footer_address_1.", ".$footer_address_2." ".$footer_city." ".$footer_zipcode."<br>T:  ".$footer_tel." F: ".$footer_fax."<br>E: ".$footer_email."</p>";
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
   $output .= "</div>";
   $output .= "</section>"; //end - further details

}

echo $output;



			?>

		<?php endwhile; // End of the loop. ?>



		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php echo createForm(); ?>

<script>
 function changeImage(img){
   // var img ="http://axishouse.haloclients.co.uk/wp-content/uploads/2015/07/INTRAflex-XT-Brush.jpg";
                 // document.getElementById('zoom-img').src=img;
    document.getElementById('zoom-img').style.zIndex = "1";
    document.getElementById('zoom-img').style.backgroundImage = "url("+img+")";
    document.getElementById('zoom-img').style.display = "block";
   // $("#zoom-img").show();

   }
 function hideImage(){
   // var img ="http://axishouse.haloclients.co.uk/wp-content/uploads/2015/07/INTRAflex-XT-Brush.jpg";
                 // document.getElementById('zoom-img').src=img;

    document.getElementById('zoom-img').style.display = "none";
   // $("#zoom-img").show();

   }
   function file_to_download(form_url, file_label){
      //alert(form_url);
      document.getElementById("file_url1").innerHTML = "Thanks! Click <a href='"+form_url+"'>here</a> to download your file.</a>";
      document.getElementById("file_url").innerHTML = form_url;
   }

   function file_to_download_bim_rfa(form_url, file_label){
      document.getElementById("bim_rfa_url1").innerHTML = "Thanks! Click <a href='"+form_url+"'>here</a> to download your file.</a>";
      document.getElementById("bim_rfa_url").innerHTML = form_url;
   }

   function file_to_download_bim_ifc(form_url, file_label){
      document.getElementById("bim_ifc_url1").innerHTML = "Thanks! Click <a href='"+form_url+"'>here</a> to download your file.</a>";
      document.getElementById("bim_ifc_url").innerHTML = form_url;
   }

   function file_to_download_nbs(form_url, file_label){
      document.getElementById("nbs_url1").innerHTML = "Thanks! Click <a href='"+form_url+"'>here</a> to download your file.</a>";
      document.getElementById("nbs_url").innerHTML = form_url;
   }


   var cad_form = document.querySelector( '#wpcf7-f21-o1' );

   cad_form.addEventListener( 'wpcf7mailsent', function( event ) {
      document.getElementById('wpcf7-f21-o1').style.display = "none";
      document.getElementById('file_url1').style.display = "block";
   }, false );


   var bim_ifc_form = document.querySelector( '#wpcf7-f7654-o3' );

   bim_ifc_form.addEventListener( 'wpcf7mailsent', function( event ) {
      document.getElementById('wpcf7-f7654-o3').style.display = "none";
      document.getElementById('bim_ifc_url1').style.display = "block";
   }, false );


   var bim_rfa_form = document.querySelector( '#wpcf7-f7653-o2' );

   bim_rfa_form.addEventListener( 'wpcf7mailsent', function( event ) {
      document.getElementById('wpcf7-f7653-o2').style.display = "none";
      document.getElementById('bim_rfa_url1').style.display = "block";
   }, false );

   var nbs_form = document.querySelector( '#wpcf7-f7679-o4' );

   nbs_form.addEventListener( 'wpcf7mailsent', function( event ) {
      document.getElementById('wpcf7-f7679-o4').style.display = "none";
      document.getElementById('nbs_url1').style.display = "block";

      dataLayer = window.dataLayer || [];
      dataLayer.push({
        'event' : 'GAEvent',
        'eventCategory' : 'NBS Specification',
        'eventAction' : 'Download',
        'eventLabel' : 'NBS Specification Download'
      });

   }, false );

</script>

<?php
function createForm(){
   $form = "";



   if( get_field('intrashape_content') ){

		$form .= "<div id='brochure-download' class='popup-form-download' style='display:none;'>";
		$form .= do_shortcode('[contact-form-7 id="6992" title="SHAPES - Download Brochure"]');
		$form .= "<p id='file_url' style='display:none;'></p>";
		$form .= "<p id='file_url1' style='display:none;'></p>";
		$form .= "</div>";

		$form .= "<div id='free-samples' class='popup-form-download' style='display:none;'>";
		$form .= '<div style="text-align:center;width:450px;" id="mainformsampleselect"><h3>Choose your Shape</h3><p>Select one or more shapes and submit your request to<br />enter your postal details</p>';
		$form .= '<table class="freesamplestable" cellpadding="50">';

    $form .= "<div id='form-download' class='popup-form-download' style='display:none;'>";
    $form .= do_shortcode('[contact-form-7 id="21" title="CAD Download"]');
  $form .= "<p id='file_url' style='display:none;'></p>";
  $form .= "<p id='file_url1' style='display:none;'></p>";
    $form .= "</div>";

    $form .= "<div id='bim-ifc-form-download' class='popup-form-download' style='display:none;'>";
    $form .= do_shortcode('[contact-form-7 id="7654" title="BIM IFC Download"]');
    $form .= "<p id='bim_ifc_url' style='display:none;'></p>";
    $form .= "<p id='bim_ifc_url1' style='display:none;'></p>";
    $form .= "</div>";

		$form .= '<tr><td><img width="140" style="margin:10px;" src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/triangle.png" /></td><td><img width="140" style="margin:10px;" src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/square.png" /></td></tr>';
		$form .= '<tr><td>Triange <input type="checkbox" value="Triangle" class="freesamplecheckbox" /></td><td>Square <input value="Square" type="checkbox" class="freesamplecheckbox" /></td></tr>';
		$form .= '<tr><td><img width="140" style="margin:10px;" src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/rectangle.png" /></td><td><img width="140" style="margin:10px;" src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/diamond.png" /></td></tr>';
		$form .= '<tr><td>Rectangle <input type="checkbox" value="Rectangle" class="freesamplecheckbox" /></td><td>Diamond<input value="Diamond" type="checkbox" class="freesamplecheckbox" /></td></tr>';
		$form .= '<tr><td><img width="140" style="margin:10px;" src="/wp-content/themes/intergage-wordpress-theme/img/intrashape/hexagon.png" /></td><td></td></tr>';
		$form .= '<tr><td>Hexagon <input type="checkbox" value="Hexagon" class="freesamplecheckbox" /></td><td></td></tr>';

		$form .= '</table>';

		$form .= '<button class="blue-btn blue-solid-btn" id="freesmapleorder">Order Free Samples</button>';
		$form .= "</div>";
		$form .= '<div style="display:none;" id="mainformsamples">'.do_shortcode('[contact-form-7 id="6993" title="Free Shape Request"]').'</div>';
		$form .= "</div>";

	} else if( get_field('intralux_grafic_content') ){

      $form .= "<div id='free-sample-folder' class='popup-form-download' style='display:none;'>";
      $form .= do_shortcode('[contact-form-7 id="7303" title="INTRAlux Grafic Sample Request"]');
      $form .= "<p id='intralux_graphic_thankyou' style='display:none'>Thank you for your request.</p>";
      $form .= "</div>";

   } else {
      $form .= "<div id='form-download' class='popup-form-download' style='display:none;'>";
      $form .= do_shortcode('[contact-form-7 id="21" title="CAD Download"]');
		$form .= "<p id='file_url' style='display:none;'></p>";
		$form .= "<p id='file_url1' style='display:none;'></p>";
      $form .= "</div>";

      $form .= "<div id='bim-rfa-form-download' class='popup-form-download' style='display:none;'>";
      $form .= do_shortcode('[contact-form-7 id="7653" title="BIM RFA Download"]');
      $form .= "<p id='bim_rfa_url' style='display:none;'></p>";
      $form .= "<p id='bim_rfa_url1' style='display:none;'></p>";
      $form .= "</div>";

      $form .= "<div id='bim-ifc-form-download' class='popup-form-download' style='display:none;'>";
      $form .= do_shortcode('[contact-form-7 id="7654" title="BIM IFC Download"]');
      $form .= "<p id='bim_ifc_url' style='display:none;'></p>";
      $form .= "<p id='bim_ifc_url1' style='display:none;'></p>";
      $form .= "</div>";

      $form .= "<div id='nbs-form-download' class='popup-form-download' style='display:none;'>";
      $form .= do_shortcode('[contact-form-7 id="7679" title="NBS Specification Download"]');
      $form .= "<p id='nbs_url' style='display:none;'></p>";
      $form .= "<p id='nbs_url1' style='display:none;'></p>";
      $form .= "</div>";

	}

   return $form;

}


?>
<?php get_footer(); ?>

