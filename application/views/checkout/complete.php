<div class="container">
  <div class="col-sm-12 checkout-section">
    <?php $this->load->view('checkout/index2',$this->data);?>
    <div class="col-sm-12">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center bg-success">
            <div class=" ">
              <h1>Success!</h1>
              <span class="alerticon"><i class="fa fa-check-circle fa-5x complete-icon"></i></span>
              <p>Thanks so much for your message. We check e-mail frequently and will try our best to respond to your inquiry.</p>
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
