</div>
<?php if($con!='product'){?>
<footer><!--footer start-->
    <div class="top_footer">
        <div class="container">
            <div class="row">
                <div class="footer_col4 footer_fbtns">
                     <h3>About us</h3>
                    <p>With more than 15 years of experience we can proudly say we are still leading the way in online fruit and veg in Victoria, trusted by thousands…………… </p>
                      <a href="<?php echo base_url('about_us')?>" class="btn btn-default light_gray">Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
                <div class="footer_col2">
                    <h3 class="footer_heading">Information</h3>
                    <ul class="footer_links">
                        <li><a href="<?php echo base_url('delivery');?>" target="_blank">Delivery</a></li>
                        <li><a href="<?php echo base_url('legel-notice');?>" target="_blank">Legal Notice</a></li>
                        <li><a href="<?php echo base_url('terms-of-use');?>" target="_blank">Terms of Use</a></li>
                        <li><a href="<?php echo base_url('terms-of-sale');?>" target="_blank">Terms of Sale</a></li>
                        <li><a href="<?php echo base_url('about-us');?>" target="_blank">About us</a></li>
                        <!--<li><a href="#">Secure Payment</a></li>-->
                        <li><a href="<?php echo base_url('our-mission');?>" target="_blank"> Our mission</a></li>
                    </ul>
                </div>
                <div class="footer_col3">
                    <h3 class="footer_heading">Get In touch</h3>
                    <ul class="footer_links">
                        <li>
                         <a href="https://twitter.com/FruitasticAus" target="_blank"><i class="fa fa-twitter"></i></a>
                         <a href="https://www.facebook.com/FruitasticMelbourne/" target="_blank"><i class="fa fa-facebook"></i></a>
                         <a href="https://www.youtube.com/channel/UCqiih4I1gVnIihQmB5ixWUw" target="_blank"><i class="fa fa-youtube-play"></i></a>
                         <a href="https://www.instagram.com/fruitasticofficial/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>

                     <h3 class="footer_heading">Payment Accepted</h3>
                     <ul class="footer_links">
                        <li>
                         <i class="fa fa-cc-paypal fa-2x footer_payment_icon" aria-hidden="true"></i>
                         <i class="fa fa-cc-visa fa-2x  footer_payment_icon" aria-hidden="true"></i>
                         <i class="fa fa-cc-mastercard fa-2x  footer_payment_icon" aria-hidden="true"></i>
                        </li>
                        <li><img src="<?php echo base_url_assets;?>images/Symantec2.png" class="img-responsive pull-left" /></li>
                        <li><img src="<?php echo base_url_assets;?>images/ssl-secure.png" class="img-responsive" /></li>
                     </ul>
                </div>
                <div class="footer_col1">
                    <h3>Newsletter</h3>
                    <p>Please feel free to join our newsletter for the latest market reports and a whole lot more.</p>
                    <form class="search_from footer_form" >
                      <div class="form-group">
                        <input type="email" required="required" class="form-control" id="email" name="email" placeholder="Enter your email address">
                      </div>
                      <button type="button" class="btn btn-default light_gray hoverd-btn" id="newslatter_Subscribe">Subscribe <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
/*function validateEmail(sEmail) 
{
   	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) 
	{
        return true;
    }
    else 
	{
        return false;
    }
}​*/
function validateEmail(sEmail) {
var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}

    $(function(){
		$("#newslatter_Subscribe").on('click',function(e){
			var email=$("#email").val();
			if ($.trim(email).length == 0) {
				notyfication("glyphicon glyphicon-warning-sign","Oops Sorry","Please enter valid email address","warning",5000);
			   // alert('Please enter valid email address');
				e.preventDefault();
			}
			if(!validateEmail(email)) {
				notyfication("glyphicon glyphicon-warning-sign","Oops Sorry","Invalid Email Address","warning",5000);
			   //alert('Invalid Email Address');
				e.preventDefault();
			}
			else 
			{
				
				//notyfication("glyphicon glyphicon-warning-sign","Thank You","Email is valid","warning",5000);
			   // alert('Email is valid');
			
				
				
				var ddd=send_ajax_return_value('<?php echo base_url('home/newslatter');?>',{email:email});
				console.log(ddd.responseText);
				
				if(ddd.responseText=='success')
				{
					$("#email").val('');
					notyfication("glyphicon glyphicon-warning-sign","Thank You","We Connect Soon","success",5000);
					/*$.notify({
								icon: "glyphicon glyphicon-warning-sign",
								title: "Thank You",
								message:"We Connect Soon",
								type: "success",
								target: '_blank'
								},{
								delay: 5000,
								animate: {
									enter: 'animated fadeInRight',
									exit: 'animated fadeOutRight'
								}
						});	*/	
				}
				else
				{
					notyfication("glyphicon glyphicon-warning-sign","Oops Sorry"," Please try again","warning",5000);
					/*$.notify({
								icon: "glyphicon glyphicon-warning-sign",
								title: "Oops Sorry",
								message:" Please try again",
								type: "warning",
								target: '_blank'
								},{
								delay: 5000,
								animate: {
									enter: 'animated fadeInRight',
									exit: 'animated fadeOutRight'
								}
						});*/		
				}
				//var cartd= jQuery.parseJSON(ddd.responseText);
			}
		});
	});
	
		function notyfication(icon1,title1,message1,type1,delay1)
		{
			$.notify({
							icon: icon1,
							title: title1,
							message:message1,
							type: type1,
							target: '_blank'
							},{
							delay: delay1,
							animate: {
								enter: 'animated fadeInRight',
								exit: 'animated fadeOutRight'
							}
					});	
		}
    </script>    
    
    <div class="bottom_footer fw">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <p>Copyright ©  2016 Fruitastic.com.au. All Rights Reserved</p>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 text-right">
                    <ul class="social_part">
                        <li><a href="<?php echo base_url('contact-us');?>" target="_blank">Contact us</a></li>
                        <li><a href="<?php echo base_url('terms-of-service');?>" target="_blank">Terms of Services</a></li>
                        <li><a href="<?php echo base_url('privacy-policy');?>"  target="_blank">Privacy Policy</a></li>
                        <!--<li><a href="#">Site Map</a></li>-->
                    </ul>
                     <span class="power"> Powered by </span> 
                     <a href="http://www.efrog.com.au/" class="power"> 
                     <img src="<?php echo base_url_assets;?>images/footer_logo.png" class="img-responsive" />
                     </a>
                </div>
            </div>
        </div>
    </div>
</footer><!--footer end-->
 <?php }?>

<!--<script type="text/javascript" src="<?php echo base_url_assets;?>js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="<?php echo base_url_assets;?>js/bootstrap.js"></script>-->
<script type="text/javascript" src="<?php echo base_url_assets;?>js/css3-animate-it.js"></script>

 
