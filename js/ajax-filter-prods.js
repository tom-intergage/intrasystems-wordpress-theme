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


  //SB
  var listBasketProductVariants = function(title, data) {

    console.log(data);

    $('#sample-basket .sample-basket__title').html(function() {
      return '<p><span id="go-to-products">Products</span> > <span id="product-name" data-product-id="">' + title + '</span></p>';
    });
    $('.sample-basket__content__stage').css({
      left: "-200%"
    });


    //console.log(data.acf);

    var endpoint = '/intrasystems/wp-json/acf/v3/var_finish/';
    $.ajax({
      url: endpoint,
      method: 'GET'
    }).done(function(response) {
      var finishes = response;

      $('.sample-basket__content__variants').html(function() {

        var finishFilter = '<div class="product-finishes-filter">';
        var toreturn = '<div class="product-finishes">';

        $.each(data.acf.finishes, function(index) {

          var finishID = this,
            finish = getObjects(finishes, 'id', finishID),
            finishName = finish[0]["name"];

          finishFilter += '<div class="product-finish"><p class="product-finish__name">' + finishName + '</p></div>';

          toreturn += '<div class="product-finish-list">';

          $.each(data.acf.prod_var, function(index) {



            var productVariationTitle = (this.var_cat) ? this.var_cat : "Regular";

            toreturn += '<article class="product-variation"><p class="product-variation__title">' + productVariationTitle + '</p><ul class="product-variation__list">';
            $.each(this.variations, function() {

              toreturn += '<li>' + this.name + '</li>';
            });
            toreturn += '</ul></article>';
          });
          toreturn += '</div>';

        });

        toreturn += '</div><div id="go-to-basket"><span>Request Samples</span></div>';

        finishFilter += '</div>';

        return finishFilter + toreturn;

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

        var featuredImage = this._embedded['wp:featuredmedia']['0'].source_url;
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
