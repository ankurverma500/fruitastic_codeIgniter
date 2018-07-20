<link rel="stylesheet" href="<?php echo base_url_assets;?>calender/calendarorganizer_org.css">
<script src="<?php echo base_url('assets/calender/calendarorganizer_org.js');?>" > </script>
 <?php //$this->load->view('checkout/calendarorganizer_org');?>
<div class="wrapper">
  <div id="calendarContainer"></div>
  <div id="organizerContainer" style="display:block"></div>
</div>
<script>

function add_run_in_session(run_detail_id1,run_date1,run_day1)
{
	//alert(data);
	var send_url="<?php echo base_url("cart/add_run_in_session/".$this->session->userdata('run_post_code'));?>";	
	var data_array={run_detail_id:run_detail_id1,run_date:run_date1,run_day_name:run_day1}
	//alert(send_url);
	var data1=send_ajax_return_value(send_url,data_array);	
	//console.log(data1);
	//alert(data1);	
	console.log(data1.responseJSON);
	if(data1.responseJSON.res)
	{
		$("#selected_run_"+run_detail_id1).css('background-color','#AEFFAE');
		$("#selected_run_"+run_detail_id1).html('Selected Click on Continue Order to proceed');
		$('.checkout_btn_div').css('display','block');
	}
	else
	{
		$('.checkout_btn_div').css('display','none');
	}
}

$(function()
{//.day-radios  radio
	$(".days > .calender_row > input[type='radio']").on('click',function(){
	//alert('remove');
	//remove_run_in_session();
	});
	$(".delivery_day_level").on('click',function(event ){
	//alert('remove');
	//event.addEventListener();
	
	remove_run_in_session();
	//$( this ).off( event );
	//event.preventDefault();
	});
$("#calendarContainer").on('click',function(event ){
	//alert('remove');
	//event.addEventListener();
	
	remove_run_in_session();
	//$( this ).off( event );
	event.preventDefault();
	});
});

function remove_run_in_session()
{
		/*$("#organizerContainer-list").empty();
	
		var send_url="<?php echo base_url("cart/remove_run_in_session/".$this->session->userdata('run_post_code'));?>";	
		var data_array={run_dtail_id:''}
		//alert(send_url);
		var data1=send_ajax_return_value(send_url,data_array);	
		//console.log(data1);
		//alert(data1);	
		console.log(data1.responseJSON);
		if(data1.responseJSON.res)
		{		
			$('.checkout_btn_div').css('display','none');
		}
		else
		{
			//$('.checkout_btn_div').css('display','block');
		}*/
	
}
</script>

<script>
 
$(function(){

	var send_url="<?php echo base_url("calendar/get_post_code_of_run_helper_ajax/".$this->session->userdata('run_post_code'));?>";	
	var data_array={post_code:'<?php echo $this->session->userdata('run_post_code')?>'}
	//alert(send_url);
	var data1=send_ajax_return_value(send_url,data_array);	
	//console.log(data1);
	//alert(data1);	
	console.log(data1.responseJSON);
	//alert(data1.responseJSON);
	//$(this).val();
	//$(obj).val(data1.responseJSON);
	var data =data1.responseJSON;
/*data = {years: [{
			  int: 2018,
			  months: [{
						  int: 1,
						  days: [{
								  int: 28,
								  events: [{
										  startTime: "6:00",
										  endTime: "6:30",
										  mTime: "pm",
										  text: "Weirdo was born"
										}]
								}]
					  	}]
				 }]
		  };*/

var calendar = new Calendar("calendarContainer", "small", [ "Sunday", 3 ],  [ "#e91e63", "#c2185b", "#ffffff", "#f8bbd0" ]);

var organizer = new Organizer("organizerContainer", calendar, data);
currentDay = calendar.date.getDate(); // used this in order to make anyday today depending on the current today


function showEvents() {
  theYear = -1, theMonth = -1, theDay = -1;
   
  for (i = 0; i < data.years.length; i++) {
    if (calendar.date.getFullYear() == data.years[i].int) {
      theYear = i;
      break;
    }
  }
  if (theYear == -1)
  { return;
  }else{
	  for (i = 0; i < data.years[theYear].months.length; i++) {
		if ((calendar.date.getMonth() + 1) == data.years[theYear].months[i].int) {
		  theMonth = i;
		  break;
		}
	  }
  }
  if (theMonth == -1) {return;
  }
  else
  {
	  for (i = 0; i < data.years[theYear].months[theMonth].days.length; i++) 
	  {
		if (calendar.date.getDate() == data.years[theYear].months[theMonth].days[i].int) {
		  theDay = i;
		  break;
		}
	  }
  }
  /*console.log(data.years[theYear].months[theMonth].days.length);
  console.log(data.years[theYear].months[theMonth].days);
  alert(calendar.date.getDate());*/
  if (theDay == -1){ return;
  }else{
  theEvents = data.years[theYear].months[theMonth].days[theDay].events;   
  organizer.list(theEvents); // what's responsible for listing
  //console.log(theEvents);
  //alert(theEvents);
  }
}

showEvents();
/*
organizer.setOnClickListener('day-slider', function () 
													{ 
														showEvents(); 
														console.log("Day back slider clicked");
														remove_run_in_session(); 
													}, function () 
													{ 
														showEvents(); 
														console.log("Day next slider clicked"); 
														remove_run_in_session();
													});
													

organizer.setOnClickListener('days-blocks', function () 
													{ 
														showEvents(); 
														console.log("Day block clicked"); 														
														remove_run_in_session();
													}, 
													null);
													

organizer.setOnClickListener('month-slider', function () 
													{ 
														showEvents(); 
														console.log("Month back slider clicked"); 
														remove_run_in_session();
													}, function () 
													{ 
													showEvents(); 
													console.log("Month next slider clicked"); 
													remove_run_in_session();
													});
													
organizer.setOnClickListener('year-slider', function () 
													{ 
														showEvents(); 
														console.log("Year back slider clicked"); 
														remove_run_in_session();
													}, function () 
													{ 
													showEvents(); 
													console.log("Year next slider clicked"); 
													remove_run_in_session();
													});*/
});
</script>