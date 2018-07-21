<!--<link rel="stylesheet" href="<?php echo base_url('assets/ng-calender/calender-customer.css');?>">
<script src="<?php echo base_url('assets/ng-calender/calender.js');?>" > </script>-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/calender-customer.css');?>">

 <?php //$this->load->view('checkout/calendarorganizer_org'); ?>
<div class="wrapper">
   <div class="col-sm-12">
      <div class="table-responsive">
        <div class="app">
          <div class="app_main">
            <div class="calendar">
              <div id="calendar1">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="calender_rd_padding col-sm-12 col-md-12" id="enableSelector" style="display:none;">          
        <div class="">
          <div class="col-sm-6 col-md-6" id="onetimeAm" style="display:none;">
            <div class="radio radio_box" >
              <input type="radio" name="shift_radio" id="shiftone" >
              <label for="shiftone" class="shiftone">AM (10am - 1pm)</label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6" id="onetimePm" style="display:none;">
            <div class="radio radio_box">
              <input type="radio" name="shift_radio" id="shifttwo" >
              <label for="shifttwo" class="shifttwo">PM (1pm - 4pm)</label>
            </div>
          </div>
        </div>
      </div>        
</div>
<script  src="<?php echo base_url('assets/js/calender.js');?>" > </script>

<script>
$(function() { 
var mdataoneTime;
var enableDays = [];
var sdate;
$.get( "<?php echo base_url('calendar/get_ontime_run/');?>", function( data ) {
	
	data=jQuery.parseJSON(data);
	//console.log(data.res);
	if(data.res)
	{
		//console.log(enableDays);
		mdataoneTime=data.rows
		$.each(data.rows, function(i, val) {
            enableDays.push(val.run_date);
            //console.log(enableDays);
			//breack;
			//console.log(enableDays.push(val.run_date));
        }.bind(this));
	}
	 //console.log('==============================================================');
	//console.log(enableDays);
    calendarInit(enableDays);
	});
/*var enableDays = ["2018-08-14", "2018-08-16", "2018-08-09", "2018-08-07", "2018-07-31", "2018-08-02", "2018-07-26", "2018-07-24"];*/


function callDataOneTime() {

    /*this.deliveryDayService.dayServiceOneTime().map((res: Response) => {
        return res.json();
    }).subscribe((data) => {
        this.mdataoneTime = data;
        //console.log(data);
        if (data.length == 0) {
            $('#NODILIVERYModal').modal('show');
            //this.router.navigate(['/contact']);
        }
        var enableDays = [];
        $.each(this.mdataoneTime, function(i, val) {
            enableDays.push(val.run_date);
            console.log(enableDays.push(val.run_date));
        }.bind(this));
        this.calendarInit(enableDays);
    });*/
	

}


function calendarInit(enableDays) 
{
    const self = this;
    $("#calendar1").datepicker({
        inline: true,
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        beforeShowDay: function(date) {
            var enableDays1 = enableDays;
            var check = false;
            $.each(enableDays1, function(i, val) {
                var ndate = new Date(val);
                var ncompare1 = ndate.getDate() + '-' + ndate.getMonth() + '-' + ndate.getUTCFullYear();
                var ncompare2 = date.getDate() + '-' + date.getMonth() + '-' + date.getUTCFullYear();
                if (ncompare1 == ncompare2)
                    check = true;
            })
            if (check)
                return true;
            return false;
        },
        onSelect: function(date) {}
    }).on('changeDate', function(e) {
		//console.log(self.enableSelector);
		
		$("#enableSelector").css('display','block');
		$("#onetimeAm").css('display','none');
		$("#shiftone").prop('checked',false);
		$("#onetimePm").css('display','none');
		$("#shifttwo").prop('checked',false);
		$('.checkout_btn_div').css('display','none');
       // self.onetimeAm = false;
       // self.onetimePm = false;
       // self.enableSelector = true;
        var adate = e.date;
        adate = adate.getUTCFullYear() + "-" + ("0" + (adate.getMonth() + 1)).slice(-2) + "-" + ("0" + adate.getDate()).slice(-2);
        sdate = adate;
        $.each(mdataoneTime, function(i, val) {
			
            if (val.run_date == adate) {
				console.log(val);
                if (val.shift_name == "AMPM") {
					console.log(val.shift_name);
                    //self.onetimeAm = true;
                    //self.onetimePm = true;
					$("#onetimeAm").css('display','block')
					//$("#onetimeAm div  radio").prop('checked',true);
					$("#onetimePm").css('display','block')
					//$("#onetimePm div  radio").prop('checked',true);
                } else if (val.shift_name == "AM")
				{
					//console.log(val.shift_name);
                    //self.onetimeAm = true;
					$("#onetimeAm").css('display','block');
					//$("#shiftone").prop('checked',true);
					$("#shiftone").attr('onclick', "add_run_in_session('"+val.run_detail_id+"','"+val.run_date+"','"+val.run_day+"','"+val.tbl_run_id+"')");
					
				}
                else
				{
					//console.log(val.shift_name);
                    //self.onetimePm = true;
					$("#onetimePm").css('display','block');
					//$("#shifttwo").prop('checked',true);
					$("#shifttwo").attr('onclick', "add_run_in_session('"+val.run_detail_id+"','"+val.run_date+"','"+val.run_day+"','"+val.tbl_run_id+"')");
					
				}
            }
        })
    });


}

});
function add_run_in_session(run_detail_id1,run_date1,run_day1,tbl_run_id1)
{
	//alert(data);
	var send_url="<?php echo base_url("cart/add_run_in_session/".$this->session->userdata('run_post_code'));?>";	
	var data_array={run_detail_id:run_detail_id1,run_date:run_date1,run_day_name:run_day1,tbl_run_id:tbl_run_id1}
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
</script>

