<!--<div class="order-box pnl-group-fix" id="cart-accordion2" role="tablist" aria-multiselectable="true" 
data-spy="affix" data-offset-top="360">-->

<div   class="order-box pnl-group-fix affix-top" 
data-offset-top="360" <?php /*?>data-spy="affix"<?php */?> aria-multiselectable="true" id="cart-accordion2" role="tablist"> <span class="halfcircle"> 
  <!--<i class="fa fa-align-justify"></i>--> 
  <img  src="<?php echo base_url('assets/images/536271-32.png');?>"> </span>
  <div  class="ipadview hidden-lg hidden-sx hidden-sm" style="display: block;">
    <p class="pull-left ipad_price" > <span>$<?php echo $this->cart->total();?></span> (<?php echo $this->cart->total_items();?> Products)</p>
    <a class="pull-right hoverd-btn" href="<?php echo base_url('checkout/your_detail');?>" >CHECKOUT <i  class="fa fa-mail-forward"></i> </a> </div>
  <!-- <div class="ipadview">
                <p>Your Current  Order: <span>$<?php echo $this->cart->total();?></span> ( <?php echo $this->cart->total_items();?> Products )</p>
                <a href="#" data-toggle="modal" data-target="#postcode_pop">Checkout <i class="fa fa-mail-forward"></i></a>
            </div>-->
  <div class="desktop-view">
    <h3 class="text-center">Your Order</h3>
    <table class="table">
      <tr>
        <th>Product Name</th>
        <th style="">Qty</th>
        <th>Sub Total</th>
        <th width="10"></th>
      </tr>
      <tr>
        <td colspan="4">
        <div class="cart_scroll table-responsive">
        <table class="table product_table" id="table_product_right_small_cart">
        <tbody>
		<?php 
           //$this->cart->destroy();
            //echo $this->cart->total_items();
            //echo $this->cart->total();
             $cart_check = $this->cart->contents();
             $product_id=array();
             /*echo '<pre>';
             print_r($cart_check );
             echo '</pre>';*/
             //echo count($cart_check['8f14e45fceea167a5a36dedd4bea2543']['id']['7']);
             foreach ($cart_check as $item)
             {
                 array_push($product_id,$item['id']);
                 $p_dtail[$item['id']]=$item['qty'];
                 $fff="remove_cart_ajax('".$item['rowid']."','".$item['id']."')";
                 echo ' <tr id="product_right_small_cart_'.$item['id'].'">
                            <td>'.$item['name'].'</td>
                            <td>'.$item['qty'].'</td>
                            <td>$'.number_format($item['price'],2).'</td>
                            <td class="text-center">
                            <a onclick="'.$fff.'" class="class_pointer">
                            <i class="fa fa-minus "></i></a></td>
                          </tr>';
             }					 
          ?>
        </tbody>
        </table>        
        </div>
        </td>
      </tr>
      <tr>
        <td colspan="2"><span>Item Subtotal</span></td>
        <td id="product_right_small_cart_subtotal">$<?php echo number_format($this->cart->total(),2);?></td>
        <td></td>
      </tr>
      <!--<tr>
                  <td colspan="3" class="text-center"><p class="moprice">Minimum order 40$ </p></td>
                  <td></td>
                </tr>
                -->
      <tr class="hidden-xs">
        <td colspan="2"><strong>Post Code:</strong>
          <p  ><?php echo $this->session->userdata('run_post_code').'-'.$this->session->userdata('run_post_code_location');?> <a href="#" class="fsizelink" data-toggle="modal" data-target="#shopnow_popup">(change)</a> </p></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2"><span>Your Shipping</span>
          <p>(FREE after $40)</p></td>
        <td id="product_right_small_cart_shipping"><?php if($this->cart->total()<40 &&$this->cart->total()>0){echo '$8.00';}else{echo 'Free';}?></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2"><strong>Total Price</strong></td>
        <td><span class="total" id="product_right_small_cart_total">$
          <?php if($this->cart->total()<40){echo number_format($this->cart->total()+8,2);}else{echo number_format($this->cart->total(),2);}?>
          </span></td>
        <td></td>
      </tr>
    </table>
    <div id="comment2" style="display:none; margin-right:12px; margin-top:-5px;">
      <table class="table">
        <tr>
          <td><span>Discount Amount:</span></td>
          <td class="text-right"><!--<p class="discount_total">$23.00</p>--><span>$23.00</span></td>
        </tr>
        <tr>
          <td><span class="total_saving">Total:</span></td>
          <td class="text-right"><span class="total_saving">$452.00</span></td>
        </tr>
      </table>
    </div>
    <?php /*if(!$this->session->userdata('discount')){ ?>
              <div class="col-sm-12">ENTER VOUCHER CODE IF YOU HAVE ONE.</div>
              <!--<form method="post" action="<?php echo base_url('cart/apply_coupon_code/');?>">-->              
              <div class="form-group col-sm-8" style="margin-top: 6px;">
                 <input type="text" class="form-control " id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code" value="<?php echo set_value('coupon_code')?>">
                   <?php echo form_error('coupon_code'); ?>         
              </div>
              <div class="col-sm-4">
                <a type="submit" name="coupon_code_submit" onclick="voucher_code()" value="coupon_code" class="btn btn-default newsletterbtn">APPLY CODE</a>
              </div>
              <div class="col-sm-12" id="discount_div_res_id">
               </div>
              <!--</form>-->
               <?php  }else{echo '<div style="color:green">Your Coupon code applied successfully</div>';} ?>
               <script>
			  function voucher_code()
			  {	
					var code=$("#coupon_code").val();
					var tt=parseFloat($("#total_price_cart_run").val());
					if(code=='')
					{
						$('#discount_div_res_id').css('color','red');
						$('#discount_div_res_id').html('Please Fill the voucher code')
						return false;
					}
					var send_url="<?php echo base_url("cart/apply_coupon_code");?>";	
					var data_array={coupon_code:code,total_price_cart_run:tt}
					//alert(send_url);
					var data1=send_ajax_return_value(send_url,data_array);	
					//console.log(data1);
					//alert(data1);	
					console.log(data1.responseJSON);
					if(data1.responseJSON.res)
					{	
						///*var discount_pv=parseFloat(data1.responseJSON.discount_array.discount_pv);
//						var order_summary_total_price=parseFloat($("#order_summary_total_price").attr('total_price'));
//						var s_charge=parseFloat($("#order_summary_total_price").attr('s_charge'));
//						
//						if(data1.responseJSON.discount_array.discount_type=='1')
//						{
//							var dd=discount_pv;
//							order_summary_total_price=order_summary_total_price+s_charge;
//							$("#order_summary_total_price").html('$'+(order_summary_total_price-dd).toFixed(2));
//						}
//						else if(data1.responseJSON.discount_array.discount_type=='2')
//						{
//							var dd=((discount_pv/100)*order_summary_total_price);
//							order_summary_total_price=order_summary_total_price+s_charge;
//							//alert('discount_pv '+discount_pv);
//							//alert('order_summary_total_price '+order_summary_total_price);					
//							$("#order_summary_total_price").html('$'+(order_summary_total_price-dd).toFixed(2));
//						}
//						else
//						{
//							alert('please contact for admin');
//						}
//						$('#discount_div_id').css('color','green');
//						$('#discount_div_id').html(data1.responseJSON.error);
						location.reload();
					}
					else
					{
						$('#discount_div_res_id').css('color','red');
						$('#discount_div_res_id').html(data1.responseJSON.error)
						//$('.checkout_btn_div').css('display','block');
					}
					
			   }
			  </script>
             <div class="coupon_code"  id="clickMeId2">
                <p class="text-center">ENTER VOUCHER CODE <!--<a href="#">APPLY HERE</a>--></p>
                <form >
                  <input type="text" class="form-control text-center"  value="Code 7682" onClick="if(this.value=='Code 7682'){this.value=''}" onBlur="if(this.value==''){this.value='Code 7682'}">
                  <!--<input type="submit" onClick="show('comment2'); hide('clickMeId2')" class="" value="APPLY CODE" >-->
                  <a href="javascript:void(0)" onClick="show('comment2'); hide('clickMeId2')" class="apply_code_button">APPLY CODE</a>
                </form>
                </div>
                <?php */?>
    <div class="text-center"> 
      <!-- <a href="#" class="checkout-btn hoverd-btn keepshop"><i class="fa fa-mail-reply"></i> Keep Shoping</a>--> 
      <a href="<?php echo base_url('checkout/your_detail')?>" class="checkout-btn hoverd-btn">CHECKOUT <i class="fa fa-mail-forward"></i></a> </div>
  </div>
</div>
