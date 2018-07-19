
<div class="col-sm-12 text-center">
  <form id='form-id'>
    <div class="row">
      <div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label class="payment_tab">
        <div class="row">
          <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2 payment_radio">
            <input id='watch-me' name='test' type='radio' checked  class="payment_type" dddd="add_credit_card"/>
          </div>
          <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
            <div class="payment_tab_text">Eway</div>
          </div>
          <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4"> <img src="<?php echo base_url('assets/image/credit_1.png')?>" class="img-responsive payment_img" style="max-height:15px;max-width:15px;"/> <img src="<?php echo base_url('assets/image/ebay.png')?>" class="img-responsive payment_img" /> 
            <!--   
                  <img src="<?php echo base_url('assets/image/payment-creditcard@2x (1).png')?>" class="img-responsive payment_img" /> --> 
            <!--assets/images/ebay.png--> 
          </div>
        </div>
        </label>
      </div>
      
      <!--<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label class="payment_tab">
                <div class="row">
                  <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2 payment_radio">
                    <input id='see-me' name='test' type='radio'  class="payment_type" dddd="paypal_account"/>
                  </div>
                  <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                    <div class="payment_tab_text">Add PayPal Account</div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4"> <img src="<?php echo base_url('assets/image/payment-paypal@2x.png')?>" class="img-responsive payment_img" /> </div>
                </div>
                </label>
              </div>-->
      <?php if($this->payment_option!=''){?>
      <div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label class="payment_tab">
        <div class="row">
          <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2 payment_radio">
            <input id='watch-me' name='test' type='radio' class="payment_type" dddd="Other"/>
          </div>
          <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
            <div class="payment_tab_text"> Other </div>
          </div>
          <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6"> <img src="<?php echo base_url('assets/image/oth_icon.png')?>" class="img-responsive payment_img" style="max-height:15px;max-width:15px;"/> <img src="<?php echo base_url('assets/image/oth_main.png')?>" class="img-responsive payment_img" /> </div>
        </div>
        </label>
      </div>
      <?php }?>
    </div>
  </form>
  <div id='add_credit_card' class="row well payment_well" style="margin-left:0px; margin-right:0px;">
    <form class="form-horizontal" method="post" action="<?php echo base_url('checkout/payment_other');//payment_eway_submit?>">
      Eway
      <input type="submit" name="Eway" style="margin-left:10px;" class="btn btn-primary checkout-btn pull-right btn-lg" value="Submit"/>
    </form>
  </div>
  <!--<div id='paypal_account' style='display:none;' class="payment_well">Paypal</div>-->
  <?php if($this->payment_option!=''){?>
  <div id='Other' style='display:none;' class="payment_well">
    <form class="form-horizontal" method="post" action="<?php echo base_url('checkout/payment_other')?>">
      Other
      <input type="submit" name="Other" style="margin-left:10px;" class="btn btn-primary checkout-btn pull-right btn-lg" value="Submit"/>
    </form>
  </div>
  <?php }?>
</div>
<script type="text/javascript">
$('input[name=test]').click(function () {
    var dddd=$(this).attr('dddd');
	$(".payment_well").hide('slow');
	 $("#"+dddd).show('slow');
	/*
	
	if (this.id == "watch-me") {
        $("#add_credit_card").show('slow');
    } else {
        $("#add_credit_card").hide('slow');
    }
	*/
});
</script> 
<script type="text/javascript">
           $(document).ready(function(){

moment.locale('tr');
//var ahmet = moment("25/04/2012","DD/MM/YYYY").year();
var date = new Date();
bugun = moment(date).format("DD/MM/YYYY");

      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        //startDate: '+1d',
        //endDate: '+0d',
        container: container,
        todayHighlight: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        language: 'tr',
        //defaultDate: moment().subtract(15, 'days')
        //setStartDate : "<DATETIME STRING HERE>"
      };
      date_input.val(bugun);
      date_input.datepicker(options).on('focus', function(date_input){
     $("h3").html("focus event");      
      }); ;
      
      
 date_input.change(function () {
    var deger = $(this).val();
    $("h3").html("<font color=green>" + deger + "</font>");
  });      
      
 
      
$('.input-group').find('.glyphicon-calendar').on('click', function(){
//date_input.trigger('focus');
//date_input.datepicker('show');
 //$("h3").html("event : click");


if( !date_input.data('datepicker').picker.is(":visible"))
{
       date_input.trigger('focus');
    $("h3").html("Ok"); 
 
    //$('.input-group').find('.glyphicon-calendar').blur();
    //date_input.trigger('blur');
    //$("h3").html("görünür");    
} else {
}


});      
 
 
 });
 </script> 
<!--<script src="js/data-picker.js"></script> 
<script>
  $(function() {
$( "#datepicker" ).datepicker();
});
</script> --> 
<script>

/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>