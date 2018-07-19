<?php


// Include RapidAPI Library
//require('../../lib/eWAY/RapidAPI.php');

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
  .loader{ position: fixed; background: #ff6d6d; left: 0px; right: 0px; bottom: 0px; top: 0px; color:#FFF; padding: 10%; margin:auto;}
  .sk-folding-cube {margin: 20px auto; width: 40px; height: 40px; position: relative; -webkit-transform: rotateZ(45deg); transform: rotateZ(45deg);margin-bottom: 60px;}
	.sk-folding-cube .sk-cube { float: left; width: 50%; height: 50%; position: relative; -webkit-transform: scale(1.1); -ms-transform: scale(1.1);          transform: scale(1.1); }
	.sk-folding-cube .sk-cube:before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #fff; -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both; animation: sk-foldCubeAngle 2.4s infinite linear both; -webkit-transform-origin: 100% 100%;      -ms-transform-origin: 100% 100%; transform-origin: 100% 100%;}
	.sk-folding-cube .sk-cube2 { -webkit-transform: scale(1.1) rotateZ(90deg); transform: scale(1.1) rotateZ(90deg);}
	.sk-folding-cube .sk-cube3 { -webkit-transform: scale(1.1) rotateZ(180deg); transform: scale(1.1) rotateZ(180deg);}
	.sk-folding-cube .sk-cube4 { -webkit-transform: scale(1.1) rotateZ(270deg); transform: scale(1.1) rotateZ(270deg);}
	.sk-folding-cube .sk-cube2:before {-webkit-animation-delay: 0.3s; animation-delay: 0.3s;}
	.sk-folding-cube .sk-cube3:before {-webkit-animation-delay: 0.6s; animation-delay: 0.6s; }
	.sk-folding-cube .sk-cube4:before { -webkit-animation-delay: 0.9s; animation-delay: 0.9s;}
@-webkit-keyframes sk-foldCubeAngle {
  	0%, 10% { -webkit-transform: perspective(140px) rotateX(-180deg); transform: perspective(140px) rotateX(-180deg); opacity: 0; } 
  	25%, 75% { -webkit-transform: perspective(140px) rotateX(0deg); transform: perspective(140px) rotateX(0deg); opacity: 1; } 
  	90%, 100% { -webkit-transform: perspective(140px) rotateY(180deg); transform: perspective(140px) rotateY(180deg); opacity: 0; } 
}
@keyframes sk-foldCubeAngle {
  	0%, 10% { -webkit-transform: perspective(140px) rotateX(-180deg); transform: perspective(140px) rotateX(-180deg); opacity: 0; } 
	25%, 75% { -webkit-transform: perspective(140px) rotateX(0deg); transform: perspective(140px) rotateX(0deg); opacity: 1; } 
	90%, 100% { -webkit-transform: perspective(140px) rotateY(180deg); transform: perspective(140px) rotateY(180deg); opacity: 0; }
}
</style>
</head>
<body onload="load()" >
<div class="loader"> 
<p class="text-center">
<!--<img src="<?php echo base_url('assets/image/Logo-white_l.png'); ?>" style="display:inline-block; width:200px;" />-->
<img src="<?php echo base_url('assets/image/logo.png'); ?>" style="display:inline-block; width:200px;" />
</p>
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
    <div id="outer">
        <div id="toplinks">
            <!--<img alt="eWAY Logo" class="logo" src="../assets/Images/companylogo.gif" width="960px" height="65px" />-->
        </div>
        <div id="main">
    <div id="titlearea">
        <h2>Sample Merchant Page</h2>
    </div>
	<?php
    if (isset($lblError)) 
	{
	?>
    <div id="error">
        <label style="color:red"><?php echo $lblError ?></label>
    </div>
	<?php } 
	?>
	<form method="POST" action="<?php echo base_url('payment/eway/?order_id='.$order_id);?>" id="frm1" autocomplete="off">
        <div id="maincontent" style="display:none;">
            <div class="transactioncustomer">
                <div class="header first">
                    Request Options
                </div>
                <div class="fields">
                    <label for="APIKey">API Key</label>
                    <input id="APIKey" name="APIKey" type="text" value="<?php echo $this->session->userdata('eWAY_key'); ?>" />
                </div>
                <div class="fields">
                    <label for="APIPassword">API Password</label>
                    <input id="APIPassword" name="APIPassword" type="password" value="<?php echo $this->session->userdata('eWAY_pass'); ?>" />
                </div>
                <div class="fields">
                    <label for="ddlSandbox">API Sandbox</label>
                    <select id="ddlSandbox" name="ddlSandbox">
                    <option value="1" selected="selected">Yes</option>
                    <option value="">No</option>
                    </select>
                </div>
                <div class="fields">
                    <label for="ddlMethod">Payment Method</label>
                    <select id="ddlMethod" name="ddlMethod" style="width: 140px" onchange="onMethodChange(this.options[this.options.selectedIndex].value)">
                        <option value="ProcessPayment">ProcessPayment</option>
                        <option value="TokenPayment" selected <?php //if($result->order_type=='1'){echo 'selected';}?>>TokenPayment</option>
                        <option value="CreateTokenCustomer" <?php //if($result->order_type=='2'){echo 'selected';}?> >CreateTokenCustomer</option>
                        <option value="UpdateTokenCustomer">UpdateTokenCustomer</option>
                        <option value="Authorise">Authorise</option>
                    </select>
                </div>
                <script>
                    function onMethodChange(v) {
                        if (v == 'ProcessPayment' || v == 'Authorise' || v == 'TokenPayment') {
                            jQuery('#payment_details').show();
                        } else {
                            jQuery('#payment_details').hide();
                        }
                    }
                </script>
    
                <div class="header first">
                    Shared Page Settings
                </div>
                <div class="fields">
                    <label for="txtLogoUrl">Logo Url (optional)</label>
                    <input id="txtLogoUrl" name="txtLogoUrl" type="text" value="" />
                   <!-- http://www.binaryfrog.co/assets/images/Logo-red.png-->
                </div>
                <div class="fields">
                    <label for="txtHeaderText">Header Text (optional)</label>
                    <input id="txtHeaderText" name="txtHeaderText" type="text" value="Frutastic" />
                </div>
                <div class="fields">
                    <label for="txtTheme">Shared Page Theme</label>
                    <select name="txtTheme" id="txtTheme">
                        <option value="Default">Default</option>
                        <option value="Bootstrap">Bootstrap</option>
                        <option value="BootstrapAmelia">BootstrapAmelia</option>
                        <option value="BootstrapCerulean">BootstrapCerulean</option>
                        <option value="BootstrapCosmo">BootstrapCosmo</option>
                        <option value="BootstrapCyborg">BootstrapCyborg</option>
                        <option value="BootstrapFlatly">BootstrapFlatly</option>
                        <option value="BootstrapJournal">BootstrapJournal</option>
                        <option value="BootstrapReadable">BootstrapReadable</option>
                        <option value="BootstrapSimplex">BootstrapSimplex</option>
                        <option value="BootstrapSlate">BootstrapSlate</option>
                        <option value="BootstrapSpacelab">BootstrapSpacelab</option>
                        <option value="BootstrapUnited">BootstrapUnited</option>
                    </select>
                </div>
                <div class="header first">
                    Beagle Verification
                </div>
                <div class="fields">
                    <label for="txtVerifyMobile">Verify Mobile</label>
                    <select id="txtVerifyMobile" name="txtVerifyMobile">
                    <option value="" selected="selected">No</option>
                    <option value="1">Yes</option>
                    </select>
                </div>
                <div class="fields">
                    <label for="txtVerifyEmail">Verify Email</label>
                    <select id="txtVerifyEmail" name="txtVerifyEmail">
                    <option value="" selected="selected">No</option>
                    <option value="1">Yes</option>
                    </select>
                </div>
              <div id='payment_details'>
                <div class="header">
                    Payment Details
                </div>
                <div class="fields">
                    <label for="txtAmount">Amount &nbsp;<img src="../assets/Images/question.gif" alt="Find out more" id="amountTipOpener" border="0" /></label>
                    <input id="txtAmount" name="txtAmount" type="text" value="<?php echo (int)(($result->amount_total*100)) ?>" />
                </div>
                <div class="fields">
                    <label for="txtCurrencyCode">Currency Code </label>
                    <input id="txtCurrencyCode" name="txtCurrencyCode" type="text" value="AUD" />
                </div>
                <div class="fields">
                    <label for="txtInvoiceNumber">Invoice Number</label>
                    <input id="txtInvoiceNumber" name="txtInvoiceNumber" type="text" value="<?php echo $result->order_id?>" />
                </div>
                <div class="fields">
                    <label for="txtInvoiceReference">Invoice Reference</label>
                    <input id="txtInvoiceReference" name="txtInvoiceReference" type="text" value="<?php echo $result->order_id?>" />
                </div>
                <div class="fields">
                    <label for="txtInvoiceDescription">Invoice Description</label>
                    <input id="txtInvoiceDescription" name="txtInvoiceDescription" type="text" value="One Time Individual Invoice Description" />
                </div>
              </div> <!-- end for <div id='payment_details'> -->
    
                <div class="header">
                    Custom Fields
                </div>
                <div class="fields">
                    <label for="txtOption1">Option 1</label>
                    <input id="txtOption1" name="txtOption1" type="text" value="Option1" />
                </div>
                <div class="fields">
                    <label for="txtOption2">Option 2</label>
                    <input id="txtOption2" name="txtOption2" type="text" value="Option2" />
                </div>
                <div class="fields">
                    <label for="txtOption3">Option 3</label>
                    <input id="txtOption3" name="txtOption3" type="text" value="Option3" />
                </div>
            </div>
            <div class="transactioncard">
                <div class="header first">
                    Customer Details
                </div>
                <div class="fields">
                    <label for="txtTokenCustomerID">Token Customer ID &nbsp;<img src="../assets/Images/question.gif" alt="Find out more" id="tokenCustomerTipOpener" border="0" /></label>
                    <input id="txtTokenCustomerID" name="txtTokenCustomerID" type="text" />
                </div>
                <div class="fields">
                    <label for="ddlTitle">Title</label>
                    <select id="ddlTitle" name="ddlTitle">
                    <option></option>
                    <option value="Mr." selected="selected">Mr.</option>
                    <option value="Miss">Miss</option>
                    <option value="Mrs.">Mrs.</option>
                    </select>
                </div>
                <div class="fields">
                    <label for="txtCustomerRef">Customer Reference</label>
                    <input id="txtCustomerRef" name="txtCustomerRef" type="text" value="A12345" />
                </div>
                <div class="fields">
                    <label for="txtFirstName">First Name</label>
                    <input id="txtFirstName" name="txtFirstName" type="text" value="<?php echo $result->name?>" />
                </div>
                <div class="fields">
                    <label for="txtLastName">Last Name</label>
                    <input id="txtLastName" name="txtLastName" type="text" value="<?php echo $result->last_name?>" />
                </div>
                <div class="fields">
                    <label for="txtCompanyName">Company Name</label>
                    <input id="txtCompanyName" name="txtCompanyName" type="text" value="<?php echo $result->primary_contact_name?>" />
                </div>
                <div class="fields">
                    <label for="txtJobDescription">Job Description</label>
                    <input id="txtJobDescription" name="txtJobDescription" type="text" value="" />
                </div>
                <div class="header">
                    Customer Address
                </div><?php if($coustomer_address['res'])
				{
					$cadd=$coustomer_address['rows'][0];?>
                <div class="fields">
                    <label for="txtStreet">Street</label>
                    <input id="txtStreet" name="txtStreet" type="text" value="<?php echo $cadd->main_address?>" />
                </div>
                <div class="fields">
                    <label for="txtCity">City</label>
                    <input id="txtCity" name="txtCity" type="text" value="<?php echo $cadd->main_city?>" />
                </div>
                <div class="fields">
                    <label for="txtState">State</label>
                    <input id="txtState" name="txtState" type="text" value="<?php echo $cadd->main_state?>" />
                </div>
                <div class="fields">
                    <label for="txtPostalcode">Post Code</label>
                    <input id="txtPostalcode" name="txtPostalcode" type="text" value="<?php echo $result->zip_code?>" />
                </div>
                <div class="fields">
                    <label for="txtCountry">Country</label>
                    <input id="txtCountry" name="txtCountry" type="text" value="au" maxlength="2" />
                </div>
                <?php }else{?>
				<div class="fields">
                    <label for="txtStreet">Street</label>
                    <input id="txtStreet" name="txtStreet" type="text" value="15 Smith St" />
                </div>
                <div class="fields">
                    <label for="txtCity">City</label>
                    <input id="txtCity" name="txtCity" type="text" value="Phillip" />
                </div>
                <div class="fields">
                    <label for="txtState">State</label>
                    <input id="txtState" name="txtState" type="text" value="ACT" />
                </div>
                <div class="fields">
                    <label for="txtPostalcode">Post Code</label>
                    <input id="txtPostalcode" name="txtPostalcode" type="text" value="<?php echo $result->zip_code?>" />
                </div>
                <div class="fields">
                    <label for="txtCountry">Country</label>
                    <input id="txtCountry" name="txtCountry" type="text" value="au" maxlength="2" />
                </div>
				<?php }?>
                <?php /*?><div class="fields">
                    <label for="txtStreet">Street</label>
                    <input id="txtStreet" name="txtStreet" type="text" value="15 Smith St" />
                </div>
                <div class="fields">
                    <label for="txtCity">City</label>
                    <input id="txtCity" name="txtCity" type="text" value="Phillip" />
                </div>
                <div class="fields">
                    <label for="txtState">State</label>
                    <input id="txtState" name="txtState" type="text" value="ACT" />
                </div>
                <div class="fields">
                    <label for="txtPostalcode">Post Code</label>
                    <input id="txtPostalcode" name="txtPostalcode" type="text" value="<?php echo $result->zip_code?>" />
                </div>
                <div class="fields">
                    <label for="txtCountry">Country</label>
                    <input id="txtCountry" name="txtCountry" type="text" value="au" maxlength="2" />
                </div><?php */?>
                <div class="fields">
                    <label for="txtEmail">Email</label>
                    <input id="txtEmail" name="txtEmail" type="text" value="<?php echo $result->email?>" />
                </div>
                <div class="fields">
                    <label for="txtPhone">Phone</label>
                    <input id="txtPhone" name="txtPhone" type="text" value="<?php //echo $result->contact_no?>" />
                </div>
                <div class="fields">
                    <label for="txtMobile">Mobile</label>
                    <input id="txtMobile" name="txtMobile" type="text" value="<?php //echo $result->contact1800 10 10 65?>" />
                </div>
                <div class="fields">
                    <label for="txtFax">Fax</label>
                    <input id="txtFax" name="txtFax" type="text" value="02 9852 2244" />
                </div>
                <div class="fields">
                    <label for="txtUrl">Website</label>
                    <input id="txtUrl" name="txtUrl" type="text" value="http://www.binaryfrog.co/" />
                </div>
                <div class="fields">
                    <label for="txtComments">Comments</label>
                    <textarea id="txtComments" name="txtComments"/>Some comments here</textarea>
                </div>
                <div class="header">
                    Others
                </div>
                <div class="fields">
                    <label for="ddlTransactionType">Transaction Type</label>
                    <select id="ddlTransactionType" name="ddlTransactionType" style="width:140px;">
                    <option value="Purchase">Ecommerce</option>
                    <option value="MOTO">MOTO</option>
                    <option value="Recurring">Recurring</option>
                    </select>
                </div>
            </div>
            <div class="button">
                <br />
                <br />
                <input type="text" id="btnSubmit" name="btnSubmit" value="Get Access Code" />
            </div>
        </div>
        <div id="maincontentbottom" style="display:none">
    
        <div id="amountTip" style="font-size: 8pt !important">
            The amount in cents. For example for an amount of $1.00, enter 100
        </div>
        <div id="tokenCustomerTip" style="font-size: 8pt !important">
            If this field has a value, the details of an existing customer will be loaded when the request is sent.
        </div>
        <div id="saveTokenTip" style="font-size: 8pt !important">
            If this field is checked, the details in the customer fields will be used to either create a new token customer, or (if Token Customer ID has a value) update an existing customer.
        </div>

	</div>
	</form>
    <script>
		function load()
		{
			$("#frm1").submit();
		}
		$(document).ready(function(){
			 //$("#frm1").submit();
		});
	</script>

            </div>
            <div id="footer"></div>
        </div>
    </center>    
</body>
</html>