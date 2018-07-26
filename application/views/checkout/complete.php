<div class="container">
  <div class=" checkout-section">
    <?php $this->load->view('checkout/index2',$this->data);?>
    <div class="col-sm-12 col-md-8 col-md-offset-2  col-lg-8 col-sm-offset-2 col-sx-12">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center bg-success">
            <div class=" " style="padding:50px;">
              <h1>Success!</h1>
              <span class="alerticon"><i class="fa fa-check-circle fa-5x complete-icon"></i></span>
              <p>Thanks so much for your message. We check e-mail frequently and will try our best to respond to your inquiry.</p>
              <p><?php echo 'Your order id is :- '.$this->session->userdata('total_order_array');?></p>
              <p><a href="<?php echo base_url('product');?>" class="btn btn-danger">Continue Shopping</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="col-sm-4">
      <?php //$this->load->view('checkout/order_summary');?>
    </div>-->
  </div>
</div>
<!--<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script> -->
