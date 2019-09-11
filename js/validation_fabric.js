var which = '';
( function($){ 

$(document).ready(function(){
 /* $.validator.setDefaults({
        ignore: []
    });*/

  fm_div = $('.login_box_popup form');
  var fm = $('#request_form');

  $('input, textarea, select, .dk_container').live('mouseenter', function() {$(this).siblings(".jv-error").children("div").show();}).live('mouseout', function() {$(this).siblings(".jv-error").children("div").hide();});


  fm.each(function(){ $(this).validate({
    onfocusout: function(element) { jQuery(element).valid(); },
    errorElement: "div",
/*    errorPlacement: function(error, element) {
      error.appendTo(element.parent("span"));
    },
    validPlacement: function(error, element) {
      error.appendTo(element.parent("span"));
    },*/
    success: "jv-valid",
    validClass: "jv-valid",
    errorClass: "jv-error",
    submitHandler: function(form) { 
      $('#block-form1').show();
      $('#fabric').val($('#request_fabric').val());
      $('#supplier').val($('#request_supplier').val());
      ga('send', 'event', 'fabric sample', 'button', 'open bespoke', 1);
      which = 'bespoke';
      return false;
    },  
    rules: {
      fabric_supplier_name: "notempty",
      fabric_name: "notempty"
    },
    messages: {
      fabric_supplier_name: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      fabric_name: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>"
    }
  });
  });

  
  fm_div.each(function(){ $(this).validate({
    onfocusout: function(element) { jQuery(element).valid(); },
    errorElement: "div",
    errorPlacement: function(error, element) {
//      error.removeClass("jv-valid");
      error.appendTo(element.parent("span"));
//      element.siblings('.dk_container').addClass('jv-error');
//      element.siblings('.dk_container').removeClass('jv-valid');
    },
    validPlacement: function(error, element) {
      error.appendTo(element.parent("span"));
//      element.siblings('.dk_container').addClass('jv-valid');
    },
    success: "jv-valid",
    validClass: "jv-valid",
    errorClass: "jv-error",
    invalidHandler: function(form, validator) 
    {
      $("#jv-errornotice").show();
      $(".jv-details").html("");
      $("#jv-errornotice strong").hide();
      if(validator.numberOfInvalids() == 1){$("#jv-errornotice strong.single").show();}else{$("#jv-errornotice strong.plural").show();}
      validator.defaultShowErrors();
//      $(".jv-error:visible div").each(function(){$(".jv-details").append("<li>" + $(this).html() + "</li>");}); 
      $(".jv-error:visible div").each(function(){if ($(this).html().substring(0, 4).toUpperCase() == '<IMG') return; $(".jv-details").append("<li>" + $(this).html() + "</li>");}); 
        },
    submitHandler: function(form) { 
      $.post($(form).attr('action'), $(form).serialize());
      $(form).parents('div.forms').hide();
      $(form).parents('div.forms').after('<div class="thanks">Thank you for your enquiry, we will be in touch soon.</div>'); 
      if (which == 'bespoke') ga('send', 'event', 'fabric sample', 'button', 'submit bespoke', 1);
      if (which == 'listed') ga('send', 'event', 'fabric sample', 'button', 'submit listed', 1);
      ga('send', 'event', 'fabric sample', 'button', 'submit order', 1);
//      $("body").append('<iframe name="form_target" style="width:1px;height:1px;display:none;" id="form_target"></iframe>');
//      $(form).attr('target', 'form_target');
//      setTimeout(function(){ $('#form_target').remove();}, 1000);
//      form.submit();
      return false;
    },  
    rules: {
      fabric_supplier: "notempty",
      fabric: "notempty",
      name: "notempty",
      address1: "notempty",
      city: "notempty",
      postcode: "notempty",
      phone: {
        notempty: true,
        phone: true
      }
    },
    messages: {
      name: "<div>Please tell us your name</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      fabric_supplier: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      fabric: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      address1: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      city: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      postcode: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
      phone: {
        notempty: "<div>This field is required</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>",
        phone: "<div>Please, enter correct phone number</div><div style='border:none !important; background-color: transparent !important;padding-top:0px; padding-left:25px; bottom:18px;'><img src='" + val_object.path + "/img/error.png' width='31' height='9' alt='img' /></div>"
      }
    }
  });})

});
})( jQuery );
