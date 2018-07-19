<?php
/*
### Warehouse model made by Chandan
###
*/
class Customer_model extends MY_Model {
	protected $_table_name = 'tbl_customer';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'customer_id', 'customer_type', 'name','last_name','email','primary_contact_name','contact', 'contact2', 'address', 'status', 'deleted', 'added_date', 'modify_date','promo_discount', 'added_by', 'modify_by','payment_option');
	
	protected $_table_name_c = 'tbl_customer_address';
	protected $_table_name_c1 = 'tbl_customer_type';
	protected $_order_by_c = 'id';
	
	
	public $id;
	public $customer_id;
	public $customer_type;
	public $name;
	public $last_name;
	public $email;
	public $primary_contact_name;	
	public $contact;
	public $contact2;
	public $address;	
	public $status;
	public $deleted;
	public $added_date;
	public $modify_date;
	public $added_by;
	public $modify_by;
	public $payment_option;	
	public function __construct(){
		parent::__construct();
		//$this->load->helper('cookie');
		//$this->load->helper('date');
	}	
	/****** Save in admin *******/
	public function save_admin(){		
		$data = $this->array_from_post(self::$db_fields);
		$customer_type=explode(',',$data['customer_type']);
		$data['customer_type']=$customer_type[1];
		$data['customer_type_id']=$customer_type[0];
		$data['username']=$this->input->post('email');
		if($this->input->post('password')!='')
		{
			//$data_c['password']=
			$data['password']=md5($this->input->post('password'));
		}	
		$id2 = $this->input->post('id2');	
		$billing_apartment_no = $this->input->post('billing_apartment_no');	
		$billing_address = $this->input->post('billing_address');		
		$same_as_billing_adddress = $this->input->post('same_as_bill');
		$delivery_address_Apartment = $this->input->post('delivery_address_Apartment');
        $delivery_address_street_address = $this->input->post('delivery_address_street_address');			
        $id	  =	$this->input->post('id');
		$sess 	= 	$this->session->userdata('admin_login');
		$ar 	= 	unserialize($sess);
		$admin_id	=  $ar['id'];
		
				
		/*echo '<pre>';
		print_r($billing_apartment_no);
		print_r($billing_address);
		exit;*/
		
		
		//print_r($id2);
		//$data['added_date']	=	date('Y-m-d:H:i:s');
		$data['added_by'] = $admin_id;		
		if($id)
		{   		
			$i = 0;
			$counter=0;
			foreach($delivery_address_Apartment as $row)
			{
				if(count($id2) <= $counter)
				{					
					$data_c['id'] = $id2[$counter];	
					//echo $data_c['id'] ;
					// exit;
					if($delivery_address_street_address[$counter]==''){continue;}	
					$data_c['customer_id'] = $id;		
					$data_c['delivery_address_Apartment'] = $delivery_address_Apartment[$counter];
					$data_c['delivery_address_street_address'] = $delivery_address_street_address[$counter];
					$data_c['same_as_billing_adddress'] = $same_as_billing_adddress;
					$data_c['billing_address'] = $billing_address;
					$data_c['billing_apartment_no'] = $billing_apartment_no;
					$r_add_bl=$this->get_google_address_with_detail($billing_apartment_no.' '.$billing_address);
					$r_add_dl=$this->get_google_address_with_detail($delivery_address_Apartment[$counter].' '.$delivery_address_street_address[$counter]);
					
					$data_c['del_apartment']=$delivery_address_Apartment[$counter]; 
					$data_c['formated_address']=$r_add_dl['f_address'];
					$data_c['main_address']=$r_add_dl['main_address'];
					$data_c['main_city']=$r_add_dl['main_city'];
					$data_c['main_state']=$r_add_dl['main_state'];
					$data_c['zip_code']=$r_add_dl['pincode'];
					$data_c['longitude']=$r_add_dl['longitude'];
					$data_c['latitude']=$r_add_dl['latitude'];
						
					$data_c['apartment']=$billing_apartment_no;
					$data_c['billing_main_address']=$r_add_bl['main_address'];
					$data_c['billing_main_city']=$r_add_bl['main_city'];
					$data_c['billing_main_state']=$r_add_bl['main_state'];
					$data_c['billing_zipcode']=$r_add_bl['pincode'];
					
					if($data_c['same_as_billing_adddress']==null)
					{
						$data_c['same_as_billing_adddress']=0;
					}
					//$this->db->where('id',$data_c['id']);
					//echo $this->db->last_query();
					//exit;
					//echo '<pre>';
					//print_r($data_c);
					//echo $this->db->last_query();
					// exit;		
					$this->db->insert($this->_table_name_c ,$data_c);					
					$i++;
						
				}
				else
				{	
				
					//$data_c['id'] = $id2[$i];
					$data_c['delivery_address_Apartment'] = $delivery_address_Apartment[$counter];
					$data_c['delivery_address_street_address'] = $delivery_address_street_address[$counter];
					$data_c['same_as_billing_adddress'] = $same_as_billing_adddress;
					$data_c['billing_address'] = $billing_address;
					$data_c['billing_apartment_no'] = $billing_apartment_no;
					$r_add_bl=$this->get_google_address_with_detail($billing_apartment_no.' '.$billing_address);
					$r_add_dl=$this->get_google_address_with_detail($delivery_address_Apartment[$counter].' '.$delivery_address_street_address[$counter]);
					
					$data_c['del_apartment']=$delivery_address_Apartment[$counter]; 
					$data_c['formated_address']=$r_add_dl['f_address'];
					$data_c['main_address']=$r_add_dl['main_address'];
					$data_c['main_city']=$r_add_dl['main_city'];
					$data_c['main_state']=$r_add_dl['main_state'];
					$data_c['zip_code']=$r_add_dl['pincode'];
					$data_c['longitude']=$r_add_dl['longitude'];
					$data_c['latitude']=$r_add_dl['latitude'];
						
					$data_c['apartment']=$billing_apartment_no;
					$data_c['billing_main_address']=$r_add_bl['main_address'];
					$data_c['billing_main_city']=$r_add_bl['main_city'];
					$data_c['billing_main_state']=$r_add_bl['main_state'];
					$data_c['billing_zipcode']=$r_add_bl['pincode'];
					
					if($data_c['same_as_billing_adddress']==null)
					{
						$data_c['same_as_billing_adddress']=0;
					}
					else if($data_c['same_as_billing_adddress']=='1')
					{
						$data_c['delivery_address_Apartment'] =  $billing_apartment_no;
						$data_c['delivery_address_street_address'] = $billing_address;
						$data_c['del_apartment']=$billing_apartment_no; 
						$data_c['formated_address']=$r_add_bl['f_address'];
						$data_c['main_address']=$r_add_bl['main_address'];
						$data_c['main_city']=$r_add_bl['main_city'];
						$data_c['main_state']=$r_add_bl['main_state'];
						$data_c['zip_code']=$r_add_bl['pincode'];
						$data_c['longitude']=$r_add_bl['longitude'];
						$data_c['latitude']=$r_add_bl['latitude'];
					}
					
					$this->db->where(array('id'=>$id2[$i],'customer_id' => $id));
					$this->db->update($this->_table_name_c ,$data_c);					
					$i++;
					
				}
				
				/*echo '<pre>';
					print_r($data_c);
					exit;*/
				//echo '<pre>';
				//echo $this->db->last_query();					
			$counter++;			
			}
			
			//exit;
			$data['modify_date']	=	date('Y-m-d:H:i:s');
			$data['modify_by']	=$admin_id;	
				unset($data['id']);
			$this->db->where('id', $id);
			$this->db->update($this->_table_name ,$data);
			
			/*echo '<br>'.$this->db->last_query();	
			print_r($_POST);
					print_r($data);
					print_r($id2);
					exit;
					exit;
				exit;*/
			/*	echo $this->db->last_query();			
			echo '<pre>';
					print_r($data_c);
					print_r($_POST);
					exit;*/
			/*foreach($delivery_address_Apartment as $row){
			   
				$data_c['id'] = $id2[$i];			
				$data_c['delivery_address_Apartment'] = $delivery_address_Apartment[$i];
				$data_c['delivery_address_street_address'] = $delivery_address_street_address[$i];
				$data_c['same_as_billing_adddress'] = $same_as_billing_adddress[$i];
				$data_c['billing_address'] = $billing_address;
				$data_c['billing_apartment_no'] = $billing_apartment_no;
				if($data_c['same_as_billing_adddress']==null)
				{
					$data_c['same_as_billing_adddress']=0;
				}
				$this->db->where('id',$data_c['id']);
				//echo $this->db->last_query();
				//exit;
					
				$this->db->update($this->_table_name_c ,$data_c);
				//$this->db->insert($this->_table_name_c ,$data_c);
				$i++;	
				
				//$this->db->insert($this->_table_name_c ,$data_c);			
			}*/
		return 1;
			
		} 
		else 
		{
			
			
			$data['status'] = 1;	
			$this->db->insert($this->_table_name ,$data);			
			$last_insert = $this->db->insert_id();			
			$data_c['customer_id']= $last_insert;
			
			$this->load->library('notification');
			$not_data=array('note_to_tbl_name'=>'tbl_admin',
							'note_to_id'=>'1', 
							'note_from_tbl_name'=>'tbl_customer', 
							'note_from_id'=>$last_insert, 
							'note_titel'=>'New customer add',
							'note_detail'=>$data['name'].' '.$data['last_name'].','.$data['primary_contact_name'],
							'page_link'=>'admin/customer/add/'.$last_insert,
							'icon'=>'USER'
							);
							//print_r($not_data);
							//exit;
			$this->notification->set($not_data);
			 $i = 0;
			foreach($delivery_address_Apartment as $row)
			{
				$data_c['delivery_address_Apartment'] = $delivery_address_Apartment[$i];
				$data_c['delivery_address_street_address'] = $delivery_address_street_address[$i];
				$data_c['same_as_billing_adddress'] = $same_as_billing_adddress[$i];
				$data_c['billing_address'] = $billing_address;
				$data_c['billing_apartment_no'] = $billing_apartment_no;
				$r_add_bl=$this->get_google_address_with_detail($billing_apartment_no.' '.$billing_address);
				$r_add_dl=$this->get_google_address_with_detail($delivery_address_Apartment[$i].$delivery_address_street_address[$i]);
				
				$data_c['del_apartment']=$delivery_address_Apartment[$i]; 
				$data_c['formated_address']=$r_add_dl['f_address'];
				$data_c['main_address']=$r_add_dl['main_address'];
				$data_c['main_city']=$r_add_dl['main_city'];
				$data_c['main_state']=$r_add_dl['main_state'];
				$data_c['zip_code']=$r_add_dl['pincode'];
				$data_c['longitude']=$r_add_dl['longitude'];
				$data_c['latitude']=$r_add_dl['latitude'];
					
				$data_c['apartment']=$billing_apartment_no;
				$data_c['billing_main_address']=$r_add_bl['main_address'];
				$data_c['billing_main_city']=$r_add_bl['main_city'];
				$data_c['billing_main_state']=$r_add_bl['main_state'];
				$data_c['billing_zipcode']=$r_add_bl['pincode'];
				if($data_c['same_as_billing_adddress']==null)
				{
					$data_c['same_as_billing_adddress']=0;
				}
				else if($data_c['same_as_billing_adddress']=='1')
				{
					$data_c['delivery_address_Apartment'] =  $billing_apartment_no;
					$data_c['delivery_address_street_address'] = $billing_address;
					$data_c['del_apartment']=$billing_apartment_no; 
					$data_c['formated_address']=$r_add_bl['f_address'];
					$data_c['main_address']=$r_add_bl['main_address'];
					$data_c['main_city']=$r_add_bl['main_city'];
					$data_c['main_state']=$r_add_bl['main_state'];
					$data_c['zip_code']=$r_add_bl['pincode'];
					$data_c['longitude']=$r_add_bl['longitude'];
					$data_c['latitude']=$r_add_bl['latitude'];
				}				
				$this->db->insert($this->_table_name_c,$data_c);				
				$i++;				
			}
			/*
				echo '<pre>';
				print_r($data_c);
				print_r($_POST);
				exit;
				*/
			
			$id =$last_insert;
			$cus_id="C".$id;			
			$data['customer_id'] = $cus_id;
			$this->db->where('id',$id);
			//return $id;
			$this->session->set_userdata('last_cust_reg_id',$id);
			return $this->db->update($this->_table_name,$data);
		}
	}
	/****** get_google_address_with_detail  *******/
	public function get_google_address_with_detail($address=null)
	{
	$data1=array();
	$data = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).',+AU&key=AIzaSyCvjYUNMayAdpHVsyYtzVlQhsyxQHlsQ5U'), true);
		//echo "<pre>";
		$pinpos = count($data['results'][0]['address_components']);
		for($i=0;$i<$pinpos;$i++){
			if($data['results'][0]['address_components'][$i]['types'][0]=='postal_code'){
				$data1['pincode'] = $data['results'][0]['address_components'][$i]['long_name'];
			}
			if($data['results'][0]['address_components'][$i]['types'][0]=='administrative_area_level_1'){
				$data1['main_state'] = $data['results'][0]['address_components'][$i]['long_name'];
			}
			if($data['results'][0]['address_components'][$i]['types'][0]=='administrative_area_level_2'){
				$data1['main_city'] = $data['results'][0]['address_components'][$i]['long_name'];
			}
			if($data['results'][0]['address_components'][$i]['types'][0]=='locality'){
				$data1['main_address'] = $data['results'][0]['address_components'][$i]['long_name'];
			}
		}
		
		$data1['f_address'] = $data['results'][0]['formatted_address'];
		//echo "<br>";
		$data1['latitude'] = $data['results'][0]['geometry']['location']['lat'];
		//echo "<br>";
		$data1['longitude']  = $data['results'][0]['geometry']['location']['lng'];
		return $data1;
	}
	/****** Save in admin  Customer Account information  *******/
	public function save_admin_account(){
		$data = $this->array_from_post(self::$db_fields);
		$id2 = $this->input->post('id2');		
		//$data['payment_option']	=	implode(",",$data['payment_option']); 
		//$data['payment_option']	=	implode(",",$data['payment_option']); 
		$id	  =	$data['id'];
		$sess 	= 	$this->session->userdata('admin_login');
		$ar 	= 	unserialize($sess);
		$admin_id	=  $ar['id'];
		//$data['added_date']	=	date('Y-m-d:H:i:s');
		$data['added_by'] = $admin_id;		
		if($id){
			$data['modify_date']	=	date('Y-m-d:H:i:s');			
			$this->db->where('id', $id);
			$this->db->update($this->_table_name ,$data);	
		    return $id;
			
		}
	}
	
	
	
	/****** get all Principle *******/
	public function getAllCustomer($customer_type=null){
	
		if($customer_type)
		{
			
			$where['customer_type']	=	$customer_type;
			$this->db->where('status', '1');
			$this->db->where('deleted', '0');
			$this->db->order_by("name", "ASC");
			$query = $this->db->get_where($this->_table_name, $where);			
			return $query->result_object();
			
		}
		else
		{			
			$this->db->where('deleted', '0');
			$this->db->where('status', '1');
			$this->db->order_by("name", "ASC");
			$result = $this->db->get($this->_table_name)->result();
			return $result;
		}
	}
	
	
	public function getAllCustomer_pending($customer_type=null){
		if($customer_type)
		{
			
			$where['customer_type']	=	$customer_type;
			$this->db->where('status', '0');
			$this->db->where('deleted', '0');
			$this->db->order_by("name", "ASC");
			$query = $this->db->get_where($this->_table_name, $where);			
			return $query->result_object();
			
		}
		else
		{
			$this->db->where('deleted', '0');
			$this->db->where('status', '0');
			$this->db->order_by("name", "ASC");
			$result = $this->db->get($this->_table_name)->result();
			return $result;		
		}
	}
	public function getAllCustomer_close($customer_type=null){
		if($customer_type)
		{
			
			$where['customer_type']	=	$customer_type;
			$this->db->where('deleted', '1');
			$query = $this->db->get_where($this->_table_name, $where);	
			$this->db->order_by("name", "ASC");			
			return $query->result_object();
			
		}
		else
		{
			$this->db->where('deleted', '1');
			$result = $this->db->get($this->_table_name)->result();
			$this->db->order_by("name", "ASC");
			return $result;		
		}
	}
	
	
	
	
	/**/
		/****** get all Principle *******/
	public function getAllCustomer_count(){	


		$result=  $this->db
        ->where('deleted', 0)       
        ->count_all_results($this->_table_name);
       
		return $result;
		
	}
	

	/**/
	
	function getByCustomer_id(){
		$supplier_id	=	$this->input->post('supplier_id');
		//$warehouse_id	=	"102555112";
		//echo $warehouse_id;
		if($supplier_id){
			$where['supplier_id']	=	$supplier_id;
			$query = $this->db->get_where($this->_table_name, $where);
			return $query->row_object();
		}
		else{
			return false;
		}
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
	/****** update delete status in admin *******/
	public function delete_admin($id,$delete=0){
		if($status==true)
			$data['deleted']	=	0;
		else
			$data['deleted']	=	1;
		$this->db->where('id', $id);
		return $this->db->update($this->_table_name ,$data);	
	}
	/****** get customer  record by ID *******/
	public function findByCustomer_id($id=null) {
		if($id) {
			$where['id']	=	$id;
			$query = $this->db->get_where($this->_table_name, $where);
			return $query->row_object();
		}else {
			return false;
		}
	}
	public function getAllCustomer_type(){
		
		//$this->db->where('deleted', 0);
		//$this->db->where('status', 1);
		$result = $this->db->get($this->_table_name_c1)->result();
		return $result;
		
	}
	
}
?>