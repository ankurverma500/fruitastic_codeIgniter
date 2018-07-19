<?php
class Notification 
{
    public $currentAddDate=0;
	public $currentAddDate_time=0;
	public $currentAdd_time=0;
    public function __construct()
    {
		//parent::__construct();		 
		$this->ci =& get_instance();
		$this->ci->load->model('common');
		$this->currentAddDate = date('Y-m-d');
		$this->currentAddDate_time = date('Y-m-d H:i:s');
		$this->currentAdd_time = date('H:i:s');
		//date_default_timezone_set('Asia/Kolkata');
		//date_default_timezone_set('Australia/Melbourne');		
    }
        
    public function get($data=null)
	{
		//$this->notification->get();		
		/*
		SELECT 'id'=>'', 
		'note_to_tbl_name'=>'', 
		'note_to_id'=>'', 
		'note_from_tbl_name'=>'', 
		'note_from_id'=>'', 
		'note_titel'=>'', 
		'note_detail'=>'', 
		'view_status'=>'', 
		'view_datetime'=>'', 
		'send_datetime'=>'', 
		'deleted'=>'', 
		'status'=>'' 
		FROM `tbl_notification` WHERE 1
		*/
		$da=array('val'=>'*',
				  'table'=>'tbl_notification',
				  'where'=>array('note_to_tbl_name'=>$data['note_to_tbl_name'], 
								 'note_to_id'=>$data['note_to_id'],
								 'view_status'=>$data['view_status'])
				  );
       return $payment_options=$this->ci->common->getdata($da);
		//print_r($payment_options);
		//exit;
	}
	public function get_new($data=null)
	{
		$da=array('val'=>'*',
				  'table'=>'tbl_notification',
				  'where'=>array('note_to_tbl_name'=>$data['note_to_tbl_name'], 
								 'note_to_id'=>$data['note_to_id'],'view_status'=>'0')
				  );
       return $payment_options=$this->ci->common->getdata($da);
		//print_r($payment_options);
		//exit;
	}
	public function set_viewed($data=null)
	{
		//$this->notification->set();
		$da=array('val'=>array(  
								'view_status'=>'1', 
								'view_datetime'=>$this->currentAddDate_time),
				  'table'=>'tbl_notification',
				  'where'=>array('note_from_tbl_name'=>$data['note_from_tbl_name'],
				  				 'note_from_id'=>$data['note_from_id'],
								 'note_to_tbl_name'=>$data['note_to_tbl_name'], 
								 'note_to_id'=>$data['note_to_id'])
				  );
       	$payment_options=$this->ci->common->update_data($da);	
	}
	public function set_viewed_all($data=null)
	{
		//$this->notification->set();
		$da=array('val'=>array(  
								'view_status'=>'1', 
								'view_datetime'=>$this->currentAddDate_time),
				  'table'=>'tbl_notification',
				  'where'=>array('note_to_tbl_name'=>$data['note_to_tbl_name'], 
								 'note_to_id'=>$data['note_to_id']
								 /*,'note_from_tbl_name'=>'tbl_admin','note_from_id'=>$id*/)
				  );
       	$payment_options=$this->ci->common->update_data($da);	
	}
		
	public function set($data=null)
	{
		/*$data=array('note_to_tbl_name'=>'',
					'note_to_id'=>'', 
					'note_from_tbl_name'=>'', 
					'note_from_id'=>'', 
					'note_titel'=>'',
					'note_detail'=>'',
					'page_link'=>'',
					'view_status'=>'0', 
					'view_datetime'=>'',
					'id'=>'' 
					);*/
		//$this->notification->set($data);		
								
		$da=array('val'=>array('note_to_tbl_name'=>$data['note_to_tbl_name'], 
								'note_to_id'=>$data['note_to_id'], 
								'note_from_tbl_name'=>$data['note_from_tbl_name'], 
								'note_from_id'=>$data['note_from_id'], 
								'note_titel'=>$data['note_titel'], 
								'note_detail'=>$data['note_detail'],
								'page_link'=>$data['page_link'],
								'icon'=>$data['icon'],
								/*'view_status'=>$data['view_status'], 
								'view_datetime'=>$data['view_datetime'], */
								'send_datetime'=>$this->currentAddDate_time, 
								'deleted'=>0, 
								'status'=>1),
				  'table'=>'tbl_notification',
				  'where'=>array('status'=>'')
				  );
       	$payment_options=$this->ci->common->add_data($da);		
	}
	
	public function update($data=null)
	{
		//$this->notification->set();
		$da=array('val'=>array( 'note_to_tbl_name'=>$data['note_to_tbl_name'], 
								'note_to_id'=>$data['note_to_id'], 
								'note_from_tbl_name'=>$data['note_from_tbl_name'], 
								'note_from_id'=>$data['note_from_id'], 
								'note_titel'=>$data['note_titel'], 
								'note_detail'=>$data['note_detail'],
								'page_link'=>$data['page_link'], 
								'view_status'=>$data['view_status'], 
								'view_datetime'=>$data['view_datetime']),
				  'table'=>'tbl_notification',
				  'where'=>array('id'=>$data['id'])
				  );
       	$payment_options=$this->ci->common->update_data($da);		
	}
}