<!--<link rel="stylesheet" href="<?php echo base_url('assets/ng-calender/calender-customer.css');?>">
<script src="<?php echo base_url('assets/ng-calender/calender.js');?>" > </script>-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/calender-customer.css');?>">

 <?php //$this->load->view('checkout/calendarorganizer_org');
 //
 
 ?>
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
</div>
<script  src="<?php echo base_url('assets/js/calender.js');?>" > </script>

<script>
$(function() {
	var enableDays = [];
    calendarInit(enableDays);

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
        /*beforeShowDay: function(date) {
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
        },*/
        onSelect: function(date) {}
    })/*.on('changeDate', function(e) {
        self.onetimeAm = false;
        self.onetimePm = false;
        self.enableSelector = true;
        var adate = e.date;
        adate = adate.getUTCFullYear() + "-" + ("0" + (adate.getMonth() + 1)).slice(-2) + "-" + ("0" + adate.getDate()).slice(-2);
        self.sdate = adate;
        $.each(self.mdataoneTime, function(i, val) {
            if (val.run_date == adate) {
                if (val.shift_name == "AMPM") {
                    self.onetimeAm = true;
                    self.onetimePm = true;
                } else if (val.shift_name == "AM")
				{
                    self.onetimeAm = true;
				}
                else
				{
                    self.onetimePm = true;
				}
            }
        })
    })*/;


}

});
</script>

