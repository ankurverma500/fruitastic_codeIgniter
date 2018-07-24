  
<!-- Login Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="fa fa-close"></span>
        </button>-->
        <button  aria-label="Close" class="close" data-dismiss="modal" type="button">
          <span  class="fa fa-close"></span>
          <span  class="close_text">Close</span>  
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 signin">
                <h3>Sign In to Fruitastic</h3>
                <form id="popup_login_form" class="form-horizontal"  method="post" autocomplete="off"  enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('checkout/step_2_login');?>" >
                <input type="hidden" name="from_url" value="<?php echo $con.'/'.$method;?>" >
                  <div class="form-group">
                    <label>Email address</label>
                   <input type="email" name="username" placeholder="Email" class="form-control" id="l_Email_Id">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control" id="l_Password">
                   
                  </div>
                  <!--<div class="form-group" id="login_error_msg" style="display:none;">
                  <label>error</label>
                  <span></span>
                  </div>-->
                  <div class="form-group">
                  <a href="#" data-toggle="modal" data-target="#fogot_password" onClick="$('#signinModal').modal('hide');">
                  Forget Username or Password</a>
                  </div>
                  <div class="form-group">
                  <!--<input type="submit" name="loginForm" id="popup_login_button"  value="Submit" class="btn btn-default btn-block  login_btn signup" data-dismiss="modal"/>-->
                    <button type="submit" name="loginForm" id="popup_login_button"  value="Submit" class="btn btn-default btn-block  login_btn signup" <?php /*?>data-dismiss="modal"<?php */?>>Submit</button>
                  </div>
                </form>
            </div>    
            <div class="col-md-6 guest">
                <h3>Sign Up to Fruitastic</h3>
                <p class="text-center join"><img src="<?php echo base_url_assets;?>images/logo.png" alt="Logo" height="100%"></p>
                <!--<button type="submit" class="btn btn-default btn-block signup" data-toggle="modal" data-target="#signupModal" onClick="$('#signinModal').modal('hide');">Register</button>-->
                <button  class="btn btn-default btn-block signup hoverd-btn" data-target="#signupModal" data-toggle="modal" onclick="$('#signinModal').modal('hide');" type="button">Register</button>
                
                
            </div>    
        </div>
      </div>
    </div>
  </div>
</div>
    
    
<script>
/* must apply only after HTML has loaded */
$(document).ready(function () {
    $("#popup_login_form").on("submit", function(e) {
        var postData = $(this).serializeArray();
		//alert(postData);
		//console.log(postData);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
				if(data=='success'){
					location.reload();
				}
				else
				{
					//$.notify("invalid username , password");
					$.notify({
							icon: "glyphicon glyphicon-warning-sign",
							title: "Error",
							message:"invalid username , password",
							type: "warning",
							target: '_blank'
							},{
							delay: 5000,
							animate: {
								enter: 'animated fadeInRight',
								exit: 'animated fadeOutRight'
							}
					});					
					/*$("#login_error_msg").css('display','block');
					$("#login_error_msg>span").html(data);*/
				}
				console.log(data);
                //$('#contact_dialog .modal-header .modal-title').html("Result");
              //  $('#contact_dialog .modal-body').html(data);
               // $("#submitForm").remove();
            },
            error: function(jqXHR, status, error) {
				$("#login_error_msg").css('display','block');
				$("#login_error_msg>span").html(status + ": " + error);
				//location.reload();
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
     
   /* $("#popup_login_button").on('click', function() {
        $("#popup_login_form").submit();
    });*/
});
</script>
    
<!-- Sign up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-close"></span></button>-->
        <button  aria-label="Close" class="close" data-dismiss="modal" type="button">
          <span  class="fa fa-close"></span>
          <span  class="close_text">Close</span>  
        </button>
      </div>
      <div class="modal-body white">
           <h1  class="text-center">
           <img  src="<?php echo base_url('assets/images/register_icon.png');?>"> 
           Sign Up
           </h1>
        	<p  class="signup_text">Let’s get you registered for ordering !</p>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="personel" style="padding: 20px;">
            
                 <form id="popup_Register_Form" class="form-horizontal"  method="post" autocomplete="off"  enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('checkout/user_register_popup');?>" >
                 <input type="hidden" name="from_url" value="<?php echo $con.'/'.$method;?>" >
                <!-- <pre> <div id="popup_Register_result" style="color:red;"></div></pre>-->
                <div class="form-group">
                  	<div class="row">
                      <div class="col-md-6 col-sm-6"> 
                      <label id="customer_type" class=" control-label">Customer Type</label>
                            <select  class="form-control"  id="customer_type" name="customer_type"  onchange="showhide_bussiness_name_div(this)">
                                <option  value="">Select Customer Type</option>
                                <option  value="1">Residential</option>
                                <option  value="2">School</option>
                                <option  value="3">Child Care</option>
                                <option  value="4">Corporate</option>
                            </select>
                            <div id="customer_type_arror" style="color:red;"></div> 
                      </div>
                      <div class="col-md-6 col-sm-6" id="bussiness_name_div" <?php if(isset($row) && $row->customer_type_id>1){echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                    
                          <label for="bussiness_name" class=" control-label">Bussiness  Name</label>                          
                             <input type="text"  class="form-control" name="bussiness_name" id="bussiness_name" value="<?php echo set_value('bussiness_name', isset($row->primary_contact_name) ? $row->primary_contact_name : '')?>" placeholder="Bussiness  Name" autocomplete="off"  />
                            <?php echo form_error('customer_type'); ?>
                       <div id="bussiness_name_arror" style="color:red;"></div> 
                      </div>                      
                   </div>
                </div>
                
                <div class="form-group">
                  	<div class="row">
                      <div class="col-md-6 col-sm-6">                        
                            <label for="first_name_pop">First Name:</label>
                            <input type="text" class="form-control" id="first_name_pop" name="first_name_pop"   value="<?php echo set_value('first_name_pop')?>" onblur="this.placeholder = 'First name'" onfocus="this.placeholder = ''" placeholder="First name">
                            <div id="first_name_pop_arror" style="color:red;"></div>                        
                      </div>
                      <div class="col-md-6 col-sm-6">                        
                           <label for="last_name_pop">Last Name:</label>
                            <input type="text" class="form-control" name="last_name_pop"  id="last_name_pop" value="<?php echo set_value('last_name_pop')?>" onblur="this.placeholder = 'Last name'" onfocus="this.placeholder = ''" placeholder="Last name">
                            <div id="last_name_pop_arror" style="color:red;"></div>                        
                      </div>                     
                  </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="contact_pop">Phone No:</label>
                            <input type="text" class="form-control"  name="contact_pop"  id="contact_pop" value="<?php echo set_value('contact_pop')?>" onblur="this.placeholder = 'Contact number'" onfocus="this.placeholder = ''" placeholder="Contact number">
                            <div id="contact_pop_arror" style="color:red;"></div>
                        </div>  
                         <div class="col-md-6 col-sm-6">
                         
                            <label for="username">Email Id:</label>
                            <input type="email" class="form-control" name="username_pop"  id="username_pop" value="<?php echo set_value('username')?>" onblur="this.placeholder = 'Email'" onfocus="this.placeholder = ''" placeholder="Email">
                            <div id="username_arror" style="color:red;"></div>
                          
                      </div>                         
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                        	<label for="password"> Password::</label>
                            <input type="password" class="form-control"  name="password_pop" id="password_pop" value="<?php echo set_value('password')?>" onblur="this.placeholder = 'Password'" onfocus="this.placeholder = ''" placeholder="Password">
                    		<div id="password_arror" style="color:red;"></div>
                        </div>  
                        <div class="col-md-6 col-sm-6">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control"  name="confirm_password_pop" id="confirm_password_pop" value="<?php echo set_value('confirm_password', isset($row->password) ? $row->password : '')?>" onblur="this.placeholder = 'Confirm password'" onfocus="this.placeholder = ''" placeholder="Confirm password" >
                            <div id="confirm_password_arror" style="color:red;"></div>
                        </div> 
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="row">
                    	<div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <p>Already have an account? 
                              <!--<a onClick="$('#signupModal').modal('hide');" href="#" data-toggle="modal"  data-target="#signinModal" >Sign In</a>--> 
                              <a  data-target="#signinModal" data-toggle="modal" href="#" onclick="$('#signupModal').modal('hide');">Sign in</a>
                              Now.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label>&nbsp;</label>
                             <!--<input type="submit" name="RegisterForm" id="popup_Register_button"  value="Submit" data-toggle="modal" class="btn btn-primary login_btn btn-block" />-->
                            <button type="submit" name="RegisterForm" id="popup_Register_button"  value="Submit" data-toggle="modal"  class="btn btn-default btn-block">Submit</button>
                        </div> 
                    </div>
                  </div>
                   
                </form>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
<!---
$("#popup_Register_Form").on("submit", function(e) {
		 e.preventDefault();
		var postData = $(this).serializeArray();
		var rr=true;
		jQuery.each( postData, function( i, field ) {
								console.log(field.name+' '+field.value);
								if($.trim(field.value)=='')
								{
									$("#"+field.name+"_arror").html('This field is required');
									rr= false;
								}
								else
								{
									$("#"+field.name+"_arror").html("");
								}
			// $( "#results" ).append( field.value + " " );
			});
			
			if(!rr)
			{
				return rr;
			}
			else
			{
				//var postData = $(this).serializeArray();				
				//console.log(postData);
				var formURL = $(this).attr("action");
			    $.ajax({
					url: formURL,
					type: "POST",
					/*datatype:"JSON",
					contentType: "application/json",*/
					data: postData,
					success: function(data, textStatus, jqXHR) {
						//location.reload();
						//jQuery.parseJSON(data)
						//class="modal-open"
						console.log(data);
						if(data!='success')
						{							
							$('#registration #popup_Register_result').html();
							$('#registration #popup_Register_result').html(data);
						}
						else
						{							
							//$("#message").modal('show');
							location.reload();
							$('#registration .modal-header .modal-title').html();
							$('#registration .modal-body').html(data);
						}
					   // $("#submitForm").remove();
					},
					error: function(jqXHR, status, error) {
						//location.reload();
						console.log(status + ": " + error);
					}
				});
			}		
		//jQuery.parseJSON(data.responseText)
       
    });
     
    /*$("#popup_Register_button").on('click', function(e) {
		e.preventDefault();
        $("#popup_Register_Form").submit();
    });*/
----->
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

/* must apply only after HTML has loaded */
$(document).ready(function () {
	$("#username").on('change',function(){
		var customer_type=$.trim($("#customer_type").val());
		var username=$.trim($(this).val());
		if(customer_type=="")
		{
			$("#customer_type_arror").html('This field is required');
			$("#customer_type").focus();
		}
		else if(username=="")
		{
			$("#customer_type_arror").html("");
			$("#username_arror").html('This field is required');
			$("#username").focus();
		}
		else
		{
			$("#username_arror").html("");
			$.ajax({
					url: "<?php echo base_url.'login/email_id_exists_or_not';?>",
					type: "POST",
					data: {username:username,customer_type:customer_type},
					success: function(data, textStatus, jqXHR) {						
						console.log(data);
						if(data!='success')
						{
							$('#registration #popup_Register_result').html();
							$('#registration #popup_Register_result').html(data);
						}
						else
						{
							//$("#message").modal('show');
							location.reload();
							$('#registration .modal-header .modal-title').html();
							$('#registration .modal-body').html(data);
						}
					   // $("#submitForm").remove();
					},
					error: function(jqXHR, status, error) {
						//location.reload();
						console.log(status + ": " + error);
					}
				});
		}
	});
	
	$("#popup_Register_Form").on("submit", function(e) {
		 e.preventDefault();
		var postData = $(this).serializeArray();
		postData.push({name: 'username', value: $("#username_pop").val()});
		postData.push({name: 'password', value: $("#password_pop").val()});
		postData.push({name: 'confirm_password', value: $("#confirm_password_pop").val()});
		var rr=true;
		jQuery.each( postData, function( i, field ) {
								console.log(field.name+' '+field.value);
								if(field.value=='')
								{
									$("#"+field.name+"_arror").html('This field is required');
									rr= false;
								}
								else
								{
									$("#"+field.name+"_arror").html('');
								}
			// $( "#results" ).append( field.value + " " );
			});
			
			if(!rr)
			{
				return rr;
			}
			else
			{
				//var postData = $(this).serializeArray();				
				//console.log(postData);
				var formURL = $(this).attr("action");
			    $.ajax({
					url: formURL,
					type: "POST",
					/*datatype:"JSON",
					contentType: "application/json",*/
					data: postData,
					success: function(data, textStatus, jqXHR) {
						//location.reload();
						//jQuery.parseJSON(data)
						//class="modal-open"
						
						console.log(data);
						if(data!='success')
						{
							var data =$.parseJSON(data);
							
							  $.each(data, function( index, value ) {
								  //alert( index + ": " + value );
								  console.log('index- '+index+'- value -'+value);
								  $("#"+index+"_arror").html(document.createTextNode(value));
								});
							
						}
						else
						{							
							//$("#message").modal('show');
							location.reload();
							$('#register .modal-header .modal-title').html();
							$('#register .modal-body').html('<pre>'+data+'</pre>');
						}
					   // $("#submitForm").remove();
					},
					error: function(jqXHR, status, error) {
						//location.reload();
						console.log(status + ": " + error);
					}
				});
			}		
		//jQuery.parseJSON(data.responseText)
       
    });
     
    $("#popup_Register_button").on('click', function(e) {
		e.preventDefault();
        $("#popup_Register_Form").submit();
    });
	
	
    
});
/*$( "#message" ).dialog({
  close: function( event, ui ) {location.reload();}
});$("#message").modal('show');
$('.close').click( function () {
// your function definition goes here 
});
*/
</script>

<!------------------------------ Forgot Password ------------------------------------>

<div class="modal fade" id="fogot_password" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-close"></span></button>
      </div>
      <div class="modal-body white">
          <h3 class="text-center">Please enter your emial id </h3>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="personel">
                 <form id="popup_Register_Form" class="form-horizontal"  method="post" autocomplete="off"  enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('checkout/forgot_password');?>" >
                  <div class="row">
                      <div class="col-md-10 col-sm-10 col-sm-offset-1">
                      <p>&nbsp;</p>
                        <div class="form-group">
                            <input type="text" class="form-control" name="forgot_password" id="forgot_password" placeholder="email id">
                        </div>
                      </div>
                      <div id="forgot_password_arror" class="col-md-10 col-sm-10 col-sm-offset-1" style="color:red; margin-bottom:20px;"></div>
                  </div>
                  
                  <div class="form-group text-center">
                         <label>&nbsp;</label>
                        <button type="submit" class="btn btn-default"  id="forgot_password_button">Submit</button>
                  </div>
                </form>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>

<script>
$("#forgot_password_button").on("click", function(e) {
		 e.preventDefault();
		var email=$("#forgot_password").val();
			
			if(email=='')
			{
				return false;
			}
			else
			{
				//var postData = $(this).serializeArray();				
				//console.log(postData);
				var formURL = '<?php echo base_url('checkout/forgot_password');?>';
			    $.ajax({
					url: formURL,
					type: "POST",
					/*datatype:"JSON",
					contentType: "application/json",*/
					data: {email:email},
					success: function(data, textStatus, jqXHR) {
						//location.reload();
						//jQuery.parseJSON(data)
						//class="modal-open"
						var data =$.parseJSON(data);
						console.log(data);
						if(!data.res)
						{	 
						  $("#forgot_password_arror").html(data.msg);
						  return false								
						}
						else
						{							
							//$("#message").modal('show');
							location.reload();
							return false;
							//$('#register .modal-header .modal-title').html();
							//$('#register .modal-body').html('<pre>'+data+'</pre>');
						}
					   // $("#submitForm").remove();
					},
					error: function(jqXHR, status, error) {
						//location.reload();
						return false;
						console.log(status + ": " + error);
					}
				});
			}		
		//jQuery.parseJSON(data.responseText)
       
    });
</script>
<!------------------------ Sign Out --------------------------------------->

<div id="signout" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h4>Are you sure you want to sign out</h4>
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>