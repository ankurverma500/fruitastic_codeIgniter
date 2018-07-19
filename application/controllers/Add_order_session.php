<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_order_session extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
		
	}
	
	function add_order_run_recuring()
	{
		$order_id=$this->input->post("order_id");
		$customer_id=$this->input->post("customer_id");
		$order_run_type=$this->input->post("order_run_type");
		$run_detail_id=$this->input->post("run_detail_id");
		$tbl_run_id=$this->input->post("tbl_run_id");
		$run_day_name=$this->input->post("run_day_name");
		$run_date=$this->input->post("run_date");
		$fortnight=$this->input->post("fortnight");
		//fortnight		
		$admin_id	= $this->added_by;
		if($this->session->userdata('run_detail'))
		{
			$run_detail=$this->session->userdata('run_detail');
			if($run_detail['run_type']==$order_run_type)
			{
				if(in_array($run_day_name, array_column($run_detail['run'], 'run_day_name')))
				{//in_array($run_day_name,$run_detail['run']['run_day_name'])
					
					if(in_array($run_detail_id, array_column($run_detail['run'], 'run_detail_id')))
					{
						//in_array($run_detail_id,$run_detail['run']['run_detail_id'])
					}
					else
					{//echo json_encode($run_day_name);
						$run=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);	
						$run_detail['run'][array_search($run_day_name, array_column($run_detail['run'], 'run_day_name'))]=$run;
						$this->session->set_userdata('run_detail',$run_detail );
					}
					
				}
				else
				{
					$run=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);	
					//array_push($run_detail['run'],$run);
					//$this->session->set_userdata('run_detail',$run_detail );
					if(is_array($run_detail['run']))
					{
						array_push($run_detail['run'],$run);
						$this->session->set_userdata('run_detail',$run_detail );
					}
					else
					{
						$run_detail['run'][]=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);
						$this->session->set_userdata('run_detail',$run_detail );
					}
				}
			}
			else
			{
				unset($_SESSION['run_detail']);
				$this->session->unset_userdata('run_detail');
				$run[]=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);			
				$this->session->set_userdata('run_detail', array('run_type'=>$order_run_type,'run'=>$run));
			}
		}
		else
		{
			$run[]=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);			
			$this->session->set_userdata('run_detail', array('run_type'=>$order_run_type,'run'=>$run));
		}
		//echo json_encode('success');
	}
	
	function delete_order_run()
	{
		$order_id=$this->input->post("order_id");
		$customer_id=$this->input->post("customer_id");
		$order_run_type=$this->input->post("order_run_type");
		$run_detail_id=$this->input->post("run_detail_id");
		$run_day_name=$this->input->post("run_day_name");
		$run_date=$this->input->post("run_date");
		$this->currentAddDate;
		$this->currentAddDate_time;
		if($this->session->userdata('run_detail'))
		{
			$run_detail=$this->session->userdata('run_detail');
			
			if($run_detail['run_type']==$order_run_type)
			{
				//print_r(json_encode($_POST));
				//echo json_encode(in_array($run_day_name,$run_detail['run']['run_day_name'],true));
				//print_r(json_encode($run_detail));
				 $data=array();
				$j=0;
				foreach($run_detail['run'] as $rec_order)
				{
					if($run_day_name!=$rec_order['run_day_name']){
					/*$data['run_detail_id'][$j]=$rec_order['run_detail_id'];
					$data['run_day'][$j]=$rec_order['run_day_name'];
					$data['run_date'][$j]=$rec_order['run_date'];	*/
					
					$run[$j]=array('run_detail_id'=>$rec_order['run_detail_id'],'run_date'=>$rec_order['run_date'],'run_day_name'=>$rec_order['run_day_name']);
					$j++;
					}
				}
				$this->session->set_userdata('run_detail', array('run_type'=>$order_run_type,'run'=>$run));
			}
			else
			{
				//unset($_SESSION['run_detail']);
				//$this->session->unset_userdata('run_detail');
				//$run[]=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);			
				//$this->session->set_userdata('run_detail', array('run_type'=>'2','run'=>$run));
			}
		}
		else
		{
			//$run[]=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);			
			//$this->session->set_userdata('run_detail', array('run_type'=>'2','run'=>$run));
		}
		echo json_encode('success');
	}
}