 

<div class="container btm-pd">
<div class="row">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
   <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?php echo base_url('assets/image/banner.jpg');?>" alt="#" class="animated fadeIn">
      <div class="carousel-caption hidden-xs">
        <h1 class="sldrfnt animated fadeInDown go">Grab The Best Offers On Fresh Vegetables & Fruits</h1>
        <p><a href="<?php echo base_url('product/index');?>" class="btn btn-danger btn-lg shopnowbtn animated fadeInUp go">Shop Now</a></p>
      </div>
    </div>

    <div class="item">
       <img src="<?php echo base_url('assets/image/banner.jpg');?>" alt="#" class="animated fadeIn">
      <div class="carousel-caption hidden-xs">
        <h1 class="sldrfnt animated fadeInDown go">Grab The Best Offers On Fresh Vegetables & Fruits</h1>
        <p><a href="<?php echo base_url('product/index');?>" class="btn btn-danger btn-lg shopnowbtn animated fadeInUp go">Shop Now</a></p>
      </div>
    </div>
    <div class="item">
       <img src="<?php echo base_url('assets/image/banner.jpg');?>" alt="#" class="animated fadeIn">
      <div class="carousel-caption hidden-xs">
        <h1 class="sldrfnt animated fadeInDown go">Grab The Best Offers On Fresh Vegetables & Fruits</h1>
        <p><a href="<?php echo base_url('product/index');?>" class="btn btn-danger btn-lg shopnowbtn animated fadeInUp go">Shop Now</a></p>
      </div>
    </div>
  </div>
 </div>
</div>  
</div>

  
<div class="container">  
	<!--<div class="row btm-pd">
        <div class="col-sm-3 col-sm-offset-1"> <h4 class="dudtmechone">DO YOU DELIVER TO ME?</h4> </div>
        <div class="input-group col-sm-7 dydtm">
            <input type="text" class="earch-query form-control input-lg wqfcil" placeholder="Enter your postcode below to check your area" />
            <span class="input-group-btn">
                <button class="btn btn-danger clearfix" type="button" data-toggle="modal" data-target="#deliverarea">
                    <i class="fa fa-angle-right fa-2x" aria-hidden="true"></i>
                </button>
            </span>
        </div>
	</div>-->
 <?php 
 $i=1;   
if( $clearence_product['res'] ) 
{  
 ?>
    <div class="row">
     <div class="col-sm-5 hidden-xs">
     	<img src="<?php echo base_url('assets/image/special-offer-border.png');?>" class="img-responsive"  / >
     </div>
     <div class="col-sm-2 text-center">
     	<img src="<?php echo base_url('assets/image/special-offer.png');?>" class="img-responsive special-offer"  / >
     </div>
     <div class="col-sm-5 hidden-xs">
     	<img src="<?php echo base_url('assets/image/special-offer-border.png');?>" class="img-responsive"  / >
     </div>
    </div>
 
    <div class="row">
        <?php /*?><div class="col-sm-3">
            <article class="col-item">
            	<div class="photo">
        			<div class="options-cart-round">
                     <a href="shopping-cart.html">
        				<button class="btn btn-default bbdffsc" title="Add to cart">
        					<span class="fa fa-shopping-cart"></span>
        				</button>
                     </a>
        			</div>
        			<a href="#"> <img src="<?php echo base_url('assets/image/savoy.png');?>" class="img-responsive" alt="#" /> </a>
        		
        		<div class="info">
        			<div class="row">
        				<div class="price-details col-md-6">
        					<p class="details">
        						Savoy Cabbage
        					</p>
        					<h1>Was <strike>$ 3.00</strike></h1>
        					<span class="price-new">Now $ 2.00</span>
        				</div>
        			</div>
        		</div>
                </div>
        	</article>
        </div><?php */?>
        
        <?php                
		foreach( $clearence_product['rows'] as $result_products)
			{ ?>
        <div class="col-sm-3">
            <article class="col-item">            	
            	<div class="photo">        			
        			<a href="#"> 
                    <?php 
					if($result_products->product_image=='')
					{ 
					$product_image=fruitastic_image_url.'uploads/noimage/no-image.jpg';?>                    
        <img src="<?php echo fruitastic_image_url.'uploads/noimage/no-image.jpg';?>" class="img-responsive" alt="Product Image"  />
        <?php 
		} 
		else 
		{  
		$product_image=fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>
        <img src="<?php echo fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>" class="img-responsive" alt="Product Image" />
        <?php } ?>
                    </a>
        		<div class="info">
        			<div class="row">
        				<div class="price-details col-md-6">
        					<p class="details">
        						<?php echo $result_products->product_name;?>
        					</p>
        					<h1>Was <strike>$ <?php echo $result_products->selling_price_after_tax?></strike></h1>
        					<span class="price-new">Now $ <?php echo $result_products->clearence_amount?></span>
        				</div>
        			</div>
        		</div>
        		</div>
        	</article>            
        </div> 
        <?php if($i==4){echo '</div><div class="row ">';$i=0;}
			$i++; 
			}
		?>
        <div class="col-sm-12 text-center">
         <a href="product.html" class="btn btn-primary bbpss">Start Shopping</a>
        </div>       
	</div>
<?php }?>
<!-------------- ------------------>
 <?php 
	$i=1;   
	if( $discount_product['res'] ) 
	{  
	?>
	<div class="row bg-color-bd">
     <div class="col-sm-2 big-discounttwo">
     	<img src="<?php echo base_url('assets/image/big-discount.png');?>" class="img-responsive big-discount"/>
     </div>
     <div class="col-sm-10 hidden-xs">
     	<IMG src="<?php echo base_url('assets/image/border.png');?>" class="img-responsive" />
     </div>
    </div>  
   
   <?php if(count($discount_product['rows'])>8){?>
    <div class="row">
      <div id="adv_team_4_columns_carousel" class="carousel slide four_shows_one_move team_columns_carousel_wrapper" data-ride="carousel" data-interval="2000" data-pause="hover">
         <!--========= Wrapper for slides =========-->
         <div class="carousel-inner" role="listbox">
            <!--========= 1st slide =========-->
            <div class="item">
               <?php /*?><div class="col-xs-12 col-sm-6 col-md-3 team_columns_item_image">
                  <article class="col-item ci">
                    <div class="shape">
                        <div class="shape-text">
                            10% OFF								
                        </div>
                    </div>
                    <div class="photo">
                        <!--<div class="options-cart-round">
                            <button class="btn btn-default bbdffsc" title="Add to cart">
                                <span class="fa fa-shopping-cart"></span>
                            </button>
                        </div>-->
                        <a href="#"> <img src="<?php echo base_url('assets/image/savoy.png');?>" class="img-responsive" alt="Product Image" /> </a>
                    <div class="info">
                        <div class="row">
                            <div class="price-details col-md-6">
                                <p class="details">
                                    Savoy Cabbage
                                </p>
                                <h1>Was <strike>$ 3.00</strike></h1>
                                <span class="price-new">Now $ 2.00</span>
                            </div>
                        </div>
                    </div>
                   </div>
                </article>
               </div><?php */?>
               <?php                
				foreach( $discount_product['rows'] as $result_products)
					{ ?>
               <div class="col-xs-12 col-sm-6 col-md-3 team_columns_item_image cloneditem-1">
                  <article class="col-item ci">
                    <div class="shape">
                        <div class="shape-text">
                            10% OFF								
                        </div>
                    </div>
                    <div class="photo">
                        
                        <a href="#"> <img src="<?php echo base_url('assets/image/savoy.png');?>" class="img-responsive" alt="Product Image" /> </a>
                    <div class="info">
                        <div class="row">
                            <div class="price-details col-md-6">
                                <p class="details">
                                    Savoy Cabbage
                                </p>
                                <h1>Was <strike>$ 3.00</strike></h1>
                                <span class="price-new">Now $ 2.00</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </article>
               </div>
               <?php if($i==4){echo '</div><div class="item">';$i=0;}
					$i++; 
					}
				?>
               
            </div>            
         </div>
         <!--======= Navigation Buttons =========-->
         <!--======= Left Button =========-->
         <a class="left carousel-control team_columns_carousel_control_left adv_left" href="#adv_team_4_columns_carousel" role="button" data-slide="prev">
         <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
         <span class="sr-only">Previous</span>
         </a>
         <!--======= Right Button =========-->
         <a class="right carousel-control team_columns_carousel_control_right adv_right" href="#adv_team_4_columns_carousel" role="button" data-slide="next">
         <i class="fa fa-arrow-circle-o-right fa-2x" aria-hidden="true"></i>
         <span class="sr-only">Next</span>
         </a>
      </div>
   </div>
  <?php }else
		{
			?><div class="row">
            <?php                
				foreach( $discount_product['rows'] as $result_products)
					{ ?>
		<div class="col-sm-3">
            <article class="col-item ci">
            		<div class="shape">
                        <div class="shape-text">
                            <?php echo $result_products->discounted?>% OFF								
                        </div>
                    </div>
                    
            	<div class="photo">        			
        			<a href="#"> 
                    <?php 
					if($result_products->product_image=='')
					{ 
					$product_image=fruitastic_image_url.'uploads/noimage/no-image.jpg';?>                    
        <img src="<?php echo fruitastic_image_url.'uploads/noimage/no-image.jpg';?>" class="img-responsive" alt="Product Image"  />
        <?php 
		} 
		else 
		{  
		$product_image=fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>
        <img src="<?php echo fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>" class="img-responsive" alt="Product Image" />
        <?php } ?>
                    </a>
        		<div class="info">
        			<div class="row">
        				<div class="price-details col-md-6">
        					<p class="details">
        						<?php echo $result_products->product_name;?>
        					</p>
        					<h1>Was <strike>$ <?php echo $result_products->selling_price_after_tax?></strike></h1>
        					<span class="price-new">Now $ <?php  echo number_format(($result_products->selling_price_after_tax-(($result_products->discounted/100)*$result_products->selling_price_after_tax)),2);?></span>
        				</div>
        			</div>
        		</div>
        		</div>
        	</article>            
        </div>   
	<?php	if($i==4){echo '</div><div class="item">';$i=0;}
					$i++; 
		}
		?>
		</div> 
		<?php
					
	}?>
   
   
   <div class="row bg-color-bd">
   	<div class="col-sm-12 text-center">
     <a href="product.html" class="btn btn-primary bbpss">Start Shopping</a>
    </div>
   </div>
    <?php }?>
<!----------------------- --------------------------------------------->
   
   <div class="row">
   	<div class="col-sm-12 text-center"><h2 class="uprcse">About Fruitastic</h2></div>
    <div class="col-sm-3 heartdiv">
     <img src="<?php echo base_url('assets/image/heart.png');?>" class="img-responsive heartimg" />
    </div>
    <div class="col-sm-9">
     <p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
     </p>
    </div>
   
   </div>
   </div>
   
<!------------------------- ---------------------------------------->


<section id="carousel">    				
	<div class="container ">
		<div class="row">
			<div class="col-md-12 cntbg">
                <h2 class="uprcse1 text-center">Happy Clients</h2>
				<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
				  <div class="carousel-inner">
				    <div class="active item">
                    	<blockquote>
			    			<p class="tst"><i class="fa fa-quote-left" aria-hidden="true"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.Impedit temporibus nisi accusamus.  <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        </blockquote>
                        <div class="profile-circle"><img src="<?php echo base_url('assets/image/client1.png');?>" class="img-circle icimg" /></div>
                        <h4 class="text-center dpj">DR. Prabankaran John</h4>
                        <p class="text-center"><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i></p>
				    </div>
				    <div class="item">
                    	<blockquote>
			    			<p class="tst"><i class="fa fa-quote-left" aria-hidden="true"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.Impedit temporibus nisi accusamus.  <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        </blockquote>
                        <div class="profile-circle"><img src="<?php echo base_url('assets/image/client1.png');?>" class="img-circle icimg" /></div>
                        <h4 class="text-center dpj">DR. Prabankaran John</h4>
                        <p class="text-center"><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i><i class="fa fa-star ffcstar" aria-hidden="true"></i></p>
				    </div>
				  </div>
				</div>
             <!-- Left and right controls -->
              <a class="left carousel-control" href="#fade-quote-carousel" data-slide="prev">
                <i class="fa fa-angle-left fa-3x tstffcl" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#fade-quote-carousel" data-slide="next">
                <i class="fa fa-angle-right fa-3x tstffcl" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
              </a>
			</div>
            </div>
            </div>
</section>


  
 
<!-- DELIVER Area code Modal -->

<div id="deliverarea" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">Post Code</h3>
      </div>
      <div class="modal-body text-center">
        <h3>2233</h3>
        <p>We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options.</p>
        <div class="deliver_btn"><a href="contact-us.html" class="btn btn-primary">Click Here!</a></div>
      </div>
    </div>
  </div>
</div>

           
            



