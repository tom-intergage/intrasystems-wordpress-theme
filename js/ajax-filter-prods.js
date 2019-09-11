jQuery(document).ready(function($) {
    $('.prod-filter').click( function(event) {
 
        // Prevent default action - opening tag page
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
 
        // Get tag slug from title attirbute
        var selected_taxonomy = $(this).attr('title');
        var selected_product = $('.page_id').attr('id');
      
      
        // After user click on tag, fade out list of posts
        $('.prod_thumbs').fadeOut();
 
        data = {
            action: 'filter_posts', // function to execute
            afp_nonce: afp_vars.afp_nonce, // wp_nonce
            taxonomy: selected_taxonomy,
            test_prod: selected_product,// selected tag
            
          
     
            };
 
        $.post( afp_vars.afp_ajax_url, data, function(response) {
 
            if( response ) {
                // Display posts on page
                $('.prod_thumbs').html( response );
                // Restore div visibility
                $('.prod_thumbs').fadeIn();
            };
        });
    });
    if ($('.prod_thumbs img').length == 0) $('.tax-variation_1 .prod-filter').trigger('click');
});
