<?php 

if( !isset($_SESSION['axishouse_pop_up_seen']) ){

  $_SESSION['axishouse_pop_up_seen'] = 0; 

}

if( isset($_SESSION['axishouse_pop_up_seen']) ){

  $_SESSION['axishouse_pop_up_seen']++;

}

if( $_SESSION['axishouse_pop_up_seen'] == 4 ){

?>
<a href="#order-sample-pop-up" id="order-sample-pop-up-button" style="display:none"></a>

<div id="order-sample-pop-up">

  <p>
    Experience the strength and<br/>
    aesthetic appeal of the<br/>
    INTRAmatting systems with<br/> 
    a product sample
  </p>

  <a href="/request-free-samples/" target="_self">
    <img src="/wp-content/themes/intergage-wordpress-theme/img/order-free-samples.gif" alt="Order Free Sample" width="246" height="107" />
  </a>

  <p class="last">
    Call us on <a href="tel:01425472000">01425 472000</a><br/> 
    or email your requirements to<br/> 
    <a href="mailto:info@intrasystems.co.uk">info@intrasystems.co.uk</a>
  </p>

</div>
<?php 

}

?>