<?php
/*
### Admin Model made by Chandan Chandan Kumar 
*/
class Admin extends MY_Model 
{
	protected $_table_name = 'customer';
	//protected $_order_by = 'id';
	//protected static $db_fields = array('id', 'admin_group_id','wearhouse_id','employee_id','user_id', 'name','last_name','username','password','emailid','contact','status','deleted','added_date','modify_date','added_by','modify_by','contact2','address','profile_image');
	protected static $db_fields = array('id', 'customer_id', 'customer_type', 'customer_type_id', 'name', 'last_name', 'email', 'username', 'password', 'primary_contact_name', 'contact', 'contact2', 'status', 'payment_gateway_status', 'payment_option', 'deleted', 'added_date', 'modify_date', 'added_by', 'modify_by', 'api_token', 'eway_custid', 'TokenCustomerID', 'TokenCustomerBillID', 'promo_discount'); 
	public $id;
	public $admin_group_id;
	public $wearhouse_id;
	public $employee_id;
	public $user_id;
	public $name;
	public $last_name; 
	public $username;
	public $password;
	public $emailid;
	public $contact;
	public $status;
	public $deleted;
	public $added_date;
	public $modify_date;
	public $added_by;
	public $modify_by; 	
	public $contact2;
	public $address;
	public $profile_image;
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->helper('common');
		$this->load->model('common');
	}	
	/***** Check admin login ****/
	public function login()
	{		
		$user = $this->get_by(array(
			'username' => $this->input->post('username'),
			'password' => $this->hash($this->input->post('password')),
			'customer_type_from_id'=>'1',
			'status'=>1
			), TRUE);
		//echo '<pre>';
		//print_r($user);
		//print_r($_POST);
		//exit;
		if(count($user))
		{
			
			$da1=array('val'=>'*',
					   'table'=>'tbl_customer_address',
					   'where'=>array('customer_id'=>$user->id)
					  );
			$qry_user=$this->common->getdata($da1);
			
			if($qry_user['res'])
			{
				if($qry_user['rows'][0]->zip_code!='')
				{
					$this->session->set_userdata('run_post_code',$qry_user['rows'][0]->zip_code);
					$this->session->set_userdata('run_post_code_with_address',$qry_user['rows'][0]->formated_address);
				}
				/*else if(isset($qry_user['rows'][1]->zip_code) && $qry_user['rows'][1]->zip_code!='')
				{
					$this->session->set_userdata('run_post_code',$qry_user['rows'][1]->zip_code);
					$this->session->set_userdata('run_post_code_with_address',$qry_user['rows'][1]->formated_address);
				}*/				
			}
			
			
			$data['api_token']		=	get_login_api_token();
			$this->db->where('id', $user->id);
			$this->db->update($this->_table_name ,$data);	
			/*User Exists Logg him in*/
			$data = array(				
				'id' 				=> $user->id,
				'loggedin' 			=> TRUE,
				'name'				=> $user->name,
				'username'			=> $user->username,
				'payment_option'	=> $user->payment_option,
				'customer_type'	    => $user->customer_type,
				'customer_type_id'	=> $user->customer_type_id,
				'api_token'	    	=> $data['api_token'],
				/*'profile_image'	=> $user->profile_image,*/
				'loggedin_time'	=> time()
				);	
			//print_r($qry_user);
			//exit;		
			$this->session->set_userdata('admin_login', serialize($data));
			return true;
		}
		else
		{
			return false;
		}
	}
	/*** Edit profile method ***/
	public function updateUser($id=null){
		$data = $this->array_from_post(self::$db_fields);
		//unset($data['email']);
		$config['upload_path']          = './uploads/profile/';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if($this->upload->do_upload('profile_image')!=''){
			if($image_data = $this->upload->data()){
					$data['profile_image']	=	$image_data['file_name'];
			}
		}
		$this->db->where('id', $id);
		return	$this->db->update($this->_table_name ,$data);		
	}
	/****** update password ********/
	function updatePassword($admin_id=null){
		$data['password']		=	$this->hash($this->input->post('password'));
		$this->db->where('id', $admin_id);
		return	$this->db->update($this->_table_name ,$data);
	}
	/****** match old password ********/
	function matchOldPassword($admin_id=null){
		$user = $this->get_by(array(
			'id' => $admin_id,
			'password' => $this->hash($this->input->post('oldpassword')),
			), TRUE);
		//print_r($user);die("test");	
		if(count($user))
			return false;
		else 
			return true;	
	}
	/*** logout method */
	public function logout(){
		$this->load->library('cart');
		$this->session->unset_userdata('admin_login');
		$this->session->unset_userdata('run_post_code');
		$this->session->unset_userdata('run_detail');
		$this->session->unset_userdata('discount');
		$this->cart->destroy();
	}

	/***** Function for Checking a User is logged in or Not ****/
	public function loggedin(){
		$sess = $this->session->userdata('admin_login');
		$ar = unserialize($sess);
		return (bool) $ar['loggedin'];
	}
	/****** Save Evaluator *******/
	public function saveEvaluator(){		
		$data = $this->array_from_post(self::$db_fields);
		if($this->input->post('password')=='')
			unset($data['password']);
		else
			$data['password']		=	$this->hash($this->input->post('password'));
		$admin_id	  =	$data['admin_id'];
		if($admin_id){
			$data['status'] 		=	$this->input->post('status');
			$data['modified_on']	=	date('Y-m-d:H:i:s');		
			$this->db->where('admin_id', $admin_id);
			if($this->db->update($this->_table_name ,$data)){
				return true;
			}			
		} else {
			$insert_id	=	'';
			$data['status'] 		=	$this->input->post('status');
			$data['created_on']	=	date('Y-m-d:H:i:s');			
			if($this->db->insert($this->_table_name ,$data)){
				return true;
			}
		}
	}
	/****** update status Evaluator *******/
	public function updateStatusEvaluator($admin_id,$status=0){
		if($status==true)
			$data['status']	=	0;
		else
			$data['status']	=	1;
		$this->db->where('admin_id', $admin_id);
		return $this->db->update($this->_table_name ,$data);	
	}
	/****** get all Evaluators *******/
	public function getAllEvaluators($start=0,$limit=0,$q=null,$status=null){
		if($q){
			$this->db->like("first_name",$q);
			$this->db->or_like("last_name",$q);
			$this->db->or_like("email",$q);
		}
		if($status)
			$this->db->where('status',$status);
		$this->db->order_by("id", "desc");
		$this->db->where('user_type',2);//2 means Evaluator
		if($limit)
			$result = $this->get_limit($limit,$start);
		else
			$result = $this->get_all();
		return $result;
	}
	/*** Function for Hashing a Password ****/
	public function hash($string){
		return md5($string);//hash('sha512', $string . config_item('encryption_key'));
	}
	/****** get by login user details *******/
	public function getLoginUser($id) {
		if($id) {
			$query = $this->db->get_where($this->_table_name, array('id' => $id));
			return $query->row_object();
		}else {
			return false;
		}
	}
	/*** access module permission for evaluator ****/
	function access_module_permission($search_query){
		if($search_query){
			foreach($search_query as $key=>$val){
				$this->db->where($key,$val);
			}
		}
		return $this->db->get($this->_table_access_module_permission)->row_object();
	}
	/*** access module permission for evaluator ****/
	public function getadmin_id($id=null){		
		if($id)
		{
			$where['id']	=	$id;
			$query = $this->db->get_where($this->_table_name, $where);
			return $query->row_object();			
		}
		else
		{
			$this->db->order_by("id", "desc");
		$result = $this->db->get($this->_table_name)->result();
		return $result;
		}
	}
	/*** get all users***/
	/****** Save in admin *******/
	public function save_admin(){
		
		$data = $this->array_from_post(self::$db_fields);
		//print_r($data);
		//die;
		$data['contact2']	= $this->input->post('contact2');
		$data['password']	= $this->hash($this->input->post('password'));
		/*if($this->input->post('admin_group_id')==1)
		{
		}
		elseif($this->input->post('admin_group_id')==2)
		{
		}
		elseif($this->input->post('admin_group_id')==3)
		{
		}
		elseif($this->input->post('admin_group_id')==4)
		{
		}
		elseif($this->input->post('admin_group_id')==5)
		{
			print_r($this->input->post('wearhouse_id'));
		}
		elseif($this->input->post('admin_group_id')==6)
		{
		}
		elseif($this->input->post('admin_group_id')==7)
		{
			
		}*/
		if(is_array ($_POST['wearhouse_id']))
		{
			$data['wearhouse_id']=implode(',',$_POST['wearhouse_id']);
		}
		else
		{
			$data['wearhouse_id']=$_POST['wearhouse_id'];
		}
		//print_r($data['wearhouse_id']);
		//exit;
		
		
		/*echo '<pre>';
		print_r($data);
		echo 'Ooops Sorry !, this url is under counstructions';
		exit;*/
        $id	  =	$data['id'];
        //echo $id;die("dsdsd");		
		$sess 	= 	$this->session->userdata('admin_login');
		$ar 	= 	unserialize($sess);
		$admin_id	=  $ar['id'];
		$config['upload_path']          = './uploads/profile/';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if($this->upload->do_upload('profile_image')!='')
		{
			if($image_data = $this->upload->data())
			{
					$data['profile_image']	=	$image_data['file_name'];
			}
		}
		//$data['added_date']	=	date('Y-m-d:H:i:s');
		
		if($id)
		{
			unset($data['password']);
			$not_data=array('note_to_tbl_name'=>'tbl_admin',
							'note_to_id'=>'1',
							'note_from_tbl_name'=>'tbl_admin',
							'note_from_id'=>$id, 
							'note_titel'=>'User hase been updated',
							'note_detail'=>'User hase been updated id:- '.$data['user_id'],
							'page_link'=>'admin/user/add/'.$id,
							'icon'=>'USER'
							);
			$this->notification->set($not_data);
			$data['modify_by'] = $admin_id;
			$data['modify_date']	=	date('Y-m-d:H:i:s');
			$this->db->where('id', $id);
			return	$this->db->update($this->_table_name ,$data);			
		} 
		else 
		{
			if($this->input->post('password')!='')
			{
				//$data_c['password']=
				$data['password']=md5($this->input->post('password'));
				//exit;
			}
			$data['added_by'] = $admin_id;
			$data['added_date'] = CURRENT_TIMESTAMP;//date('Y-m-d:H:i:s');
			$this->db->insert($this->_table_name ,$data);
			$id  = $this->db->insert_id();
			/*echo $this->db->last_query();
			echo $wearhouse_id;
			die;*/
			$data['user_id'] = "W".implode('_',$_POST['wearhouse_id'])."U".$id;
			$not_data=array('note_to_tbl_name'=>'tbl_admin',
							'note_to_id'=>'1',
							'note_from_tbl_name'=>'tbl_admin',
							'note_from_id'=>$id, 
							'note_titel'=>'User hase been Created',
							'note_detail'=>'User hase been Created id:- '.$data['user_id'],
							'page_link'=>'admin/user/add/'.$id,
							'icon'=>'USER'
							);
			$this->notification->set($not_data);
			$this->db->where('id',$id);
			return $this->db->update($this->_table_name,$data);
		}
			
	}
	public function getAlluser($start=0,$limit=0,$q=null,$status=null,$select=null){
		$this->db->where('deleted', 0);
		//$this->db->where('admin_group_id!=', 6);
		$this->db->order_by("id", "desc");
		$result = $this->db->get($this->_table_name)->result();
		return $result;
	}
	/****** update status in admin *******/
	public function update_admin($id,$status){
		if($status==0)
		{	
			$data['status']	=	0;
		    $msg = "Deactive";
		}
		else
		{
			$data['status']	=	1;
			$msg = "Active";
		}		    
		$this->db->where('id', $id);
		$this->db->update($this->_table_name ,$data);
        return $msg;	
	}
	/*** Delete Admin ***/
	public function delete_admin($id,$delete=0){
		if($status==true)
			$data['deleted']	=	0;
		else
			$data['deleted']	=	1;
		$this->db->where('id', $id);
		return $this->db->update($this->_table_name ,$data);	
	}
	public function getAllemployee_export($headers = TRUE){
		
		$this->db->where('deleted', 0);		
		$query = $this->db->get($this->_table_name);
		if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
		{
			show_error('invalid query');
		}
		date_default_timezone_set('Australia/Sydney');
		$date = date('Y-m-d H:i:s');
		$download = "Employee".$date.".csv";
		
		$array = array();
		
		if ($headers)
		{
			$line = array();
			foreach ($query->list_fields() as $name)
			{
				$line[] = $name;
			}
			$array[] = $line;
		}
		
		foreach ($query->result_array() as $row)
		{
			$line = array();
			foreach ($row as $item)
			{
				$line[] = $item;
			}
			$array[] = $line;
		}
		
		if ($download != "")
		{	
			header('Content-Type: application/csv');
			header('Content-Disposition: attachement; filename="' . $download . '"');
		}		

		ob_start();
		$f = fopen('php://output', 'w') or show_error("Can't open php://output");
		$n = 0;		
		foreach ($array as $line)
		{
			$n++;
			if ( ! fputcsv($f, $line))
			{
				show_error("Can't write line $n: $line");
			}
		}
		fclose($f) or show_error("Can't close php://output");
		$str = ob_get_contents();
		//print_r($str);
		
		//ob_end_clean();

			return $str;	
			
		
	}

}
?>