jQuery(window).load(function() {

	var shape_options_animating = false;
	var examples_open = false;

	
	jQuery('#shape-options a').click(function(){

		//jQuery('.gallery-holder').hide();
		var shape_button = jQuery(this);

		if(!shape_options_animating){
			
			if( jQuery(this).hasClass('selected') ){

				shape_options_animating = true;

				shape_button.removeClass('selected');
				jQuery('.example-wrapper').each(function()
				{
					if(jQuery(this).attr('rel') == shape_button.data('examples'))
					{
						examplewrapper = jQuery(this);
					}
				});
				examplewrapper.slideUp(1000,function(){

					jQuery('.example-images').css('display','none');

					shape_options_animating = false;

					examples_open = false;

				});

			} else {

				shape_options_animating = true;

				jQuery('#shape-options a').removeClass('selected');

				shape_button.addClass('selected');

				if(examples_open){
					
					jQuery('.example-wrapper').each(function()
					{
						if(jQuery(this).attr('rel') == shape_button.data('examples'))
						{
							examplewrapper = jQuery(this);
						}
					});
					
					examplewrapper.slideUp(1000,function(){

						jQuery('.example-images').css('display','none');
						jQuery('.psd-downloads').css('display','none');
						
						jQuery( '#' + shape_button.data('examples') ).css('display','block');
						jQuery( '#' + shape_button.data('downloads') ).css('display','block');
						jQuery('#shapeinput').val( shape_button.data('shape') );

						examplewrapper.slideDown(1000,function(){

					    	jQuery("html, body").animate({ 
								scrollTop: (jQuery( '#' + shape_button.data('examples') ).offset().top - 125)
							}, 1000);

							shape_options_animating = false;

							examples_open = true;

						});

					});

				} else {
					
					jQuery('.example-wrapper').each(function()
					{
						if(jQuery(this).attr('rel') == shape_button.data('examples'))
						{
							examplewrapper = jQuery(this);
						}
					});
					jQuery('.example-images').css('display','none');
					jQuery('.psd-downloads').css('display','none');

					jQuery( '#' + shape_button.data('examples') ).css('display','block');
					jQuery( '#' + shape_button.data('downloads') ).css('display','block');
					jQuery('#shapeinput').val( shape_button.data('shape') );

					examplewrapper.slideDown(1000,function(){

						jQuery("html, body").animate({ 
							scrollTop: (jQuery( '#' + shape_button.data('examples') ).offset().top - 125) 
						}, 1000);

						shape_options_animating = false;

						examples_open = true;

					});

				}
				
				jQuery('#'+shape_button.data('examples')+'-gallery').show();
				
			}

		}

		return false;
	
	});

	if( jQuery('#example-wrapper a').length > 0 ){

		jQuery('#example-wrapper a').fancybox({
			padding : [40,40,40,40],
			afterLoad: function() {
				var caption = this.title.split("$");
		        this.title = '<h3>' + caption[0] + '</h3>' + caption[1];
		    },
			helpers : {
		        title: {
		            type: 'inside',
		            position: 'bottom'
		        }
		    }
		});

	}

});