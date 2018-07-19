<div class="container">
  <div class="row checkout-section">
    <?php $this->load->view('checkout/index2',$this->data);?>
    <div class="col-sm-8">
      <div class="row">
        <?php $this->load->view('payment/index');?>
      </div>
    </div>
    <div class="col-sm-4">
      <?php $this->load->view('checkout/order_summary');?>
    </div>
  </div>
</div>
<script>
/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>