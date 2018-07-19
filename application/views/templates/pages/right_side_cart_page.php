
<a href="javascript:void(0)" class="closebtn sidenav_a text-center" onClick="closeNavcart()">Your Order <span class="pull-right">&times;</span></a>
  <div class="row sidenav_header">
    <div class="col-sm-6 col-md-6">
      <p><strong>Product Name</strong></p>
    </div>
    <div class="col-sm-2 col-md-2">
      <p><strong>Qty</strong></p>
    </div>
    <div class="col-sm-4 col-md-4">
      <p class="text-center"><strong>Sub Total</strong></p>
    </div>
  </div>
  <hr class="cart_hr_bold">
  <div class="row nav_cart_scroll">
    <div class="col-sm-12 col-md-12">
     <?php 
	   //$this->cart->destroy();
		//echo $this->cart->total_items();
		//echo $this->cart->total();
		 $cart_check = $this->cart->contents();
		 $product_id=array();
		// echo '<pre>';
		// print_r($cart_check );
		 //echo count($cart_check['8f14e45fceea167a5a36dedd4bea2543']['id']['7']);
		 foreach ($cart_check as $item)
		 {
			 array_push($product_id,$item['id']);
			 $p_dtail[$item['id']]=$item['qty'];
			  $fff="remove_cart_ajax('".$item['rowid']."','".$item['id']."')";
			 echo '<div class="row" id="table_cart_top_big_product_'.$item['id'].'">
					<div class="col-sm-6 col-md-6">
					  <p>'.$item['name'].'</p>
					</div>
					<div class="col-sm-2 col-md-2">
					  <p class="text-center">'.$item['qty'].'</p>
					</div>
					<div class="col-sm-4 col-md-4">
					  <p class="text-right">$'.number_format($item['price'],2).' 
					  <a onclick="'.$fff.'"><i class="fa fa-minus sidenav_i"></i></a>
					  </p>
					</div>
				  </div>';			
		 }					 
	  ?>
      
     <!-- <div class="row">
        <div class="col-sm-6 col-md-6">
          <p>Organic pineapple</p>
        </div>
        <div class="col-sm-2 col-md-2">
          <p class="text-center">20</p>
        </div>
        <div class="col-sm-4 col-md-4">
          <p class="text-right">$250.00 <a href="#"><i class="fa fa-minus sidenav_i"></i></a></p>
        </div>
      </div>-->     
    </div>
  </div>
  
  <!--<hr class="cart_hr" />
                         <hr class="cart_hr" />-->
  
  <div class="fix_bottom_cart">
  <div class="row sidenav_row">
      <div class="col-sm-8 col-md-8">
        <p><strong>Item Subtotal</strong></p>
      </div>
      <div class="col-sm-4 col-md-4">
        <p class="text-right">$<?php echo number_format($this->cart->total(),2);?></p>
      </div>
    </div>
    
    <!-- <hr class="cart_hr_counter" />-->
    
    
    
    <div class="row sidenav_row">
      <div class="col-sm-8 col-md-8">
        <p><strong>Your Shipping:</strong></p>
      </div>
      <div class="col-sm-4 col-md-4">
        <p class="text-right"><?php if($this->cart->total()<40 &&$this->cart->total()>0){echo '$8.00';}else{echo 'Free';}?></p>
      </div>
    </div>
    <div class="row sidenav_row">
      <div class="col-sm-8 col-md-8">
        <p><strong>SubTotal:</strong></p>
      </div>
      <div class="col-sm-4 col-md-4">
        <p class="text-right"><strong>$<?php echo number_format($this->cart->total(),2);?></strong></p>
      </div>
    </div>
    <div id="comment" style="display:none;">
      <div class="row sidenav_row">
        <div class="col-sm-8 col-md-8">
          <p><strong>Discount Amount:</strong></p>
        </div>
        <div class="col-sm-4 col-md-4">
          <p class="text-right"><strong>$23.00</strong></p>
        </div>
      </div>
      <div class="row sidenav_row">
        <div class="col-sm-8 col-md-8">
          <h4 class="total_saving"><strong>Total:</strong></h4>
        </div>
        <div class="col-sm-4 col-md-4">
          <h4 class="text-right total_saving"><strong>$<?php if($this->cart->total()<40){echo number_format($this->cart->total()+8,2);}else{echo number_format($this->cart->total(),2);}?></strong></h4>
        </div>
      </div>
    </div>
    <?php /*?><div class="row sidenav_row"  id="clickMeId">
      <div class="col-sm-12 col-md-12">
        <p class="text-center sidenav_code_p"><small>ENTER VOUCHER CODE <!--<a href="#" onClick="show('comment'); hide('clickMeId')">APPLY HERE</a>--></small></p>
        
        <!-- <img id="clickMeId" onclick="show('comment'); hide('clickMeId')" alt="click me">-->
        
        <form>
          <div class="input-group input-sm"> 
            <!--<input type="text" class="form-control code_text_box" placeholder="Code 7682">-->
            <input type="text" class="form-control code_text_box" value="Code 7682" onClick="if(this.value=='Code 7682'){this.value=''}" onBlur="if(this.value==''){this.value='Code 7682'}">
            <span class="input-group-btn"> <a href="#" onClick="show('comment'); hide('clickMeId')" class="btn btn-secondary sidenav_code_btn">Apply Code</a> </span> </div>
        </form>
      </div>
    </div><?php */?>
    <hr />
    <div class="row sidenav_row">
      <div class="col-sm-12 col-md-12"> <a href="<?php echo base_url('checkout/your_detail')?>" class="start_shopping shop_btn hoverd-btn sidenav_a btn-block" onClick="closeNav()">CHECKOUT <i class="fa fa-mail-forward"></i> <span class="pull-right"></span></a> </div>
    </div>
  </div>

<script>

function remove_cart_ajax(rowid,tr_id)
{
	
	var ddd=send_ajax_return_value('<?php echo base_url('cart/remove_cart_ajax/');?>'+rowid,{rowid:rowid});
	console.log(ddd);
	var dd=jQuery.parseJSON(ddd.responseText);
	if(dd.res)
	{
		$("#product_right_small_cart_"+tr_id).remove();
		$("#table_cart_top_big_product_"+tr_id).remove();
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
	closeNavcart();
}
function closeNavcart() 
{
    document.getElementById("mySidenav").style.width = "0%";
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
</script>