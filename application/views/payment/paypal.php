<?php
/*echo '<pre>';
print_r($result);	
exit;*/
/*$this->API['USER'] = 'singhkumarvinay23-facilitator_api1.gmail.com';
$this->API['PWD'] = '1410246966';
$this->API['SIGNATURE'] = 'AFcWxV21C7fd0v3bYYYRCpSSRl31A8X9-bZUrSTrtbhVbjjq0cvdrap8';
$this->API['VERSION'] = '108';
$this->API['LOCALECODE'] = 'pt_US';

$this->API['USER'] = 'pavnishyadav-facilitator_api1.gmail.com';
$this->API['PWD'] = 'EH5F8AVSWSDGDGP9';
$this->API['SIGNATURE'] = 'AFcWxV21C7fd0v3bYYYRCpSSRl31AHzNm5HNcZVKOpeI8zx4d5.jtqgE';
$this->API['VERSION'] = '119';
$this->API['LOCALECODE'] = 'pt_US';

        define('C_TYPE','USD');*/
?>
<?php

$submit_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
$return_url=base_url('payment/paypal/return_url/');
$cancel_return=base_url('payment/paypal/cancle_url/');
$notify_url=base_url('payment/paypal/index/?order_id='.$order_id);
$business_id='AbVLn8rsiLSmQPxIHdDcW_zSrkiT8tShjO66t-Nj6WNDSiQLEWkK6iIc46XWrdfi3JoevQI-2MF-sqAx';
$merchant_country='AU';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>eWAY Rapid Responsive Shared Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<style>
.loader {
	position: fixed;
	background: #ff6d6d;
	left: 0px;
	right: 0px;
	bottom: 0px;
	top: 0px;
	color: #FFF;
	padding: 10%;
	margin: auto;
}
.sk-folding-cube {
	margin: 20px auto;
	width: 40px;
	height: 40px;
	position: relative;
	-webkit-transform: rotateZ(45deg);
	transform: rotateZ(45deg);
	margin-bottom: 60px;
}
.sk-folding-cube .sk-cube {
	float: left;
	width: 50%;
	height: 50%;
	position: relative;
	-webkit-transform: scale(1.1);
	-ms-transform: scale(1.1);
	transform: scale(1.1);
}
.sk-folding-cube .sk-cube:before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: #fff;
	-webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
	animation: sk-foldCubeAngle 2.4s infinite linear both;
	-webkit-transform-origin: 100% 100%;
	-ms-transform-origin: 100% 100%;
	transform-origin: 100% 100%;
}
.sk-folding-cube .sk-cube2 {
	-webkit-transform: scale(1.1) rotateZ(90deg);
	transform: scale(1.1) rotateZ(90deg);
}
.sk-folding-cube .sk-cube3 {
	-webkit-transform: scale(1.1) rotateZ(180deg);
	transform: scale(1.1) rotateZ(180deg);
}
.sk-folding-cube .sk-cube4 {
	-webkit-transform: scale(1.1) rotateZ(270deg);
	transform: scale(1.1) rotateZ(270deg);
}
.sk-folding-cube .sk-cube2:before {
	-webkit-animation-delay: 0.3s;
	animation-delay: 0.3s;
}
.sk-folding-cube .sk-cube3:before {
	-webkit-animation-delay: 0.6s;
	animation-delay: 0.6s;
}
.sk-folding-cube .sk-cube4:before {
	-webkit-animation-delay: 0.9s;
	animation-delay: 0.9s;
}
@-webkit-keyframes sk-foldCubeAngle {
 0%, 10% {
-webkit-transform: perspective(140px) rotateX(-180deg);
transform: perspective(140px) rotateX(-180deg);
opacity: 0;
}
 25%, 75% {
-webkit-transform: perspective(140px) rotateX(0deg);
transform: perspective(140px) rotateX(0deg);
opacity: 1;
}
 90%, 100% {
-webkit-transform: perspective(140px) rotateY(180deg);
transform: perspective(140px) rotateY(180deg);
opacity: 0;
}
}
@keyframes sk-foldCubeAngle {
 0%, 10% {
-webkit-transform: perspective(140px) rotateX(-180deg);
transform: perspective(140px) rotateX(-180deg);
opacity: 0;
}
 25%, 75% {
-webkit-transform: perspective(140px) rotateX(0deg);
transform: perspective(140px) rotateX(0deg);
opacity: 1;
}
 90%, 100% {
-webkit-transform: perspective(140px) rotateY(180deg);
transform: perspective(140px) rotateY(180deg);
opacity: 0;
}
}
</style>
</head>
<body onload="load()" >
<div class="loader">
  <p class="text-center"> 
    <!--<img src="<?php echo base_url('assets/image/Logo-white_l.png'); ?>" style="display:inline-block; width:200px;" />--> 
    <img src="<?php echo base_url('assets/image/logo.png'); ?>" style="display:inline-block; width:50px;" /> </p>
  <div class="sk-folding-cube">
    <div class="sk-cube1 sk-cube"></div>
    <div class="sk-cube2 sk-cube"></div>
    <div class="sk-cube4 sk-cube"></div>
    <div class="sk-cube3 sk-cube"></div>
  </div>
  <h4 class="text-center">Please wait while your payment is being Processed and</h4>
  <h4 class="text-center">you will be redirected to the payment page.</h4>
</div>
<center style="display:none">
  
<!--
<form method="POST" action="<?php echo base_url('payment/eway/?order_id='.$order_id);?>" id="frm1" autocomplete="off">
-->
<form action="<?php echo $submit_url;?>" id="paypalFrm" method="post" target="_top">
    <input type='hidden' name='business' value='<?php echo $business_id;?>'>
    <input type='hidden' name='item_name' value='Camera'>
    <input type='hidden' name='item_number' value='CAM#N1'>
    <input type='hidden' name='amount' value='0.01'>
    <input type='hidden' name='no_shipping' value='1'>
    <input type='hidden' name='currency_code' value='USD'>
    <input type='hidden' name='notify_url' value='<?php echo $notify_url;?>'>
    <input type='hidden' name='cancel_return' value='<?php echo $cancel_return;?>'>
    <input type='hidden' name='return' value='<?php echo $return_url;?>'>
    <!-- COPY and PASTE Your Button Code -->
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="### COPY FROM BUTTON CODE ###">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
</form>

  <?php /*?><form name="paypalFrm" id="paypalFrm" action="<?php echo $submit_url;?>" method="post">
    <input type="hidden" name="cmd" value="_ext-enter">
    <input type="hidden" name="redirect_cmd" value="_xclick-subscriptions">
    <input type="hidden" name="return" value="<?php echo $return_url;?>">
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return;?>">
    <input type="hidden" name="notify_url" value="<?php echo $notify_url;?>">
    <input type="hidden" name="custom" value="<?php //echo $custom.",".$custom2;?>">
    <input type="hidden" name="business" value="<?php echo $business_id;?>">
    <input type="hidden" name="item_name" value="<?php echo $item_name;?>">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="a3" value="<?php echo $result->amount_total;?>">
    <input type="hidden" name="p3" value="1">
    <input type="hidden" name="t3" value="M">
    <input type="hidden" name="src" value="1">
    <input type="hidden" name="sra" value="1">
    <input type="hidden" name="srt" value="12">
    <input type="hidden" name="first_name" value="<?php echo $result->name;?>">
    <input type="hidden" name="lc" value="<?php echo $merchant_country;?>">
    <input type="hidden" name="email" value="<?php echo $result->email;?>">
  </form><?php */?>
  <script>
		function load()
		{
			$("#paypalFrm").submit();
		}
		$(document).ready(function(){
			 //$("#frm1").submit();
		});
	</script>
</center>
</body>
</html>
