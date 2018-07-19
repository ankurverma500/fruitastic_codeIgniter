<?php 
$rec_order=get_order_run_detail_by_session($order_id,$this->added_by,'fornightly');		
$run_detail_id=$rec_order['run_detail_id'];
$run_day=$rec_order['run_day'];
$run_date=$rec_order['run_date'];
//$zip_code=$rec_order['zip_code'];
//$zip_code=$this->session->userdata('zip_code');
//$array=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunadey'); 
$array=get_day_name();
$run_exist=0;
$myDate = $this->currentAddDate;
$counter=8;
$tomorrow_date=date('Y-m-d',date(strtotime("+1 day", strtotime($myDate))));
for($i=1;$i<$counter;$i++)
{	 
	$newdate=date('Y-m-d',date(strtotime("+".$i." day", strtotime($myDate))));
	//$this->currentAdd_time > date('H:i:s',strtotime(time('15:00:00')))
	if( ($tomorrow_date==$newdate) &&  strtotime($this->currentAdd_time) > strtotime('15:00:00') ) 
	{
		$counter++;
		continue;
	}
	// date('Y-m-d', strtotime("next ".$row->run_day, strtotime($newdate)));
	//$current_day_name1=date('l',strtotime( $newdate ));	
	$current_day_name=date('l',strtotime( $newdate ));	
			$checked='';
			if(in_array($current_day_name,$run_day))
			{
				$checked=' checked="checked" ';
			}
			
			 $comment1=array('table'=>'tbl_run_detail as trd',
								'val'=>'*,trd.id as run_detail_id,(SELECT `name` FROM `tbl_working_shift` WHERE id=trd.shift) as shift_name',
								'where'=>array('trd.deleted'=>'0','trd.status'=>'1','trz.zip_code'=>$zip_code,'trd.run_day'=>$current_day_name,'trd.run_date'=>$newdate),
								//,'trz.max_deliveries<'=>'trz.total_deliveries'
								//  ,'trz.max_deliveries < trz.total_deliveries'
								'minvalue'=>'',
								'group_by'=>'trd.shift,trd.run_day,trd.run_date',//trd.id,
								'start'=>'',
								'orderby'=>'trd.id',
								'orderas'=>'DESC');	
				$multijoin1=array(
							array('table'=>'tbl_run_zip as trz','on'=>'trz.run_id=trd.tbl_run_id AND trz.status=1','join_type'=>'right')           
					); 
			$this->db->where('trd.max_deliveries > trd.total_deliveries');        
			$all_run_day=$this->common->multijoin($comment1,$multijoin1);
			/*echo '<pre>';
			print_r($all_run_day);
			echo $this->db->last_query();
			exit;*/
			if($all_run_day['res'])
			{	
			?>
			<div class="col-sm-4" style="height: auto;   margin-left: 0px !important;">
				<div class="checkbox" style="padding-bottom: 0px !important; ">
				  <input id="<?php echo $current_day_name.'_'.$newdate;?>" run_date="<?php echo $newdate;?>" run_day="<?php echo $current_day_name;?>" type="checkbox" <?php echo $checked;?> class="day_name_hedding_fortnight">
				  <label for="<?php echo $current_day_name.'_'.$newdate;?>">
				  <h5 class="days" style="margin-top: 0px;"><?php echo $current_day_name.' - '.$newdate;?></h5>
				  </label>
				 </div>
				  <?php	
				 
			foreach($all_run_day['rows'] as $mn)
			{
			
				$checked='';
				if(in_array($mn->run_detail_id,$run_detail_id))
				{
					$checked=' checked="checked" ';
				}	
							
			  ?>
		  <div class="radio " style="margin-left: 20px;">
			<input type="radio" <?php echo $checked;?> class="day_name_class_fortnight" run_detail_id="<?php echo $mn->run_detail_id?>" name="<?php echo $current_day_name?>" tbl_run_id="<?php echo $mn->tbl_run_id?>" id="<?php echo $current_day_name.'_'.$mn->run_detail_id?>" run_date="<?php echo $mn->run_date;?>"  run_day="<?php echo $current_day_name;?>" />
			<label for="<?php echo $current_day_name.'_'.$mn->run_detail_id?>">
			<?php 
			echo $mn->shift_name;
			echo $mn->shift_name=='AM'?'(8am - 12pm)':'(12pm - 4pm)';
			
			//echo $mn->run_name.' '.$mn->shift_name.' '.$mn->run_date?>
			</label>
		  </div>
		  <?php 				  
		  }
		  ?>
			<div class="warning text-danger"></div>           
	  </div>
			<?php
			}
}

?>
<script type="text/javascript">
$(".day_name_class_fortnight").on('click',function(){
	//var perent_div_id=
	var order_run_type=$(".delivery_day_radio:checked").val();
	var run_day=$(this).attr('run_day');
	var run_date=$(this).attr('run_date');
	var run_detail_id=$(this).attr('run_detail_id');
	var tbl_run_id=$(this).attr('tbl_run_id');
	if($(this).is(":checked")) 
	{
		$("#"+run_day+'_'+run_date).prop("checked",true);
	}
	else
	{
		$("#"+run_day).prop("checked",false);
	}
	$('.checkout_btn_div').css('display','block');
	//alert('in');
	var fortnight=1;
	var customer_id='<?php echo $customer_id;?>';
	var order_id='<?php echo $order_id;?>';
	var send_url="<?php echo base_url("add_order_session/add_order_run_recuring");?>";	
	var data_array={fortnight:fortnight,order_id:order_id,customer_id:customer_id,run_detail_id:run_detail_id,run_day_name:run_day,run_date:run_date,tbl_run_id:tbl_run_id,order_run_type:order_run_type};
	send_ajax1(send_url,data_array);
});

			
$(".day_name_hedding_fortnight").on('click',function(){
	var order_run_type=$(".delivery_day_radio:checked").val();
	var run_day=$(this).attr('run_day');
	var run_date=$(this).attr('run_date');
	if($(this).is(":checked")) 
	{
		//$("input:radio[name='"+id+"']").prop("checked",true);
	}
	else
	{	
		/*alert($('.day_name_hedding:checkbox').length);
		if($('.day_name_hedding_fortnight:checkbox').length<1)
		{
			$('.checkout_btn_div').css('display','none');
		}*/	
		var run_detail_id='';
		var customer_id='<?php echo $customer_id;?>';
		var order_id='<?php echo $order_id;?>';
		var send_url="<?php echo base_url("add_order_session/delete_order_run/");?>";	
		var data_array={run_date:run_date,order_id:order_id,customer_id:customer_id,run_detail_id:run_detail_id,run_day_name:run_day,order_run_type:order_run_type};
		//alert(id);
		send_ajax1(send_url,data_array);
		//$("input:radio[name='"+run_day+"']").prop("checked",false);
		$(this).parent('div .checkbox').siblings('div .radio').children('.day_name_class_fortnight').prop("checked",false);
	}
});
				
</script>