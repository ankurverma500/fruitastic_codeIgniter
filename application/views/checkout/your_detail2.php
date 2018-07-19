<div class="container">
  <div class="row checkout-section">
    <div class="col-sm-8">
      <div class="row bs-wizard"> 
        
        <!--<div class="col-sm-2 col-sm-offset-2 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Order</div>
                  <div class="progress hidden-xs"><div class="progress-bar"></div></div>
                  <a href="your-details.html" class="bs-wizard-dot"></a>
                </div>-->
        
        <div class="col-sm-2 col-sm-offset-3 bs-wizard-step complete">
          <div class="text-center bs-wizard-stepnum">Your Details</div>
          <div class="progress hidden-xs">
            <div class="progress-bar"></div>
          </div>
          <a href="your-details.html" class="bs-wizard-dot"></a> </div>
        <div class="col-sm-2 bs-wizard-step disabled">
          <div class="text-center bs-wizard-stepnum">Delivery Day</div>
          <div class="progress hidden-xs">
            <div class="progress-bar"></div>
          </div>
          <a href="delivery-day.html" class="bs-wizard-dot"></a> </div>
        <div class="col-sm-2 bs-wizard-step disabled">
          <div class="text-center bs-wizard-stepnum">Payment</div>
          <div class="progress hidden-xs">
            <div class="progress-bar"></div>
          </div>
          <a href="payment.html" class="bs-wizard-dot"></a> </div>
        <div class="col-sm-2 bs-wizard-step disabled">
          <div class="text-center bs-wizard-stepnum">Complete</div>
          <div class="progress hidden-xs">
            <div class="progress-bar"></div>
          </div>
          <a href="complete.html" class="bs-wizard-dot"></a> </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <form class="form-horizontal"  id='form-id'>
            <div class="deliver_day_form">
              <div class="row delivery_day_tab_row">
                <div class="col-sm-6 col-md-4">
                  <label class="delivery_day_level" data-toggle="tooltip" data-placement="top" title="Click to choose your delivery day for this order only">
                    <input id='watch-me' name='test' type='radio' />
                    <span class="one_time_label_tab">One TIME</span></label>
                </div>
                <div class="col-sm-6 col-md-4">
                  <label class="delivery_day_level" data-toggle="tooltip" data-placement="top" title="Click to set up as weekly recurring order. Please note prices fluctuate daily. Order can be stopped, paused, or altered using profile page top right of screen">
                    <input id='see-me' name='test' type='radio' />
                    <span class="one_time_label_tab">WEEKLY</span></label>
                </div>
                <div class="col-sm-6 col-md-4">
                  <label class="delivery_day_level" data-toggle="tooltip" data-placement="top" title="Click to set up as fortnightly recurring order. Order can be stopped, paused, or altered using profile page top right of screen">
                    <input id='look-me' name='test' type='radio' />
                    <span class="one_time_label_tab">FORTNIGHTLY</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div id='show-me' style='display:none; margin-left:0px;'>
                    <div class="wrapper">
                      <div id="calendarContainer"></div>
                      <div id="organizerContainer" style="display:none"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div id='show-me-two' style='display:none;'>
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox1" type="checkbox">
                          <label for="checkbox1">Monday</label>
                          <div class="radio">
                            <input type="radio" name="Monday" id="radio1" value="#">
                            <label for="radio1">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Monday" id="radio2" value="#">
                            <label for="radio2">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox2" type="checkbox">
                          <label for="checkbox2">Tuesday</label>
                          <div class="radio">
                            <input type="radio" name="Tuesday" id="radio3" value="#">
                            <label for="radio3">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Tuesday" id="radio4" value="#">
                            <label for="radio4">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox3" type="checkbox">
                          <label for="checkbox3">Wednesday</label>
                          <div class="radio">
                            <input type="radio" name="Wednesday" id="radio5" value="#">
                            <label for="radio5">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Wednesday" id="radio6" value="#">
                            <label for="radio6">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox4" type="checkbox">
                          <label for="checkbox4">Thursday</label>
                          <div class="radio">
                            <input type="radio" name="Thursday" id="radio7" value="#">
                            <label for="radio7">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Thursday" id="radio8" value="#">
                            <label for="radio8">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox5" type="checkbox">
                          <label for="checkbox5">Friday</label>
                          <div class="radio">
                            <input type="radio" name="Friday" id="radio9" value="option1">
                            <label for="radio9">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Friday" id="radio10" value="option2">
                            <label for="radio10">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox6" type="checkbox">
                          <label for="checkbox6">Saturday</label>
                          <div class="radio">
                            <input type="radio" name="Saturday" id="radio11" value="option1">
                            <label for="radio11">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Saturday" id="radio12" value="option2">
                            <label for="radio12">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div id='show-me-three' style='display:none;'>
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox7" type="checkbox">
                          <label for="checkbox7">Monday</label>
                          <div class="radio">
                            <input type="radio" name="Monday" id="radio13" value="#">
                            <label for="radio13">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Monday" id="radio14" value="#">
                            <label for="radio14">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox8" type="checkbox">
                          <label for="checkbox8">Tuesday</label>
                          <div class="radio">
                            <input type="radio" name="Tuesday" id="radio15" value="#">
                            <label for="radio15">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Tuesday" id="radio16" value="#">
                            <label for="radio16">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox9" type="checkbox">
                          <label for="checkbox9">Wednesday</label>
                          <div class="radio">
                            <input type="radio" name="Wednesday" id="radio17" value="#">
                            <label for="radio17">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Wednesday" id="radio18" value="#">
                            <label for="radio18">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox10" type="checkbox">
                          <label for="checkbox10">Thursday</label>
                          <div class="radio">
                            <input type="radio" name="Thursday" id="radio19" value="#">
                            <label for="radio19">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Thursday" id="radio20" value="#">
                            <label for="radio20">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox11" type="checkbox">
                          <label for="checkbox11">Friday</label>
                          <div class="radio">
                            <input type="radio" name="Friday" id="radio22" value="option1">
                            <label for="radio22">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Friday" id="radio23" value="option2">
                            <label for="radio23">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="checkbox checkbox-info">
                          <input id="checkbox12" type="checkbox">
                          <label for="checkbox12">Saturday</label>
                          <div class="radio">
                            <input type="radio" name="Saturday" id="radio25" value="option1">
                            <label for="radio25">AM (8am - 12pm)</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="Saturday" id="radio26" value="option2">
                            <label for="radio26">AM (8am - 12pm)</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 text-right"> <a href="payment.html" class="btn btn-primary checkout-btn btn-lg">Continue Order >></a> </div>
            </div>            
            <!--<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Delivery Day</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">Monday</label>
                                     <div class="radio">
                                        <input type="radio" name="Monday" id="radio1" value="#">
                                        <label for="radio1">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="Monday" id="radio2" value="#">
                                        <label for="radio2">Option 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox2" type="checkbox">
                                    <label for="checkbox2">Tuesday</label>
                                     <div class="radio">
                                        <input type="radio" name="Tuesday" id="radio3" value="#">
                                        <label for="radio3">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="Tuesday" id="radio4" value="#">
                                        <label for="radio4">Option 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox3" type="checkbox">
                                    <label for="checkbox3">Wednesday</label>
                                     <div class="radio">
                                        <input type="radio" name="Wednesday" id="radio5" value="#">
                                        <label for="radio5">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="Wednesday" id="radio6" value="#">
                                        <label for="radio6">Option 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox4" type="checkbox">
                                    <label for="checkbox4">Thursday</label>
                                     <div class="radio">
                                        <input type="radio" name="Thursday" id="radio7" value="#">
                                        <label for="radio7">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="Thursday" id="radio8" value="#">
                                        <label for="radio8">Option 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox5" type="checkbox">
                                    <label for="checkbox5">Friday</label>
                                     <div class="radio">
                                        <input type="radio" name="Friday" id="radio9" value="option1">
                                        <label for="radio9">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="Friday" id="radio10" value="option2">
                                        <label for="radio10">Option 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox6" type="checkbox">
                                    <label for="checkbox6">Saturday</label>
                                     <div class="radio">
                                        <input type="radio" name="Saturday" id="radio11" value="option1">
                                        <label for="radio11">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="Saturday" id="radio12" value="option2">
                                        <label for="radio12">Option 2</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <p class="select_odr_typ">Select Order Type:</p>
                            </div>
                            <div class="col-sm-12">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="option1" name="radioInline" >
                                    <label for="inlineRadio1"> One Time </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="option1" name="radioInline">
                                    <label for="inlineRadio2"> Recurring </label>
                                </div>
                                <div class="radio-inline">
                                  <select class="form-control input-sm" id="#">
                                    <option>Select</option>
                                    <option>Weekly</option>
                                    <option>Weekly</option>
                                    <option>Weekly</option>
                                  </select>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                 </div>-->            
          </form>
        </div>
      </div>
      
      <!--<p class="pull-right"><input type="button" class="btn btn-danger btn-lg checkoutbtn" value="CHECKOUT"></p>--> 
    </div>
    <div class="col-sm-4">
      <div class="table-responsive innnerbdr">
        <h2 class="yourorder clrwhite">Order Summary</h2>
        <table class="table">
          <thead>
            <tr>
              <td class="clrwhite">PRODUCT</td>
              <td class="clrwhite">QTY</td>
              <td class="clrwhite">TOTAL</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="fsize">Product name one</td>
              <td class="fsize">20</td>
              <td class="fsize">$100.00</td>
            </tr>
            <tr>
              <td class="tdbdrnine">Product name two</td>
              <td class="tdbdrnine">20</td>
              <td class="tdbdrnine">$100.00</td>
            </tr>
            <tr>
              <td class="tdbdrnine">Product name three</td>
              <td class="tdbdrnine">20</td>
              <td class="tdbdrnine">$100.00</td>
            </tr>
            <tr>
              <td colspan="2"><strong class="clrwhite">SUB TOTAL</strong></td>
              <td><strong class="clrwhite">$300.00</strong></td>
            </tr>
            <tr>
              <td colspan="2" class="clrwhite">Your Shipping</td>
              <td class="clrwhite">Free</td>
            </tr>
            <!--<tr>
                <td colspan="3" class="tdbdrnine clrwhite">Post code</td>
              </tr>
              <tr>
                <td colspan="3" class="tdbdrnine clrwhite">3150 - Glen Waverley <a href="#" class="fsizelink" data-toggle="modal" data-target="#changepostcode">(change)</a></td>
              </tr>-->
            <tr>
              <td colspan="2"><strong class="clrwhite">TOTAL PRICE</strong></td>
              <td><strong class="clrwhite">$300.00</strong></td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-12">
            <p class="evciyhheading">ENTER VOUCHER CODE IF YOU HAVE ONE. APPLY HERE</p>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control  vocher_code_text" placeholder="enter voucher code" aria-label="enter voucher code">
              <span class="input-group-btn">
              <input type="submit" class="btn btn-default boucher_code_button"  value="Apply Code">
              </span> </div>
          </div>
        </div>
      </div>
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
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/calender/calendarorganizer.js');?>" > </script>
<script>
$(document).ready(function () 
 { 
  $("#watch-me").click(function()
  {
    $("#show-me:hidden").show('slow');
   $("#show-me-two").hide();
   $("#show-me-three").hide();
   });
   $("#watch-me").click(function()
  {
    if($('watch-me').prop('checked')===false)
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
    if($('see-me-two').prop('checked')===false)
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
    if($('see-me-three').prop('checked')===false)
   {
    $('#show-me-three').hide();
   }
  });
  
 });

</script> 

<script>
  
var calendar = new Calendar("calendarContainer", "small", [ "Wednesday", 3 ], [ "#e91e63", "#c2185b", "#ffffff", "#f8bbd0" ]);
var organizer = new Organizer("organizerContainer", calendar);

currentDay = calendar.date.getDate(); // used this in order to make anyday today depending on the current today

// my best way of organizing data, maybe that can be the outcome of joining multiple tables in the database and then parsing them in such a manner, easier for the person to push use a date and the events of it
/*data = {
  years: [
    {
      int: 2017,
      months: [
        {
          int: 12,
          days: [
            {
              int: 28,
              events: [
                {
                  startTime: "6:00",
                  endTime: "6:30",
                  mTime: "pm",
                  text: "Weirdo was born"
                }
              ]
            }
          ]
        }
      ]
    },
    {
      int: (new Date().getFullYear()),
      months: [
        {
          int: (new Date().getMonth() + 1),
          days: [
            {
              int: (new Date().getDate()),
              events: [
                {
                  startTime: "6:00",
                  endTime: "7:00",
                  mTime: "am",
                  text: "This is scheduled to show today, anyday."
                },
                {
                  startTime: "5:45",
                  endTime: "7:15",
                  mTime: "pm",
                  text: "WIP Library"
                },
                {
                  startTime: "10:00",
                  endTime: "11:00",
                  mTime: "pm",
                  text: "Probably won't fix that (time width)"
                },
                {
                  startTime: "8:00",
                  endTime: "9:00",
                  mTime: "pm",
                  text: "Next spam is for demonstration purposes only"
                },
                {
                  startTime: "5:45",
                  endTime: "7:15",
                  mTime: "pm",
                  text: "WIP Library"
                },
                {
                  startTime: "10:00",
                  endTime: "11:00",
                  mTime: "pm",
                  text: "Probably won't fix that (time width)"
                },
                {
                  startTime: "5:45",
                  endTime: "7:15",
                  mTime: "pm",
                  text: "WIP Library"
                },
                {
                  startTime: "10:00",
                  endTime: "11:00",
                  mTime: "pm",
                  text: "Probably won't fix that (time width)"
                },
                {
                  startTime: "5:45",
                  endTime: "7:15",
                  mTime: "pm",
                  text: "WIP Library"
                },
                {
                  startTime: "10:00",
                  endTime: "11:00",
                  mTime: "pm",
                  text: "Probably won't fix that (time width)"
                },
                {
                  startTime: "5:45",
                  endTime: "7:15",
                  mTime: "pm",
                  text: "WIP Library"
                },
                {
                  startTime: "10:00",
                  endTime: "11:00",
                  mTime: "pm",
                  text: "Probably won't fix that (time width)"
                },
                {
                  startTime: "5:45",
                  endTime: "7:15",
                  mTime: "pm",
                  text: "WIP Library"
                },
                {
                  startTime: "10:00",
                  endTime: "11:00",
                  mTime: "pm",
                  text: "Probably won't fix that (time width)"
                }
              ]
            }
          ]
        }
      ]
    }
  ]
};*/

function showEvents() {
  theYear = -1, theMonth = -1, theDay = -1;
  for (i = 0; i < data.years.length; i++) {
    if (calendar.date.getFullYear() == data.years[i].int) {
      theYear = i;
      break;
    }
  }
  if (theYear == -1) return;
  for (i = 0; i < data.years[theYear].months.length; i++) {
    if ((calendar.date.getMonth() + 1) == data.years[theYear].months[i].int) {
      theMonth = i;
      break;
    }
  }
  if (theMonth == -1) return;
  for (i = 0; i < data.years[theYear].months[theMonth].days.length; i++) {
    if (calendar.date.getDate() == data.years[theYear].months[theMonth].days[i].int) {
      theDay = i;
      break;
    }
  }
  if (theDay == -1) return;
  theEvents = data.years[theYear].months[theMonth].days[theDay].events;  
  organizer.list(theEvents); // what's responsible for listing
}

showEvents();

organizer.setOnClickListener('day-slider', function () { showEvents(); console.log("Day back slider clicked"); }, function () { showEvents(); console.log("Day next slider clicked"); });
organizer.setOnClickListener('days-blocks', function () { showEvents(); console.log("Day block clicked"); }, null);
organizer.setOnClickListener('month-slider', function () { showEvents(); console.log("Month back slider clicked"); }, function () { showEvents(); console.log("Month next slider clicked"); });
organizer.setOnClickListener('year-slider', function () { showEvents(); console.log("Year back slider clicked"); }, function () { showEvents(); console.log("Year next slider clicked"); });
</script> 
