<header class="header inner-header cartpage-header"><!--header start-->
      <div class="top_header hidden-xs hidden-sm">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-sm-6">
                      <ul class="social_icon">
                          <li><a href="https://www.facebook.com/FruitasticMelbourne/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="https://www.instagram.com/fruitasticofficial/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                          <li><a href="https://www.youtube.com/channel/UCqiih4I1gVnIihQmB5ixWUw" target="_blank"><i class="fa fa-youtube"></i></a></li>
                          <li><a href="https://twitter.com/FruitasticAus" target="_blank"><i class="fa fa-twitter"></i></a></li>
                      </ul>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                        <ul class="login_part">
                           <?php if($this->session->userdata('admin_login'))
								{?>
								<li>
								<a href="<?php echo base_url('login/logout')?>" >
								<i class="fa fa-user" aria-hidden="true"></i> Logout /
								</a> 
								</li>
								<li   >
								<a href="<?php echo fruitastic_dashboard.'dashboard/index.php?id='.$this->added_by.'&token='.$this->api_token?>" target="_blank" class="rgst" >My Account <?php //echo 'Hi'.$this->name?></a>
								</li>
						  <?php 
								}
								else
								{
						  ?>      
							<li>
							<a href="#" data-toggle="modal" data-target="#signinModal">
							<i class="fa fa-lock" aria-hidden="true"></i> Login /
							</a> 
							</li>
							<li class="rgst" data-toggle="modal" data-target="#registration">
							<a href="#" data-toggle="modal" data-target="#signupModal">Register</a>
							</li>
							<?php }//logout?>
                        </ul>
                    </div>
              </div>
          </div>
      </div>
      <div class="bottom_header fw">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-xs-12 col-sm-3">
                        <!--<a href="index.html" class="logo"><img src="common/images/logo.png" alt="logo" class="img-responsive"></a>-->
      <a href="<?php echo base_url('home');?>" class="logo"> 
          <img src="<?php echo base_url_assets;?>images/Logo-red.png" alt="logo" class="img-responsive img1 hidden-xs hidden-sm"> 
          <img src="<?php echo base_url_assets;?>images/Logo-red.png" alt="logo" class="img-responsive img2"> 
          </a> 
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-12 pull-right">
                        <div class="menu_sec">
                            <nav class="navbar navbar-default">
                                <div class="navbar-header cart-navbar-header">
                                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button>
                                </div>

                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                  <ul class="nav navbar-nav">
                                    <!--<li><a href="index.html">home</a></li>
                                    <li class="active"><a href="cart.html">SHOP NOW </a></li>
                                    <li><a href="bulk-orders.html">BULK ORDERS</a></li>
                                    <li><a href="how-it-works.html">HOW IT WORKS</a></li>
                                    <li><a href="about.html">ABOUT US</a></li>
                                    <li><a href="contact.html">CONTACT US</a></li>-->
<li <?php if($con=='' || $con=='home'){echo ' class="active"';}?>><a href="<?php echo base_url('home');?>">Home</a></li>
<li <?php if($con=='product'){echo ' class="active"';}?>><a href="<?php echo base_url('product');?>">Shop</a></li>
<li <?php if($con=='bulk_order'){echo ' class="active"';}?>> <a href="<?php echo base_url('bulk_order');?>">Bulk Order</a></li>
<li <?php if($con=='how-it-works'){echo ' class="active"';}?>><a href="<?php echo base_url('how-it-works');?>">How IT Works</a></li>
<li <?php if($con=='about-us'){echo ' class="active"';}?>><a href="<?php echo base_url('about-us');?>">About</a></li>
<li><a  href="https://blog.fruitastic.com.au/"  target="_blank">Blog</a></li>
<li <?php if($con=='contact-us'){echo ' class="active"';}?>><a href="<?php echo base_url('contact-us');?>">Contact</a></li>
                                    
                                    <li class="hidden-lg hidden-md">
                                    <a href="#" data-toggle="modal" data-target="#signinModal">
                                    <i class="fa fa-sign-in"> </i> Login</a></li>
                                    <li class="hidden-lg hidden-md">
                                    <a href="<?php echo fruitastic_dashboard.'dashboard/index.php?id='.$this->added_by.'&token='.$this->api_token?>"><span class="glyphicon glyphicon-user"> </span> My Account</a>
                                    
                                    <li class="hidden-lg  hidden-md mobile-social-icon">
                                    <a href="https://www.facebook.com/FruitasticMelbourne/" target="_blank">
                                    <i class="fa fa-facebook"></i></a>
                                    <a href="https://www.instagram.com/fruitasticofficial/" target="_blank">
                                    <i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="https://www.youtube.com/channel/UCqiih4I1gVnIihQmB5ixWUw" target="_blank">
                                    <i class="fa fa-youtube"></i></a>
                                    <a href="https://twitter.com/FruitasticAus" target="_blank">
                                    <i class="fa fa-twitter"></i></a></li>
                                  </ul>
                                </div>
                              </nav>
                              <!--<span class="login_part hidden-xs hidden-sm">
                                 <li><a href="cart.html"><i class="fa fa-shoping-cart">0</i></a></li>
                          	  </span>-->
                              <span class="login_part hidden-xs hidden-sm">
                              <ul  class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                                 <li><a  <?php /*?> onClick="openNav()"<?php */?> onClick="openNavcart()"  style="" class="cartbtnaaaaa">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    <i class="crtnmbra" id="cart_top_big_total_item"><?php echo $this->cart->total_items()?></i>
                                    <span id="cart_top_big_total_price"><?php echo $this->cart->total(); ?></span>
                                </a></li>
                                </ul>
                          	  </span>
                        </div>
                    </div>
                   <div id="mySidenav" class="sidenav"> 
				  <?php //$this->load->view('templates/pages/right_side_cart_page');?>
                 </div>
                    
                </div>
            </div>
        </div>
  </header>

  

<?php $this->load->view('templates/pages/headers_popups');?>

 <script>
function openNavcart() 
{	
	var ccp=$('#coupon_code').val();
	//alert(ccp);
	var send_url="<?php echo base_url('cart/show_side_cart');?>";	
	var data_array={customer_id:'1'}
	var ddd=send_ajax_return_value(send_url,data_array);
	console.log(ddd);
	//var dd=jQuery.parseJSON(ddd.responseText);
	var dd=(ddd.responseText);
	$('#mySidenav').html('');
	$('#mySidenav').html(dd);
	document.getElementById("mySidenav").style.width = "438px";	
	console.log(dd);	
}

function closeNavcart() 
{
    document.getElementById("mySidenav").style.width = "0";
}
</script>
    

    
   
	
  