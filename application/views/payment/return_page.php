<?php


// Include RapidAPI Library
//require('../../lib/eWAY/RapidAPI.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>eWAY Rapid Responsive Shared Page</title>  
     <style>
     h1 {color:#ffb205; font-size:1.6em; font-weight: normal;}
h1 span {color:#000; font-size:0.7em; margin-left:30px;}
h2 {font-size:1.1em; font-weight:bold;display:inline; float:left; margin:0; padding:0; }
h2.first {margin-top:0; }

.clear {clear:both;}

#outer {width:926px; font-family:Arial, Helvetica, sans-serif; font-size:62.5%; color:#999; text-align:left; }
#main {background:#ebebeb; color:#000; line-height:1.4em;  width:926px; padding:7px 7px 7px 27px; clear:both; font-size:1.2em; overflow:hidden;}
img {border:none;}

#toplinks {width:926px; }
#toplinks .help {float:right;}
#titlearea {padding:20px 0px 10px 20px; overflow:hidden;float:left; width:879px; color:#000; clear:both; font-size:1.1em; }
#titlearea p.left {float:left; width:477px;}
#titlearea p.right span.tel {font-weight:bold; font-size:1.6em;}
#titlearea p.right span.sub {font-size:0.8em; color:#000;}

#maincontent { float:left; width:845px; padding:10px 27px; margin:0 auto; overflow:hidden;  }
#maincontentbottom { clear:both; height:4px;}

.fields {clear:both; float:left; margin-bottom:20px; width:400px; margin-top:10px; }
label {width:174px; float:left; }
input {margin-top:2px;  border:1px solid #9fa0a5; color:#7b7b7b; }
input.text {width:187px;}
input.zip {width:72px; }
select {margin-top:2px; border:1px solid #9fa0a5; color:#7b7b7b; height:18px;}

a.question {background:url(../Images/question.gif) no-repeat left middle; float:right; margin-left:10px; margin:3px 0 0 40px;  color:#fa0000; font-weight:normal; text-decoration:none;}
a.question:hover {text-decoration:none;}

#footer {border:1px solid #ccc; width:953px; margin:0px 3px; background:#fff; clear:both;}
#footer .foothead { font-weight:bold; color:#646464; line-height:25px; padding-left:19px;}

a {text-decoration:none;}
a:hover {text-decoration:underline;}
a.logo {display:block; height:60px; margin-left:40px; float:left;}
* html a.logo {margin-left:20px;}

p {margin:5px 0;}

div.button {clear:both; text-align:right;  margin-right:10px; color:#000; margin-right:37px;}
.button input { background-color: #FFAF00; border-radius: 5px; color:#000; padding:10px; }
.button input:hover { background-color: #FFC855; }

div.paymentbutton { clear: both; text-align:right; margin-right:10px; color:#FFF; margin-right:37px;}
.paymentbutton input { background-color: #009900; border-radius: 5px; color:#FFF; padding:10px; }
.paymentbutton input:hover { background-color: #00D700; }

.transactioncard {float:left; width:393px; background:#f3f3f3; padding:5px 5px 20px 5px; overflow:hidden;}
.transactioncard .header { width:380px; margin-top:5px; clear:both; font-weight: bold;}
*:first-child+html .transactioncard .header {margin-top:10px;} * html .transactioncard .header {margin-top:10px;}
.transactioncard .fields {background:#fafafa; margin:1px 0px; width:380px; padding:4px 5px; line-height:20px; }
.transactioncard .fields label {padding-top:3px; width:150px;}
.transactioncard .fields input {width:220px; height:20px; color:#000000; }
.transactioncard .fields select {width:60px; margin-right:2px; height:20px; color:#000000;}
.transactioncard .fields .price {font-size:1.4em;}

.transactioncustomer {float:left; width:393px; background:#f3f3f3; padding:5px 5px 20px 5px; overflow:hidden;}
.transactioncustomer .header { width:380px; margin-top:5px; clear:both; font-weight: bold; }
*:first-child+html .transactioncustomer .header {margin-top:10px;} * html .transactioncustomer .header {margin-top:10px;}
.transactioncustomer .fields {background:#fafafa; margin:1px 0px; width:380px; padding:4px 5px; line-height:20px; }
.transactioncustomer .fields label {padding-top:3px; width:150px;}
.transactioncustomer .fields input {width:220px; height:20px; color:#000000; }
.transactioncustomer .fields select {width:85px; margin-right:2px; height:20px; color:#000000;}
.transactioncustomer .fields .price {font-size:1.4em;}

.response {float:left; width:835px; background:#f3f3f3; padding:5px 5px 20px 5px; overflow:hidden;}
.response .fields {background:#fafafa; margin:1px 0px; width:824px; padding:4px 5px; line-height:20px; }
.response .fields label {padding-top:3px; width:200px;}
.response .fields input {width:220px; height:20px; color:#000000; }
.response .fields select {width:85px; margin-right:2px; height:20px; color:#000000;}
.response .fields .price {font-size:1.4em;}


div#errors { border: 1px solid red; display: none; }
div#errors h4 { color:Red; padding-left: 32px;  }
div#errors Li { margin-left: 16px; }
input[type="image"] { border: 0px;}
     </style>
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

       <!-- <br />
        <br />
        <a href="index.php">[Start Over]</a>
        <br />
        <br />-->
        
        <a href="#" id="showraw">[Show raw request & response]</a>
        
        <div id="raw">
            <div style="width: 45%; margin-right: 2em; background: #f3f3f3; float:left; overflow: scroll; white-space: nowrap;">
                <?php echo $service->getLastUrl(); ?><br>
                <pre id="request_dump"></pre>
            </div>
            <div style="width: 45%; margin-right: 2em; background: #f3f3f3; float:left; overflow: scroll; white-space: nowrap;"><pre id="response_dump"></pre></div>
        </div>
        <script>
            jQuery('#raw').hide();
            // no body for GetAccessCodeResult
            var response_dump = JSON.stringify(JSON.parse('<?php echo $service->getLastResponse(); ?>'), null, 4); 
            jQuery('#response_dump').html(response_dump);
            
            jQuery( "#showraw" ).click(function() {     
                if(jQuery('#raw:visible').length)
                    jQuery('#raw').hide();
                else
                    jQuery('#raw').show();        
            });
         </script>

    <div id="maincontentbottom">
    </div>
 	<script>
		function load()
		{
			//$("#frm1").submit();
		}		
	</script>

	
            </div>
            <div id="footer"></div>
        </div>
    </center>    
</body>
</html>