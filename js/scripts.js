var multiFilter = {

  // Declare any variables we will need as properties of the object

  $filterGroups: null,
  $filterUi: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',

  // The "init" method will run on document ready and cache any jQuery objects we will need.

  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

    self.$filterUi = jQuery('#Filters');
    self.$filterGroups = jQuery('.filter-group');
    self.$reset = jQuery('#Reset');
    self.$container = jQuery('#Container');

    self.$filterGroups.each(function(){
      self.groups.push({
        $inputs: jQuery(this).find('input'),
        active: [],
		    tracker: false
      });
    });

    self.bindHandlers();
  },

  // The "bindHandlers" method will listen for whenever a form value changes.

  bindHandlers: function(){
    var self = this,
        typingDelay = 300,
        typingTimeout = -1,
        resetTimer = function() {
          clearTimeout(typingTimeout);

          typingTimeout = setTimeout(function() {
            self.parseFilters();
          }, typingDelay);
        };


    self.$filterGroups
      .filter('.search')
      .on('keyup change', resetTimer);

    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filterUi[0].reset();
      self.$filterUi.find('input[type="text"]').val('');
      self.parseFilters();
    });
  },

  // The parseFilters method checks which filters are active in each group:

  parseFilters: function(){
    var self = this;

    // loop through each filter group and add active filters to arrays

    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){
        var searchTerm = '',
       			$input = jQuery(this),
            minimumLength = 1;

        if ($input.is(':checked')) {
          group.active.push(this.value);
        }

        if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
          searchTerm = this.value
            .trim()
            .toLowerCase()
            .replace(' ', ' ');

          group.active[0] = '[class*="' + searchTerm + '"]';
        }
      });
	    group.active.length && (group.tracker = 0);
    }

    self.concatenate();
  },

  // The "concatenate" method will crawl through each group, concatenating filters as desired:

  concatenate: function(){
    var self = this,
		  cache = '',
		  crawled = false,
		  checkTrackers = function(){
        var done = 0;

        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }

        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);

          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];

          if(group.active[group.tracker + 1]){
            group.tracker++;
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };

    self.outputArray = []; // reset output array

	  do{
		  crawl();
	  }
	  while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();

    // If the output string is empty, show all rather than none:

    !self.outputString.length && (self.outputString = 'all');

    console.log(self.outputString);

    // ^ we can check the console here to take a look at the filter string that is produced

    // Send the output string to MixItUp via the 'filter' method:

	  if(self.$container.mixItUp('isLoaded')){
    	self.$container.mixItUp('filter', self.outputString);
	  }
  }
};


jQuery(document).ready(function($) {

   $('#Filters').keypress(function(e) {
    if ( e.which == 13 ) return false;
    //or...
    if ( e.which == 13 ) e.preventDefault();
});
 $(document).foundation({
    tab: {
      callback : function (tab) {
        console.log(tab);
      }
    }
  });

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  sync1.owlCarousel({
    singleItem : true,
    slideSpeed : 1000,

    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
  });

  sync2.owlCarousel({
    items : 3,
    itemsDesktop      : [1500,3],
    itemsDesktopSmall  : [1200,3],
    itemsTablet       : [992,3],
    itemsMobile       : [768,2],
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    },
   navigation: true,
    navigationText: [
      "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-left'></i>",
      "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-right'></i>"
      ],
    beforeInit : function(elem){
      //Parameter elem pointing to $("#owl-demo")
     // random(elem);
    }
	});
	
	var sync3 = $("#sync3");
	var sync4 = $("#sync4");
	sync3.owlCarousel({
	singleItem : true,
	slideSpeed : 1000,

	pagination:false,
	afterAction : syncPosition4,
	responsiveRefreshRate : 200,
	});

	sync4.owlCarousel({
	items : 3,
	itemsDesktop      : [1500,3],
	itemsDesktopSmall  : [1200,3],
	itemsTablet       : [992,3],
	itemsMobile       : [768,2],
	pagination:false,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	},
	navigation: true,
	navigationText: [
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-left'></i>",
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-right'></i>"
	  ],
	beforeInit : function(elem){
	  //Parameter elem pointing to $("#owl-demo")
	 // random(elem);
	}
	});
	
	var sync5 = $("#sync5");
	var sync6 = $("#sync6");
	sync5.owlCarousel({
	singleItem : true,
	slideSpeed : 1000,

	pagination:false,
	afterAction : syncPosition6,
	responsiveRefreshRate : 200,
	});

	sync6.owlCarousel({
	items : 3,
	itemsDesktop      : [1500,3],
	itemsDesktopSmall  : [1200,3],
	itemsTablet       : [992,3],
	itemsMobile       : [768,2],
	pagination:false,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	},
	navigation: true,
	navigationText: [
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-left'></i>",
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-right'></i>"
	  ],
	beforeInit : function(elem){
	  //Parameter elem pointing to $("#owl-demo")
	 // random(elem);
	}
	});
	
	var sync7 = $("#sync7");
	var sync8 = $("#sync8");
	sync7.owlCarousel({
	singleItem : true,
	slideSpeed : 1000,

	pagination:false,
	afterAction : syncPosition8,
	responsiveRefreshRate : 200,
	});

	sync8.owlCarousel({
	items : 3,
	itemsDesktop      : [1500,3],
	itemsDesktopSmall  : [1200,3],
	itemsTablet       : [992,3],
	itemsMobile       : [768,2],
	pagination:false,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	},
	navigation: true,
	navigationText: [
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-left'></i>",
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-right'></i>"
	  ],
	beforeInit : function(elem){
	  //Parameter elem pointing to $("#owl-demo")
	 // random(elem);
	}
	});
	
	var sync9 = $("#sync9");
	var sync10 = $("#sync10");
	sync9.owlCarousel({
	singleItem : true,
	slideSpeed : 1000,

	pagination:false,
	afterAction : syncPosition10,
	responsiveRefreshRate : 200,
	});

	sync10.owlCarousel({
	items : 3,
	itemsDesktop      : [1500,3],
	itemsDesktopSmall  : [1200,3],
	itemsTablet       : [992,3],
	itemsMobile       : [768,2],
	pagination:false,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	},
	navigation: true,
	navigationText: [
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-left'></i>",
	  "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-right'></i>"
	  ],
	beforeInit : function(elem){
	  //Parameter elem pointing to $("#owl-demo")
	 // random(elem);
	}
	});
  
  var sync_single = $(".sync_single");
  sync_single.owlCarousel({
    items : 3,
    itemsDesktop      : [1500,3],
    itemsDesktopSmall  : [1200,3],
    itemsTablet       : [768,2],
    itemsMobile       : [480,1],
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    },
   navigation: true,
    navigationText: [
      "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-left'></i>",
      "<i id='intrasys-icon-arrow-left' class='intrasys-icon-arrow-right'></i>"
      ],
    beforeInit : function(elem){
      //Parameter elem pointing to $("#owl-demo")
     // random(elem);
    }

  });

  // Product variations active background change

  $('.tax-variation_1').addClass('tax-variation_current');

  // Prod Variation Active
  $('.tax-variation_1 > a').on('click', function () {
  	// Display our base
  	$('.tax-variation_1').addClass('tax-variation_active');

  	// hide other bases
  	$('.tax-variation_2').removeClass('tax-variation_active');
  	$('.tax-variation_3').removeClass('tax-variation_active');
  });

  // Prod Variation Active
  $('.tax-variation_2 > a').on('click', function () {
  	// Add class
  	$('.tax-variation_2').addClass('tax-variation_active');

  	// remove classes from others
  	$('.tax-variation_1').removeClass('tax-variation_active');
  	$('.tax-variation_3').removeClass('tax-variation_active');
  	$('.tax-variation_1').removeClass('tax-variation_current');
  });

  // Prod Variation Active
  $('.tax-variation_3 > a').on('click', function () {
      	// Add class
      $('.tax-variation_3').addClass('tax-variation_active');

      // remove classes from others
      $('.tax-variation_1').removeClass('tax-variation_active');
      $('.tax-variation_2').removeClass('tax-variation_active');
      $('.tax-variation_1').removeClass('tax-variation_current');
  });

  // Back to Top Function

  $("#btn-top").click(function() {
      $('html, body').animate({
          scrollTop: $("#masthead").offset().top
      }, 1000);
  });

  $(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#btn-top').fadeIn();
    } else {
        $('#btn-top').fadeOut();
    }
  });

  // scroll down
  $("#btn-down").click(function() {
      $('html, body').animate({
          scrollTop: $("#scroll-down").offset().top
      }, 1500);
  });

  // scroll down
  $(".accessories-btn").click(function() {
      $('html, body').animate({
          scrollTop: $("#main").offset().top
      }, 1500);
  });




  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }

  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });

  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }

    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }

  }
  
  function syncPosition4(el){
    var current = this.currentItem;
    $("#sync4")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync4").data("owlCarousel") !== undefined){
      center4(current)
    }
  }

  $("#sync4").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync3.trigger("owl.goTo",number);
  });

  function center4(number){
    var sync4visible = sync4.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync4visible){
      if(num === sync4visible[i]){
        var found = true;
      }
    }

    if(found===false){
      if(num>sync4visible[sync4visible.length-1]){
        sync4.trigger("owl.goTo", num - sync4visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync4.trigger("owl.goTo", num);
      }
    } else if(num === sync4visible[sync4visible.length-1]){
      sync4.trigger("owl.goTo", sync4visible[1])
    } else if(num === sync42visible[0]){
      sync4.trigger("owl.goTo", num-1)
    }

  }
  
  function syncPosition6(el){
    var current = this.currentItem;
    $("#sync6")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync6").data("owlCarousel") !== undefined){
      center6(current)
    }
  }

  $("#sync6").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync5.trigger("owl.goTo",number);
  });

  function center6(number){
    var sync6visible = sync6.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync6visible){
      if(num === sync6visible[i]){
        var found = true;
      }
    }

    if(found===false){
      if(num>sync6visible[sync6visible.length-1]){
        sync6.trigger("owl.goTo", num - sync6visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync6.trigger("owl.goTo", num);
      }
    } else if(num === sync6visible[sync6visible.length-1]){
      sync6.trigger("owl.goTo", sync6visible[1])
    } else if(num === sync6visible[0]){
      sync6.trigger("owl.goTo", num-1)
    }

  }
  
  function syncPosition8(el){
    var current = this.currentItem;
    $("#sync8")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync8").data("owlCarousel") !== undefined){
      center8(current)
    }
  }

  $("#sync8").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync7.trigger("owl.goTo",number);
  });

  function center8(number){
    var sync8visible = sync8.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync8visible){
      if(num === sync8visible[i]){
        var found = true;
      }
    }

    if(found===false){
      if(num>sync8visible[sync8visible.length-1]){
        sync8.trigger("owl.goTo", num - sync8visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync8.trigger("owl.goTo", num);
      }
    } else if(num === sync8visible[sync8visible.length-1]){
      sync8.trigger("owl.goTo", sync8visible[1])
    } else if(num === sync8visible[0]){
      sync8.trigger("owl.goTo", num-1)
    }

  }
  function syncPosition10(el){
    var current = this.currentItem;
    $("#sync10")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync108").data("owlCarousel") !== undefined){
      center10(current)
    }
  }

  $("#sync10").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync9.trigger("owl.goTo",number);
  });

  function center10(number){
    var sync10visible = sync10.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync10visible){
      if(num === sync10visible[i]){
        var found = true;
      }
    }

    if(found===false){
      if(num>sync10visible[sync10visible.length-1]){
        sync10.trigger("owl.goTo", num - sync10visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync10.trigger("owl.goTo", num);
      }
    } else if(num === sync10visible[sync10visible.length-1]){
      sync10.trigger("owl.goTo", sync10visible[1])
    } else if(num === sync10visible[0]){
      sync10.trigger("owl.goTo", num-1)
    }

  }


   $(".plus").click(function (e) {
      e.preventDefault();
           // $(".popup-box").toggle('slide', {'down'}, 400);
            $(".popup-box").toggle(400);
   });
   $(".popup-close").click(function (e) {
      e.preventDefault();
           // $(".popup-box").toggle('slide', {'down'}, 400);
            $(".popup-box").toggle(400);
   });


   $(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
    helpers:{
      overlay:{
        locked:false
      }
    }
	} );
      $(".form-download").fancybox({
		maxWidth	: 370,
         maxHeight	: 550,

		width		: '60%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
    helpers:{
      overlay:{
        locked:false
      }
    }
	});
	
	$(".brochure-download").fancybox({
		maxWidth	: 370,
         maxHeight	: 250,

		width		: '60%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
    helpers:{
      overlay:{
        locked:false
      }
    }
	});

  $(".free-sample-folder").fancybox({
    maxWidth  : 370,
         maxHeight  : 250,

    width   : '60%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none',
    helpers:{
      overlay:{
        locked:false
      }
    }
  });
	
	$(".free-samples").fancybox({
		maxWidth	: 800,
         maxHeight	: 950,

		width		: '60%',
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		helpers:{
		  overlay:{
			locked:false
		  }
		},
		'beforeClose': function() 
		{
			$('#mainformsampleselect').show();  
			$('#mainformsamples').hide();
			$('.freesamplecheckbox').each(function()
			{
				$(this).prop( "checked", false );
			});
		},
	});

  if( $("#order-sample-pop-up-button").length > 0 ){

    var order_popup = false;

    $( window ).scroll(function() {

      if( !order_popup ){

        order_popup = true;

        setTimeout(function(){

          $("#order-sample-pop-up-button").fancybox({
            closeClick : false,
            helpers:{
              overlay:{
                locked:false
              }
            }
          });

          $("#order-sample-pop-up-button").trigger('click');

        },1000);

      }

    });

  }

          // Check the initial Position of the Sticky Header
          var nav = $('.sticky');
          if (nav.length) {
              var stickyNavTop = nav.offset().top;
              $(window).scroll(function () {
                  if ($(window).scrollTop() > stickyNavTop) {
                     $('.sticky').addClass('sticktotop');
                     $('.responsive-menu').removeClass('menu-scroll-down');

                    // $('.responsive-menu').style.top = "0px";
                     //  $('.responsive-menu').style.bottom = "initial";

                  } else {
                     $('.sticky').removeClass('sticktotop');
                     $('.responsive-menu').addClass('menu-scroll-down');

                   //  $('.responsive-menu').style.bottom = "40px";

                  }
              });
          }

var sectionHeight = $(".prod-info").height();


if ($(".prod-info").height() < $(".thumb-featured").height() ) {
  sectionHeight =  $(".thumb-featured").height();
}


$(".post_system").css({'height':sectionHeight +'px'});


var elementSample = document.getElementById('freesmapleorder');
if(elementSample)
{
elementSample.addEventListener("click", function(event)
{
	var sampleID = 1;
	$('.freesamplecheckbox').each(function()
	{
		if($(this).is(':checked'))
		{
			$('#sample'+sampleID).val($(this).val());
			sampleID++;
		}
	});
	
	document.getElementById('mainformsampleselect').style.display = 'none';  
	document.getElementById('mainformsamples').style.display = 'block';
});
}

});

jQuery(window).resize(function($) {
var sectionHeight = jQuery(".prod-info").height();


if (jQuery(".prod-info").height() < jQuery(".thumb-featured").height() ) {
  sectionHeight =  jQuery(".thumb-featured").height();
}


jQuery(".post_system").css({'height':sectionHeight +'px'});


});
