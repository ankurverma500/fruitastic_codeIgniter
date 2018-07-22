<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('templates/pages/meta');?>
<style>
.alert-info {
    z-index: 99999999 !important;
}
</style>
</head>
<body>

  <?php $this->load->view('templates/pages/header_pages');?>
  

   <?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="alert-danger-massage"><?php echo $this->session->flashdata('error') ;?></div>
    </div>
    <?php } 
    if($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert">×</button>
        <div class="alert-success-massage"><?php echo $this->session->flashdata('success') ;?></div>
    </div>
    <?php } 
    if($this->session->flashdata('info')) { ?>
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="alert-info-massage"><?php echo $this->session->flashdata('info') ;?></div>
    </div>
<?php } ?>
  <?php echo isset($content)?$content:'&nbsp;'?>
            
            
 
<?php $this->load->view('templates/pages/footer');?>
<?php $this->load->view('notify/notify');?>

</body>
<script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 9056975;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<script>
		
        /**** hide message notification ****/
        setTimeout(function(){ 
            $(".alert-danger").hide();
            $(".alert-success").hide();
            $(".alert-info").hide();
        }, 7000);
        </script>
<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	
	function simpal_notify(tt,mm,typ)
	{
		$.notify({
				title: '<strong>'+tt+'</strong>',
				message: mm
			},{
				type: typ
			});
	}
</script>
<script>
/*function openNav() {
    document.getElementById("myNav").style.width = "100%";
}
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}*/
</script>

  <script>
   
function send_ajax_return_value(send_url,data_array)
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


<script>
jQuery(document).ready(function(){
  jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 150) {
    jQuery('.bottom_header').addClass('fixed-header');
    }
    else {
    jQuery('.bottom_header').removeClass('fixed-header');
    }
  });
});
</script>




<script>
  $('.carousel').carousel({
   interval: 2000
  });
 </script> 
 

​<script>
/*function openNav() {
    document.getElementById("mySidenav").style.width = "400px";    
	//$("#mySidenav").css('width','400px');
	document.body.style.bottom = "0px";
	document.body.style.left = "0px";
	document.body.style.position = "fixed";
	document.body.style.right = "0px";
	document.body.style.top = "0px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";    
	//$("#mySidenav").css('width','0px');
	document.body.style.position = "relative";
}*/
/*function openNav() {
    $("#myNav").css('width','100%');
}
function closeNav() {
    $("#myNav").css('width','0%');
}*/
</script>



<!--
<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>-->

<script>
  function show (toBlock){
    setDisplay(toBlock, 'block');
  }
  function hide (toNone) {
    setDisplay(toNone, 'none');
  }
  function setDisplay (target, str) {
    document.getElementById(target).style.display = str;
  }
</script>
</html>
<?php exit;?>