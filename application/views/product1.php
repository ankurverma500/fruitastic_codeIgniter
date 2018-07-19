<?php $this->load->view('top_menubar');?>

<div class="container">  	
    <form>
    	<div class="row toprowproduct">
    	<div class="col-sm-6"><h2 class="productheading">Products</h2></div>
        <div class="col-sm-3">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Search products" name="search_products" id="search_products" aria-label="Search products" onfocus="this.placeholder = ''" value="<?php echo $search_products?>" onblur="this.placeholder = 'Search products'">
              <span class="input-group-btn">
                <button class="btn btn-danger" type="submit">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                </button>
              </span>
            </div>
        </div>
        <div class="col-sm-3">
             <div class="form-group">
              <select class="form-control" id="sel1" name="popularty" onchange="this.form.submit()">
                <option>Popularty</option>
                <option>Popularty</option>
                <option>Popularty</option>
                <option>Popularty</option>
              </select>
            </div>
		</div>
      </div>
      </form>
      <form>
		<div class="row">
      <script type="text/javascript">
            // To conform clear all data in cart.
            function clear_cart() {
                var result = confirm('Are you sure want to clear all bookings?');

                if (result) {
                    window.location = "<?php echo base_url('cart/remove/all'); ?>";
                } else {
                    return false; // cancel button
                }
            }
        </script>
      <!--<input type="button" class ='fg-button teal' value="Clear Cart" onClick="clear_cart()">-->
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
      </div>
    	
    <div class="row productsection">  
    <?php 
		//print_r($result_product);
		//exit;
		//exit;
		
			 
		$i=1;   
		if( $result_product['res'] ) 
		{                 
		foreach( $result_product['rows'] as $result_products)
			{
				
			$res=get_product_final_price_by_customer_type('','',$result_products->id,$result_products);
			//print_r($res);
			//exit;
			if($res['res'])
			{
				//echo '<pre>';
				//print_r($result_products);
				//print_r($res);
				//$result_products->was_price=$res['was_price'];
				$result_products->cost_per_unit=number_format($res['price'],2);
				$show=false;
				if(in_array($result_products->id,$product_id))
				{
					$show=true;
				}
			?>
			<div class="col-sm-3" style="height: 300px;">
            	<article class="col-item ci">
            	<div class="photo">
                <div class="imagea">
        			<a href='<?php //echo base_url("product/add/".$result_products->id);?>' class="on-default view-row ">                    <?php 
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
        <?php } ?>
                    </a>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price-details col-md-6">
                                <p class="details">
                                    <?php echo $result_products->product_name;?>
                                </p>
                                <?php 
								$was_price=0;
								if($res['discount_option']){$was_price=$res['was_price']; echo '<h1>Was <strike>$ '.$res['was_price'].'</strike></h1>';}?>
                                
                                <span class="price-new">Now $ <?php echo $result_products->cost_per_unit;?></span>
                            </div>
                            <div class="col-md-6 col-sm-offset-6 product_qnty_div"  >
                              <a href="javascript:void(0)" class="btn btn-warning btn-xs bbwbx btn-block" 
                              <?php if($show){echo 'style="display:none;"';}?>
                              onclick="add_to_cart('<?php echo $result_products->id;?>','<?php echo $product_image?>','<?php echo $result_products->cost_per_unit?>','<?php echo $result_products->product_name;?>','<?php echo $was_price?>','1','add')" 
							  <?php /*?>onclick="show('comment'); hide('clickMeId')"<?php */?> 
                              id="add_to_cart_<?php echo $result_products->id;?>">
                              ADD <i class="fa fa-shopping-basket"></i>
                              </a>
                              
                              <div id="update_add_to_cart_<?php echo $result_products->id;?>" 
                              <?php if($show){echo 'style="display:block;"';}else{echo 'style="display:none;"';}?>
                              >
                                <div class="input-group input-group-sm product_input_group">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-warning btn-number product_dec_btn" data-type="minus" data-field="product_<?php echo $result_products->id;?>"   onclick="add_to_cart('<?php echo $result_products->id;?>','<?php echo $product_image?>','<?php echo $result_products->cost_per_unit?>','<?php echo $result_products->product_name;?>','<?php echo $was_price?>','-1','update_m')"  >
                                          <span class="glyphicon glyphicon-minus"></span>
                                      </button>
                                  </span>
                                  
                                  <input type="text" name="product_<?php echo $result_products->id;?>" id="product_<?php echo $result_products->id;?>" class="form-control input-number text-center product_txt" value="<?php echo $p_dtail[$result_products->id]?>" min="1" max="100" readonly>
                                  
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-warning btn-number product_inc_btn" data-type="plus" data-field="product_<?php echo $result_products->id;?>"
                                       onclick="add_to_cart('<?php echo $result_products->id;?>','<?php echo $product_image?>','<?php echo $result_products->cost_per_unit?>','<?php echo $result_products->product_name;?>','<?php echo $was_price?>','1','update_p')"  >
                                          <span class="glyphicon glyphicon-plus"></span>
                                      </button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
        	</article>
        	</div>
			<?php
			if($i==4){echo '</div><div class="row productsection">';$i=0;}
			$i++; 
			}
			}
		}
	?>
    </div>
    </form>   
</div>
<script>
function add_to_cart(id,image,price,name,was_price,qty,action_type)
{
	if(action_type=='update_p')
	{
		var send_url="<?php echo base_url('cart/update_cart');?>";	
		//$("#product_"+id).val((parseInt($("#product_"+id).val())+1));	
		var qty=1;
		var qty2=$("#product_"+id).val();
	}else if(action_type=='update_m')
	{
		var send_url="<?php echo base_url('cart/update_cart');?>";	
		//$("#product_"+id).val((parseInt($("#product_"+id).val())-1));
		var qty=-1;
		var qty2=$("#product_"+id).val();
	}
	else
	{
		var send_url="<?php echo base_url('cart/add');?>";	
		add_left_cart_product(id,image,price,name,was_price,qty,action_type);
		$("#product_"+id).val(parseInt(1));
	}
	//add_to_cart_notify(id,image,price,name,was_price,qty,action_type);
	document.getElementById("mycartSidenav").style.width = "0";
	//var ccp=$('#coupon_code').val();
	//alert(qty2);
	
	var data_array={id:id,image:image,customer_id:'1',price:price,name:name,was_price:was_price,qty:qty}
	var ddd=send_ajax_return_value(send_url,data_array);
	console.log(ddd);
	var dd=jQuery.parseJSON(ddd.responseText);
	//var dd=(ddd.responseText);
	console.log(dd);
	if(dd.res)
	{
		if(dd.action=='add')
		{
			$('.crtnmbr').html(dd.total);
			$('#add_to_cart_'+id).hide();
			$('#update_add_to_cart_'+id).show();
		}
		else
		{
		}
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
  



<script type="text/javascript">
    $(window).on('load',function(){
        $('#shopnow_popup').modal('show');
    });
</script>

  <!--<script>
	  function show (toBlock){
		setDisplay(toBlock, 'block');
	  }
	  function hide (toNone) {
		setDisplay(toNone, 'none');
	  }
	  function setDisplay (target, str) {
		document.getElementById(target).style.display = str;
	  }
  </script>-->

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
</script>




 <script>
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
</script> 