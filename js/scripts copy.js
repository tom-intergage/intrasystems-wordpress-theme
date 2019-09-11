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
    /*
    self.$filterGroups
      .filter('.checkboxes')
    	.on('change', function() {
      	self.parseFilters();
    	});
*/
    
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
   
   $('#Filters').keypress(function(e){
    if ( e.which == 13 ) return false;
    //or...
    if ( e.which == 13 ) e.preventDefault();
});
   

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  var sync_single = $(".sync_single");
 
  sync1.owlCarousel({
    singleItem : true,
    slideSpeed : 1000,
    //navigation: true,
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
   /*
   function random(owlSelector){
    owlSelector.children().sort(function(){
        return Math.round(Math.random()) - 0.5;
    }).each(function(){
      $(this).appendTo(owlSelector);
    });
  }*/
   

 
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
  
   /*     FANCYBOX FOR VIDEOS    */
  // $(".fancybox").fancybox();
   $(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
        $(".form-download").fancybox({
		maxWidth	: 370,
         maxHeight	: 470,
       
		width		: '60%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	}); 
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
   

  //SEARCH Filter
 
   
   //END SEARCH Filter
   


   /*	$(".variation").on("mouseenter", function() {
      $("#zoom-img").show();
});	*/
   
});

/*
jQuery(document).ajaxComplete(function($) {
     
   	$(".variation").on("mouseleave", function() {
      $("#zoom-img").hide();
}); 
}*/