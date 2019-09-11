var s_ids = [];
var s_colors = [];
var s_fabrics = [];

function add_sample(id, color, fabric)
{
  if (s_ids.length < 10)                                                                                 
  {
    jQuery('li.sample-' + id + ' .sample_add').hide().next().show();
    jQuery('.btn--order--samples').show();  // Show btn when item added.
    s_ids.push(id);
    s_colors.push(color);
    s_fabrics.push(fabric);

    jQuery('.list_chose_sample').append('<li class="added-' + id + '"><div class="single_sample"></div><a href="javascript:void(0);" onclick="remove_sample(' + id + ');" class="delete"></a></li>');
    jQuery('li.sample-' + id + ' ').first().clone().appendTo('li.added-' + id + ' .single_sample');
  }
  else
  {
    alert('You can only order 10 samples at a time. Thanks');
  }
}

function remove_sample(id)
{

  jQuery('li.sample-' + id + ' .sample_add').show();
  jQuery('li.sample-' + id + ' .chose').hide();
  jQuery('li.added-' + id).remove();
 // 
if(s_ids.length <=1){
jQuery('.btn--order--samples').hide();  // Show btn when item added.
}
  for(var i = s_ids.length - 1; i >= 0; i--) 
  {
    if(s_ids[i] === id) 
    {
  s_ids.splice(i, 1);
  s_colors.splice(i, 1);
  s_fabrics.splice(i, 1);
    }
  }
}

(function($) {
 $(document).ready(function() 
 {
   $('#order').click(function(e){
  e.preventDefault();
  
  $(".btn--order--samples").click(function() {
      $('html, body').animate({
          scrollTop: $("#content").offset().top
      }, 1000);
  });


  if (s_ids.length == 0) return;
  //$('#block-form2').show();
 // alert('hi');
 

  which = 'listed';
  for (i = 0; i < 10; i++)
  {
    if(s_ids[i] != null)
    {
      $('#sample' + parseInt(i+1)).val(s_ids[i]);
      $('#color' + parseInt(i+1)).val(s_colors[i]);
      $('#fabric' + parseInt(i+1)).val(s_fabrics[i]);     
    }
    else
    {
      $('#sample' + parseInt(i+1)).val('');
      $('#color' + parseInt(i+1)).val('');
      $('#fabric' + parseInt(i+1)).val('');
    }
  }
  $("#trigger-block-form2").trigger('click');

   });

   $('#close1').click(function(e){
  e.preventDefault();
  $('#block-form1').hide();
  $('#block-form1').find('div.jv-error').remove();
  $('#block-form1').find('.jv-error').removeClass('jv-error');
   });

   $('#close2').click(function(e){
  e.preventDefault();
  $('#block-form2').hide();
  $('#block-form2').find('div.jv-error').remove();
  $('#block-form2').find('.jv-error').removeClass('jv-error');

   });


 $("#checkAll").click(function () {
   if ($(this).attr('checked')) {
  //alert('show');
$('.row_prod').show();
$("label[for='checkAll']").text("Clear all selected");
 }
 else{
 //alert('hide');
 $('.row_prod').hide();
$("label[for='checkAll']").text("Select all");
 }
     $('input:checkbox').not(this).prop('checked', this.checked);

 });

 $('.input-checkbox').click(function() {
  var currentId = $(this).attr('id');
  var divCurrentId = "#box_" + currentId;
        if (this.checked) {
            $(divCurrentId).show();
        } else {
            $(divCurrentId).hide();
        }
    }); 

      $(".sample-request-form").fancybox({
    maxWidth  : 430,
         maxHeight  : 750,
       
    width   : '80%',
    height: '80%',
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

 });
})(jQuery);