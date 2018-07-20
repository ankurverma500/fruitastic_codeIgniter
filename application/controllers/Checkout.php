<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkout extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();	
			
		$this->load->model('common');			
	}
	//step 1
	public function your_detail($id=null)
	{
	
		
			
		if($this->input->post('loginForm')) 
		{
			
			$this->step_1_login();
		}
			$this->form_validation->set_error_delimiters('<span style="color:red; position:absolute;">','<span>');
			if(!$id)
			{
				 $original_value = $this->db->query("SELECT email FROM tbl_customer WHERE customer_type_from_id ='1' AND email= '".$this->input->post('username')."'")->row()->email ;
				// print_r($original_value);
				// exit;
				// if($this->input->post('username') != $original_value) {
				if($original_value) 
				{
				   $is_unique =  '|is_unique[tbl_customer.email]';
				}
				else
				{
				   $is_unique =  '';
				}//|xss_clean
				$this->form_validation->set_rules('username',' Email','trim|required|valid_email'.$is_unique);
				//$this->form_validation->set_rules('new_password','Password','trim|required');
				//$this->form_validation->set_rules('confirm_password','Password','trim|required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			}
			//$this->form_validation->set_rules('customer_type','Customer Type','required');
			$this->form_validation->set_rules('name','Name','trim|required');
            $this->form_validation->set_rules('last_name','Last Name','trim|required');			
			//$this->form_validation->set_rules('primary_contact_name','Primary Contact Number','required');			
			$this->form_validation->set_rules('contact','Contact','trim|required');	
			//$this->form_validation->set_rules('delivery_address_Apartment','Delivery Apartment No','trim|required');				
			$this->form_validation->set_rules('delivery_address_street_address','Delivery Address','trim|required');
			if(!$this->input->post('deliveryaddress'))
			{
            //$this->form_validation->set_rules('billing_apartment_no','Billing Apartment No','required');				
			$this->form_validation->set_rules('billing_address','Billing Address','required');
			}
		
		if($this->input->post('save') && $this->form_validation->run() != false) 
		{
			/*echo $id;
			print_r($_POST);
			exit;*/
			
		//print_r( 	$this->form_validation->error_array());
		//echo validation_errors();
			
			
			
			/*SELECT `id`, `customer_id`, `customer_type`, `customer_type_id`, `name`, `last_name`, `email`, `username`, `password`, `primary_contact_name`, `contact`, `contact2`, `status`, `payment_gateway_status`, `payment_option`, `deleted`, `added_date`, `modify_date`, `added_by`, `modify_by`, `api_token`, `eway_custid`, `TokenCustomerID`, `TokenCustomerBillID`, `promo_discount` FROM `tbl_customer` WHERE 1*/
			
			if($id)
			{
				$da=array('val'=>array('name'=>$this->input->post('name'),
									   'last_name'=>$this->input->post('last_name'),
									   'contact'=>$this->input->post('contact'),
									   'added_date'=>$this->currentAddDate_time,
									   'customer_type_from_id'=>'1',
									   'modify_by'=>'0',
									   'modify_date'=>$this->currentAddDate_time
									   ),
					  'table'=>'tbl_customer',
					  'where'=>array('id'=>$id)
					  );
				$result=$this->common->update_data($da);		
				$data_c['customer_id']= $last_insert=$id;
			}
			else
			{
				$da=array('val'=>array('name'=>$this->input->post('name'),
									   'last_name'=>$this->input->post('last_name'),
									   'primary_contact_name'=>$this->input->post('bussiness_name'),
									   'username'=>$this->input->post('username'),
									   'password'=>md5($this->input->post('password')),
									   'email'=>$this->input->post('username'),
									   'contact'=>$this->input->post('contact'),
									   'added_date'=>$this->currentAddDate_time,
									   'customer_type'=>'Fruitastic Site',
									   'customer_type_id'=>$this->input->post('customer_type'),
									   'customer_type_from_id'=>'1',									   
									   'added_by'=>'0',
									   'added_date'=>$this->currentAddDate_time,
									   'deleted'=>'0',
									   'status'=>'1'),
					  'table'=>'tbl_customer',
					  'where'=>array('id'=>$id)
					  );//Residential
				$result=$this->common->add_data($da);
				$last_insert = $this->db->insert_id();			
				$data_c['customer_id']= $last_insert;
				
				$da['val']=array('customer_id'=>'C'.$last_insert);
				$da['where']=array('id'=>$last_insert);
				$this->common->update_data($da);
				$data_c['customer_id']=$last_insert;
			}
				$data_c['delivery_address_Apartment'] =$this->input->post('delivery_address_Apartment');
				$data_c['delivery_address_street_address'] = $this->input->post('delivery_address_street_address');
				$data_c['same_as_billing_adddress'] = $this->input->post('deliveryaddress');
				$data_c['billing_apartment_no'] = $this->input->post('billing_apartment_no');
				$data_c['billing_address'] = $this->input->post('billing_address');			
				$r_add_bl=$this->get_google_address_with_detail($data_c['billing_apartment_no'].' '.$data_c['billing_address']);
				$r_add_dl=$this->get_google_address_with_detail($data_c['delivery_address_Apartment'].' '.$data_c['delivery_address_street_address']);
				
				$data_c['del_apartment']=$data_c['delivery_address_Apartment']; 
				$data_c['formated_address']=$r_add_dl['f_address']!=''?$r_add_dl['f_address']:'';
				$data_c['main_address']=$r_add_dl['main_address']!=''?$r_add_dl['main_address']:'';
				$data_c['main_city']=$r_add_dl['main_city']!=''?$r_add_dl['main_city']:'';
				$data_c['main_state']=$r_add_dl['main_state']!=''?$r_add_dl['main_state']:'';
				$data_c['zip_code']=$r_add_dl['pincode']!=''?$r_add_dl['pincode']:'';
				$data_c['longitude']=$r_add_dl['longitude'];
				$data_c['latitude']=$r_add_dl['latitude'];
					
				$data_c['apartment']=$data_c['billing_apartment_no'];
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
					$data_c['billing_apartment_no'] =  $data_c['delivery_address_Apartment'];
					$data_c['billing_address'] = $data_c['delivery_address_street_address'];
					$data_c['apartment']=$data_c['delivery_address_Apartment']; 
					//$data_c['formated_address']=$r_add_dl['f_address'];
					$data_c['billing_main_address']=$r_add_dl['main_address'];
					$data_c['billing_main_city']=$r_add_dl['main_city'];
					$data_c['billing_main_state']=$r_add_dl['main_state'];
					$data_c['billing_zipcode']=$r_add_dl['pincode'];
					//$data_c['longitude']=$r_add_dl['longitude'];
					//$data_c['latitude']=$r_add_dl['latitude'];
				}
				
				$this->session->set_userdata('run_post_code_with_address',$data_c['delivery_address_street_address']);				
				$this->session->set_userdata('array_address',array('Apartment'=>$data_c['delivery_address_Apartment'],
																   'longitude'=>$data_c['longitude'],
																   'latitude'=>$data_c['latitude']));	
				$this->session->set_userdata('run_post_code',$data_c['zip_code']);
				//print_r($data_c);
				//exit;
			if($id)
			{
				$this->db->where(array('id'=>$customer_address_id,'customer_id' => $id));
				$this->db->update('tbl_customer_address' ,$data_c);		
			}
			else
			{							
				$this->db->insert('tbl_customer_address',$data_c);
				$not_data=array('note_to_tbl_name'=>'tbl_admin',
								'note_to_id'=>'1', 
								'note_from_tbl_name'=>'tbl_customer', 
								'note_from_id'=>$last_insert, 
								'note_titel'=>'New customer add  from cheapstore',
								'note_detail'=>$this->input->post('name').' '.$this->input->post('last_name'),
								'page_link'=>'admin/customer/add/'.$last_insert,
								'icon'=>'USER'
								);
								//print_r($not_data);
								//exit;
				$this->notification->set($not_data);
			}
			
			
			
			if($id)
			{
				/*print_r($_POST);
				exit;*/
				//echo $this->session->flashdata('success');
				$this->session->set_flashdata('success', UPDATE_MESSAGE);
				//$this->step_1_login();
				redirect(base_url("checkout/delivery_day"),'refresh');
				exit;
			}
			else
			{				
				$this->session->set_flashdata('success', ADD_MESSAGE);
				$this->step_1_login();
				//redirect("product/index",'refresh');
			}
			
		}
		else
		{
			$da=array('val'=>'*',
					  'table'=>'tbl_customer',
					  'where'=>array('status'=>'1','deleted'=>'0','id'=>$this->added_by)
					  );
			$row=$this->common->getdata($da);
			
			$da1=array('val'=>'*',
					  'table'=>'tbl_customer_address',
					  'where'=>array('deleted'=>'0','customer_id'=>$this->added_by)
					  );
			$customer=$this->common->getdata($da1);
			
			$this->data['row']='';
			$this->data['customer']='';
			
			/*$sess 	= 	$this->session->userdata('admin_login');
				$ar 	= 	unserialize($sess);	
				echo $this->added_by;*/
				
			if($row['res'])
			{
				$this->data['id']=$id=$this->added_by;
				$this->data['row']=$row['rows'][0];
				$this->session->set_userdata('customer_other_payment_option',$row['rows'][0]->payment_option);
				$this->data['customer']=$customer['rows'][0];
				
				$customer_id=$row['rows'][0]->id;
				$customer_address_id=$customer['rows'][0]->id;
				
				/*echo '<pre>';
				print_r($row);
				exit;*/
			}
			
			$this->data['content']=$this->load->view('checkout/your_detail',$this->data,true);//
			$this->load->view('layouts/pages',$this->data);
		}
	}
	 
	//step 2
	public function delivery_day()
	{
		
		/*echo $this->session->userdata('run_post_code');
		echo '<pre>';
		$cart_check = $this->cart->contents();
		print_r($cart_check);
		exit;*/
		$this->login_check();
		if($this->session->userdata('run_post_code') && ($this->cart->total_items()>0))
		{
			
			$post_code=$this->session->userdata('run_post_code');
			$cur_date=date('Y-m-d',date(strtotime("+1 day", strtotime(date('Y-m-d')))));
			if(date('H')>='15:00')
			{
				//$this->db->where('trd.run_date>',date('Y-m-d',date(strtotime("+1 day", strtotime($cur_date)))));
				$cur_date=date('Y-m-d',date(strtotime("+1 day", strtotime($cur_date))));
			}
			else
			{
				//echo 'sads';
				//$this->db->where('trd.run_date >',$cur_date);
			}
			$comment1=array('table'=>'tbl_run_detail as trd',
							'val'=>'*,trd.run_date,trd.id as run_detail_id
							,(SELECT `name` FROM `tbl_working_shift` WHERE id=trd.shift) as shift_name 
							',
							//,	(SELECT count(*) FROM `tbl_recurring_order` WHERE `order_id`='.$order_id.' AND  `customer_id`='.$customer_id.' AND `run_detail_id`=trd.id ) as recorder_exists
							'where'=>array('trd.deleted'=>'0','trd.status'=>'1','trz.zip_code'=>$post_code,'trd.run_date>'=>$cur_date),
							//,'trd.id'=>'76' ,'trd.run_date'=>'2018-01-01'
							//'trz.max_deliveries < trz.total_deliveries'
							'minvalue'=>'',
							//'group_by'=>'trd.id',
							'group_by'=>'trd.run_date,trd.shift',
							'start'=>'',
							'orderby'=>'trd.run_date',
							'orderas'=>'ASC');	
					$multijoin1=array(
						array('table'=>'tbl_run_zip as trz','on'=>'trz.run_id=trd.tbl_run_id AND trz.status="1"','join_type'=>'left')           
						);
			
			
			$this->db->where("trd.tbl_run_id IN (SELECT `run_id` FROM `tbl_run_customer_type` WHERE `tbl_customer_type_id`='$this->customer_type_id') ");
			$all_run_day=$this->common->multijoin($comment1,$multijoin1);
			/*print_r($all_run_day);
			echo $this->db->last_query();
			exit;*/
			if($all_run_day['res'])
			{
				$da=array('val'=>'*',
						  'table'=>'tbl_customer',
						  'where'=>array('status'=>'1','deleted'=>'0','id'=>$this->added_by)
						  );
				$row=$this->common->getdata($da);
				
				$da1=array('val'=>'*',
						  'table'=>'tbl_customer_address',
						  'where'=>array('deleted'=>'0','customer_id'=>$this->added_by)
						  );
				$customer=$this->common->getdata($da1);			
				$this->data['row']='';
				$this->data['customer']='';
					
				if($row['res'])
				{
					$id=$this->added_by;
					$this->data['row']=$row['rows'][0];
					$this->data['customer']=$customer['rows'][0];					
					$customer_id=$row['rows'][0]->id;
					$customer_address_id=$customer['rows'][0]->id;
				}
				$this->data['zip_code']=$this->session->userdata('run_post_code');
				$this->data['customer_id']=$this->added_by;
				$this->data['content']=$this->load->view('checkout/delivery_day',$this->data,true);
				$this->load->view('layouts/pages',$this->data);
			}
			else
			{	
			
				$this->session->set_userdata('error_post_code', POST_CODE_EMPTY); 			
				$this->session->set_flashdata('error', POST_CODE_EMPTY);				
				redirect(base_url("checkout/your_detail"),'refresh');
			}
		}
		else
		{			
			if((count($this->cart->contents())<1))
			{
				//echo 'product';
				$this->session->set_flashdata('error', CART_EMPTY);				
				redirect(base_url("product"),'refresh');
			}
			else
			{
				$this->session->set_userdata('error_post_code', POST_CODE_EMPTY); 
				$this->session->set_flashdata('error', POST_CODE_EMPTY);				
				redirect(base_url("checkout/your_detail"),'refresh');
			}
		}		
	}
	//step 3
	public function payment()
	{
		
		
		if($this->session->userdata('run_post_code')&&$this->session->userdata('run_detail')&&(count($this->cart->contents())>0))
		{	
		
			/*print_r( $this->session->userdata('run_detail'));
			exit;*/
			$run_detail=$this->session->userdata('run_detail');
			$this->data['order_type']=$run_detail['run_type'];
			$this->data['order_payment_option']=$this->session->userdata('customer_other_payment_option');
					
			$this->session->set_userdata('delivery_notes',$this->input->post('delivery_notes'));
			$this->session->set_userdata('packing_notes',$this->input->post('packing_notes'));
			$this->data['content']=$this->load->view('checkout/index',$this->data,true);
			$this->load->view('layouts/pages',$this->data);			
		}
		else
		{
			if((count($this->cart->contents())<1))
			{
				//echo 'product';
				$this->session->set_flashdata('error', CART_EMPTY);				
				redirect(base_url("product"),'refresh');
			}
			else
			if(!$this->session->userdata('run_post_code'))
			{
				$this->session->set_flashdata('error', POST_CODE_EMPTY);				
				redirect(base_url("checkout/your_detail"),'refresh');
			}
			if(!$this->session->userdata('run_detail'))
			{
				$this->session->set_flashdata('error', DELIVERY_RUN_EMPTY);				
				redirect(base_url("checkout/delivery_day"),'refresh');
			}
		}
	}
	
	public function payment_other()
	{		
		if($this->session->userdata('run_post_code')&&$this->session->userdata('run_detail'))
		{			
			if($this->input->post('Other') || $this->input->post('Eway') || $this->input->post('paypal'))
			{				
				$this->db->trans_off();
				//$this->db->trans_start();
				$this->db->trans_begin();
				$da1=array('val'=>'*',
						   'table'=>'tbl_customer',
						   'where'=>array('id'=>$this->added_by)//'deleted'=>'0','status'=>'1',
						  );
				if($this->input->post('Other'))
				{
					$this->db->where('payment_option!=','');
				}
				$qry_user=$this->common->getdata($da1);
				/*echo $this->db->last_query();
				print_r($_POST);
				echo '3<br>';
				print_r($qry_user);
				exit;*/
				if($qry_user['res'])
				{					
					$cart_check = $this->cart->contents();
				   /*print_r($qry_user);	echo '<pre>';
					print_r($cart_check);
					print_r($this->session->userdata('run_detail'));
					print_r($this->session->userdata('run_post_code'));				
					echo 'Other';*/
					
					$customer_id					=	$this->added_by;
					$c_name							=	$qry_user['rows'][0]->name.' '.$qry_user['rows'][0]->last_name;
					$c_email						=	$qry_user['rows'][0]->email;
					$c_contact_no					=	$qry_user['rows'][0]->contact.','.$qry_user['rows'][0]->contact2;
					$array_address					=	$this->session->userdata('array_address');
					$Apartment						=	$array_address['delivery_address_Apartment'];
					$longitude						=	$array_address['longitude'];
					$latitude						=	$array_address['latitude'];								
					$run_post_code_with_address		=	$this->session->userdata('run_post_code_with_address');									
					$address						= 	$Apartment.' '.$run_post_code_with_address;
					$qry_user_zip_code				=	$this->session->userdata('run_post_code');
					$delivery_notes					=	$this->session->userdata('delivery_notes');
					$packing_notes					=	$this->session->userdata('packing_notes');
					$delivery_notes					=	$delivery_notes	!=''?$delivery_notes	:'';
					$packing_notes					=	$packing_notes	!=''?$packing_notes	:'';
					$total_price=0;
					$run_detail=$this->session->userdata('run_detail');
					$order_type=$run_detail['run_type'];
					$run_detail_id='';
					
					$i=0;
					$r_id_array=array();
					$this->data['total_price_cart']=0;
					$discode ='';
					$discount_code_value='';
					$discount_percentage='';
					
					if($this->session->userdata('discount'))
					{
						$discount_session=$this->session->userdata('discount');
						$discode=$discount_session['discount_code'];
						//print_r($discount_session);					
					}
					$da=array('val'=>'*',
							  'table'=>'tbl_discount',
							  'where'=>array('code'=>$discode,
											 'deleted'=>'0',
											 'status'=>'1',										 
											 'start_date<='=>$this->currentAddDate,
											 'expiry_date>='=>$this->currentAddDate)
							  );
					$discount_value=$this->common->getdata($da);
					//print_r(json_encode($discount_value) );
					//exit;
					if($discount_value['res'])
					{
						$discount_code_value=$discount_value['rows'][0]->discount_value;
						$discount_percentage=$discount_value['rows'][0]->discount_percentage;
					}
					
					$data=array('table'=>'tbl_order',
								'val'=>array('name'=>$c_name,
											 'user_id'=>$customer_id,
											 'tbl_customer_type_from_id'=>$qry_user['rows'][0]->customer_type_from_id,
											 'contact_no'=>$c_contact_no,
											 'email'=>$c_email,
											 'address'=>$address,
											 'formated_address'=>$address,
											 'zip_code'=>$qry_user_zip_code,
											 'longitude'=>$longitude,
											 'latitude'=>$latitude,
											 'delivery_status'=>'0',
											 'discount'=>$discount_code_value,
											 'discount_code'=>$discode,
											 'amount'=>'',
											 'order_source'=>'1',
											 'added_date'=>$this->currentAddDate,
											 'order_run_id'=>$run_detail_id,
											 'approved_order'=>'0',
											 'order_status'=>'1',
											 'order_type'=>$order_type,
											 'order_repeat_status'=>'0',
											 'delivery_notes'=>$delivery_notes,	
											 'packing_note'=>$packing_notes,	
											 'deleted'=>'1',
											 'status'=>'0'
											  )
								);
								
					if($this->input->post('Other'))
					{
						//payment type other start
						$row_user['payment_option_id']=$qry_user['rows'][0]->payment_option;					
						$msdata='';		
						$days=0;
						$mm=0;								
						if($row_user['payment_option_id']=="7")
						{
							$days=7;
							$mm=4;
						}
						else if($row_user['payment_option_id']=="8")
						{
							$days=15;
							$mm=5;
						}
						else if($row_user['payment_option_id']=="9")
						{
							$days=30;
							$mm=6;
						}
						else
						{
							$days=0;
							$mm=666;
						}
						 $payment_day=date('l', strtotime("+ $days day ", strtotime(date('Y-m-d')) ));
						 $payment_date=date('Y-m-d', strtotime("+ $days day ", strtotime(date('Y-m-d')) ));
						 //payment type other end
						 $data['val']['payment_status']='2';
						 $data['val']['payment_date']=$payment_date;
						 $data['val']['payment_mode']=$mm;
						 $data['val']['payment_type']='Manual '.$days.' Days';
						 $data['val']['tbl_customer_payment_options_id']=$row_user['payment_option_id'];
						 $data['val']['tbl_customer_payment_options_day']=$payment_day;
						 $data['val']['tbl_customer_payment_options_no_day']=$days;
						 $data['val']['tbl_customer_payment_options_date']=$payment_date;
						 $data['val']['deleted']='0';
						 $data['val']['status']='1';
						
					}
					
					$last_insert_order_id=0;
					
					/*echo '<pre>';
					print_r($data);	
					exit;	*/
					
					$log=$this->common->add_data($data);
					$last_insert_order_id=$this->db->insert_id();
					$total_order_price=0;	
					$product_total_price=0;
					$product_price='0';
					$cart_check = $this->cart->contents();
					foreach($cart_check as $Products)
					{
						//product_ids:[{id: "1", qty: 1}]
						$product_id=$Products['id'];
						$Product_qty=$Products['qty'];
						$product_price=$Products['price'];
						$product_gst=$Products['product_gst'];
						$product_total_price	=	floatval($product_price*$Product_qty);
						$total_order_price		=	floatval($total_order_price+$product_total_price);						
						$data=array('table'=>'tbl_order_summary',
									'val'=>array('order_id'=>$last_insert_order_id,
												 'product_id'=>$product_id,
												 'qty'=>$Product_qty,
												 'product_price'=>$product_price,
												 'product_gst'=>$product_gst,
												 'amount'=>$product_total_price,
												 'added_date'=>$this->currentAddDate,
												 'deleted'=>'0'
												 ));
						//print_r($data);
						$log=$this->common->add_data($data);
						$order_summary_insert_id=$this->db->insert_id();
						//echo $this->db->last_query();
						$data1=array('table'=>'tbl_order_summary_tracking',
									'val'=>array('order_id'=>$last_insert_order_id,
												 'product_id'=>$product_id,
												 'user_id'=>$customer_id,
												 'order_summary_id'=>$order_summary_insert_id,
												 'new_order'=>1,
												 'new_order_date'=>$this->currentAddDate_time,
												 'driver_id'=>'',
												 'vehicle_id'=>'',
												 'warehouse_id'=>''));	
							//print_r($data1);		
						$log1=$this->common->add_data($data1);				
					}
							
					$shipping_amount=0;
					$order_shown_id='';
					$total_order_price;
					$dd_value=0;
					
					if($discount_percentage!='')
					{	//(500/100)*50
						$dd_value=(($total_order_price/100)*$discount_percentage);
						//echo json_encode('p '.$discount_percentage.' t '.$total_order_price.' dv '.$dd_value);
					}
					else
					{
						$dd_value=($discount_code_value);
						//echo json_encode('v '.$discount_code_value.' t '.$total_order_price.' dv '.$dd_value);
					}
					
					
					if($total_order_price>=40)
					{				
						$amount_total=floatval($total_order_price);				
					}
					else
					{
						$shipping_amount=8;
						$amount_total=floatval(($total_order_price+8));
					}
					
					$amount_total=($amount_total-$dd_value);
					if($order_type==1)
					{
						$or_id='ORDIDA.'.$last_insert_order_id;
					}
					elseif($order_type==3)
					{
						$or_id='FO.'.$last_insert_order_id;
					}
					else
					{
						$or_id='RO.'.$last_insert_order_id;
					}
					
					$order_id='ORDIDA.'.$last_insert_order_id; 
					$this->session->set_userdata('order_final_amount',$amount_total);
					 $query_order_update="UPDATE `tbl_order` SET  ship_amount='$shipping_amount', 
					`discount`='$dd_value', `discount_code`='$discode',
					amount_total='$amount_total', amount='$total_order_price',
					`order_shown_id`='$or_id', `order_id`='$order_id' WHERE id =".$last_insert_order_id;
					$this->db->query($query_order_update);
					//exit;
					//print_r(json_encode($this->db->last_query()) );
					//exit;
					$i=0;
					$run_detail2=$this->session->userdata('run_detail');//run
					//foreach($run_iddd as $run_id)
					//print_r($run_detail2);
					//
					/*if(in_array('Sunday', array_column($run_detail2['run'], 'run_day_name'))){
					echo 'exist';
					}else{echo 'not exist';}*/
					//echo array_search($run_detail2['run']);
					//echo array_search('Monday', array_column($run_detail2['run'], 'run_day_name'));
					for($i=0;$i<count($run_detail2['run']);$i++)			
					{
						$run_detail_id = $run_detail2['run'][$i]['run_detail_id'];					
						$da=array('val'=>'*',
								  'table'=>'tbl_run_detail',
								  'where'=>array('id'=>$run_detail_id)
								  );
						$run_detail=$this->common->getdata($da);
						$run_id=$run_detail['rows'][0]->tbl_run_id;
						/*
						echo $this->db->last_query();
						print_r($run_detail);
						exit;
						*/
						if($order_type=='1')
						{
							$data1=array('table'=>'tbl_recurring_order',
										'val'=>array('order_id'=>$last_insert_order_id,
													 'customer_id'=>$customer_id,
													 'on_days'=>$run_detail['rows'][0]->run_day,
													 'weekly'=>$run_detail['rows'][0]->run_day,
													 'run_date'=>$run_detail['rows'][0]->run_date,
													 'run_detail_id'=>$run_detail_id,
													 'added_by'=>$customer_id,
													 'add_date'=>$this->currentAddDate_time,
													 'deleted'=>'0',
													 'status'=>'1'));			
							//print_r($data1);
							$log1=$this->common->add_data($data1);	
							//if one time 
						
						}
						else if($order_type=='2' or $order_type=='3')
						{
							//if recurring 
							$da=array('val'=>'count(*) as total_order',
									  'table'=>'tbl_recurring_order_master',
									  'where'=>array('customer_id'=>$customer_id)//,'order_id'=>$order_id
									  );
							$d_order=$this->common->getdata($da);
							$recuring_order_counter_id='Ro';
							if($d_order['res'])
							{
								$recuring_order_counter_id.='.'.($d_order['rows'][0]->total_order+1);
							}
							else
							{
								$recuring_order_counter_id.='.1';
							}
							$data1=array('table'=>'tbl_recurring_order_master',
										'val'=>array('order_id'=>$last_insert_order_id,
													 'recuring_order_counter_id'=>$recuring_order_counter_id,
													 'customer_id'=>$customer_id,
													 'on_days'=>$run_detail['rows'][0]->run_day,
													 'weekly'=>$run_detail['rows'][0]->run_day,
													 'run_date'=>$run_detail['rows'][0]->run_date,
													 'run_detail_id'=>$run_detail_id,
													 'tbl_run_id'=>$run_id,
													 'added_by'=>$customer_id,
													 'add_date'=>$this->currentAddDate_time,
													 'deleted'=>'0',
													 'status'=>'1'));	
							if($order_type=='3')
							{
								$data1['val']['fortnight'] = '1';
							}
							//print_r($data1);
							$log1=$this->common->add_data($data1);	 					
						}
					}
					if ($this->db->trans_status() === FALSE)
					{
							$this->db->trans_rollback();
							$this->session->set_flashdata('error', 'Oops Sorry!. Your order could not be processed , trans status false, please try again');				
							//redirect(base_url("checkout/your_detail"),'refresh');
					}
					else
					{
						$this->db->trans_commit();
						
						
						//exit;
						$this->session->set_userdata('total_order_array',$last_insert_order_id);
						$this->session->set_flashdata('success', ORDER_PLACED.' order id is :- '.$last_insert_order_id);	
						if($this->input->post('Eway'))
						{
							redirect(base_url("payment/eway/index/?order_id=".$last_insert_order_id),'refresh');
						} 
						else if( $this->input->post('paypal'))
						{
							//redirect(base_url("payment/paypal/index/?order_id=".$last_insert_order_id),'refresh');
							//redirect(base_url("paypal/demos/express_checkout/index/?order_id=".$last_insert_order_id),'refresh');
							redirect(base_url("paypal/demos/express_checkout/SetExpressCheckout/?order_id=".$last_insert_order_id),'refresh');
						}
						else if($this->input->post('Other'))
						{
							if($discount_value['res'])
							{
								if($discount_value['rows'][0]->availability=='One Time')
								{
									$vvvv='Order_id ='.$last_insert_order_id.'CustomerId ='.$customer_id;
									$da=array('val'=>array('specification'=>$vvvv,
															 'deleted'=>'0',
															 'status'=>'0'),
											  'table'=>'tbl_discount',
											  'where'=>array('id'=>$discount_value['rows'][0]->id)
											  );
									$this->common->update_data($da);
								}
							}
							$this->after_place_order_split_it($last_insert_order_id);
							$not_data=array('note_to_tbl_name'=>'tbl_admin',
											'note_to_id'=>'1',
											'note_from_tbl_name'=>'tbl_customer',//tbl_order
											'note_from_id'=>$customer_id, 
											'note_titel'=>'New Order add',
											'note_detail'=>'Order by school site(Other), order id:- '.$last_insert_order_id,
											'page_link'=>'admin/customer/edit_order/'.$customer_id.'/'.$last_insert_order_id,
											'icon'=>'ORDER'
											);
							//$this->notification->set($not_data);							
							redirect(base_url("checkout/complete"),'refresh');
						}
						//echo 'order plasd';
						//print_r($total_order_array);
					}
					//$this->data['content']=$this->load->view('checkout/complete',$this->data,true);
					//$this->load->view('layouts/pages',$this->data);
					exit;
				}
				else
				{
					$this->session->set_flashdata('error', UNAUTHORISED_ACCESS." And  your detail don't exist");
					redirect(base_url("checkout/your_detail"),'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', UNAUTHORISED_ACCESS);				
				redirect(base_url("checkout/your_detail"),'refresh');
			}
		}
		else
		{
			if(!$this->session->userdata('run_post_code'))
			{
				$this->session->set_flashdata('error', POST_CODE_EMPTY);				
				redirect(base_url("checkout/your_detail"),'refresh');
			}
			if(!$this->session->userdata('run_detail'))
			{
				$this->session->set_flashdata('error', DELIVERY_RUN_EMPTY);				
				redirect(base_url("checkout/delivery_day"),'refresh');
			}
		}
	}
	
	//step 4
	public function complete()
	{
		//echo 'complete';	
		$this->data['content']=$this->load->view('checkout/complete',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
	
	public function payment_status()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('discount');
		$this->session->unset_userdata('run_detail');
		$this->session->unset_userdata('run_post_code_with_address');
		$this->session->unset_userdata('array_address');
		$this->session->unset_userdata('run_post_code');
		
		if($this->input->get('status')=='fail')
		{
			if($this->input->get('payment'))
			{
				
				$this->data['content']=$this->load->view('checkout/fail_success',$this->data,true);
				$this->load->view('layouts/pages',$this->data);
				
			}
			else
			{
				//print_r($this->input->get('status'));
				//echo 'fail';//
				$this->data['content']=$this->load->view('checkout/fail',$this->data,true);
				$this->load->view('layouts/pages',$this->data);
			}
		}
		else if($this->input->get('status')=='success')
		{
			$this->data['content']=$this->load->view('checkout/complete',$this->data,true);
			$this->load->view('layouts/pages',$this->data);
		}
		else
		{
			//print_r($this->input->get('status'));
			//echo 'errer';
			$this->data['content']=$this->load->view('checkout/fail',$this->data,true);
			$this->load->view('layouts/pages',$this->data);
		}
	}
	
	public function step_1_login()
	{
		//print_r($_POST);
		//exit;
		    $from_url=$this->input->post('from_url');
		    $this->form_validation->set_error_delimiters('<span style="color:red;">','<span>');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');		
			if ($this->form_validation->run() == FALSE) 
			{
				$this->data['content']=$this->load->view('checkout/your_detail',$this->data,true);
				$this->load->view('layouts/pages',$this->data);
			} 
			else
			{
				$this->load->model('admin');
				//print_r($_POST); 
				//exit;
				$result = $this->admin->login();
				
				if($result) 
				{
					/*** if remember me ***/
					if($this->input->post('remember'))
					{
						$username 		= $this->input->post('username');
						$password 	= $this->input->post('password');
						$this->input->set_cookie('email_customer_cookie', $this->input->post('username'), time()+86500); 	
						$this->input->set_cookie('password_customer_cookie', $this->input->post('password'), time()+86500); 
					}
					else
					{
						delete_cookie("email_customer_cookie");
						delete_cookie("password_customer_cookie");
					}
					$this->session->set_flashdata('success', 'WELCOME user, You are succesfully login ');
					//redirect(base_url("checkout/index"),'refresh');
					//redirect(base_url("'".$from_url."'"),'refrash');
					//redirect(base_url($from_url),'refrash');
					redirect($_SERVER['HTTP_REFERER'],'refresh');
				}
				else
				{
					//$this->session->set_flashdata('error', INVALID_LOGIN);	
					$this->session->set_flashdata('error', 'Invalid username and password.');				
					//redirect(base_url("checkout/index"),'refresh');
					//redirect(base_url("'".$from_url."'"),'refrash');	
					//redirect(base_url($from_url),'refrash');
					redirect($_SERVER['HTTP_REFERER'],'refresh');
				}
			}
	}
	
	public function step_2_login()
	{
		//print_r($_POST);
		//exit;
		    $from_url=$this->input->post('from_url');
		    $this->form_validation->set_error_delimiters('<span style="color:red;">','<span>');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');		
			if ($this->form_validation->run() == FALSE) 
			{
				$this->data['content']=$this->load->view('checkout/your_detail',$this->data,true);
				$this->load->view('layouts/pages',$this->data);
			} 
			else
			{
				$this->load->model('admin');
				//print_r($_POST); 
				//exit;
				$result = $this->admin->login();
				
				if($result) 
				{
					/*** if remember me ***/
					if($this->input->post('remember'))
					{
						$username 		= $this->input->post('username');
						$password 	= $this->input->post('password');
						$this->input->set_cookie('email_customer_cookie', $this->input->post('username'), time()+86500); 	
						$this->input->set_cookie('password_customer_cookie', $this->input->post('password'), time()+86500); 
					}
					else
					{
						delete_cookie("email_customer_cookie");
						delete_cookie("password_customer_cookie");
					}
					
					$this->session->set_flashdata('success', 'WELCOME user, You are succesfully login ');					
					//redirect(base_url("checkout/index"),'refresh');
					//redirect(base_url("'".$from_url."'"),'refrash');
					//redirect(base_url($from_url),'refrash');
					//redirect($_SERVER['HTTP_REFERER'],'refresh');
					echo 'success';
				}
				else
				{
					//$this->session->set_flashdata('error', INVALID_LOGIN);	
					$this->session->set_flashdata('error', 'Invalid username and password.');				
					//redirect(base_url("checkout/index"),'refresh');
					//redirect(base_url("'".$from_url."'"),'refrash');	
					//redirect(base_url($from_url),'refrash');
					//redirect($_SERVER['HTTP_REFERER'],'refresh');
					echo 'error';
				}
			}
	}
	
	public function user_register_popup()
	{
		if($this->input->post('from_url'))
		{
			$from_url=$this->input->post('from_url');
			$this->form_validation->set_error_delimiters('<span style="color:red; position:absolute;">','<span>');
						
			$original_value = $this->db->query("SELECT email FROM tbl_customer WHERE customer_type_from_id ='2' AND email= '".$this->input->post('username')."'")->row()->email ;
			
			if($original_value) 
			{
			   $is_unique =  '|is_unique[tbl_customer.email]';
			}
			else
			{
			   $is_unique =  '';
			}//|xss_clean
			$this->form_validation->set_rules('username','Email','trim|required|valid_email'.$is_unique);
			//$this->form_validation->set_rules('new_password','Password','trim|required');
			//$this->form_validation->set_rules('confirm_password','Password','trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			
			//$this->form_validation->set_rules('customer_type','Customer Type','required');
			$this->form_validation->set_rules('first_name_pop','Name','trim|required');
            $this->form_validation->set_rules('last_name_pop','Last Name','trim|required');			
			//$this->form_validation->set_rules('primary_contact_name','Primary Contact Number','required');			
			$this->form_validation->set_rules('contact_pop','Contact','trim|required');	
			//$this->form_validation->set_rules('delivery_address_Apartment','Delivery Apartment No','trim|required');				
			//$this->form_validation->set_rules('delivery_address_street_address','Delivery Address','trim|required');
            //$this->form_validation->set_rules('billing_apartment_no','Billing Apartment No','required');				
			//$this->form_validation->set_rules('billing_address','Billing Address','required');
			
			//print_r( 	$this->form_validation->error_array());
			//echo validation_errors();
			if($this->form_validation->run() == false)
			{	print_r(json_encode( $this->form_validation->error_array()));
				//print_r(json_encode($this->form_validation->error_array()));
			}
			else 
			{
			
			
			/*SELECT `id`, `customer_id`, `customer_type`, `customer_type_id`, `name`, `last_name`, `email`, `username`, `password`, `primary_contact_name`, `contact`, `contact2`, `status`, `payment_gateway_status`, `payment_option`, `deleted`, `added_date`, `modify_date`, `added_by`, `modify_by`, `api_token`, `eway_custid`, `TokenCustomerID`, `TokenCustomerBillID`, `promo_discount` FROM `tbl_customer` WHERE 1*/
			
			//echo 'sachin';
			//exit;
			
				$this->db->trans_off();
				//$this->db->trans_start();
				$this->db->trans_begin();
			
				$da=array('val'=>array('name'=>$this->input->post('first_name_pop'),
									   'last_name'=>$this->input->post('last_name_pop'),
									   'username'=>$this->input->post('username'),
									   'password'=>md5($this->input->post('password')),
									   'email'=>$this->input->post('username'),
									   'contact'=>$this->input->post('contact_pop'),
									   'added_date'=>$this->currentAddDate_time,
									   'customer_type'=>'Fruitastic Site',
									   'customer_type_id'=>$this->input->post('customer_type'),
									   'customer_type_from_id'=>'1',
									   'added_by'=>'0',
									   'added_date'=>$this->currentAddDate_time,
									   'deleted'=>'0',
									   'status'=>'1'),
					  'table'=>'tbl_customer',
					  'where'=>array('id'=>$id)
					  );
				$result=$this->common->add_data($da);
				$data_c['customer_id']=$last_insert = $this->db->insert_id();			
				 
				
				$da['val']=array('customer_id'=>'C'.$last_insert);
				$da['where']=array('id'=>$last_insert);
				$this->common->update_data($da);
				
				$this->db->query("INSERT INTO `tbl_customer_address` SET `same_as_billing_adddress`='1',`customer_id`='$last_insert', `deleted`='0'");
					//echo $this->db->last_query();
					//exit;
				$not_data=array('note_to_tbl_name'=>'tbl_admin',
								'note_to_id'=>'1', 
								'note_from_tbl_name'=>'tbl_customer', 
								'note_from_id'=>$last_insert, 
								'note_titel'=>'New customer add from cheapstore',
								'note_detail'=>$this->input->post('first_name_pop').' '.$this->input->post('last_name_pop'),
								'page_link'=>'admin/customer/add/'.$last_insert,
								'icon'=>'USER'
								);
								//print_r($not_data);
								//exit;
			$this->notification->set($not_data);
			$send_mail_data=array('to'=>$this->input->post('username'),'subject'=>'Welcome to Corporate','message'=>$this->send_user_register_mail($this->input->post('first_name_pop').' '.$this->input->post('last_name_pop')));	
				//$this->send_email($send_mail_data);
				
				
			
				$this->load->model('admin');
				//print_r($_POST); 
				//exit;
				$result = $this->admin->login();
				
				if($result) 
				{
					
					if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();							
					}
					else
					{
						$this->db->trans_commit();
					}
					/*** if remember me ***/
					if($this->input->post('remember'))
					{
						$username 		= $this->input->post('username');
						$password 	= $this->input->post('password');
						$this->input->set_cookie('email_customer_cookie', $this->input->post('username'), time()+86500); 	
						$this->input->set_cookie('password_customer_cookie', $this->input->post('password'), time()+86500); 
					}
					else
					{
						delete_cookie("email_customer_cookie");
						delete_cookie("password_customer_cookie");
					}
					$this->session->set_flashdata('success', 'WELCOME user, Your Acount are succesfully created ');
					//redirect(base_url("checkout/index"),'refresh');
					//redirect(base_url("'".$from_url."'"),'refrash');
					//redirect(base_url($from_url),'refrash');
					echo 'success'; 
				}
				else
				{
					$this->session->set_flashdata('error', INVALID_LOGIN);	
					//$this->session->set_flashdata('error', 'Invalid username and password.');				
					//redirect(base_url("checkout/index"),'refresh');
					//redirect(base_url("'".$from_url."'"),'refrash');	
					//redirect(base_url($from_url),'refrash');
					echo 'success';
				}
				//redirect("product/index",'refresh');
			}
		}
		else
		{
			echo 'wrong access';
			//echo json_encode('wrong access');
		}
	}
	
	public function get_run_by_zip_code_for_reccuring()
	{
		$this->data['order_id']='';
		$this->data['customer_id']=$this->input->post('customer_id');
		$this->data['zip_code']=$this->input->post('zip_code');
		print_r(($this->load->view('checkout/get_run_by_zip_code_for_reccuring',$this->data,true)));
	}
	
	public function get_run_by_zip_code_for_fornightly()
	{
		$this->data['order_id']='';
		$this->data['customer_id']=$this->input->post('customer_id');
		$this->data['zip_code']=$this->input->post('zip_code');
		print_r(($this->load->view('checkout/get_run_by_zip_code_for_fornightly',$this->data,true)));
	}
}