<div class="container">
  <div class="col-sm-12 checkout-section">
    <?php $this->load->view('checkout/index2',$this->data);?>
    <div class="col-sm-12 col-md-8 col-md-offset-2  col-lg-8 col-sm-offset-2 col-sx-12">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center  bg-danger">
            <div class=" " style="padding:50px;">
              <h1 style="color: #a94442;"><?php echo ORDER_PLACED;?></h1>
              <span class="alerticon"><i  aria-hidden="true" class="fa fa-exclamation-triangle fa-5x"></i></span>
              <p><?php echo '<hr>but Please Contact admin , your order not placed properly';?></p>
              <p><?php echo 'Your order id is :- '.$this->session->userdata('total_order_array');?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script> 
