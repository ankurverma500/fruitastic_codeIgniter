

<section class="top_slider">
<!-- top_slider start-->
<?php $this->load->view('templates/pages/top_menu');?>

<?php if($con=='home'){?> <?php }?>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators  hidden-xs">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    
    <div class="item active">
      <img src="<?php echo base_url_assets;?>images/Fruitastic-Home-Banner.jpg" alt="#">
          <div class="carousel-caption">
                <figure class="animated fadeInDown go">
                <img src="<?php echo base_url_assets;?>images/banner_logo.png" alt="#">
                </figure>
          		<p class="animated fadeInDown go banner_slogan hidden-xs">as fresh as it gets </p>
                <a href="<?php echo base_url('product');?>" class="now_btn animated fadeInUp go cus-btn">Shop Now</a>
          </div>
        </div>

    <div class="item">
      <img src="<?php echo base_url_assets;?>images/BREAD-EGGS-FRUIT-WE-HAVE-IT-COVERED.jpg" alt="#">
          <div class="carousel-caption">
          		<h1 class="animated fadeInDown go second_banner_content">not just fruit and veg </h1>
          </div>
        </div>

    <div class="item">
      <img src="<?php echo base_url_assets;?>images/KITCHEN-FUN-BANNER.jpg" alt="#">
          <div class="carousel-caption">
          		<h1 class="animated fadeInDown go second_banner_content">more time to get creative </h1>
          </div>
        </div>
    </div>
  </div>

<!--<input type="hidden" name="from_url" value="<?php echo $con.'/'.$method;?>" >-->
</section><!-- top_slider end--> 

  <?php $this->load->view('templates/pages/headers_popups');?>



 
    

    
   
	
  