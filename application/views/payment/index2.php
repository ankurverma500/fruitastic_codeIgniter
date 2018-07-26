<style>
.customer-details{padding-bottom: 0px;    border: none;    padding-top: 0px;}
</style>
<div  class="row">
    <div class="col-sm-12">
    
  		<div  class="col-sm-12 col-md-6">
            <div  class="payment_div text-center ">
              <div  class="row">
                <div  class="col-sm-12"> <img  class="img-responsive pull-left credit_icon" src="<?php echo base_url('assets/images/credit_1.png')?>">
                  <p  class="payment_heading">Credit Card</p>
                </div>
                <div  class="col-sm-12">
                  <p  class="text-center txt_payment">Pay Securely with</p>
                </div>
                <div  class="col-sm-8 col-sm-offset-2">
                  <p  class="text-center"> <img  class="img-responsive" src="<?php echo base_url('assets/images/ebay.png')?>"> </p>
                </div>
              </div>
              <!--<div _ngcontent-c9="" id="ewaypay"><form ngnoform="" action="https://www.binaryfrog.co/dev//payment/eway" method="post"><input type="hidden" value="4952" name="order_id"><span class="hoverd-btn span_your_detail_login_butn"><input type="submit" value="PayNow" class="your_detail_login_butn"></span> </form></div>-->
              <div  id="ewaypay" class="customer-details" style="">
                <form class="form-horizontal" method="post" action="<?php echo base_url('checkout/payment_other')?>">
                  <span class="hoverd-btn span_your_detail_login_butn">
                  <input type="submit" name="Eway" value="PayNow" class="your_detail_login_butn">
                  <!--<input type="submit" name="Eway" style="margin-left:10px;" class="btn btn-primary checkout-btn pull-right btn-lg" value="Submit"/>--> 
                  </span>
                </form>
              </div>
            </div>
          </div>
          
          
          <div  class="col-sm-12 col-md-6 pytHid" <?php if($order_type==1){echo 'style="display:block;"';}?> >
            <div  class="payment_div text-center">
              <div  class="row">
                <div  class="col-sm-8 col-sm-offset-2"> <img  class="img-responsive paypal_icon2 pull-left" src="<?php echo base_url('assets/images/paypal-icon21.png')?>">
                  <p  class="payment_heading">Paypal</p>
                </div>
                <div  class="col-sm-12">
                  <p  class="text-center txt_payment">Pay Securely with</p>
                </div>
                <div  class="col-sm-8 col-sm-offset-2">
                  <p  class="text-center"> 
                  <img  class="img-responsive" src="<?php echo base_url('assets/images/paypal-main.png')?>"> 
                  </p>
                </div>
              </div>
              
              <div  id="paypal-button" ></div>
              <div  id="paypalpay"></div>
            </div>
          </div>
          
          
          <div  class="col-sm-12 col-md-6" <?php if($order_payment_option==''){echo 'style="display:none;"';}?>>
            <div  class="payment_div text-center">
              <div  class="row">
                <div  class="col-sm-8 col-sm-offset-2"> <img  class="img-responsive others_icon3" src="<?php echo base_url('assets/images/oth_icon.png')?>">
                  <p  class="payment_heading">Other</p>
                </div>
                <div  class="col-sm-12">
                  <p  class="text-center txt_payment">Other Payment Options</p>
                  <p  class="text-center txt_payment">MSG : 7 Days after Delivery</p>
                </div>
                <div  class="col-sm-8 col-sm-offset-2">
                  <p  class="text-center"> 
                  <img  class="img-responsive" src="<?php echo base_url('assets/images/oth_main.png')?>"> 
                  </p>
                  <div class="customer-details">
                  <form class="form-horizontal" method="post" action="<?php echo base_url('checkout/payment_other')?>">
                  <span class="hoverd-btn span_your_detail_login_butn"></span>
                    <input type="submit" name="Other"  class="your_detail_login_butn" value="Submit"/>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
            
    </div>  
</div>
<script src="https://www.paypalobjects.com/api/checkout.js" ></script> 
<script> 

$(function () {
	 var morderid = '<?php echo '3';//$this->session->userdata('total_order_array');?>';
	 paypal.Button.render({
		 env: 'sandbox', // sandbox | production		
		 style: {
			 label: "pay",
			 size: "responsive",
			 shape: "rect",
			 color: "gold"
		 },
		 client: {
			 sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',              
			 production: "AbVLn8rsiLSmQPxIHdDcW_zSrkiT8tShjO66t-Nj6WNDSiQLEWkK6iIc46XWrdfi3JoevQI-2MF-sqAx"
		 },
		 commit: true,
		 payment: function(e, t) {
			 return t.payment.create({
				 payment: {
					 transactions: [{
						 amount: {
							 total: '<?php  echo number_format($this->cart->total(),2);?>',
							 currency: "AUD"
						 }
					 }]
				 }
			 })
		 },
		 onAuthorize: function(e, t) {
			 /*return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
					 submitOrder(morderid, "paypal", e.state, e.id)
                });*/
			 return t.payment.execute().then(function(e) {
					 submitOrder(morderid, "paypal", e.state, e.id)
				
			 })
		 },
		 onCancel: function(e) {
			 alert("The payment was cancelled!");
			 //this.router.navigate(["/fail"]);
			 window.location.assign("<?php echo base_url("checkout/payment_status/?status=fail");?>");
		 }
	 }, "#paypal-button"); 
});

function submitOrder(order_id, payment_mode, payment_status, transection_id) 
{
    console.log('helloSubmit');
	//var data_url='<?php echo base_url('paypal/return_url');?>';
	var data_url='<?php echo base_url('checkout/payment_other/');?>';
	var data_array={order_id:order_id,payment_mode:payment_mode,payment_status:payment_status,transection_id:transection_id,paypal:'paypal'};
	var ddd=send_ajax_return_value(data_url,data_array);
	console.log(ddd);
	//location.reload();
	window.location.assign("<?php echo base_url("checkout/payment_status/?status=success");?>");
	//var cartd= jQuery.parseJSON(ddd.responseText);
   /* var values = {
      "id": localStorage.getItem('user'),
      "token": localStorage.getItem('token'),
      "order_id": order_id,
      "payment_mode": payment_mode,
      "payment_status": payment_status,
      "transection_id": transection_id
    };
    this.getListService.PostRawlist(localStorage.getItem('base_url')+'upate_order.php', values)
      .map((res: Response) => {
        return res.json();
      }).subscribe((d) => {
        this.router.navigate(['/success']);
      });*/
  }
	 </script>