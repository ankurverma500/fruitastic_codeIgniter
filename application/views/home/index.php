
<section class="delivery_sec fw"><!-- delivery_sec start -->
     <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="delivery_cont">
                    <img src="<?php echo base_url_assets;?>images/if_JD-29_2183552.svg" alt="car_img">
                    <p>Check your Post Code for Free Delivery</p>
                    <input type="text" name="pin_code" id="pin_code" require value="Enter your post code" onClick="if(this.value=='Enter your post code'){this.value=''}" onBlur="if(this.value==''){this.value='Enter your post code'}" >
					<a href="#" class="hoverd-btn" data-toggle="modal" data-target="#check_now" onClick="chk_pincode()">Check Now</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- delivery_sec end -->

  
  <script>
function chk_pincode() 
{	
	var pin_code=$('#pin_code').val();
	//alert(ccp);
	var send_url="<?php echo base_url('calendar/check_post_code_index');?>";	
	var data_array={post_code:pin_code}
	var ddd=send_ajax_return_value(send_url,data_array);
	console.log(ddd);
	var dd=jQuery.parseJSON(ddd.responseText);
	//var dd=(ddd.responseText);
	$("#truemsg,#truemsg2").css('display','none');
	if(dd.res)
	{
		$('#check_now .post_code_detail_display').removeClass('text-danger');
		$('#check_now .post_code_detail_display').addClass('text-success');
		$("#truemsg").css('display','block');
	}
	else
	{
		$('#check_now .post_code_detail_display').removeClass('text-success');
		$('#check_now .post_code_detail_display').addClass('text-danger');
		$("#truemsg2").css('display','block');
	}
	$('#check_now .post_code .post_code_display').html(pin_code);
	$('#check_now .post_code .post_code_detail_display').html(dd.msg);
	//document.getElementById("check_now").style.width = "438px";	
	//console.log(dd);	
}

</script>
  
<div id="check_now" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body post_code">
        <h1 class="text-center"><i class="fa fa-map-marker post-code-icon" aria-hidden="true"></i> <span class="post_code_h_one">Post Code</span></h1>
        <h3 class="text-center post_code_h3"><span class="post_code_display"></span></h3>
        <p class="text-center"><span class="post_code_detail_display"></span> 
        </p>
        <!--<p class="text-center text-success post_code_congrats">Congrats!! We can deliver to your place FREE</p>
        <p class="text-center"><a href="#" class="post_code_shop_btn hoverd-btn">Shop Now <i class="fa fa-mail-forward"> </i></a></p>
        
        <p class="text-center post_code_apologies">Apologies - Currently we are not delivering in your area</p>-->
        <p  class="text-center" id="truemsg" style="display:none">
        <a  class="post_code_shop_btn hoverd-btn"  href="<?php echo base_url('product');?>">Shop Now 
        <i  class="fa fa-mail-forward"> </i></a>
        </p>
        <p class="text-center" id="truemsg2" style="display:none">
            <a href="#" class="post_code_shop_btn hoverd-btn" data-dismiss="modal">
            	<i class="fa fa-times" aria-hidden="true"> </i> Close
            </a>
        </p>
      </div>
    </div>

  </div>
</div>

<section class="residential_sec fw text-center"><!-- residential_sec start -->
    <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4">
          <a href="javascript:void(0)">
                <div class="service">
                    <i class="icon-presentation"><img src="<?php echo base_url_assets;?>images/home_img1.png"></i>
                    <h2>Residential</h2>
                    <hr>
                    <p class="alt-paragraph">Delivery is free to most homes throughout Victoria*(subject to minimum spend and post code). 
 Please check your post code to see if you qualify.</p>
                </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
            <a href="javascript:void(0)">
                <div class="service">
                    <i class="icon-presentation"><img src="<?php echo base_url_assets;?>images/home_img2.png"></i>
                    <h2>Schools & Childcare</h2>
                    <hr>
                    <p class="alt-paragraph">We currently deliver to 450 + schools Vic wide, ensuring thousands of kids are enjoying Fruitastic freshness daily. </p>
                </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
            <a href="javascript:void(0)">
                <div class="service">
                    <i class="icon-presentation"><img src="<?php echo base_url_assets;?>images/home_img3.png"></i>
                    <h2>Corporate</h2>
                    <hr>
                    <p class="alt-paragraph">Healthy team room snacks delivered to your office, tailored to your work force. Boosting moral and energy levels. Click bulk orders above to get started. </p>
                </div>
                </a>
            </div>
        </div>
    </div>
</section><!-- residential_sec end -->

<section class="whoweare_sec fw text-center"><!-- whoweare_sec start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="white_box">
                    <div class="inner_box">
                        <h1 class="common-title">Who We Are</h1>
                        <p>Fruitastic is an Australian family owned and operated company. </p>
						<p>Our service began deliveries to homes in Victoria way back in 1993. It's taken on many changes and a few faces, and we are proud to be one of the pioneers in online deliveries in Australia.</p> 
						<p>In 2005 Fruitastic was formed to set the benchmark for real fresh fruit and veg deliveries throughout Melbourne. 
Our team, source, purchase, pack and deliver all goods in house. In other words, unlike many of our competitors, we take your order from start to finish, delivering with confidence and experience, ensuring 100% satisfaction in great quality and freshness. </p>
						<p>Our team are all fresh fruit and veg lovers. We are passionate about quality produce and pride ourselves in the supply from farm to kitchen. </p>
						<p>Like and subscribe to our social media pages to stay up to date with us and view more of who we are and what we do behind the scenes. </p>
                        <ul class="fruit_part">
                            <li><a href="#"><img src="<?php echo base_url_assets;?>images/fruits_img1.png" alt="fruits_img1">Fruit </a></li>
                            <li><a href="#"><img src="<?php echo base_url_assets;?>images/fruits_img2.png" alt="fruits_img2">Vegetables</a></li>
                            <li><a href="#"><img src="<?php echo base_url_assets;?>images/fruits_img3.png" alt="fruits_img3">Milk & Bread </a></li>
                        </ul>
                        <a href="<?php echo base_url('product');?>" class="shop_btn hoverd-btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- whoweare_sec end -->
 
<section class="special_sec fw text-center animatedParent"><!-- special_sec start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 special_cont">
                <h1 class="common-title">Weekly Specials</h1>
                <ul class="">
                <?php 
	$i=1;   
	if( $discount_product['res'] ) 
	{  
	?>
                <?php                
				foreach( $discount_product['rows'] as $result_products)
					{
						if(array_key_exists($result_products->id,$discount_product_exist) && ($discount_product_exist[$result_products->id]['discount_option']==1))
						{ 
						$sel_price=$discount_product_exist[$result_products->id]['sel_price'];
						$was_price=$discount_product_exist[$result_products->id]['was_price'];
					?>
                    <li class="block bounceIn animated af">
                        <figure>
                         <?php 
					if($result_products->product_image=='')
					{ 
					$product_image=fruitastic_image_url.'uploads/noimage/no-image.jpg';?>                    
                    <img src="<?php echo fruitastic_image_url.'uploads/noimage/no-image.jpg';?>" class=" img img-responsive" alt="Product Image"  />
                    <?php 
                    } 
                    else 
                    {  
                    $product_image=fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>
                    <img src="<?php echo fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>" class="img img-responsive" alt="Product Image" />
                    <?php } ?>
                        <!--<img src="<?php echo base_url_assets;?>images/special_img1.png" alt="special_img1" class="">-->
                        </figure>
                        <h3><?php echo $result_products->product_name;?></h3>
                        <p><span>$<?php echo $was_price;?></span>$<?php  echo number_format($sel_price,2);?></p>
                        <!--<div class="overlay"><a href="#" class="hoverd-btn view-bbdbsm btn btn-danger">View</a></div>-->
                    </li>
                    <?php	//if($i==4){echo '</div><div class="item">';$i=0;}
					$i++; 
					}
					}
					?>
                    <?php
					
				}?>
                </ul>
                <p class="text-center animatedParent">
                <a href="<?php echo base_url('product');?>" class="viewall hoverd-btn block bounceIn animated">Shop Now</a>
                </p>
            </div>
        </div>
    </div>
</section><!-- special_sec end -->

<section class="ualuebox_sec fw animatedParent"><!-- ualuebox_sec start -->
  <h1 class="common-title transparent"><span>Value box</span></h1>
   <div class="row">
    <div class="col-sm-10 col-sm-offset-1 value_box_row">
    <img class="ualuebox_img block bounceInLeft animated img-responsive go" src="<?php echo base_url('assets/images/fruit-and-veg-box.jpg')?>" alt="ualue_img">
    <div class="monthly_part block bounceInRight animated go pull-right">
        <h2 class="animated fadeInRight go">VALUE BOXES START AT JUST </h2>
        <span>$40.00</span>
        <p class="text-justify">Simply the best value of Fruit and Veg boxes available. Saving you hundreds of $$$ per year. We pack so much goodness, variety and most importantly plenty of fruit and veg into these boxes, the whole family will be thrilled. Menus change weekly.</p>
        <p><a href="<?php echo base_url('product')?>" class="shop_btn hoverd-btn">Shop Now</a></p>
    </div>
   </div>
  </div>
</section>    





<div class="about_us_sec"><!--- about_us_sec start -->
    <div class="container">
        <div class="row">
             <h1 class="common-title hidden-lg hidden-md hidden-sm">About Us</h1>
            <div class="col-md-12 col-sm-12">
            	<figure class="about_us_image"><img class="img-responsive img-circle" src="<?php echo base_url_assets;?>images/JAGJDJ.jpg" alt="baby_img"></figure>
                <div class="wrape_about text-center">
                    <h1 class="common-title hidden-xs">About Us</h1>
                    <p> Fruitastic is a classic elucidation of how vision and perseverance of a small team of individuals can impact lives of thousands. We are extraordinarily simple people with one elementary goal; deliver garden-fresh fruits and veggies to every household in Victoria. </p>
                    
                    <div class="text-center">
                       <a href="<?php echo base_url('about-us');?>" class="shop_btn hoverd-btn">READ MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--- about_us_sec end -->



<div class="fresh_sec fw">
  <div class="container">
    <h1 class="common-title">Just how fresh ?</h1>
    <div class="hidden-sm hidden-xs desktop">
    <img src="<?php echo base_url_assets;?>images/just-how-fresh.jpg" alt="">
    </div>
    <ul class="hidden-md hidden-lg mobile">
      <li><img src="<?php echo base_url_assets;?>images/step1.png"><span>You place your order </span><small>Delivery <br>Day</small></li>
      <li><img src="<?php echo base_url_assets;?>images/step2.png"><span>We buy fresh fruit <br>& vegetables</span></li>
      <li><img src="<?php echo base_url_assets;?>images/step3.png"><span>Hand picked and <br>Packed</span></li>
      <li><img src="<?php echo base_url_assets;?>images/step4.png"><span>Deliveries start</span></li>
      <li><img src="<?php echo base_url_assets;?>images/step5.png"><span>Enjoy Fresh</span></li>
    </ul>
  </div>
</div>