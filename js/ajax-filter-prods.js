jQuery(document).ready(function($) {
  $('.prod-filter').click(function(event) {

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
      test_prod: selected_product, // selected tag



    };

    $.post(afp_vars.afp_ajax_url, data, function(response) {

      if (response) {
        // Display posts on page
        $('.prod_thumbs').html(response);
        // Restore div visibility
        $('.prod_thumbs').fadeIn();
      };
    });
  });
  if ($('.prod_thumbs img').length == 0) $('.tax-variation_1 .prod-filter').trigger('click');

  //SAMPLE BASKET TRIGGER SETUP

  function addToBasket(itemToAdd) {
    var currentFinish = $('.product-finish.active p').text();
    var basketItemText = $(itemToAdd).find('span').text() + ' ('+currentFinish+' | '+$(itemToAdd).closest('.product-variation').find('.product-variation__title').text()+')';
    var basketImage = $(itemToAdd).find('img').attr('src');
    $('.sample-basket__items').append('<div class="sample-in-basket" data-text="'+basketItemText+'"><img src="'+basketImage+'"/><span>'+basketItemText+'</span></div>');
  }

  function removeFromBasket(itemToRemove,self) {
    if (self) {
      console.log($(this));
      $(this).remove();
    }
    else {
      var currentFinish = $('.product-finish.active p').text();
      var basketItemText = $(itemToRemove).find('span').text() + ' ('+currentFinish+' | '+$(itemToRemove).closest('.product-variation').find('.product-variation__title').text()+')';
      $('.sample-basket__items > div[data-text="'+basketItemText+'"]').remove();
    }
  }


  //SB
  var listBasketProductVariants = function(title, mydata) {

    $('#sample-basket .sample-basket__title').html(function() {
      return '<p><span id="go-to-products">Products</span> > <span id="product-name" data-product-id="">' + title + '</span></p>';
    });
    $('.sample-basket__content__stage').css({
      left: "-200%"
    });


    //console.log(data.acf);

    var endpoint = '/intrasystems/wp-json/wp/v2/var_finish/';
    $.ajax({
      url: endpoint,
      method: 'GET'
    }).done(function(response) {
      var finishes = response;

      $('.sample-basket__content__variants').html(function() {

        var finishFilter = '<div class="product-finishes-filter">';
        var toreturn = '<div class="product-finishes">';

        $.each(mydata.acf.finishes, function(index) {

          var finishID = this;
          var finish = getObjects(finishes, 'id', finishID);
          var finishName = finish[0]["name"];

          finishFilter += '<div class="product-finish"><p class="product-finish__name">' + finishName + '</p></div>';

          toreturn += '<div class="product-finish-list" id="pfl-'+index+'"></div>';

        });

        finishFilter += '</div>';

        toreturn += '<div id="go-to-basket"><span>Request Samples</span></div>';

        return finishFilter + toreturn;

      });

      $('.product-finish-list').on('click', '.basket-item', function(event) {
        if ($(this).hasClass('in-basket')) {
          $(this).removeClass('in-basket');
          removeFromBasket(this,false);
        }
        else {
          $(this).addClass('in-basket');
          addToBasket(this);
        }
       });

$('.sample-basket__items').on('click', '.sample-in-basket', function(event) {
$(this).remove();

var thisItemsName = $(this).attr('data-text');
var thisItemsNameAsAnObject = thisItemsName.split(' (');
var thisItemsListName = thisItemsNameAsAnObject[0];
var tr = thisItemsNameAsAnObject[1];
var thisItemsStyle = tr.replace(")","");

var selector = '.product-variation[data-variation-title="'+thisItemsStyle+'"] li[data-name="'+thisItemsListName+'"]';


$(selector).removeClass('in-basket');

});

      $.each(mydata.acf.finishes, function(index) {

        var finishID = this;
        var finish = getObjects(finishes, 'id', finishID);
        var finishName = finish[0]["name"];

        var finishIndex = index;

        $.each(mydata.acf.prod_var, function(index) {

          var pvlID = index;
          var productVariationTitle = (this.var_cat) ? this.var_cat : "Regular";

          $('#pfl-'+finishIndex).append('<article class="product-variation" data-variation-title="'+finishName+' | '+productVariationTitle+'"><p class="product-variation__title">' + productVariationTitle + '</p><ul id="pv-list-' + finishIndex + '-' + pvlID + '" class="product-variation__list"></ul>');

          $.each(this.variations, function() {

            var endpoint = '/intrasystems/wp-json/wp/v2/variations/?_embed&var_prod=' + this.term_id + '&var_finish=' + finishID;
            var variantName = this.name;
            $.ajax({
              url: endpoint,
              method: 'GET'
            }).done(function(response) {

              var myListID = '#pv-list-' + finishIndex + '-' + pvlID;
              var featuredImage = response[0]._embedded['wp:featuredmedia']['0']['media_details']['sizes']['prod_featured-small']['source_url'];

              $(myListID).append('<li data-name="'+variantName+'" class="basket-item"><img src="'+featuredImage+'"/><span>' + variantName + '</span></li>');
            });

          });

        });

      });



      $('.product-finish:nth-child(1)').addClass('active');
      $('.product-finish-list:nth-child(1)').addClass('active');

      $('.product-finish').click(function() {
        if (!$(this).hasClass('active')) {
          var thisIndex = $(this).index() + 1;
          $('.product-finish').removeClass('active');
          $(this).addClass('active');
          $('.product-finish-list').removeClass('active');
          $('.product-finish-list:nth-child(' + thisIndex + ')').addClass('active');
        }
      });

      $('.product-variation:nth-child(1) .product-variation__title').addClass('active');

      $('.product-variation__title').click(function() {
        if (!$(this).hasClass('active')) {
          $('.product-variation__title').removeClass('active');
          $(this).addClass('active');
        }
      });

    });
  }

  var getBasketProductVariants = function(title, id) {

    var endpoint = '/intrasystems/wp-json/acf/v3/products/' + id + '/';
    $.ajax({
      url: endpoint,
      method: 'GET'
    }).done(function(response) {
      new listBasketProductVariants(title, response);
    }).fail(function(response) {
      // Show error message
      alert(response.responseJSON.message);
    }).always(function() {
      // e.g. Remove 'loading' class.

    });
  }

  var listProductTypes = function(data) {
    $('.sample-basket__content__stage').css({
      left: "0%"
    });
    $('#sample-basket .sample-basket__title').html(function() {
      return '<p>Select a product type</p>';
    });

    $('#sample-basket .sample-basket__content__types').html(function() {
      var toreturn = "";
      toreturn += '<article class="sample-basket__content__types__type" data-product-category="466" data-product-type="ceilings"><p>Ceilings</p></article>';
      toreturn += '<article class="sample-basket__content__types__type" data-product-category="465" data-product-type="grilles"><p>Grilles</p></article>';
      toreturn += '<article class="sample-basket__content__types__type" data-product-category="464" data-product-type="matting"><p>Matting</p></article>';
      return toreturn;
    });
    $('.sample-basket__content__types__type').click(function() {
      var filter = $(this).attr('data-product-category');
      new sampleBasketProducts(filter);
    });
  }

  var listBasketProducts = function(data, category) {
    var productCategory = new Number(category);

    $('.sample-basket__content__stage').css({
      left: "-100%"
    });
    $('#sample-basket .sample-basket__title').html(function() {
      return '<p>Select a product</p>';
    });
    $('#sample-basket .sample-basket__content__products').html(function() {
      var toreturn = "";
      $.each(data, function(index) {

        var featuredImage = this._embedded['wp:featuredmedia']['0']['media_details']['sizes']['prod_featured-small']['source_url'];
        var itemTitle = this.title.rendered;
        var itemID = this.id;

        var match = 0;

        $.each(this.categories, function() {

          var thisCategory = this;

          if (thisCategory - productCategory == 0) match = 1;

        });


        if (match == 1) {
          toreturn += '<article class="sample-basket__item" data-product-category="" data-product-id="' + itemID + '">';
          toreturn += '<div class="sample-basket__item__image"><img src="' + featuredImage + '" alt="' + itemTitle + '"/></div>';
          toreturn += '<p class="sample-basket__item__name">' + itemTitle + '<p>';
          toreturn += '</article>';
        }
      });
      return toreturn;
    });
    $('.sample-basket__item').click(function() {
      var productID = $(this).attr('data-product-id');
      var productTitle = $(this).find('p').text();
      new getBasketProductVariants(productTitle, productID);
    });
  }

  function getObjects(obj, key, val) {
    var objects = [];
    for (var i in obj) {
      if (!obj.hasOwnProperty(i)) continue;
      if (typeof obj[i] == 'object') {
        objects = objects.concat(getObjects(obj[i], key, val));
      } else if (i == key && obj[key] == val) {
        objects.push(obj);
      }
    }
    return objects;
  }

  var sampleBasketProducts = function(category) {

    var storedProducts = sessionStorage.getItem("__insys_productList");

    if (storedProducts) {
      var products = JSON.parse(storedProducts);
      new listBasketProducts(products, category);
    } else {

      // Use the main Wordpress API to make the initial call to reduce page load if someone isn't using the tool
      var endpoint = '/intrasystems/wp-json/wp/v2/products?_embed&per_page=100';
      $.ajax({
        url: endpoint,
        method: 'GET', // POST means "add friend" for example.
        data: {
          foo: 'var',
          hoge: 'fuga'
        }
      }).done(function(response) {

        //LOAD PRODUCTS INTO FRAME ONE
        var productsToSave = JSON.stringify(response);
        sessionStorage.setItem("__insys_productList", productsToSave);
        new listBasketProducts(response, category);
      }).fail(function(response) {
        // Show error message
        alert(response.responseJSON.message);
      }).always(function() {
        // e.g. Remove 'loading' class.

      });

    }
  }

  var sampleBasket = function() {
    new listProductTypes();
  }

  new sampleBasket;

  $('#sample-basket-tab').click(function() {
    new listProductTypes;
    $(this).addClass('hidden');
    $('#sample-basket').addClass('open');

  });
  $('.sample-basket__close').click(function() {
    $('#sample-basket-tab').removeClass('hidden');
    $(this).closest('.sample-basket').removeClass('open');
  });

  if ($('body.logged-in').length > 0) $('#sample-basket-tab').trigger("click");

});
