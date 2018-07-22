<style>
.pac-container {
    background-color: #FFF;
    z-index: 9000051 !important;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal {
    z-index: 299999;
}
.modal-backdrop{
   z-index: 66666;        
}​
.btn:hover,.btn-default:hover {
    color: #333;
    background-color: none !important;
    border-color: #adadad;
}
#shopnow_popup
{
	z-index:99999;
}
.class_pointer
{
	cursor:pointer;
}
/*.complete-order > table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td{     padding: 0px 0px !important; }
.img-responsive{max-height: 81px;}
.product-list table td {
    padding: 15px 5px !Important;
}*/
/*.btn-default:hover {
    color: #333;
    background-color: #e6e6e6;
    border-color: #adadad;
}
.productbox
{
	cursor: text !important;
}*/
</style>

  <div class="banner_container cart-banner hidden-md hidden-sm hidden-xs">
    <!--<img src="common/images/cart-banner.jpg" alt="">-->
    <div class="banner_details text-center">
      <div class="container">
        <h1 class="animated fadeInDown go">So much goodness straight from</h1>
        <span>local Aussie farms!! Delish!!</span>
      </div>
    </div>
  </div>

  <div class="product_sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 cart-sidebar scrollspy">
          
          <div class="panel-group pnl-group-fix" id="cart-accordion" role="tablist" aria-multiselectable="true" data-spy="affix" data-offset-top="360">
          
          <!--<div class="panel-group pnl-group-fix followMeBar" role="tablist">-->
          
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title active cart_product_heading">
                  <a role="button" data-toggle="collapse" data-parent="#cart-accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Products</a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <ul class="nav nav-tabs" role="tablist">
                  <?php
				 // echo ''.$this->db->last_query();
				  $da=array('val'=>'`id`, `name`, `status`, `deleted`, `added_date`, `orderby`, `class`',
							  'table'=>'tbl_category',
							  'where'=>array('status'=>'1','deleted'=>'0'));
					$this->db->order_by('orderby','DESC');
					$category=$this->common->getdata($da);
					if($category['res'])
					{
						foreach($category['rows'] as $ct)
						{
							$active='';
							if($cat_id==$ct->id){$active='active';}
							echo '<li class="'.$active.' '.$ct->class.'"><a href="'.base_url('product/index/'.$ct->id).'">'.$ct->name.' </a></li>';
							/*echo '<li class="'.$active.' '.$ct->class.'" id="get_all_product_detal_li_'.$ct->id.'">
										<a onclick="get_all_product_detal_function('.$ct->id.')" >'.$ct->name.' </a>
								  </li>';*/
						}
					}
				  ?>                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php 
		
	     $cart_check = $this->cart->contents();
		 $product_id=array();
		 //echo count($cart_check['8f14e45fceea167a5a36dedd4bea2543']['id']['7']);
		 foreach ($cart_check as $item)
		 {
			 array_push($product_id,$item['id']);
			 $p_dtail[$item['id']]=$item['qty'];
		 }
		 /*if(empty($cart_check)) 
		 {
             echo 'To add products to your shopping cart click on "Add to Cart" Button'; 
         }
		 else
		 {
			 echo '<pre>';
			 print_r($cart_check);
			 echo '</pre>';
		 } */
	  ?>
        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
          <h1 class="cart-title">Products</h1>
          
         <!-- <div class="search_box">
            <input type="text"><input type="submit" value="Search">
          </div>-->
          
              <?php 
		//print_r($result_product);
		//exit;
		//exit;
		
			 
		$i=1;   
		if( $result_product['res'] ) 
		{ ?>
		<div class="table-responsive product-list" id="get_all_product_detal_div_<?php echo $result_product['rows'][0]->cat_id?>">
           <table class="table" id="get_all_product_detal_table_<?php echo $result_product['rows'][0]->cat_id?>" >
            <thead>
              <tr>
                <th>Product Detail</th>
                <th>Product Price</th>
                <th class="text-center">Quantity</th>
                <th>Sub Total</th>
                <th class="actions"></th>
              </tr>
              </thead>
              <tbody>
		    <?php            
		foreach( $result_product['rows'] as $result_products)
			{
			$prod_id=$result_products->id;
			$prod_price=$result_products->cost_per_unit;
			$res=get_product_final_price_by_customer_type($this->added_by,$this->customer_type,$prod_id,$result_products);
			//print_r($res);
			//exit;
			if($res['res'])
			{
				$product_gst=0;
				if($res['gst'])
				{
					$product_gst=$res['product_gst'];
				}
				/*echo '<pre>';
				//print_r($result_products);
				print_r($res);
				//echo $prod_id;
				//print_r($product_id);
				exit;*/
				//$result_products->was_price=$res['was_price'];
				$prod_price=number_format($res['price'],2);
				$show=false;
				if(in_array($prod_id,$product_id))
				{
						//echo 'asdsa';
					 $show=true;
				}
				
			?>
              <tr style="background-color: #FBFBFB;
    border-bottom: 1px solid #DDDDDD;">
                <td>
				<?php 
                if($result_products->product_image=='')
                { 
                $product_image=fruitastic_image_url.'uploads/noimage/no-image.jpg';?>                    
                <img src="<?php echo fruitastic_image_url.'uploads/noimage/no-image.jpg';?>" class="img-responsive" alt="#"  />
                <?php 
                } 
                else 
                {  
                $product_image=fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>
                <img src="<?php echo fruitastic_image_url."uploads/thumbs/$result_products->product_image";?>" class="img-responsive" alt="#" />
                <?php } if($res['discount_option']){?>
                <div class="item_details">
                <?php if($res['discount_type']==1){ ?>
                	<small class="red btn">CLEARANCE</small>
				<?php }else if($res['discount_type']==2){ ?>
                	<small class="green btn">10% off</small>
				<?php } }?>
                  
                  <h3><?php echo $result_products->product_name;?></h3>
                  <span class="per"><?php echo $result_products->product_type;?></span>
                </div>
                </td>
                <td align="center" class="price"><small>
				<?php 
				 if($p_dtail[$result_products->id]){ $qty= $p_dtail[$result_products->id];}else{ $qty=1;}
				$res['discount_option']?$f_price=number_format($res['price'],2):$f_price=$prod_price;
				$was_price=0;
				if($res['discount_option']=='1'){$was_price=$res['was_price']; echo '$ '.$res['was_price'];}?>
				</small> <span>$<?php echo $prod_price;?> </span></td>
                <td>
                	<div class="input-group input-group-sm cart-quantity">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-number minus-btn product_cart_button product_b_<?php echo $prod_id;?>"  data-type="minus" data-field="product_<?php echo $prod_id;?>"  show="<?php echo $show?>"  pid="<?php echo $prod_id;?>" pprice="<?php echo $prod_price;?>">
                              <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" id="product_<?php echo $prod_id;?>" name="product_<?php echo $prod_id;?>" class="form-control input-number quantity-text" value="<?php echo $qty;?>" min="1" max="100" show="<?php echo $show?>" pid="<?php echo $prod_id;?>" pprice="<?php echo $prod_price;?>">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-number plus-btn product_cart_button product_b_<?php echo $prod_id;?>" data-type="plus" data-field="product_<?php echo $prod_id;?>" show="<?php echo $show?>" pid="<?php echo $prod_id;?>" pprice="<?php echo $prod_price;?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                     </div>
                    <!--<a href="#"><i class="fa fa-minus"></i></a>
                    <input type="text" placeholder="20">
                    <a href="#"><i class="fa fa-plus"></i></a>-->
                </td>
                <td><strong class="pid_total_price_<?php echo $prod_id;?>">$<?php echo number_format(($qty*$f_price),2);?> </strong></td>
                <?php 
				if(!$show)
				{?>
                 <?php 
				}
				else
				{
					?>
				<?php }?>
                <td style="display:<?php if(!$show){echo 'block;';}else{echo 'none;';}?>" class="action add" id="add_to_cart_td_<?php echo $result_products->id;?>">
                <a onclick="add_to_cart('<?php echo $result_products->id;?>','<?php echo $product_image?>','<?php echo $prod_price?>','<?php echo $result_products->product_name;?>','<?php echo $was_price?>','1','add','<?php echo $product_gst?>')" 
							  <?php /*?>onclick="show('comment'); hide('clickMeId')"<?php */?> 
                              id="add_to_cart_<?php echo $result_products->id;?>" class="cart-add class_pointer">
                	<p>
                		<i class="fa fa-cart-plus fa-3x" aria-hidden="true"></i>
                    </p>
                    <span>Add</span>
                </a>
                </td>
               
                <td  style="display:<?php if(!$show){echo 'none;';}else{echo 'block;';}?>
   <?php /*?> margin: -135px 0 0 0;<?php */?>" class="action added" id="Added_to_cart_td_<?php echo $result_products->id;?>">
                    <a <?php /*?>onclick="add_to_cart('<?php echo $result_products->id;?>','<?php echo $product_image?>','<?php echo $prod_price?>','<?php echo $result_products->product_name;?>','<?php echo $was_price?>','1','Added','<?php echo $product_gst?>')"<?php */?> 
                              id="add_to_cart_<?php echo $result_products->id;?>" class="check-add">
                        <p>
                            <i class="fa fa-check-circle fa-3x"></i>
                        </p> 
                        <span>Added</span>
                    </a>
                </td>
                
                <td style="display:none;
  <?php /*?>  margin: -135px 0 0 0;<?php */?>" class="action update" id="update_to_cart_td_<?php echo $result_products->id;?>">
                        <a onclick="add_to_cart('<?php echo $result_products->id;?>','<?php echo $product_image?>','<?php echo $prod_price?>','<?php echo $result_products->product_name;?>','<?php echo $was_price?>','1','update','<?php echo $product_gst?>')" 
                              id="add_to_cart_<?php echo $result_products->id;?>" class="check-update class_pointer">                    
                            <p><i class="fa fa-upload fa-3x"></i></p>
                            <span>Update</span>
                        </a>
                    </td>
                    
              </tr>
            	<?php
			//if($i==4){echo '</div><div class="row productsection">';$i=0;}
			$i++; 
			}
			}?>
            <tbody>
            </table>
          </div>
	<?php
		}
	?>    		
        </div>        
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 scrollspy">
          <!--<div class="order-box pnl-group-fix" role="tablist" aria-multiselectable="true" data-spy="affix" data-offset-top="360">-->
          
          <?php $this->load->view('order_summary')?>

        </div>
        
       <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm hidden-md">
          <p class="followMeBar followMeBar2" style="margin-top:-180px;"></p>
        </div>-->
        
      </div>
    </div>
  </div>
  
 
 <?php /*?>
<!-- Modal -->
<div id="change_code" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm text-center">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-close"></span></button>
      </div>
      <div class="modal-body">
        <h3>Enter new post code</h3>
        <input type="text" class="form-control post_code_text"  />
        <a href="#" class="post_code_btn hoverd-btn" data-dismiss="modal">Submit</a>
      </div>
      
    </div>

  </div>
</div>


<div class="modal fade" id="postcodemodel" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <!--<div class="modal-content podecode_modalcontent">-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-close"></span><span class="close_text">Close</span>
        </button> 
      </div>
      <div class="modal-body postcode_modalbody">  
        <h1 class="postcode_modalhead"><img src="assets/images/post_code_icon.png" /> <span class="postcode_txt">Post code</span></h1>
        <p class="postcode_p">Please enter your Post Code to check for</p> 
        <p class="postcode_p">Free Delivery*</p>
        <div class="postcode_textbox">
        <!--<input type="text" id="pin_code" class="form-control post_code_text" placeholder="Enter Post Code" onclick="if(this.value=='Enter Post Code'){this.value=''}" onblur="if(this.value==''){this.value='Enter Post Code'}" />-->
        
        <input type="text" id="pin_code" class="form-control post_code_text" onblur="this.placeholder = 'Enter Post Code'" onfocus="this.placeholder = ''" placeholder="Enter Post Code" />
        </div>
       <!-- <a href="#" (click)="changePin($event)" class="post_code_btn hoverd-btn" data-dismiss="modal">Submit</a>-->
        <button (click)="changePin($event)" class="post_code_btn hoverd-btn" id="errormsg">Submit</button>         
        <!--<div class="error text-center" style="display:none">
            <p class="text-center" style="padding-left:5%; padding-right:5%">We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options. </p>
             <a  href="#/contact" class="post_code_btn hoverd-btn" > Contact Us</a>  
        </div>-->  
        <p>* Free Delivery for orders above $40</p> 
      </div>
    </div>
  </div>  
</div><?php */?>

<!--<div class="modal fade" id="postcode_pop" aria-labelledby="myModalLabel">
    <div class="flexpop">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
              <h3><img src="common/images/map-mark.png" alt=""> Post Code</h3>
              <p>Please enter your Post Code or Suburb for Delivery</p>
              <p><input type="text"></p>
              <p>Congrats !!   We can deliver to your place FREE</p>
              <p><a href="#" class="btn">Shop Now <i class="fa fa-mail-forward"></i></a></p>
              <p>Apologies - Currently we are not delivering in your area</p>
              <p><a href="#" class="btn" data-dismiss="modal"><i class="fa fa-close"></i> Close</a></p>
          </div>
        </div>
      </div>
    </div>
</div>-->


<div id="shopnow_popup" class="modal  fade" role="dialog" aria-labelledby="shopnow_popupLabel" aria-hidden="true" style="padding: 30px 10px 0 10px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button  aria-label="Close" class="close" data-dismiss="modal" type="button">
          <span  class="fa fa-close"></span>
          <span  class="close_text">Close</span>  
        </button>
      </div>
      <div class="modal-body">
        <h1  class="postcode_modalhead">
        <img src="assets/images/post_code_icon.png"> 
        <span  class="postcode_txt">Post code</span> 
        </h1>
      
      
     
       <div id="clickMeId_post_code" class="text-center">
        <h5>Please enter your Address to check for </h5>
		<h5>Free Delivery*</h5>
        <div  class="postcode_textbox">
        
        
        <input  class="form-control post_code_text" id="post_code_with_address" name="post_code_with_address" onblur="this.placeholder = 'Enter Post Code'" onfocus="this.placeholder = ''" placeholder="Enter Post Code" type="text">
        </div>
       <?php /*?> <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-sm-offset-3 ">
          <!--<input type="text" id="post_code" name="post_code" class="form-control text-center popup_textbox" placeholder="enter post code" />-->
          <input type="text" id="post_code_with_address" name="post_code_with_address" class="form-control popup_textbox" placeholder="Enter your postcode" />
          <!--<textarea class="form-control" rows="1" id="post_code" name="post_code"></textarea>-->
         </div>
        </div><?php */?>
        
        <button type="Submit" id="popup_postcode_button" class="btn btn-danger" <?php /*?>onclick="show('comment_post_code'); hide('clickMeId_post_code')"<?php */?>>Submit</button>
       
       </div>
       
        <div id="comment_post_code" style="display:none;" class="text-center shopnow_hidden_div">
          <p class="shopnow_hidden_p">We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options.</p>
           <a href="<?php echo base_url('contact-us');?>" class="btn btn-danger">Contact Us</a>
           <button type="button"  class="btn btn-danger" onclick="hide('comment_post_code'); show('clickMeId_post_code')">Try Again</button>
        </div>
      
       <p class="shopnow_p2">* Free Delivery for orders above $40</p>
      </div>
      
    </div>
  </div>
</div>
<?php 
//echo $this->session->userdata('run_post_code');
if($this->session->userdata('run_post_code')=='')
{?>
<!-- Shop Now post code Popup -->
<script type="text/javascript">
    $(window).on('load',function(){
        $('#shopnow_popup').modal('show');
    });
</script>
<?php 
}?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvjYUNMayAdpHVsyYtzVlQhsyxQHlsQ5U&callback=initialize&libraries=places&region=au"
  type="text/javascript"></script> 
<script type="text/javascript">
function initialize() {
 var options = {
  componentRestrictions: {country: "au"}
 };

 var input = document.getElementById('post_code_with_address1');
 //alert(input);
 var autocomplete = new google.maps.places.Autocomplete(input, options);
 var input1 = document.getElementById('billing_address');
 //alert(input);
 var autocomplete = new google.maps.places.Autocomplete(input1, options);
}

$(document).ready(function () {
    $("#popup_postcode_button").on("click", function(e) {		
		//var postData = $(this).serializeArray();				
		//console.log(postData);
		
		//var formURL='<?php echo base_url('calendar/check_post_code_popup');?>';
		var formURL='<?php echo base_url('calendar/check_post_code_with_address_popup');?>';
		//var formURL = $(this).attr("action");
		$.ajax({
			url: formURL,
			type: "POST",
			/*datatype:"JSON",
			contentType: "application/json",*/
			data: {post_code_with_address:$("#post_code_with_address").val()},
			success: function(data, textStatus, jqXHR) {
				//location.reload();
				//jQuery.parseJSON(data)
				//class="modal-open"
				console.log(data);
				if(data!='success')
				{
					show('comment_post_code'); hide('clickMeId_post_code');
					//$('#registration #popup_Register_result').html();
					//$('#registration #popup_Register_result').html(data);
				}
				else
				{
					
					//$("#message").modal('show');
					location.reload();
					//$('#registration .modal-header .modal-title').html();
					//$('#registration .modal-body').html(data);
				}
			   // $("#submitForm").remove();
			},
			error: function(jqXHR, status, error) {
				//location.reload();
				console.log(status + ": " + error);
			}
		});		
     });
   
});
</script>
<script>
//input[type="submit"]
$(function (){
	//$(".cart-quantity > .input-group-btn > input[type='button']").on('click',function(){
	$(".product_cart_button").on('click',function(){
		var pid=$(this).attr("pid");
		var p_show=$(this).attr("show");
		var pprice=$(this).attr("pprice");
		var qty=$("#product_"+pid).val();
		if(p_show)
		{
			$("#add_to_cart_td_"+pid).css("display",'none');
			$("#Added_to_cart_td_"+pid).css("display",'none');
			$("#update_to_cart_td_"+pid).css("display",'block');			
		}
		$(".pid_total_price_"+pid).html("$"+(qty*pprice).toFixed(2));
		//alert('click');
	});
	$(".cart-quantity input[type='text']").on('keyup',function(){
		var pid=$(this).attr("pid");
		var p_show=$(this).attr("show");
		var pprice=$(this).attr("pprice");
		var qty=$("#product_"+pid).val();
		if(p_show)
		{
			$("#add_to_cart_td_"+pid).css("display",'none');
			$("#Added_to_cart_td_"+pid).css("display",'none');
			$("#update_to_cart_td_"+pid).css("display",'block');			
		}
		$(".pid_total_price_"+pid).html("$"+(qty*pprice).toFixed(2));
		//alert('change');
	});
});
function remove_cart_ajax(rowid,tr_id)
{
	
	var ddd=send_ajax_return_value('<?php echo base_url('cart/remove_cart_ajax/');?>'+rowid,{rowid:rowid});
	console.log(ddd);
	var dd=jQuery.parseJSON(ddd.responseText);
	if(dd.res)
	{
		$("#product_right_small_cart_"+tr_id).remove();
		$("#product_"+tr_id).val('1');
		$("#product_"+tr_id).attr('show','');
		$("#Added_to_cart_td_"+tr_id).css('display','none');
		$("#update_to_cart_td_"+tr_id).css('display','none');
		$("#add_to_cart_td_"+tr_id).css('display','block');
		show_on_cart(tr_id);
		//add_to_cart_td_183
		//Added_to_cart_td_183
		//update_to_cart_td_183
		//product_183
	}
}
                  

function add_to_cart(id,image,price,name,was_price,qty,action_type,product_gst)
{
	if(action_type=='update_p')
	{
		var send_url="<?php echo base_url('cart/update_cart');?>";	
		//$("#product_"+id).val((parseInt($("#product_"+id).val())+1));	
		var qty=1;
		var qty2=$("#product_"+id).val();
	}else if(action_type=='update')
	{
		var send_url="<?php echo base_url('cart/update_cart');?>";	
		//$("#product_"+id).val((parseInt($("#product_"+id).val())-1));
		var qty=-1;
		var qty2=$("#product_"+id).val();
	}	
	else if(action_type=='add')
	{
		var qty2=$("#product_"+id).val();
		var send_url="<?php echo base_url('cart/add');?>";	
		add_left_cart_product(id,image,price,name,was_price,qty,action_type);
		//$("#product_"+id).val(parseInt(1));
	}
	else 
	{
		var send_url="<?php echo base_url('cart/update_cart');?>";	
		//$("#product_"+id).val((parseInt($("#product_"+id).val())-1));
		var qty=-1;
		var qty2=$("#product_"+id).val();
	}
	//add_to_cart_notify(id,image,price,name,was_price,qty,action_type);
	//document.getElementById("mycartSidenav").style.width = "0";
	//var ccp=$('#coupon_code').val();
	//alert(qty2);
	
	var data_array={id:id,image:image,customer_id:'1',price:price,name:name,was_price:was_price,qty:qty2,product_gst:product_gst}
	var ddd=send_ajax_return_value(send_url,data_array);
	console.log(ddd);
	var dd=jQuery.parseJSON(ddd.responseText);
	//var dd=(ddd.responseText);
	console.log(dd);
	closeNavcart();
	if(dd.res)
	{
		if(dd.action=='add')
		{
			$('.crtnmbr').html(dd.total);
			//$('#add_to_cart_'+id).hide();
			//$('#update_add_to_cart_'+id).show();
			var fff='';
			/*fff='onclick="add_to_cart('+id+','+image+','+price+','+name+','+was_price+','+qty+','+action_type+')" 
                              id="add_to_cart_'+id+'"';*/	
							  
			/*var fnc='<td '+fff+' class="action added">';
					fnc+='<a  class="check-add">';
						fnc+='<p>';
							fnc+='<i class="fa fa-check-circle fa-3x"></i>';
						fnc+='</p>';
						fnc+='<span>Added</span>';
					fnc+='</a>';
				fnc+='</td>';			
				$("#add_to_cart_td_"+id).replaceWith(fnc);*/
			var p_show=$(this).attr("show");
			if(p_show)
			{
				$("#add_to_cart_td_"+id).css("display",'none');
				$("#Added_to_cart_td_"+id).css("display",'block');
				$("#update_to_cart_td_"+id).css("display",'none');			
			}
			$("#product_"+id).attr( "show",true );
			$(".product_b_"+id).attr( "show",true );
			var fff="remove_cart_ajax('"+dd.rowid+"','"+id+"')";
			var htmldd='<tr id="product_right_small_cart_'+id+'">';
				htmldd+='<td>'+name+'</td>';
				htmldd+='<td>'+qty2+'</td>';
				htmldd+='<td>$'+(qty2*price)+'</td>';
				htmldd+='<td class="text-center"><a onclick="'+fff+'" class="class_pointer"><i class="fa fa-minus"></i></a></td>';
				htmldd+='</tr>';
				$("#table_product_right_small_cart tbody").append(htmldd);
			/*if($("#table_product_right_small_cart tbody").html()=='')
			{
				$("#table_product_right_small_cart tbody").html(htmldd);
			}
			else
			{
				$("#table_product_right_small_cart tbody").append(htmldd);
			}*/
			 
		}
		else
		{
				$("#add_to_cart_td_"+id).css("display",'none');
				$("#Added_to_cart_td_"+id).css("display",'block');
				$("#update_to_cart_td_"+id).css("display",'none');
				
				var htmldd='<td>'+name+'</td>';
					htmldd+='<td>'+qty2+'</td>';
					htmldd+='<td>$'+(price*qty2)+'</td>';
					htmldd+='<td class="text-center"><a href="#"><i class="fa fa-minus"></i></a></td>';
				$("#table_product_right_small_cart tbody #product_right_small_cart_"+id).html(htmldd);
		}
		
		show_on_cart('asd');
		
		//alert('done');
	}
	else
	{
		$('.crtnmbr').html(dd.total);
		$('#add_to_cart_'+id).show();
		$('#update_add_to_cart_'+id).hide();
		//alert('error');
	}
}

function show_on_cart(obj)
{
	var ddd=send_ajax_return_value('<?php echo base_url('cart/get_cart_details');?>',{obj:obj});
	console.log(ddd);
	var cartd= jQuery.parseJSON(ddd.responseText);	
	$("#product_right_small_cart_subtotal").html('$'+cartd.sub_total_amount);
	$("#product_right_small_cart_shipping").html(cartd.shipment_amount);
	$("#product_right_small_cart_total").html('$'+cartd.total_amount);
	$("#cart_top_big_total_price").html('$'+cartd.total_amount);
	$("#cart_top_big_total_item").html(cartd.total_item);
}

function add_to_cart_notify(id,image,price,name,was_price,qty,action_type)
{
	var msg='';
	if(action_type=='update_p')
	{
		msg=' Product Qty added Successfully in your cart.';
	}
	if(action_type=='update_m')
	{
		msg=' Product Qty  Remove Successfully in your cart.';
	}
	if(action_type=='add')
	{
		msg=' Product added Successfully in your cart.';
	}
	$.notify({
			icon: image,
			title: name,
			message: msg
		},{
			type: 'minimalist',
			delay: 5000,
			icon_type: 'image',
			template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<img data-notify="icon" class="img-circle pull-left" style="max-height:30px;max-width:30px;">' +
				'<span data-notify="title">{1}</span>' +
				'<span data-notify="message">{2}</span>' +
			'</div>'
		});
}
  /*function show (toBlock){
	setDisplay(toBlock, 'block');
  }
  function hide (toNone) {
	setDisplay(toNone, 'none');
  }*/
  function setDisplay (target, str) {
	document.getElementById(target).style.display = str;
  }
function add_left_cart_product(id,image,price,name,was_price,qty,action_type)
{
	var wwprice='';
	var data='';
	if(was_price)
	{
		wwprice=' <span class="old-price">$ '+was_price+'</span>';
	}
	 data+='<div class="row nav_cart_row" id="nav_cart_row_left_product_detail_'+id+'">';
      data+='<div class="col-sm-3"> <img src="'+image+'" class="img-responsive cartnav_product_img"> </div>';
      data+='<div class="col-sm-9">';
        data+='<div class="row">';
         data+=' <div class="col-sm-12 col-md-12">';
            data+='<p class="cartnav_product_name">'+name+'</p>';
           data+=' <!--<p>3x40 gm</p>-->';
         data+=' </div>';
         data+=' <div class="col-sm-5 col-md-5">';
          data+='  <div class="input-group input-group-sm"> ';
           data+=' <span class="input-group-btn">';
             data+=' <button type="button" class="btn btn-default btn-number booking_day_btn" disabled="disabled" data-type="minus" data-field="quant[1]"> <span class="glyphicon glyphicon-minus"></span> </button>';
             data+=' </span>';
             data+=' <input type="text" name="quant[1]" class="form-control input-number text-center quantity_txt" value="'+qty+'" min="1" max="10" readonly>';
            data+='  <span class="input-group-btn">';
            data+='  <button type="button" class="btn btn-default btn-number booking_day_btn" data-type="plus" data-field="quant[1]"> <span class="glyphicon glyphicon-plus"></span> </button>';
             data+=' </span> </div>';
         data+=' </div>';
         data+=' <div class="col-sm-3 col-md-3">';
         data+='   <p class="cartnav_price"> <span class="new-price">$ '+price+'</span>'+wwprice+' </p>';
          data+='</div>';
         data+=' <div class="col-sm-4 col-md-4">';
            data+='<p class="last_price">$ ('+(price*qty)+')</p>';
         data+=' </div>';
        data+='</div>';
     data+=' </div>';
     data+=' <div class="col-sm-12">';
       data+=' <hr class="carrtnav_hr">';
     data+=' </div>';
   data+=' </div>';
	$("#nav_cart_scroll_left_product_list").append(data);
}
</script>

<script type="text/javascript">
    ! function($, n, e) {
      var o = $();
      $.fn.dropdownHover = function(e) {
        return "ontouchstart" in document ? this : (o = o.add(this.parent()), this.each(function() {
          function t(e) {
            o.find(":focus").blur(), h.instantlyCloseOthers === !0 && o.removeClass("open"), n.clearTimeout(c), i.addClass("open"), r.trigger(a)
          }
          var r = $(this),
            i = r.parent(),
            d = {
              delay: 100,
              instantlyCloseOthers: !0
            },
            s = {
              delay: $(this).data("delay"),
              instantlyCloseOthers: $(this).data("close-others")
            },
            a = "show.bs.dropdown",
            u = "hide.bs.dropdown",
            h = $.extend(!0, {}, d, e, s),
            c;
          i.hover(function(n) {
            return i.hasClass("open") || r.is(n.target) ? void t(n) : !0
          }, function() {
            c = n.setTimeout(function() {
              i.removeClass("open"), r.trigger(u)
            }, h.delay)
          }), r.hover(function(n) {
            return i.hasClass("open") || i.is(n.target) ? void t(n) : !0
          }), i.find(".dropdown-submenu").each(function() {
            var e = $(this),
              o;
            e.hover(function() {
              n.clearTimeout(o), e.children(".dropdown-menu").show(), e.siblings().children(".dropdown-menu").hide()
            }, function() {
              var t = e.children(".dropdown-menu");
              o = n.setTimeout(function() {
                t.hide()
              }, h.delay)
            })
          })
        }))
      }, $(document).ready(function() {
        $('[data-hover="dropdown"]').dropdownHover()
      })
    }(jQuery, this);
  </script>


<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
  



<!--<script type="text/javascript">
    $(window).on('load',function(){
        $('#shopnow_popup').modal('show');
    });
</script>-->


<!--
<script>
	window.onscroll = function() {myFunction()};
	var navbar = document.getElementById("bottom_navbar");
	var sticky = navbar.offsetTop;
	function myFunction() {
	  if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	  } else {
		navbar.classList.remove("sticky");
	  }
	}
</script>-->




 <!--<script>
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
</script> -->