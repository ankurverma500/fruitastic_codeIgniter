<?php


// Include RapidAPI Library
//require('../../lib/eWAY/RapidAPI.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>eWAY Rapid Responsive Shared Page</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>  
    <style>
  .loader{ position: fixed; background: #ff6d6d; left: 0px; right: 0px; bottom: 0px; top: 0px; color:#FFF; padding: 10%; margin:auto;}
  .sk-folding-cube {margin: 20px auto; width: 40px; height: 40px; position: relative; -webkit-transform: rotateZ(45deg); transform: rotateZ(45deg);margin-bottom: 60px;}
	.sk-folding-cube .sk-cube { float: left; width: 50%; height: 50%; position: relative; -webkit-transform: scale(1.1); -ms-transform: scale(1.1);          transform: scale(1.1); }
	.sk-folding-cube .sk-cube:before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #fff; -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both; animation: sk-foldCubeAngle 2.4s infinite linear both; -webkit-transform-origin: 100% 100%;      -ms-transform-origin: 100% 100%; transform-origin: 100% 100%;}
	.sk-folding-cube .sk-cube2 { -webkit-transform: scale(1.1) rotateZ(90deg); transform: scale(1.1) rotateZ(90deg);}
	.sk-folding-cube .sk-cube3 { -webkit-transform: scale(1.1) rotateZ(180deg); transform: scale(1.1) rotateZ(180deg);}
	.sk-folding-cube .sk-cube4 { -webkit-transform: scale(1.1) rotateZ(270deg); transform: scale(1.1) rotateZ(270deg);}
	.sk-folding-cube .sk-cube2:before {-webkit-animation-delay: 0.3s; animation-delay: 0.3s;}
	.sk-folding-cube .sk-cube3:before {-webkit-animation-delay: 0.6s; animation-delay: 0.6s; }
	.sk-folding-cube .sk-cube4:before { -webkit-animation-delay: 0.9s; animation-delay: 0.9s;}
@-webkit-keyframes sk-foldCubeAngle {
  	0%, 10% { -webkit-transform: perspective(140px) rotateX(-180deg); transform: perspective(140px) rotateX(-180deg); opacity: 0; } 
  	25%, 75% { -webkit-transform: perspective(140px) rotateX(0deg); transform: perspective(140px) rotateX(0deg); opacity: 1; } 
  	90%, 100% { -webkit-transform: perspective(140px) rotateY(180deg); transform: perspective(140px) rotateY(180deg); opacity: 0; } 
}
@keyframes sk-foldCubeAngle {
  	0%, 10% { -webkit-transform: perspective(140px) rotateX(-180deg); transform: perspective(140px) rotateX(-180deg); opacity: 0; } 
	25%, 75% { -webkit-transform: perspective(140px) rotateX(0deg); transform: perspective(140px) rotateX(0deg); opacity: 1; } 
	90%, 100% { -webkit-transform: perspective(140px) rotateY(180deg); transform: perspective(140px) rotateY(180deg); opacity: 0; }
}
</style>
</head>
<body  >
<div class="loader"> 
<p class="text-center"><img src="<?php echo base_url('assets/image/logo.png'); ?>" style="display:inline-block; width:200px;" /></p>
 <div class="sk-folding-cube">
  <div class="sk-cube1 sk-cube"></div>
  <div class="sk-cube2 sk-cube"></div>
  <div class="sk-cube4 sk-cube"></div>
  <div class="sk-cube3 sk-cube"></div>
 </div>
 <h4 class="text-center">Please wait while your payment is being Processed and</h4> 
 <h4 class="text-center">you will be redirected to the responce page.</h4>
</div>   
    
</body>
</html>