
<div class="container ">
  <div class="col-sm-12 checkout-section">
    
      
      <?php $this->load->view('checkout/index2',$this->data);?>
      
     <div class="col-sm-8 customer-details"> 
      	<div class="row">
        
        <div class="col-sm-12 col-md-12">
		<?php if(!$this->session->userdata('admin_login'))
            {?>
          <div class="login-panel panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Your Details</h3>
              
            </div>
            <div class="panel-body">
              <form class="form-horizontal" name="login" id="login" autocomplete="off" action="<?php echo base_url('checkout/your_detail');?>" method="POST">
              <input type="hidden" name="from_url" value="<?php echo $con.'/'.$method;?>" >
                <fieldset>
                <div class="col-sm-12 col-md-12">
                  <div class=" col-sm-6 col-md-6 form-group">
                    <!--<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>-->
                     <input class="form-control" name="username" type="text" placeholder="Username" autocomplete="off">
                    <?php echo form_error('username1'); ?>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class=" col-sm-6 col-md-6 form-group">
                    <!--<input class="form-control" placeholder="Password" name="password" type="password" value="">-->
                    <input class="form-control" name="password" type="password" placeholder="Password" autocomplete="off">
                <?php echo form_error('password'); ?>
                  </div>
                
                  <!--<div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>-->
                    <div class=" col-sm-6 col-md-6 form-group">
                    <span  class="hoverd-btn span_your_detail_login_butn pull-right">
                      <input  class="pull-right your_detail_login_butn" type="submit" name="loginForm" value="Login">
                      </span>
                      <!--<input type="submit" class="btn btn-default checkout-btn pull-right"  name="loginForm" value="Login">-->
                      </div>
                 </div>
                </fieldset>
              </form>
            </div>
          </div>
          <?php }?>
          <?php
		  $desable_input_text='';
		  if(isset($row->id)){$desable_input_text='readonly="readonly"';}
		  $parm = array('class' => 'form-horizontal', 'id' => 'sinupSubmitForm','method'=>'post','autocomplete'=>"off",'onSubmit'=>'return validate_this_form()');
			echo form_open_multipart(base_url("checkout/your_detail/$row->id"), $parm);
          ?>
          <!--<form class="form-horizontal" onSubmit="return validate_this_form()">-->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">New Customer</h3>
              </div>
              <div class="panel-body">
                
                
                <div class="form-group">
                
                  <label class="col-md-3 col-sm-3 control-label">Customer Type <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                     <select  class="form-control required " id="customer_type" name="customer_type" onchange="showhide_bussiness_name_div(this)">
                        <option  value="" >Select Customer Type</option>
                        <option <?php if($row->customer_type_id==1){echo 'selected="selected"';}?>  value="1" >Residential</option>
                        <option <?php if($row->customer_type_id==2){echo 'selected="selected"';}?> value="2" >School</option>
                        <option <?php if($row->customer_type_id==3){echo 'selected="selected"';}?> value="3" >Child Care</option>
                        <option <?php if($row->customer_type_id==4){echo 'selected="selected"';}?> value="4" >Corporate</option>
                      </select>
      				<?php echo form_error('customer_type'); ?>
                  </div> 
                  <div class="" id="bussiness_name_div" <?php if(isset($row) && $row->customer_type_id>1){echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                   	  <label class="col-md-3 col-sm-3 control-label">Bussiness  Name</label>
                      <div class="col-md-3 col-sm-3">
                         <input type="text" class="form-control" name="bussiness_name" id="bussiness_name" value="<?php echo set_value('bussiness_name', isset($row->primary_contact_name) ? $row->primary_contact_name : '')?>" placeholder="Bussiness  Name" autocomplete="off"  />
                        <?php echo form_error('customer_type'); ?>
                  </div> 
                  </div>          
                </div>
                
                
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label">First Name <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                     <input type="text"  class="form-control" required="required"  name="name"  id="name" value="<?php echo set_value('name', isset($row->name) ? $row->name : '')?>" placeholder="First Name" autocomplete="off" >
      <?php echo form_error('name'); ?>
                  </div>
                  <label class="col-md-3 col-sm-3 control-label your_details_text_right">Last Name <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                     <input type="text"  class="form-control" required="required"  name="last_name"  id="last_name" value="<?php echo set_value('last_name', isset($row->last_name) ? $row->last_name : '')?>" placeholder="Last Name" autocomplete="off">
					 <?php echo form_error('last_name'); ?>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label">Phone Number <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text"  required="required" class="form-control "   name="contact"  id="contact" value="<?php echo set_value('contact', isset($row->contact) ? $row->contact : '')?>" placeholder="Mobile Number " autocomplete="off">
      <?php echo form_error('contact'); ?>
                  </div>
                  <label class="col-md-3 col-sm-3 control-label your_details_text_right">Email <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" <?php echo $desable_input_text;?>  class="form-control" required="required"  name="username"  id="email" value="<?php echo set_value('username', isset($row->email) ? $row->email : '')?>" placeholder="Enter a Email" autocomplete="off">
      <?php echo form_error('username'); ?>
                  </div>
                </div>
                <?php if(!isset($row->id)){?>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label">New Password <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                    <input type="password"   class="form-control"   name="password" id="password" value="<?php echo set_value('password', isset($row->password) ? $row->password : '')?>" placeholder="New Password" autocomplete="off">
                    <?php echo form_error('password'); ?>
                  </div>
                  <label class="col-md-3 col-sm-3 control-label your_details_text_right">Confirm Password <span class="text-danger">*</span></label>
                  <div class="col-md-3 col-sm-3">
                    <input type="password"   class="form-control"   name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password', isset($row->password) ? $row->password : '')?>" placeholder="Confirm Password" autocomplete="off">
                    <?php echo form_error('confirm_password'); ?>
                  </div>
                </div>
                <?php }?>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label">Delivery Address <span class="text-danger">*</span></label>
                  <div class="col-md-9 col-sm-9">
                    <!--<textarea class="form-control" rows="1" id="address1"></textarea>-->
                    <input class="form-control" type="text" name="delivery_address_street_address" 
	value="<?php echo set_value('delivery_address_street_address', isset($customer->delivery_address_street_address) ? $customer->delivery_address_street_address : '')?>" id="delivery_address_street_address" placeholder="Enter a Delivery street address"  size="50"  autocomplete="off">
                    <?php echo form_error('delivery_address_street_address'); ?>
                   
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label">Apartment/Unit </label>
                  <div class="col-md-9 col-sm-9">
                    <!--<textarea class="form-control" rows="1" id="apartment1"></textarea>-->
                     <input class="form-control" type="text" name="delivery_address_Apartment" id="delivery_address_Apartment" value="<?php echo set_value('delivery_address_Apartment', isset($customer->delivery_address_Apartment) ? $customer->delivery_address_Apartment : '')?>" autocomplete="off">
                    <?php echo form_error('delivery_address_Apartment'); 
					
					?>
                  </div>
                </div>
                <div class="form-group">
                  <label class=" control-label col-md-6 col-sm-6">Billing Address is same as Delivery Address: </label>
                  <div class="col-md-6 col-sm-6">
                    <label class="radio-inline" >
                      <input  type="radio" <?php  if(isset($row->id)){if($customer->same_as_billing_adddress){echo ' checked ';}}else{echo ' checked ';} if(isset($_POST['deliveryaddress']) && $_POST['deliveryaddress']==1){echo ' checked ';}?>  id="chkYes" value="1" name="deliveryaddress" />
                      Yes</label>
                    <label class="radio-inline">
                      <input type="radio" id="chkNo"  <?php  if(isset($row->id)){if(!$customer->same_as_billing_adddress){echo ' checked ';}} if(isset($_POST['deliveryaddress']) && $_POST['deliveryaddress']==0){echo ' checked';}?>  value="0" name="deliveryaddress" />
                      No</label>
                  </div>
                </div>
                <div id="dvAddress" style=" <?php  if(isset($row->id)){if($customer->same_as_billing_adddress){echo 'display: none;';}else{echo 'display: block;';}}else{echo 'display: none;';} if(isset($_POST['deliveryaddress']) && $_POST['deliveryaddress']==0){echo 'display: block;';}?>">
                  <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Billing Address </label>
                    <div class="col-md-9 col-sm-9">
                      <!--<textarea class="form-control" rows="1" id="address2" >
                      </textarea>-->
                       <input class="form-control"  type="text" name="billing_address" value="<?php echo set_value('billing_address', isset($customer->billing_address) ? $customer->billing_address : '');?>" id="billing_address" placeholder="Enter a Address"  size="50"  autocomplete="on">
                       <?php echo form_error('billing_address'); ?>
                       
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Apartment/Unit</label>
                    <div class="col-md-9 col-sm-9">
                      <!--<textarea class="form-control" rows="1" id="apartment2"></textarea>-->
                     <input class="form-control"  type="text" name="billing_apartment_no" id="billing_apartment_no" value="<?php echo set_value('billing_apartment_no', isset($customer->billing_apartment_no) ? $customer->billing_apartment_no : '');?>"  placeholder="Billing Apartment No"  size="50"  autocomplete="off">
      <?php echo form_error('billing_apartment_no'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                	<?php /*if($this->session->userdata('error_post_code')!='')
					{
						?>
                        <h4 style="color:red;">Deliveries to this area not available.
 <a onclick='$("#order_popup").modal("show");'>Please check serviceable areas here</a> and update delivery address.</h4>
		 
                        <?php 
					}*/?>
                    <div class="form-group">
                    
                      <div class="col-md-4 col-sm-4 col-sm-offset-8">
                       <span class="hoverd-btn span_your_detail_login_butn pull-right">
                       <input  type="submit"  name="save" value="Continue Order >" class="btn btn-block your_detail_login_butn">
                        </span>
                      </div>
                    </div>
              	<!--	<input type="submit" name="save"  class="btn btn-default checkout-btn pull-right " value="Continue"/>
                <a href="delivery-day.html" class="btn btn-primary checkout-btn pull-right btn-lg">
                    Continue Order >>
                    </a>-->
              </div>
              
              </div>              
            </div>           
          </form>
        </div>
      </div>
      <!--<p class="pull-right"><input type="button" class="btn btn-danger btn-lg checkoutbtn" value="CHECKOUT"></p>--> 
    </div>
    <div class="col-sm-4">
    <?php $this->load->view('checkout/order_summary');?>
    
    </div>
  </div>
</div>
<?php $this->load->view('post_code');?>
<script>
function showhide_bussiness_name_div(obj)
{
	if($(obj).val()>1)
	{
		$("#bussiness_name_div").css('display','block');
	}
	else
	{
		$("#bussiness_name_div").css('display','none');
	}
}
function validate_this_form()
{
	var ll='<?php echo $this->added_by;?>';
	if(ll!=''){return true;}
	var name=$.trim($('#name').val());
	var last_name=$.trim($('#last_name').val());
	var contact=$.trim($('#contact').val());
	var email=$.trim($('#email').val());
	
	var new_password=$('#password').val();
	var confirm_password=$('#confirm_password').val();
	
	var delivery_address_street_address=$.trim($('#delivery_address_street_address').val());
	var delivery_address_Apartment=$.trim($('#delivery_address_Apartment').val());
	var billing_address=$.trim($('#billing_address').val());
	var billing_apartment_no=$.trim($('#billing_apartment_no').val());
	//alert(name);
	//alert(name.length);
	if(name=='')
	{
		$('#name').focus().addClass('formvalidetionred');//.css('border-color','#ee0808');
		simpal_notify("Name is Required!" , "Please fill the name field. this is required field."  , "danger");
		return false;
	}
	else
	if(last_name=='')
	{
		remove_class_('name');
		//$('#name').removeClass('formvalidetionred');
		$('#last_name').focus().addClass('formvalidetionred');
		simpal_notify("last name is Required!" , "Please fill the last name field. this is required field."  , "danger");
		return false;
	}
	else
	if(contact=='')
	{	
		remove_class_('last_name');
		$('#contact').focus().addClass('formvalidetionred');	
		simpal_notify("contact is Required!" , "Please fill the contact field. this is required field."  , "danger");
		return false;
	}
	else
	if(email=='')
	{	
		remove_class_('contact');
		$('#email').focus().addClass('formvalidetionred');
		simpal_notify("email is Required!" , "Please fill the email field. this is required field."  , "danger");
		return false;
	}
	else
	if(new_password=='')
	{	
		remove_class_('email');
		$('#password').focus().addClass('formvalidetionred');
		simpal_notify("password is Required!" , "Please fill the password field. this is required field."  , "danger");
		return false;
	}
	else
	if(confirm_password=='')
	{	
		remove_class_('password');
		$('#confirm_password').focus().addClass('formvalidetionred');
		simpal_notify("confirm password is Required!" , "Please fill the confirm password field. this is required field."  , "danger");
		return false;
	}
	else
	if(new_password!=confirm_password)
	{
		remove_class_('confirm_password');
		simpal_notify('Password not match!','Your Confirm Password are not matched to new password. please fill the right information.','danger');
		/*$.notify({
				title: '<strong>Password not match!</strong>',
				message: 'Your Confirm Password are not matched to new password. please fill the right information.'
			},{
				type: 'danger'
			});*/
		$(this).focus().addClass('formvalidetionred');
		$(this).val('');
		//return false;
	}else
	if(delivery_address_street_address=='')
	{	
		remove_class_('formvalidetionred');	
		$('#delivery_address_street_address').focus().addClass('formvalidetionred');
		simpal_notify("Delivery Address is Required!" , "Please fill the Delivery Address field. this is required field."  , "danger");
		return false;
	}
	//else if($("input:radio[name='deliveryaddress']")){}
	else 
	{
		remove_class_('delivery_address_street_address');
		return true;
	}
	//alert('exiteee');
	return false;
	
	
}

function add_class_(id)
{
	$('#'+id).removeClass('formvalidetionred');
}
function remove_class_(id)
{
	$('#'+id).removeClass('formvalidetionred');
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvjYUNMayAdpHVsyYtzVlQhsyxQHlsQ5U&callback=initialize&libraries=places&region=au"
  type="text/javascript"></script> 
<script type="text/javascript">
function initialize() {
 var options = {
  componentRestrictions: {country: "au"}
 };

 var input = document.getElementById('delivery_address_street_address');
 //alert(input);
 var autocomplete = new google.maps.places.Autocomplete(input, options);
 var input1 = document.getElementById('billing_address');
 //alert(input);
 var autocomplete = new google.maps.places.Autocomplete(input1, options);
}

/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script> 

<script type="text/javascript">
$("#password,#confirm_password").on('change',function(){
	if($(this).attr('id')=='password')
	{
		
	}
	else
	{
		var password=$('#password').val();
		var confirm_password=$(this).val();
		if(password!=confirm_password)
		{
			simpal_notify('Password not match!','Your Confirm Password are not matched to new password. please fill the right information.','danger');
			/*$.notify({
					title: '<strong>Password not match!</strong>',
					message: 'Your Confirm Password are not matched to new password. please fill the right information.'
				},{
					type: 'danger'
				});*/
			$(this).focus();
			$(this).val('');
			//return false;
		}
	}
});
$('#delivery_address_street_address,#billing_address,#searchTextField2,#searchTextField3,#delivery_location').on('change',function(){
	var obj=this;
	window.setTimeout(function () { 
        showDetails(obj) 
    }, 200);
});
function showDetails(obj)
{
	var val=$(obj).val();
	 //alert($(obj).val());
	 var send_url="<?php echo base_url("/add_customer_order/get_formated_address/");?>";	
	var data_array={address:val}
	//alert(send_url);
	var data=send_ajax_return_value(send_url,data_array);		
	//console.log(data.responseJSON);
	//alert(data.responseJSON);
	//$(this).val();
	$(obj).val(data.responseJSON);
}
    $(function () {
        $("input[name='deliveryaddress']").click(function () {
            if ($("#chkNo").is(":checked")) {
                $("#dvAddress").show();
            } else {
                $("#dvAddress").hide();
            }
        });
    });
</script> 
