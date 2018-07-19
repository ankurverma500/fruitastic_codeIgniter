<style>
.bottom_header .menu_sec .navbar-nav li a ,.bottom_header .menu_sec .navbar-default .navbar-nav > .active > a, .menu_sec .navbar-nav li a:focus {
    background: none;
    color: #000!important;
}
.order-bar ul,.order-box form{
    display:inline-block;
    width:100%
}
.order-box form{
    padding:0 8px
}
.order-bar{
    margin-top:150px;
    margin-bottom:40px
}
.order-bar ul{
    border-radius:25px;
    vertical-align:top;
    font-weight:600;
    line-height:40px;
    font-size:16px;
    box-shadow:0 0 0 2px #ff4141
}
.order-bar ul li:first-child,.order-bar ul li:first-child a{
    border-radius:25px 0 0 25px
}
.order-bar ul li{
    float:left;
    width:25%;
    text-align:center;
    background:url(<?php echo base_url('assets/images/bar-white-arrow.png')?>) right top no-repeat;
    background-size:auto 100%;
    position:relative;
    padding-right:20px
}
.order-bar ul li.active{
    background:url(<?php echo base_url('assets/images/bar-green-arrow.png')?>) right top no-repeat #fff;
    background-size:auto 100%
}
.order-bar ul li:after{
    position:absolute;
    left:-20px;
    background:url(<?php echo base_url('assets/images/bar-whitegreen-arrow.png')?>) left top no-repeat;
    background-size:auto 100%;
    height:100%;
    content:'';
    top:0;
    width:30px;
    display:none
}
.order-bar ul li.active:after{
    display:block
}
.order-bar ul li:first-child.active:after,.order-bar ul li:first-child:hover:after{
    display:none
}
.order-bar ul li:last-child{
    background:0 0;
    border-radius:0 25px 25px 0
}
.order-bar ul li a{
    color:#525252;
    display:block
}
.order-bar ul li.active a,.post_code_btn{
    background:#ff4141;
    color:#fff
}
.order-bar ul li:last-child.active{
    background:#ff4141
}
.not-active{
    cursor:default
}
</style>
<?php
 $con = $this->router->fetch_class();
 $method = $this->router->fetch_method();
 /*echo $this->session->userdata('run_post_code');
 echo '<pre>';
 print_r($this->session->userdata('run_detail'));
 echo '</pre>';*/
?>

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1 order-bar">
      <ul>
        <li  <?php   if($method=='your_detail' || $method=='delivery_day'||$method=='payment'||$method=='payment_status'){echo 'class="active"';}else{echo '';}?>>
          <a  href="<?php echo base_url('checkout/your_detail');?>" class="not-active">Your Details</a>  
        </li>
        <li <?php   if($method=='delivery_day' ||$method=='payment'||$method=='payment_status'){echo 'class="active"';}else{echo '';}?>>
          <a  href="<?php echo base_url('checkout/delivery_day');?>" class="not-active">Delivery Day</a>
        </li>
        <li <?php   if($method=='payment' ||$method=='payment_status'){echo 'class="active"';}else{echo '';}?>>
          <a  href="<?php echo base_url('checkout/payment');?>" class="not-active">Payment</a>
        </li>
        <li <?php   if($method=='payment_status'){echo 'class="active"';}else{echo '';}?>>
          <a  href="<?php echo base_url('checkout/complete');?>" class="not-active">Complete</a>
        </li>
      </ul>
    </div>
</div>
</div>
    