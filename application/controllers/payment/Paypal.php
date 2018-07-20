<?php
//header("Access-Control-Allow-Origin: *"); 
//header("Access-Control-Allow-Headers: Content-Type");
//defined('BASEPATH') OR exit('No direct script access allowed');

//require_once(APPPATH.'controllers/admin/Email.php');
class Paypal extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		//define('online_Site_Url','https://www.binaryfrog.co/school/checkout/payment_status/?status=');
		define('online_Site_Url',base_url('checkout/payment_status/?status='));
		//$this->load->library("payment/RapidAPI");
		//$this->load->library("rapidAPI");
		//$this->session->set_userdata('eWAY_key', '60CF3Czk1Y+NyyE+BDrNcQm144QfqVO+QRKTjVjMIbrxPaE4l5G1TV09bot9w0XX3B0Jps');
		//$this->session->set_userdata('eWAY_pass', 'qa1YKyqN');
		/*for real time paymant*/
		//$this->session->set_userdata('eWAY_key', 'C3AB9A9513buqjwUlEtJr4n8URX4eCjueL19dW3yOU2bNKHgOKOoVhLGopxiCuN9SQpout');
		//$this->session->set_userdata('eWAY_pass', '0Gz1Ghp2');
		/*		
		for real time paymant*/
		/*$this->session->set_userdata('eWAY_key', 'C3AB9A9513buqjwUlEtJr4n8URX4eCjueL19dW3yOU2bNKHgOKOoVhLGopxiCuN9SQpout');
		$this->session->set_userdata('eWAY_pass', '0Gz1Ghp2');*/
		 
	}
	public function index()
	{
		//echo $this->uri->segment(2);
		
			// first page.  defoult load page
			if(isset($_REQUEST['order_id']))
			{
				$order_id=$_REQUEST['order_id'];
				$comment1=array('table'=>'tbl_order as tor',
								'val'=>'*,tor.id order_id',
								'where'=>array('tor.id'=>$order_id),
								'minvalue'=>'',
								'group_by'=>'',
								'start'=>'',
								'orderby'=>'tor.id',
								'orderas'=>'DESC');
			   $multijoin1=array(
							array('table'=>'tbl_customer as tc','on'=>'tc.id=tor.user_id','join_type'=>'')
							);         
				$res=$this->common->multijoin($comment1,$multijoin1);
				
				if($res['res'])
				{
					$this->data['order_id']=$order_id;
					$this->data['result']=$res['rows'][0];
					$da=array('val'=>'*',
							  'table'=>'tbl_customer_address',
							  'where'=>array('customer_id'=>$res['rows'][0]->user_id)					  
							  );
					$coustomer_address=$this->common->getdata($da);
					$this->data['coustomer_address']=$coustomer_address;
					/*echo '<pre>';
					print_r($this->data['result']);	
					exit;
					exit;	*/					
					$html=$this->load->view('payment/paypal',$this->data);
				}
				else
				{
					echo 'Wrong access , Wrong Order Id  or user id';
					exit;
				}
						
		}
	}
	
	function return_url()
	{
		$order_id = $this->input->post('order_id');
		$payment_mode=$this->input->post('payment_mode');
		$payment_status=$this->input->post('payment_status');
		$transection_id=$this->input->post('transection_id');
		
		$this->db->query("update tbl_order set 
			payment_mode='2',
			payment_type = '".$payment_mode."', 
			payment_status='3', 
			TransactionID='".$transection_id."',
			sess_id='".$transection_id."',
			order_status='1',
			payment_date=CURDATE(),
			status='1',
			deleted='0'		
			where id = $order_id");
		//$this->load->view('payment/loader');
		$comment1=array('table'=>'tbl_order as tor',
						'val'=>'tc.email as email,tc.id as tbl_customer_id',
						'where'=>array('tor.id'=>$order_id),
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tor.id',
						'orderas'=>'DESC');
	   $multijoin1=array(
					array('table'=>'tbl_customer as tc','on'=>'tc.id=tor.user_id','join_type'=>'')
					);
		$res=$this->common->multijoin($comment1,$multijoin1);
		$email_to=array($res['rows'][0]->email,$this->admin_email);
		
		//$this->data['request']=$request;
		/*echo '<pre>';
		print_r($service);
		print_r($request);
		print_r($result);				
		exit;*/
		$tbl_customer_id=$res['rows'][0]->tbl_customer_id;
		
		
		
		$this->data['in_page'] = 'view_result';
		if(!$payment_status)
		{
			$da=array('val'=>array('TransactionID'=>$result->TransactionID,
								   'TokenCustomerID'=>$result->TokenCustomerID,
								   'ResponseCode'=>$result->ResponseCode,
								   'payment_mode'=>'2',
								   'payment_status'=>'4',
								   'order_status'=>'1',
								   'payment_type'=>' Paypal Payment Canceled',
								   'deleted'=>'1',
								   'status'=>'0',
								   'payment_date'=>$this->currentAddDate_time),
					  'table'=>'tbl_order',
					  'where'=>array('id'=>$order_id)					  
					  );
			$coustomer_order=$this->common->update_data($da);
			redirect(online_Site_Url."fail",'refresh');
		}
		else
		{
			if($transection_id=='')
			{					
				$html=$this->load->view('payment/return_page',$this->data,true);
				$mail_data=array('to'=>$email_to,
								 'subject'=>'Payment Status',
								 'message'=>$html);
				$this->send_email($mail_data);
				
				$da=array('val'=>array('TransactionID'=>$result->TransactionID,
									   'TokenCustomerID'=>$result->TokenCustomerID,
									   'ResponseCode'=>$result->ResponseCode,
									   'payment_mode'=>'2',
									   'payment_type'=>'Paypal',
									   'payment_status'=>'1',
									   'order_status'=>'1',
									   'deleted'=>'0',
									   'status'=>'1',
									   'payment_date'=>$this->currentAddDate_time),
						  'table'=>'tbl_order',
						  'where'=>array('id'=>$order_id)					  
						  );
				$coustomer_order=$this->common->update_data($da);
				redirect(online_Site_Url."fail",'refresh');
			}
			else
			{
				$da=array('val'=>array(
						   'tbl_customer_id'=>$tbl_customer_id,
						   'TokenCustomerID'=>$result->TokenCustomerID,	
						   'ResponseCode'=>$result->ResponseCode,
						   'add_dateTime'=>$this->currentAddDate_time,
						   'status'=>'1'
						   ),									   
			  'table'=>'tbl_customer_TokenID'					  
			  );
			$this->common->add_data($da);
			$not_data=array('note_to_tbl_name'=>'tbl_admin',
							'note_to_id'=>'1',
							'note_from_tbl_name'=>'tbl_customer',//tbl_order
							'note_from_id'=>$tbl_customer_id, 
							'note_titel'=>'New Order add',
							'note_detail'=>'Order by Fruitastic Site(Paypal), order id:- '.$order_id,
							'page_link'=>'admin/customer/edit_order/'.$tbl_customer_id.'/'.$order_id,
							'icon'=>'ORDER'
							);
			//$this->notification->set($not_data);
			
				//$html=$this->load->view('payment/thanks_to_order',$this->data,true);
				/*$mail_data=array('to'=>$email_to,
								 'subject'=>'Thank You For Order Us',
								 'message'=>$html);
				$this->send_email($mail_data);*/
				$da1=array('val'=>array(
									   'payment_gateway_status'=>'1',
									   'TokenCustomerID'=>$result->TokenCustomerID
									   ),
						  'table'=>'tbl_customer',
						  'where'=>array('id'=>$tbl_customer_id)					  
						  );
				$this->common->update_data($da1);
				$da=array('val'=>array('TransactionID'=>$result->TransactionID,
									   'TokenCustomerID'=>$result->TokenCustomerID,
									   'ResponseCode'=>$result->ResponseCode,
									   'payment_mode'=>'2',
									   'payment_type'=>'Paypal',
									   'payment_status'=>'3',
									   'order_status'=>'1',
									   'deleted'=>'0',
									   'status'=>'1',
									   'payment_date'=>$this->currentAddDate_time),
						  'table'=>'tbl_order',
						  'where'=>array('id'=>$order_id)					  
						  );
				$coustomer_order=$this->common->update_data($da);
				$this->after_place_order_split_it($order_id);					
				if($coustomer_order)
				{
					//echo 'done<pre>';
					//print_r($this->data);
					//$this->load->view('payment/return_page',$this->data);
					$html=$this->load->view('payment/return_page',$this->data,true);
					$mail_data=array('to'=>$email_to,
									 'subject'=>'Payment Status',
									 'message'=>$html);
					$this->send_email($mail_data);
					//redirect(online_Site_Url."success",'refresh');
					//exit;
				}
				else
				{
					/*print_r($da);
					exit;*/
					$html=$this->load->view('payment/return_page',$this->data,true);
					$mail_data=array('to'=>$email_to,
									 'subject'=>'Payment Status',
									 'message'=>$html);
					$this->send_email($mail_data);
					//redirect(online_Site_Url."fail&payment=success",'refresh');
					//echo 'update for updating';
					//exit;
				}					
			}
		}
	}
	function cancle_url()
	{
		//$this->load->view('payment/loader');
		$this->loader_function();
		if(isset($_GET['AccessCode']) ) 
		{
			$AccessCode = $_GET['AccessCode'];
			// should be somewhere from config instead of SESSION
			if($_SESSION['eWAY_key'] && $_SESSION['eWAY_password']) 
			{
				// Call RapidAPI
				$eway_params = array();
				//if ($_SESSION['eWAY_sandbox']) $eway_params['sandbox'] = true;
				if ($_SESSION['eWAY_sandbox']) $eway_params['sandbox'] = false;
				$service = new eWAY\RapidAPI($_SESSION['eWAY_key'], $_SESSION['eWAY_password'], $eway_params);
				
				$request = new eWAY\GetAccessCodeResultRequest();
				$request->AccessCode = $AccessCode;
				$result = $service->GetAccessCodeResult($request);
				
				$this->data['service']=$service;
				$this->data['request']=$request;
				$this->data['AccessCode']=$AccessCode;
				$this->data['result']=$result;
				$this->data['order_id']=$order_id=$result->InvoiceNumber;
				$this->data['TransactionID']=$result->TransactionID;
				$comment1=array('table'=>'tbl_order as tor',
								'val'=>'tc.email as 	email',
								'where'=>array('tor.id'=>$order_id),
								'minvalue'=>'',
								'group_by'=>'',
								'start'=>'',
								'orderby'=>'tor.id',
								'orderas'=>'DESC');
			   $multijoin1=array(
							array('table'=>'tbl_customer as tc','on'=>'tc.id=tor.user_id','join_type'=>'')
							);         
				$res=$this->common->multijoin($comment1,$multijoin1);
				$email_to=array($res['rows'][0]->email,$this->admin_email);	
				//$this->data['request']=$request;
				
					$html=$this->load->view('payment/return_page',$this->data,true);
					$mail_data=array('to'=>$email_to,
									 'subject'=>'Payment Status is  Canceled',
									 'message'=>$html);
					$this->send_email($mail_data);
					$da=array('val'=>array('TransactionID'=>$result->TransactionID,
										   'payment_mode'=>'2',
										  /* 'payment_type'=>'',*/
										   'payment_status'=>'1',
										   'order_status'=>'1',
										   'payment_type'=>' eway Payment Canceled',
										   'deleted'=>'1',
									 	   'status'=>'0',
										   'payment_date'=>$this->currentAddDate_time),
							  'table'=>'tbl_order',
							  'where'=>array('id'=>$order_id)					  
							  );
					$coustomer_order=$this->common->update_data($da);
					redirect(online_Site_Url."fail",'refresh');
				/*
				echo '<pre>';
				print_r($service);
				print_r($request);
				print_r($result);				
				exit;
				*/
			}
		}
		/*
		print_r($_REQUEST);
		exit;
		*/
	}
	function loader_function()
	{		
	
		
		$this->load->view('payment/loader');
		
		
		//sleep(10);
		//exit;
		//redirect(online_Site_Url."fail",'refresh');
	}
}