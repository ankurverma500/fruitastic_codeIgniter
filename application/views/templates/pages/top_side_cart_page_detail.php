<div> 
     <a href="javascript:void(0)" class="closebtncart" onClick="closeNavcart()">
         Your Order 
         <span class="pull-right">×</span>
     </a>
  <div class="row sidenav_header">
    <div class="col-sm-6">
      <h5 class="carrtnav_h">Sub Total</h5>
    </div>
    <div class="col-sm-6">
      <h5 class="text-right carrtnav_h" id="sub_total_price_left_cart" price="<?php echo $total_price_cart?>">$ <?php echo $total_price_cart?></h5>
    </div>
    <div class="col-sm-6">
      <h5 class="carrtnav_h">Delivery Charges</h5>
    </div>
    <div class="col-sm-6">
      <h5 class="text-right text-success carrtnav_h" id="delivery_charges_left_cart">
	  <?php $dl_charge=0; if($total_price_cart>=40){echo 'Free';}else{$dl_charge='8.00';echo '$ 8.00';}?>
      </h5>
    </div>
    <div class="col-sm-12">
      <hr class="carrtnav_hr">
    </div>
    <div class="col-sm-6">
      <h5 class="carrtnav_h">Your total savings</h5>
    </div>
    <div class="col-sm-6">
      <h5 class="text-right text-danger carrtnav_h" 
      id="total_price_left_cart" 
      delivery_charges="<?php echo $dl_charge;?>"  
      total_price="<?php echo number_format(($dl_charge+$total_price_cart),2)?>" >
	  <?php echo '$ '.number_format(($dl_charge+$total_price_cart),2)?><!--$96 (8.67%)--></h5>
    </div>
    <div class="col-sm-12">
      <hr class="hr_bold">
    </div>
  </div>
  <div class="nav_cart_scroll" id="nav_cart_scroll_left_product_list">
  
  <?php
  	$cart_check = $this->cart->contents();
	$this->data['product_id']=array();
	$this->data['total_price_cart']=0;
	foreach ($cart_check as $item)
	 {
		 //array_push($this->data['product_id'],$item['id']);	
		 //$this->data['total_price_cart']=($this->data['total_price_cart']+$item['price']);		
	 
  ?>
    <div class="row nav_cart_row" id="nav_cart_row_left_product_detail_<?php echo $item['id'];?>">
      <div class="col-sm-3"> <img src="<?php echo $item['image'];?>" class="img-responsive cartnav_product_img"> </div>
      <div class="col-sm-9">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <p class="cartnav_product_name"><?php echo $item['name'];?></p>
            <!--<p>3x40 gm</p>-->
          </div>
          <div class="col-sm-5 col-md-5">
            <div class="input-group input-group-sm"> 
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number booking_day_btn"  data-type="minus" data-field="quant_<?php echo $item['id'];?>" 
             onclick="add_to_cart_left('<?php echo $item['id'];?>','<?php echo $item['image']?>','<?php echo $item['price']?>','<?php echo $item['name'];?>','<?php echo $item['was_price']?>','-1','update_m')"  
              > <span class="glyphicon glyphicon-minus"></span> </button>
              </span>
              <input type="text" name="quant_<?php echo $item['id'];?>" id="quant_<?php echo $item['id'];?>" class="form-control input-number text-center quantity_txt" value="<?php echo $item['qty'];?>" min="1" max="10" readonly>
              <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number booking_day_btn" data-type="plus" data-field="quant_<?php echo $item['id'];?>"
             onclick="add_to_cart_left('<?php echo $item['id'];?>','<?php echo $item['image']?>','<?php echo $item['price']?>','<?php echo $item['name'];?>','<?php echo $item['was_price']?>','1','update_p')" 
              > <span class="glyphicon glyphicon-plus"></span> </button>
              </span> </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <p class="cartnav_price"><span class="new-price">$<?php echo $item['price'];?></span><span class="old-price"><?php if($item['was_price']){?>$<?php echo $item['was_price']?><?php }?></span></p>
          </div>
          <div class="col-sm-4 col-md-4">
            <p class="last_price" id="last_price_left_<?php echo $item['id'];?>">$<?php echo ($item['price']*$item['qty']);?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <hr class="carrtnav_hr">
      </div>
    </div>
  <?php }?>
  
  
  </div>
  <div class="fix_bottom_cart">
    <hr class="hr_bold_footer">
    <div class="row sidenav_row">
      <div class="col-sm-12 col-md-12"> <a href="<?php echo base_url('checkout/your_detail');?>" class="btn btn-primary btn-block right_cart_btn" onClick="closecartNav()">Proceed to Checkout</a> </div>
    </div>
  </div>
</div>

<script>
function add_to_cart_left(id,image,price,name,was_price,qty,action_type)
{
	//sub_total_price_left_cart   delivery_charges_left_cart (total_price_left_cart  delivery_charges total_price)
	if(action_type=='update_p')
	{
		//total_cost=total_cost.toFixed(2);
		var kkk=parseFloat($("#quant_"+id).val())+1;
		$("#quant_"+id).val(kkk);
		$("#product_"+id).val(kkk);
		var ll_price=(kkk*price).toFixed(2);
		$("#last_price_left_"+id).html('$ '+(ll_price));
		var tttt=(parseFloat($("#sub_total_price_left_cart").attr('price'))+parseFloat(price));
		$("#sub_total_price_left_cart").attr('price',tttt.toFixed(2));
		$("#sub_total_price_left_cart").html('$ '+tttt.toFixed(2));
		var delivery_charges=parseFloat($("#total_price_left_cart").attr('delivery_charges'));
		var total_price=parseFloat($("#total_price_left_cart").attr('total_price'));
		if(tttt>=40)
		{
			$("#delivery_charges_left_cart").html('Free');			
			$("#total_price_left_cart").attr('delivery_charges',0);
			$("#total_price_left_cart").attr('total_price');
			$("#total_price_left_cart").html('$ '+(tttt.toFixed(2)));
		}
		else
		{
			var ftt=(tttt+delivery_charges);
			$("#delivery_charges_left_cart").html('$ '+delivery_charges);			
			$("#total_price_left_cart").attr('delivery_charges',delivery_charges);
			$("#total_price_left_cart").html('$ '+ftt.toFixed(2));
		}
		//alert(delivery_charges);
		//alert(tttt);
		var qty=1;
	}
	else if(action_type=='update_m')
	{
		if($("#quant_"+id).val()==1)
		{
			/*$.notify({
					icon: 'fa fa-shopping-cart',
					title: "<strong>Product qty</strong>",
					message:"minimmum qty 1",
					type: "danger",
					target: '_blank'
					},{
					delay: 5000,
					animate: {
						enter: 'animated fadeInRight',
						exit: 'animated fadeOutRight'
					}
			});*/
			//return false;
			
		}
		var kkk=parseFloat($("#quant_"+id).val())-1;
		$("#quant_"+id).val(kkk);
		$("#product_"+id).val(kkk);
		var ll_price=(kkk*price).toFixed(2);
		$("#last_price_left_"+id).html('$ '+ll_price);
		var tttt=(parseFloat($("#sub_total_price_left_cart").attr('price'))-parseFloat(price));
		$("#sub_total_price_left_cart").attr('price',tttt.toFixed(2));
		$("#sub_total_price_left_cart").html('$ '+tttt.toFixed(2));
		var delivery_charges=parseFloat($("#total_price_left_cart").attr('delivery_charges'));
		var total_price=parseFloat($("#total_price_left_cart").attr('total_price'));
		if(tttt>=40)
		{
			$("#delivery_charges_left_cart").html('Free');			
			$("#total_price_left_cart").attr('delivery_charges',0);
			$("#total_price_left_cart").attr('total_price');
			$("#total_price_left_cart").html('$ '+(tttt.toFixed(2)));
		}
		else
		{
			var ftt=(tttt+8);
			$("#delivery_charges_left_cart").html('$ 8.00');			
			$("#total_price_left_cart").attr('delivery_charges','8.00');
			$("#total_price_left_cart").html('$ '+ftt.toFixed(2));
		}
		//alert(delivery_charges);
		//alert(tttt);
		var qty=-1;
		//$("#product_"+id).val();
	}
	else
	{
		add_left_cart_product(id,image,price,name,was_price,qty,action_type);
		$("#product_"+id).val(parseInt(1));
	}
	//alert($("#sub_total_price_left_cart").html());
	
	//document.getElementById("mycartSidenav").style.width = "0";
	//var ccp=$('#coupon_code').val();
	//alert(qty);
	var send_url="<?php echo base_url('cart/update_cart');?>";	
	var data_array={id:id,image:image,customer_id:'1',price:price,name:name,was_price:was_price,qty:qty}
	var ddd=send_ajax_return_value2(send_url,data_array);
	console.log(ddd);
	var dd=jQuery.parseJSON(ddd.responseText);
	//var dd=(ddd.responseText);
	console.log(dd);
	if(dd.res)
	{		
		//alert('done');
	}
	else
	{
		$("#nav_cart_row_left_product_detail_"+id).remove();
		$('.crtnmbr').html(dd.total);
		$('#add_to_cart_'+id).show();
		$('#update_add_to_cart_'+id).hide();
		//alert('error');
	}
}
function send_ajax_return_value2(send_url,data_array)
{	
//alert('send_url= '+send_url+' data_array= '+data_array);
return $.ajax({
				async: false,
				type:"POST",
				url: send_url,
				//Content-Type: 'application/x-www-form-urlencoded',
				dataType:'json',
				//data:encodeURIComponent(data_array),
				data:data_array,
				success: function(response) 
				{	
					//console.log(response);
					//alert(response);
					/*if(response=="success")
					{
					//location.reload();							
					}
					else
					{
					//location.reload();				   
					}	*/						
				}				
		});	
}
</script>