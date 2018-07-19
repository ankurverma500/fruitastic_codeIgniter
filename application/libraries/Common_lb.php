<?php
class Common_lb {
    
    public function __construct()
    {
           		
    }
        
   function get_post_code_of_run_helper($post_code,$order_id=null,$customer_id=null)
	{
		$cur_date=date('Y-m-d',date(strtotime("+1 day", strtotime(date('Y-m-d')))));
        $this->ci =& get_instance();
		$this->ci->load->model('common');
		
        
		$comment1=array('table'=>'tbl_run_detail as trd',
						'val'=>'*,trd.id as run_detail_id
						,(SELECT `name` FROM `tbl_working_shift` WHERE id=trd.shift) as shift_name 
						',
						//,	(SELECT count(*) FROM `tbl_recurring_order` WHERE `order_id`='.$order_id.' AND  `customer_id`='.$customer_id.' AND `run_detail_id`=trd.id ) as recorder_exists
						'where'=>array('trd.deleted'=>'0','trd.status'=>'1','trz.zip_code'=>$post_code),
						//'trz.max_deliveries < trz.total_deliveries'
						'minvalue'=>'',
						'group_by'=>'trd.id',
						'start'=>'',
						'orderby'=>'trd.run_date',
						'orderas'=>'DESC');	
				$multijoin1=array(
					array('table'=>'tbl_run_zip as trz','on'=>'trz.run_id=trd.tbl_run_id AND trz.status=1','join_type'=>'left')           
					);
		//,
		if(date('H')>='15:00')
		{
			$this->ci->db->where('trd.run_date>',date('Y-m-d',date(strtotime("+1 day", strtotime($cur_date)))));
		}
		else
		{
			$this->ci->db->where('trd.run_date>',$cur_date);
		}
		  $all_run_day=$this->ci->common->multijoin($comment1,$multijoin1);
		 echo '<pre>';
		echo $this->ci->db->last_query();
		echo '<hr>in dasdlkajd alksdjlasj';
			print_r($all_run_day);
			exit;
		if($all_run_day['res'])
		{
			echo '<pre>';
			print_r($all_run_day);
			$res='';
			$years='';
			$months='';
			$days='';
			$events='';
			foreach($all_run_day['rows'] as  $rn)
			{
				if($years!=date('Y',strtotime($rn->run_date)))
				{
					$res.='years: [{
						  			int: 2017,';
				}
				if($months!=date('m',strtotime($rn->run_date)))
				{
					$res.=' months: [{
									  int: 12,';
				}
				if($days!=date('d',strtotime($rn->run_date)))
				{
					$res.=' days: [{
									int: 28,';
				}
				'years: [{
						  int: 2017,
						  months: [{
									  int: 12,
									  days: [{
											  int: 28,
											  events: [{
													  startTime: "6:00",
													  endTime: "6:30",
													  mTime: "pm",
													  text: "Weirdo was born"
													}]
											}]
									}]
							 }]';
			}
		}
				
	}
}