<div class="container">
  <div class="col-sm-12 checkout-section">
    <?php $this->load->view('checkout/index2',$this->data);?>
    <div class="col-sm-12">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center bg-danger">
            <div class=" ">
              <h1 style="color: #a94442;">Fail!</h1>
              <span class="alerticon"> <i  aria-hidden="true" class="fa fa-exclamation-triangle fa-5x"></i> </span>
              <p></p>
              <p>
                <?php //echo 'Your order id is :- '.$this->session->userdata('total_order_array');?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    < </div>
</div>
<script>
/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script> 
