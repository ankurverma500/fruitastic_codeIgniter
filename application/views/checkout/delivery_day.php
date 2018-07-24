
<style>
.radio_box {
    border: 1px solid #eee;
    padding: 10px 10px 10px 33px!important;
    border-radius: 3px;
}
</style>
<div class="container">
  <div class=" checkout-section">
  
  	<?php $this->load->view('checkout/index2',$this->data);?>
    
    <div class="col-sm-12 col-md-8 col-lg-8 col-sx-12" style="padding: 22px;
    border: 1px solid #eee;
    padding-top: 22px;">
          <form class="form-horizontal" action="<?php echo base_url('checkout/payment');?>" method="POST">  
          <?php
		  $run_detail=$this->session->userdata('run_detail');
		  /*echo '<pre>';
		   print_r($this->session->userdata('run_detail'));
		   echo '</pre>';*/
		   ?>
            <div class="deliver_day_form">
              <div class="row delivery_day_tab_row">
                <div class="col-sm-6 col-md-4 ">
                	<div class="radio radio_box tooltips">
                  <label class="delivery_day_level" data-toggle="tooltip" data-placement="top" title="Click to choose your delivery day for this order only">
                    <input id='watch-me' class="delivery_day_radio" s_dive="show-me" <?php if($run_detail['run_type']==1){echo 'checked="checked"';}?>  name='one_time' type='radio' value="1" />
                    <span class="one_time_label_tab">One TIME</span></label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                	<div class="radio radio_box tooltips">
                  <label class="delivery_day_level" data-toggle="tooltip" data-placement="top" title="Click to set up as weekly recurring order. Please note prices fluctuate daily. Order can be stopped, paused, or altered using profile page top right of screen">
                    <input id='see-me' class="delivery_day_radio" s_dive="show-me-two" <?php if($run_detail['run_type']==2){echo 'checked="checked"';}?> name='recurring' type='radio' value="2" />
                    <span class="one_time_label_tab">WEEKLY</span></label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                	<div class="radio radio_box tooltips">
                  <label class="delivery_day_level" data-toggle="tooltip" data-placement="top" title="Click to set up as fortnightly recurring order. Order can be stopped, paused, or altered using profile page top right of screen">
                    <input id='look-me' class="delivery_day_radio"  s_dive="show-me-three" <?php if($run_detail['run_type']==3){echo 'checked="checked"';}?>  name='fortnightly' type='radio' value="3" />
                    <span class="one_time_label_tab">FORTNIGHTLY</span></label>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div id='show-me' style=' <?php if($run_detail['run_type']==1){echo ' display:block;';}else{echo 'display:none;';}?> margin-left:0px;'>
                  <?php $this->load->view('checkout/ng-one_time');?>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div id='show-me-two' style=' <?php if($run_detail['run_type']==2){echo 'display:block;';}else{echo 'display:none;';}?>'>
                    <?php 
					if($run_detail['run_type']==2){
					$this->load->view('checkout/get_run_by_zip_code_for_reccuring');
					}
					?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div id='show-me-three' style=' <?php if($run_detail['run_type']==3){echo 'display:block;';}else{echo 'display:none;';}?>'>
                     <?php 
					 if($run_detail['run_type']==3){
					 $this->load->view('checkout/get_run_by_zip_code_for_fornightly');
					 }
					 ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-top:20px;">
                  <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 control-label your_details_text_right">Delivery notes </label>
                          <div class="col-md-8 col-sm-8">
                            <input type="text"   class="form-control "   name="delivery_notes"  id="delivery_notes" value="" placeholder="Enter a Delivery notes ">
             
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-4 col-sm-4 control-label your_details_text_right">Packing notes </label>
                          <div class="col-md-8 col-sm-8">
                            <input type="text"   class="form-control"   name="packing_notes"  id="packing_notes" value="" placeholder="Enter a Packing notes">
             
                          </div>
                        </div>
                  </div>
                </div>            
            <div class="row">
                  <div class="col-sm-12 col-md-12 text-right checkout_btn_div customer-details" <?php if((!$run_detail) ||($run_detail['run_type']=='')||(count($run_detail['run'])<1) ){echo 'style="display:none;margin-top:20px;"';}?>> 
                  <input type="submit" class="your_detail_login_butn pull-right"  name="deliveryday" value="Continue Order >>">
                  <!--<a href="payment.html" class="btn btn-primary checkout-btn btn-lg" >Continue Order >></a> -->
                  </div>
                </div>        
      </form>
      <!--<p class="pull-right"><input type="button" class="btn btn-danger btn-lg checkoutbtn" value="CHECKOUT"></p>--> 
    </div>
    <div class="col-sm-4">
      <?php $this->load->view('checkout/order_summary');?>
    </div>
  </div>
</div>


<script>
$(document).ready(function () 
 { 
  /*$("#watch-me").click(function()
  {
    $("#show-me:hidden").show('slow');
   $("#show-me-two").hide();
   $("#show-me-three").hide();
   });
   $("#watch-me").click(function()
  {
    if($('#watch-me').prop('checked')===false)
   {
    $('#show-me').hide();
   }
  });
  
  $("#see-me").click(function()
  {
    $("#show-me-two:hidden").show('slow');
   $("#show-me").hide();
   $("#show-me-three").hide();
   });
   $("#see-me").click(function()
  {
    if($('#see-me-two').prop('checked')===false)
   {
    $('#show-me-two').hide();
   }
  });
  
  $("#look-me").click(function()
  {
       $("#show-me-three:hidden").show('slow');
	   $("#show-me").hide();
	   $("#show-me-two").hide();
   });
   $("#look-me").click(function()
  	{
		if($('#see-me-three').prop('checked')===false)
	   {
		$('#show-me-three').hide();
	   }
  });*/
	  $('.delivery_day_radio').on('click',function(){
		  $('.delivery_day_radio').prop('checked',false);
		  $(this).prop('checked',true);
		  var s_dive=$(this).attr('s_dive');
		  var value=$(this).val();
		  if(value!=1)
		  {
			  if(value==2)
			  {
				  var send_url="<?php echo base_url('checkout/get_run_by_zip_code_for_reccuring');?>";
				  var data_array={zip_code:'<?php echo $zip_code?>'}
					var ddd=send_ajax_return_value(send_url,data_array);
					console.log(ddd);
					//var dd=jQuery.parseJSON(ddd.responseText);
					var dd=(ddd.responseText);
					$('#show-me-three').html('');
					$('#show-me-two').html('');
					$('#show-me-two').html(dd);
			  }
			  else if(value==3)
			  {
				  var send_url="<?php echo base_url('checkout/get_run_by_zip_code_for_fornightly');?>";
				  var data_array={zip_code:'<?php echo $zip_code?>'}
					var ddd=send_ajax_return_value(send_url,data_array);
					console.log(ddd);
					//var dd=jQuery.parseJSON(ddd.responseText);
					var dd=(ddd.responseText);
					$('#show-me-two').html('');
					$('#show-me-three').html('');
					$('#show-me-three').html(dd);
			  }
		  }
		  $("#show-me").hide();
   		  $("#show-me-two").hide();
		  $('#show-me-three').hide();
		  $("#"+s_dive+":hidden").show('slow');
	  });
 });

</script> 
<script>
function send_ajax1(send_url,data_array)
{	
//alert('send_url= '+send_url+' data_array= '+data_array);
$.ajax({
		type:"POST",
		url: send_url,
		dataType:'json',
		data:data_array,
		success: function(response) 
		{			
			console.log(response);
			//alert(response);
			if(response=="success")
			{
			//location.reload();							
			}
			else
			{
			//location.reload();				   
			}							
		}				
	});	
}

</script> 
<script>

/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>