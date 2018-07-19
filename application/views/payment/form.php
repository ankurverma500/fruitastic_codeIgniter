<?php


// Include RapidAPI Library
//require('../../lib/eWAY/RapidAPI.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>eWAY Rapid Responsive Shared Page</title>  
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>  
</head>
<body onload="load()" >    
<center>
    <div id="outer">
        <div id="toplinks">
            <!--<img alt="eWAY Logo" class="logo" src="../assets/Images/companylogo.gif" width="960px" height="65px" />-->
        </div>
        <div id="main">
<?php			
    if ($in_page == 'view_result') 
	{		
	?>
   
    <?php
        if (isset($lblError) && $lblError!='') 
		{
    	?>
        <div id="error">
            <label style="color:red"><?php echo $lblError ?></label>
        </div>
    	<?php 
		} 
		else 
		{ 
		?>
            <div id="maincontent">
                <div class="response">
                    <div class="fields">
                        <label for="lblAuthorisationCode">
                            Authorisation Code</label>
                        <label id="lblAuthorisationCode"><?php echo isset($result->AuthorisationCode) ? $result->AuthorisationCode:""; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblInvoiceNumber">
                            Invoice Number</label>
                        <label id="lblInvoiceNumber"><?php echo $result->InvoiceNumber; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblInvoiceReference">
                            Invoice Reference</label>
                        <label id="lblInvoiceReference"><?php echo $result->InvoiceReference; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblOption1">
                            Option1</label>
                        <label id="lblOption1"><?php echo isset($result->Options[0]->Value) ? $result->Options[0]->Value:""; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblOption2">
                            Option2</label>
                        <label id="lblOption2"><?php echo isset($result->Options[1]->Value) ? $result->Options[1]->Value:""; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblOption3">
                            Option3</label>
                        <label id="lblOption3"><?php echo isset($result->Options[2]->Value) ? $result->Options[2]->Value:""; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblResponseCode">
                            Response Code</label>
                        <label id="lblResponseCode"><?php echo $result->ResponseCode; ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblResponseMessage">
                            Response Message</label>
                        <label id="lblResponseMessage">
                         <?php
                         
            
                                if(isset($result->ResponseMessage)) 
                                {
                                    //Get Error Messages from Error Code.
                                    $ResponseMessageArray = explode(",", $result->ResponseMessage);
                                    $responseMessage = "";
                                    foreach ($ResponseMessageArray as $message) {
                                        $real_message = $service->getMessage($message);
                                        if($message != $real_message)
                                            $responseMessage .= $message . " " . $real_message . "<br>";
                                        else
                                            $responseMessage .= $message;
                                    }
                                    echo $responseMessage;
                                }
                                
                         ?>
                        </label>
                    </div>
                    <div class="fields">
                        <label for="lblTokenCustomerID">
                            TokenCustomerID
                        </label>
                        <label id="lblTokenCustomerID"><?php
                            if (isset($result->TokenCustomerID)) {
                                    echo $result->TokenCustomerID;
                            }
                        ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblTotalAmount">
                            Total Amount</label>
                        <label id="lblTotalAmount"><?php
                            if (isset($result->TotalAmount)) {
                                $amount = $result->TotalAmount;
                                echo '$'.number_format($amount/100, 2);
                            }
                        ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblTransactionID">
                            TransactionID</label>
                        <label id="lblTransactionID"><?php
                            if (isset($result->TransactionID)) {
                                    echo $result->TransactionID;
                            }
                        ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblTransactionStatus">
                            Transaction Status</label>
                        <label id="lblTransactionStatus"><?php
                            if (isset($result->TransactionStatus) && $result->TransactionStatus && (is_bool($result->TransactionStatus) || $result->TransactionStatus != "false")) {
                                echo 'True';
                            } else {
                                echo 'False';
                            }
                        ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblBeagleScore">
                            Beagle Score</label>
                        <label id="lblBeagleScore"><?php
                            if (isset($result->BeagleScore)) {
                                echo $result->BeagleScore;
                            }
                        ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblBeagleVerificationEmail">
                            Beagle Verification - Email: </label>
                        <label id="lblBeagleVerificationEmail"><?php
                                            
                            if (isset($result->BeagleVerification->Email)) {
                                switch ($result->BeagleVerification->Email) {
                                    case 1:
                                        echo "1";
                                        break;
                                    case 2:
                                        echo "2";
                                        break;
                                    case 3:
                                        echo "3";
                                        break;
                                    default:
                                        echo "Not Verified";
                                        break;
                                }
                            }
                        ?></label>
                    </div>
                    <div class="fields">
                        <label for="lblBeagleVerificationPhone">
                            Beagle Verification - Phone: </label>
                        <label id="lblBeagleVerificationPhone"><?php
                            if (isset($result->BeagleVerification->Phone)) {
                                switch ($result->BeagleVerification->Phone) {
                                    case 1:
                                        echo "1";
                                        break;
                                    case 2:
                                        echo "2";
                                        break;
                                    case 3:
                                        echo "3";
                                        break;
                                    default:
                                        echo "Not Verified";
                                        break;
                                }
                            }
                        ?></label>
                    </div>
                </div>
            </div>
    	<?php 
		} 
		?>

        <br />
        <br />
        <a href="index.php">[Start Over]</a>
        <br />
        <br />
        
        <a href="#" id="showraw">[Show raw request & response]</a>
        
        <div id="raw">
            <div style="width: 45%; margin-right: 2em; background: #f3f3f3; float:left; overflow: scroll; white-space: nowrap;">
                <?php echo $service->getLastUrl(); ?><br>
                <pre id="request_dump"></pre>
            </div>
            <div style="width: 45%; margin-right: 2em; background: #f3f3f3; float:left; overflow: scroll; white-space: nowrap;"><pre id="response_dump"></pre></div>
        </div>
        <script>
            /*jQuery('#raw').hide();
            // no body for GetAccessCodeResult
            var response_dump = JSON.stringify(JSON.parse('<?php echo $service->getLastResponse(); ?>'), null, 4); 
            jQuery('#response_dump').html(response_dump);
            
            jQuery( "#showraw" ).click(function() {     
                if(jQuery('#raw:visible').length)
                    jQuery('#raw').hide();
                else
                    jQuery('#raw').show();        
            });*/
         </script>

    <div id="maincontentbottom">
    </div>
 	<script>
		function load()
		{
			//$("#frm1").submit();
		}		
	</script>
<?php

    } 
	else 
	{ // for if ($in_page === 'view_result') {
		
?>

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
	<form method="POST" action="<?php echo base_url('payment/eway/?order_id'.$order_id);?>" id="frm1" autocomplete="off">
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
                        <option value="TokenPayment">TokenPayment</option>
                        <option value="CreateTokenCustomer">CreateTokenCustomer</option>
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
                </div>
                <?php if($coustomer_address['res'])
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
                
                <div class="fields">
                    <label for="txtEmail">Email</label>
                    <input id="txtEmail" name="txtEmail" type="text" value="<?php echo $result->email?>" />
                </div>
                <div class="fields">
                    <label for="txtPhone">Phone</label>
                    <input id="txtPhone" name="txtPhone" type="text" value="1800 10 10 65<?php //echo $result->contact_no?>" />
                </div>
                <div class="fields">
                    <label for="txtMobile">Mobile</label>
                    <input id="txtMobile" name="txtMobile" type="text" value="1800 10 10 65<?php //echo $result->contact?>" />
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
<?php
    } // for if ($in_page === 'view_result') {
?>
            </div>
            <div id="footer"></div>
        </div>
    </center>    
</body>
</html>