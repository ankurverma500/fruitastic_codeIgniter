

<div id="order_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-map-marker" aria-hidden="true"> </i> Post Code</h4>
      </div>
      <div class="modal-body">
       <div id="clickMeId_post_code" class="text-center">
        <h5>Please enter your Post Code to check for </h5>
		<h5>Free Delivery*</h5>
        <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 col-sm-offset-4 col-xs-offset-2">
         <input type="text" id="post_code_with_address" name="post_code_with_address" class="form-control popup_textbox" placeholder="Enter your postcode" />
          <!--<input type="text" class="form-control text-center popup_textbox" placeholder="enter post code" />-->
         </div>
        </div>
        
        <button type="Submit" id="popup_postcode_button" class="btn btn-info" <?php /*?>onclick="show('comment_post_code'); hide('clickMeId_post_code')"<?php */?>>Submit</button>
       </div>
       
       <div id="comment_post_code" style="display:none;" class="text-center shopnow_hidden_div">
          <p class="shopnow_hidden_p">We currently don't have free delivery to your area, however, please click on live chat to discuss delivery fee and options, or send us an enquiry to find out delivery options.</p>
          <a href="<?php echo base_url('contact-us');?>" class="btn btn-info">Contact Us</a>
           <button type="button"  class="btn btn-info" onclick="hide('comment_post_code'); show('clickMeId_post_code')">Try Again</button>
        </div>
      
       <p class="shopnow_hidden_div_p2">* Free Delivery for orders above $40</p>
      </div>
      
    </div>
  </div>
</div>
<script>
function show (toBlock)
  {
	  $("#"+toBlock).css('display','block');
	  //setDisplay(toBlock, 'block');
  }
  function hide (toNone) 
  {
	   $("#"+toNone).css('display','none');
	  //setDisplay(toNone, 'none');
  }
$(document).ready(function () {
    $("#popup_postcode_button").on("click", function(e) {								
		$.ajax({
			url: '/school/calendar/check_post_code_with_address_popup',
			type: "POST",								
			data: {post_code_with_address:$("#post_code_with_address").val()},
			success: function(data) {										
				if(data!='success'){
					show('comment_post_code'); hide('clickMeId_post_code');									
				}
				else{
					location.reload();								
				}
			},
			error: function(error) {
				//console.log(status + ": " + error);
			}
		});		
     });   
});
</script>