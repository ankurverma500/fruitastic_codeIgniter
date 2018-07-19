<style>
.alert-minimalist {
	background-color: rgb(241, 242, 240);
	border-color: rgba(149, 149, 149, 0.3);
	border-radius: 3px;
	color: rgb(149, 149, 149);
	padding: 10px;
}
.alert-minimalist > [data-notify="icon"] {
	height: 50px;
	margin-right: 12px;
}
.alert-minimalist > [data-notify="title"] {
	color: rgb(51, 51, 51);
	display: block;
	font-weight: bold;
	margin-bottom: 5px;
}
.alert-minimalist > [data-notify="message"] {
	font-size: 80%;
}
</style>
<link href="<?php echo base_url(); ?>assets/js/notify/notify_css.css" rel="stylesheet" type="text/css"/>
<!----notify Start---->
<script  src="<?php echo base_url('assets/js/notify/bootstrap-notify.js')?>"></script>
<script  src="<?php echo base_url('assets/js/notify/notify_core.js')?>"></script>
<!----notify End---->


<?php

$data=array('message_type'=>'success',
				'title'=>'<strong>SACHIN</strong>',
				'message'=>'hi there some changes',
				'icon'=>'fa fa-paw'				
				);
 // $this->session->set_flashdata('notify', $data);

  $notify = $this->session->flashdata('notify');
  if($notify['message_type'] !="" )
  {
?>
<script>
$.notify({
			<?php if($notify['icon']!=''){echo "icon: '".$notify['icon']."',";}?>
			title: "<?php echo $notify['title']?>",
			message:"<?php echo $notify['message']?>",
			type: "<?php echo $notify['message_type']?>",
			target: '_blank'
			},{
			delay: 1000,
			animate: {
				enter: 'animated fadeInRight',
				exit: 'animated fadeOutRight'
			}
	});
	
</script>
<?php } ?>