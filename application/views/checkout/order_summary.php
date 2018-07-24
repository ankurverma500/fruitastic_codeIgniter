<style>

</style>

<div class="  table-responsive innnerbdr obox-2 order-box ">
        <h2 class="yourorder clrwhite text-center" >Order Summary</h2>
        <div class="cart_scroll1" <?php /*?>style="    height: 250px;   overflow: scroll;"<?php */?>>
       <table class="table">
                <tr>
                  <th>Product Name</th>
                  <th  style="text-align:right;">Qty</th>
                  <th>Sub Total</th>
                  <th width="10"></th>
                </tr>
               
               <tr>
                <td colspan="4">
                 <div class="cart_scroll table-responsive">
                  <table class="table product_table" id="table_product_right_small_cart">
                  <tbody>
            <?php
			$total_price=0;
			$cart_check = $this->cart->contents();
			$this->data['product_id']=array();
			$this->data['total_price_cart']=0;
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
							</td>
						  </tr>';//<a onclick="'.$fff.'" class="class_pointer"><i class="fa fa-minus "></i></a>
				 //array_push($this->data['product_id'],$item['id']);	
				 //$this->data['total_price_cart']=($this->data['total_price_cart']+$item['price']);		
			 
		  /*?>
            <tr>
              <td class="fsize"><?php echo $item['name'];?></td>
              <td class="fsize"><?php echo $item['qty'];?></td>
              <td class="fsize">$<?php echo ($item['price']*$item['qty']);?></td>
            </tr>
            <?php */
			$total_price=$total_price+($item['price']*$item['qty']);
			}			
			?>
             </tbody>
                  </table>
            	</div>
            	</td>
              </tr>
         </table>
             <table class="table">
             <tbody>
            <tr>
              <td colspan="2" class="clrwhite">Your Shipping</td>
              <td class="clrwhite">
			  <?php $s_charge=0; if($total_price>40){echo 'Free';}else{ echo '$8';$s_charge=8;}?></td>
            </tr>
            
            <!--<tr>
                <td colspan="3" class="tdbdrnine clrwhite">Post code</td>
              </tr>
              <tr>
                <td colspan="3" class="tdbdrnine clrwhite"><?php echo $this->session->userdata('run_post_code').'-'.$this->session->userdata('run_post_code_location');?> 
                <a href="#" class="fsizelink" data-toggle="modal" data-target="#shopnow_popup">(change)</a>
                </td>
              </tr>-->
              
              <?php 
			$ddiscount=0;
			if($this->session->userdata('discount'))
			{
				$discount_session=$this->session->userdata('discount');
				//print_r($discount_session);
				if(intval($discount_session['minimum_order']) > intval(floatval($total_price)))
				{
					echo '<tr>
							  <td class="clrwhite">Discount Value</td>
							  <td colspan="2"  class="clrwhite" style="color:red;font-size: 10px;">Amount is much greater than $'.$discount_session['minimum_order'].'</td>
						 </tr>';
					
				}
				else
				{
					if($discount_session['discount_type']==1)
					{
						$dd=number_format($discount_session['discount_pv'],2);
						$total_price=$total_price-$dd;
					}
					else
					if($discount_session['discount_type']==2)
					{
						$dd=number_format(($total_price/100)*$discount_session['discount_pv'],2);
						$total_price=$total_price-$dd;
					}
					else
					{
						
					}
					echo '<tr>
							  <td colspan="2" class="clrwhite">Discount Value</td>
							  <td class="clrwhite" >'.$dd.'</td>
						 </tr>';
				}
			}
			?>
            <tr>
              <td colspan="2"><strong class="clrwhite">TOTAL PRICE</strong></td>
              <td><strong class="clrwhite" id="order_summary_total_price" s_charge="<?php echo $s_charge;?>" total_price="<?php echo $total_price;?>">$<?php echo ($total_price+$s_charge)?></strong>
              </td>
            </tr>
          </tbody>
        </table>
        
        <div class="row">
          <div class="col-sm-12" id="discount_div_id">
          <?php if(!$this->session->userdata('discount')){ ?>
           <?php		   
		  /*$parm = array('class' => 'form-horizontal', 'id' => 'validateSubmitForm','method'=>'post','autocomplete'=>"off",'onSubmit'=>'return validate_this_form()');
			echo form_open_multipart(base_url("cart/voucher_code/$row->id"), $parm);*/
          ?>
            <p class="evciyhheading">ENTER VOUCHER CODE IF YOU HAVE ONE. APPLY HERE</p>
            <div class="input-group1 input-group-sm">
              <input type="text" class="form-control  vocher_code_text" placeholder="enter voucher code" aria-label="enter voucher code" id="voucher_code" name="voucher_code">
              <span class="input-group-btn">
              <input type="submit" class="btn btn-default boucher_code_button" onclick="voucher_code()" value="Apply Code">
              </span> 
             </div>
             <div class="col-sm-12" id="discount_div_res_id">
             </div>
             <!--</form>-->
             <?php  }else{echo '<div style="color:green">Your Coupon code applied successfully</div>';}?>
          </div>
        </div>
      </div>
      <script>
      function voucher_code()
	  {	
	  		var code=$("#voucher_code").val();
			var tt=parseFloat($("#order_summary_total_price").attr('total_price'));
			if(code=='')
			{
				$('#discount_div_res_id').css('color','red');
				$('#discount_div_res_id').html('Please Fill the voucher code')
				return false;
			}
		    var send_url="<?php echo base_url("cart/voucher_code");?>";	
			var data_array={voucher_code:code,total_price:tt}
			//alert(send_url);
			var data1=send_ajax_return_value(send_url,data_array);	
			//console.log(data1);
			//alert(data1);	
			console.log(data1.responseJSON);
			if(data1.responseJSON.res)
			{	
				var discount_pv=parseFloat(data1.responseJSON.discount_array.discount_pv);
				var order_summary_total_price=parseFloat($("#order_summary_total_price").attr('total_price'));
				var s_charge=parseFloat($("#order_summary_total_price").attr('s_charge'));
				
				if(data1.responseJSON.discount_array.discount_type=='1')
				{
					var dd=discount_pv;
					order_summary_total_price=order_summary_total_price+s_charge;
					$("#order_summary_total_price").html('$'+(order_summary_total_price-dd).toFixed(2));
				}
				else if(data1.responseJSON.discount_array.discount_type=='2')
				{
					var dd=((discount_pv/100)*order_summary_total_price);
					order_summary_total_price=order_summary_total_price+s_charge;
					//alert('discount_pv '+discount_pv);
					//alert('order_summary_total_price '+order_summary_total_price);					
					$("#order_summary_total_price").html('$'+(order_summary_total_price-dd).toFixed(2));
				}
				else
				{
					alert('please contact for admin');
				}
				$('#discount_div_id').css('color','green');
				$('#discount_div_id').html(data1.responseJSON.error)
			}
			else
			{
				$('#discount_div_res_id').css('color','red');
				$('#discount_div_res_id').html(data1.responseJSON.error)
				//$('.checkout_btn_div').css('display','block');
			}
	   }
      </script>
      <!--<div class="row cart-bg">
          <div class="col-sm-10 col-sm-offset-1">
           <p class="evciyhheading">ENTER VOUCHER CODE IF YOU HAVE ONE. APPLY HERE</p>
           <div class="input-group evciyh">
              <input type="text" class="form-control evciyhtxt">
              <span class="input-group-btn">
                <a href="#" class="btn btn-secondary bbs" type="button"><strong>APPLY CODE</strong></a>
              </span>

            </div>
          </div>
          </div>--> 