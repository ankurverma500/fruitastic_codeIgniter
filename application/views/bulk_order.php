<link type="text/css" rel="stylesheet" href="<?php echo base_url_assets;?>css/tymp.css">


<div class="banner_container about-us">
    <div class="banner_details text-center">
      <div class="container">
        <h1 class="animated fadeInDown go">So much goodness straight from </h1>
        <span class="animated fadeInUp go">local Aussie farms!! Delish!!</span>
      </div>
    </div>
</div>

<div class="contact_page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 hidden-xs">
                <div class="conatct_pic"><img src="<?php echo base_url('assets/images/contact_new.jpg')?>" alt="" class="img-responsive"></div>
            </div>
            <div class="col-md-6 col-sm-7 pull-right contact-form">
                <h1>Bulk Order Enquiry</h1>
                <p class="text-justify">Thank you for your interest in our wholesale supply to schools, office, or childcare centres. 
So we can tailor our service to your needs, we ask you please fill out the form below and one of our staff members will be in contact very shortly to discuss options available to you and possibly furnish you with a wholesale quote and have you onboard and enjoying our service in no time at all. </p>
                
                                
               <form action="" method="post" id="ContactForm" novalidate>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <!--<input class="form-control" type="text" placeholder="Name">-->
                            <span class="input input--minoru">
                                <input class="input__field input__field--minoru" type="text" id="name" name="name" placeholder="Enter name" value="<?php echo set_value('name')?>">
                
                                <label class="input__label input__label--minoru" for="input-13">
                                    
                                </label>
							</span>
                            <div class="col-md-12 col-sm-12"><?php echo form_error('name'); ?></div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <span class="input input--minoru">
                                <textarea class="input__field input__field--minoru" placeholder="Address" name="address" id="address" rows="1"></textarea>
                                <label class="input__label input__label--minoru" for="#">
                                </label>
							</span>
                             <div class="col-md-12 col-sm-12"><?php echo form_error('address'); ?></div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <span class="input input--minoru">
                                <input class="input__field input__field--minoru" type="email" id="email" name="email" placeholder="Enter email id" value="<?php echo set_value('email')?>">
                
                                <label class="input__label input__label--minoru" for="input-13">
                                </label>
							</span>
                            <div class="col-md-12 col-sm-12"><?php echo form_error('email'); ?></div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <span class="input input--minoru">
                                <input class="input__field input__field--minoru" type="text" id="contact_no" name="contact_no" placeholder="Your phone no" value="<?php echo set_value('contact_no')?>">
                
                                <label class="input__label input__label--minoru" for="input-13">
                                </label>
							</span>
                            <div class="col-md-12 col-sm-12"><?php echo form_error('contact_no'); ?></div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <span class="input input--minoru">
                                <!--<input class="input__field input__field--minoru" type="text" id="input-13">-->
                                <textarea class="input__field input__field--minoru" placeholder="Requirement" id="message" name="message" placeholder="Requirement"><?php echo set_value('message')?></textarea>
                
                                <label class="input__label input__label--minoru" for="input-13">
                                </label>
							</span>   
                             <div class="col-md-12 col-sm-12"><?php echo form_error('message'); ?></div>                        
                        </div> 
                         
                    </div>
                    
                    
                    
                                      
                   <div class="row">
                         <div class="col-md-5 col-sm-5">
                            <span class="input input--minoru">
                            	<label class="bulk-captcha-label">How much is 8+4 ? <em class="text-danger">*</em></label>
							</span>
                        </div> 
                        <div class="col-md-7 col-sm-7">
                            <span class="input input--minoru">
                            	<input type="hidden" name="captcha_ans" id="captcha_ans" value="12">
                                <input class="input__field input__field--minoru" type="text" id="captcha_value" name="captcha_value" value="<?php echo set_value('captcha_value')?>">
                                <label class="input__label input__label--minoru"></label>
							</span>                   
                        </div> 
                        <div class="col-md-12 col-sm-12"><?php echo form_error('captcha_value'); ?></div>
                    </div>
                  
				                     <div class="row">
                        <div class="col-sm-offset-8 col-sm-4"> 
                      <span class="input input--minoru hoverd-btn bulk-order-submit-btn"> <input type="submit" value="Submit" name="submit" class="btn btn-link btn-block bulk-order-submit-btn"></span>
                     </div>
                    </div>
                </form>                 
             <?php /*?><form method="post">
              <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo set_value('name')?>">
                <?php echo form_error('name'); ?>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email id" value="<?php echo set_value('email')?>">
                <?php echo form_error('email'); ?>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="Your phone no" value="<?php echo set_value('contact_no')?>">
                <?php echo form_error('contact_no'); ?>
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address"></textarea>
                <?php echo form_error('address'); ?>
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="2" id="message" name="message" placeholder="Requirement"><?php echo set_value('message')?></textarea>
                <?php echo form_error('message'); ?>
              </div>
              <input type="submit" name="submit" class="btn btn-default contact-us-btn" value="Send">
            </form><?php */?>
            </div>
        </div>
    </div>
    
    
    
    <div class="map_sec">
        <!--<img src="common/images/ma.jpg" alt="" class="img-responsive map">-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143.892365672985!2d145.11569931532432!3d-38.00297097971853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad66d22fb9d178f%3A0x3fff8b7afa3ba4dc!2s14+Endeavour+Way%2C+Braeside+VIC+3195%2C+Australia!5e0!3m2!1sen!2sin!4v1504667807433" width="100%" height="450" frameborder="0" style="border:0; margin-bottom: -6px;" allowfullscreen=""></iframe>
        <div class="contact_info">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5 pull-right">
                        <div class="greenbox">
                            <h4>Contact info</h4>
                            <p>Get in touch and we will help with any questions or queries you may have via:</p>
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <span>14 Endeavour Way, Braeside, 3195, Victoria, Australia.</span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <span>service@fruitastic.com.au</span>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span>+ 1800 378 482</span>
                                </li>
                                <li>
                                    <i class="fa fa-globe"></i>
                                    <span>www.fruitastic.com.au</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>