

jQuery(document).ready(function($) {

var prefix = $('#sample-basket').attr('data-url');
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

  /*
   * SAMPLE BASKET
   */

  function generateBasketItem(itemID, basketItemText, basketImage) {
    $('.sample-basket__items').append('<div class="sample-in-basket" data-id="' + itemID + '" data-text="' + basketItemText + '"><img src="' + basketImage + '"/><span>' + basketItemText + '</span></div>');
  }

  function addToBasket(itemToAdd) {

    var currentFinish = $('.product-finish.active p').text();
    var basketItemText = $(itemToAdd).find('span').text() + ' (' + currentFinish + ' | ' + $(itemToAdd).closest('.product-variation').find('.product-variation__title').text() + ')';
    var basketImage = $(itemToAdd).find('img').attr('src');
    var currentBasket = sessionStorage.getItem('__insys_basketList');
    var itemID = $(itemToAdd).attr('data-id');

    var st = {
      id: itemID,
      title: basketItemText,
      image: basketImage
    }

    if (currentBasket) {
      //PARSE TEXT FROM SESSION STORAGE
      var bo = JSON.parse(currentBasket);
      bo.push(st);
      sessionStorage.setItem('__insys_basketList', JSON.stringify(bo));
    } else {
      var toR = [];
      toR.push(st);
      sessionStorage.setItem('__insys_basketList', JSON.stringify(toR));
    }
    generateBasketItem(itemID, basketItemText, basketImage);
    //$('.sample-basket__items').append('<div class="sample-in-basket" data-id="' + itemID + '" data-text="' + basketItemText + '"><img src="' + basketImage + '"/><span>' + basketItemText + '</span></div>');
  }

  function returnProduct(itemID, basketItems) {

    var newBasketItems = basketItems;
    for (var i = 0; i < newBasketItems.length; i++) {
      if (newBasketItems[i] !== null && newBasketItems[i].id === itemID) {
        //delete newBasketItems[i];
        newBasketItems.splice(i, 1);
      }
    }
    return newBasketItems;
  }

  function returnProductTrue(itemID, basketItems) {
    var match = "";
    for (var i = 0; i < basketItems.length; i++) {

      if (basketItems[i] !== null && parseInt(basketItems[i].id) === parseInt(itemID)) {
        match = " in-basket";
      }
    }
    return match;
  }

  function removeFromBasket(itemID) {

    var currentBasket = JSON.parse(sessionStorage.getItem('__insys_basketList'));

    var newBasketItems = returnProduct(itemID, currentBasket);
    sessionStorage.setItem('__insys_basketList', JSON.stringify(newBasketItems, function(key, value) {
      if (value !== null) return value;
    }));

    $('.basket-item[data-id="' + itemID + '"').removeClass('in-basket');
    $('.sample-basket__items > div[data-id="' + itemID + '"]').remove();
  }

  var listBasketProductVariants = function(title, mydata, prodID) {

    var thisProduct = prodID;


    $('.sample-basket__content__variants__list').html('<p>Loading...</p>');

    setActiveLocation(3);

    $('#sample-basket .sample-basket__title').html(function() {
      return '<p><span id="go-to-products">Products</span> > <span id="product-name" data-product-id="">' + title + '</span></p>';
    });
    $('.sample-basket__content__stage').css({
      left: "-200%"
    });


    var endpoint =   prefix+'/wp-json/wp/v2/var_finish/';
    $.ajax({
      url: endpoint,
      method: 'GET'
    }).done(function(response) {
      var finishes = response;

      var shapes = ["Triangle", "Square", "Rectangle", "Diamond", "Hexagon"];

      $('.sample-basket__content__variants__list').html(function() {

        var finishFilter;
        var toreturn;


        if (mydata.acf.finishes) {

          finishFilter = '<div class="product-finishes-filter">';
          toreturn = '<div class="product-finishes">';

          $.each(mydata.acf.finishes, function(index) {

            var finishID = this;
            var finish = getObjects(finishes, 'id', finishID);
            var finishName = finish[0]["name"];
            finishFilter += '<div class="product-finish"><p class="product-finish__name">' + finishName + '</p></div>';
            toreturn += '<div class="product-finish-list" id="pfl-' + index + '"></div>';

          });
          finishFilter += '</div>';
        } else {

          //BUILD THE INTRASHAPE FILTERS MANUALLY
          if (mydata.acf.alt_text == "INTRAshape") {
            finishFilter = '<div class="product-finishes-filter">';
            console.log(shapes);
            for (var i = 0; i < 5; i++) {
              finishFilter += '<div class="product-finish"><p class="product-finish__name">' + shapes[i] + '</p></div>';
            }
            finishFilter += '</div>';
            toreturn = '<div class="product-finishes">';

            for (var i = 0; i < 5; i++) {
              toreturn += '<div class="product-finish-list" id="pfl-' + i + '"></div>';
            }

            toreturn += '</div>';
          } else {
            finishFilter = '<div style="display:none" class="product-finishes-filter"><div class="product-finish"><p class="product-finish__name">Regular</p></div></div>';
            toreturn = '<div class="product-finishes"><div class="product-finish-list active" id="pfl-0"></div></div>';
          }
        }

        return finishFilter + toreturn;

      });

      $('.product-finish-list').on('click', '.basket-item', function(event) {
        var basketItemID = $(this).attr('data-id');
        if ($(this).hasClass('in-basket')) {
          $(this).removeClass('in-basket');
          removeFromBasket(basketItemID);
        } else {
          $(this).addClass('in-basket');
          addToBasket(this);
        }
      });

      $('.sample-basket__items').on('click', '.sample-in-basket', function(event) {
        var itemID = $(this).attr('data-id');
        removeFromBasket(itemID);
      });

      var productVariations = JSON.parse(localStorage.getItem('__insys_variationList'));
      var currentBasket = JSON.parse(sessionStorage.getItem('__insys_basketList'));

      if (mydata.acf.finishes) {



        $.each(mydata.acf.finishes, function(index) {

          var finishID = this;
          var finish = getObjects(finishes, 'id', finishID);
          var finishName = finish[0]["name"];
          var finishIndex = index;

          var productVariationTitle = (this.var_cat) ? this.var_cat : "Regular";

          $.each(mydata.acf.prod_var, function(index) {

            var pvlID = index;
            var productVariationTitle = (this.var_cat) ? this.var_cat : "Regular";

            $('#pfl-' + finishIndex).append('<article class="product-variation" data-variation-title="' + finishName + ' | ' + productVariationTitle + '"><p class="product-variation__title">' + productVariationTitle + '</p><ul id="pv-list-' + finishIndex + '-' + pvlID + '" class="product-variation__list"></ul>');

            $.each(this.variations, function() {

              var variationID = this.term_id;
              var variantName = this.name;

              var filteredProductVariation = productVariations.filter(function(el) {
                //if (finishIndex == 0) console.log(el.var_finish[0]);
                return el.var_prod[0] == parseInt(variationID) &&
                el.var_finish[0] == parseInt(finishID);
              });

              var myListID = '#pv-list-' + finishIndex + '-' + pvlID;
              var featuredImage = filteredProductVariation[0]._embedded['wp:featuredmedia']['0']['media_details']['sizes']['prod_featured-small']['source_url'];
              var addClass = (currentBasket) ? returnProductTrue(filteredProductVariation[0].id, currentBasket) : "";

              $(myListID).append('<li data-id="' + filteredProductVariation[0].id + '" data-image="' + featuredImage + '" data-name="' + variantName + '" class="basket-item' + addClass + '"><div><img src="' + featuredImage + '"/></div><span>' + variantName + '</span></li>');

            });

          });


        });

      } else {



        $.each(mydata.acf.prod_var, function(index) {

          var pvlID = index;
          var productVariationTitle = (this.var_cat) ? this.var_cat : "Regular";
          var currentBasket = JSON.parse(sessionStorage.getItem('__insys_basketList'));

          for (var i = 0; i < 5; i++) {
            var finishID = i;
            var finishName = shapes[i];
            var finishIndex = i;
            $('#pfl-' + finishIndex).append('<article class="product-variation" data-variation-title="' + finishName + ' | ' + productVariationTitle + '"><p class="product-variation__title">' + productVariationTitle + '</p><ul id="pv-list-' + finishIndex + '-' + pvlID + '" class="product-variation__list"></ul>');
          }

          $.each(this.variations, function() {

            for (var i = 0; i < 5; i++) {

            var variationID = this.term_id;
            var variantName = this.name;

            var filteredProductVariation = productVariations.filter(function(el) {

              return el.var_prod[0] == parseInt(variationID)
            });

            var myListID = '#pv-list-' + i + '-' + pvlID;
            var featuredImage = filteredProductVariation[0]._embedded['wp:featuredmedia']['0']['media_details']['sizes']['prod_featured-small']['source_url'];
            var addClass = (currentBasket) ? returnProductTrue(filteredProductVariation[0].id, currentBasket) : "";

            $(myListID).append('<li data-id="' + filteredProductVariation[0].id + '" data-image="' + featuredImage + '" data-name="' + variantName + '" class="basket-item' + addClass + '"><div><img src="' + featuredImage + '"/></div><span>' + variantName + '</span></li>');

            }

          });

        });

      }


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

    var endpoint = prefix+'/wp-json/acf/v3/products/' + id + '/';
    $.ajax({
      url: endpoint,
      method: 'GET'
    }).done(function(response) {

      new listBasketProductVariants(title, response, id);
    }).fail(function(response) {
      // Show error message
      alert(response.responseJSON.message);
    }).always(function() {
      // e.g. Remove 'loading' class.

    });
  }

  var listProductTypes = function(data) {

    console.log("listing product types");

    $('.sample-basket__content__types .loading').addClass('loaded');

    setActiveLocation(1);
    $('.sample-basket__content__stage').css({
      left: "0%"
    });

    $('.sample-basket__content__types__type').click(function() {
      var filter = $(this).attr('data-product-category');
      new sampleBasketProducts(filter);
    });
  }

  function setActiveLocation(num) {
    $('.sample-basket__progress__stage').removeClass('active');
    $('.sample-basket__progress__stage:nth-child(' + num + ')').addClass('active');
  }

  var goCheckout = function() {
    setActiveLocation(4);
    $('.sample-basket__content__stage').css({
      left: "-300%"
    });
  }

  $('.sample-basket__progress__stage.type').click(function() {
    new listProductTypes;
  });

  var listBasketProducts = function(data, category) {
    setActiveLocation(2);

    var productCategory = new Number(category);

    $('.sample-basket__content__stage').css({
      left: "-100%"
    });

    $('#sample-basket .sample-basket__content__products__list').html(function() {
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
      var endpoint = prefix+'/wp-json/wp/v2/products?_embed&per_page=100';
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

  var addBasketItems = function() {
    var basketItems = JSON.parse(sessionStorage.getItem('__insys_basketList'));

    if (basketItems) {
      for (var i = 0; i < basketItems.length; i++) {
        generateBasketItem(basketItems[i].id, basketItems[i].title, basketItems[i].image);
      }
    }
  }


  var sampleBasket = function() {

    new listProductTypes;
    new addBasketItems;
  }

  var sampleBasketPreload = function() {

    var storedVariations = localStorage.getItem('__insys_variationList');

    if (storedVariations !== null) {
      new sampleBasket;
    } else {

        $('.sample-basket__content__stage').css({
          left: "0%"
        });



      function getPage(page) {

        var finishEndpoint = prefix+'/wp-json/wp/v2/variations/?_embed&per_page=100&page=' + page;

        return $.get(finishEndpoint).then(function(r) {
          return r;
        });
      }

      $.when(getPage(1), getPage(2), getPage(3), getPage(4), getPage(5)).then(function(p1, p2, p3, p4, p5) {
        var variations = p1.concat(p2).concat(p3).concat(p4).concat(p5);
        localStorage.setItem('__insys_variationList', JSON.stringify(variations));
        new sampleBasket;
      });
    }

  }


  $('#go-to-basket').click(function() {

    if ($(this).prev().children().length > 0) {
      if ($('.sample-basket__progress__stage.checkout').hasClass('active')) {
        //GENERATE TEXT FOR INPUT FIELD HERE
        var basketContents = JSON.parse(sessionStorage.getItem('__insys_basketList'));
        var fieldSubmit = "";

        $.each(basketContents, function() {
          fieldSubmit += this.title + ' \r\n';
        });

        $('#sampleRequestInputField').val(fieldSubmit);

        $('.sample-basket__content__basket .submit-btn input').trigger('click');
      } else {
        new goCheckout;
      }

    }
  });



$('.header-prod .blue-solid-btn').click(function(e) {
  e.preventDefault();
  if ($('.sample-basket').length > 0) {
  new sampleBasketPreload;
$('#sample-basket-tab').addClass('hidden');
  $('#sample-basket').addClass('open');
  }
  else {
    window.location = 'https://intrasystems.co.uk/request-free-samples/';
  }
});



  $('#sample-basket-tab').click(function() {
    new sampleBasketPreload;
    $(this).addClass('hidden');
    $('#sample-basket').addClass('open');
  });
  $('.sample-basket__close').click(function() {
    $('#sample-basket-tab').removeClass('hidden');
    $(this).closest('.sample-basket').removeClass('open');
  });

  //if ($('body.logged-in').length > 0) $('#sample-basket-tab').removeClass('hidden').trigger("click");



});
