<?php
//header("Access-Control-Allow-Origin: *"); 
//header("Access-Control-Allow-Headers: Content-Type");
//defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/RapidAPI.php');
//require_once(APPPATH.'controllers/admin/Email.php');
class Eway extends MY_Controller 
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
		//exit;
		$this->data['in_page'] = 'before_submit';
		$this->data['lblError']='';
		if (isset($_POST['btnSubmit'])) 
		{
			
			// we skip all validation but you should do it in real world		
			// Create Responsive Shared Page Request Object
			$request = new eWAY\CreateAccessCodesSharedRequest();		
			// Populate values for Customer Object
			// Note: TokenCustomerID is Required Field When Update an exsiting TokenCustomer
			if(!empty($_POST['txtTokenCustomerID'])) 
			{
				$request->Customer->TokenCustomerID = $_POST['txtTokenCustomerID'];
			}
		
			$request->Customer->Reference = $_POST['txtCustomerRef'];
			$request->Customer->Title = $_POST['ddlTitle'];
			$request->Customer->FirstName = $_POST['txtFirstName'];
			$request->Customer->LastName = $_POST['txtLastName'];
			$request->Customer->CompanyName = $_POST['txtCompanyName'];
			$request->Customer->JobDescription = $_POST['txtJobDescription'];
			$request->Customer->Street1 = $_POST['txtStreet'];
			$request->Customer->City = $_POST['txtCity'];
			$request->Customer->State = $_POST['txtState'];
			$request->Customer->PostalCode = $_POST['txtPostalcode'];
			$request->Customer->Country = $_POST['txtCountry'];
			$request->Customer->Email = $_POST['txtEmail'];
			$request->Customer->Phone = $_POST['txtPhone'];
			$request->Customer->Mobile = $_POST['txtMobile'];
			$request->Customer->Comments = $_POST['txtComments'];
			$request->Customer->Fax = $_POST['txtFax'];
			$request->Customer->Url = $_POST['txtUrl'];
		
			// Populate values for ShippingAddress Object.
			// This values can be taken from a Form POST as well. Now is just some dummy data.
			/*
			$request->ShippingAddress->FirstName = "John";
			$request->ShippingAddress->LastName = "Doe";
			$request->ShippingAddress->Street1 = "9/10 St Andrew";
			$request->ShippingAddress->Street2 = " Square";
			$request->ShippingAddress->City = "Edinburgh";
			$request->ShippingAddress->State = "";
			$request->ShippingAddress->Country = "gb";
			$request->ShippingAddress->PostalCode = "EH2 2AF";
			$request->ShippingAddress->Email = "your@email.com";
			$request->ShippingAddress->Phone = "0131 208 0321";
			*/
			
			$request->ShippingAddress->FirstName = $_POST['txtFirstName'];
			$request->ShippingAddress->LastName = $_POST['txtLastName'];
			$request->ShippingAddress->Street1 = $_POST['txtStreet'];
			$request->ShippingAddress->Street2 = "";
			$request->ShippingAddress->City = $_POST['txtCity'];
			$request->ShippingAddress->State = $_POST['txtState'];
			$request->ShippingAddress->Country = $_POST['txtCountry'];
			$request->ShippingAddress->PostalCode = $_POST['txtPostalcode'];;
			$request->ShippingAddress->Email = $_POST['txtEmail'];
			$request->ShippingAddress->Phone = $_POST['txtPhone'];
			// ShippingMethod, e.g. "LowCost", "International", "Military". Check the spec for available values.
			$request->ShippingAddress->ShippingMethod = "LowCost";
		
			if ($_POST['ddlMethod'] == 'ProcessPayment' || $_POST['ddlMethod'] == 'Authorise' || $_POST['ddlMethod'] == 'TokenPayment') {
				
					// Populate values for LineItems
					$item1 = new eWAY\LineItem();
					$item1->SKU = "SKU1";
					$item1->Description = "Description1";
					$item2 = new eWAY\LineItem();
					$item2->SKU = "SKU2";
					$item2->Description = "Description2";
					$request->Items->LineItem[0] = $item1;
					$request->Items->LineItem[1] = $item2;
			
					// Populate values for Payment Object
					$request->Payment->TotalAmount = $_POST['txtAmount'];
					$request->Payment->InvoiceNumber = $_POST['txtInvoiceNumber'];
					$request->Payment->InvoiceDescription = $_POST['txtInvoiceDescription'];
					$request->Payment->InvoiceReference = $_POST['txtInvoiceReference'];
					$request->Payment->CurrencyCode = $_POST['txtCurrencyCode'];
				}
		
			// Populate values for Options (not needed since it's in one script)
			$opt1 = new eWAY\Option();
			$opt1->Value = $_POST['txtOption1'];
			$opt2 = new eWAY\Option();
			$opt2->Value = $_POST['txtOption2'];
			$opt3 = new eWAY\Option();
			$opt3->Value = $_POST['txtOption3'];
	
			$request->Options->Option[0]= $opt1;
			$request->Options->Option[1]= $opt2;
			$request->Options->Option[2]= $opt3;
		
			// Build redurect & cancel URLs
			$self_url = 'http';
			if (!empty($_SERVER['HTTPS'])) {$self_url .= "s";}
			$self_url .= "://" . $_SERVER["SERVER_NAME"];
			if ($_SERVER["SERVER_PORT"] != "80") {
				$self_url .= ":".$_SERVER["SERVER_PORT"];
			}
			$self_url .= $_SERVER["REQUEST_URI"];
			$self_url=base_url('payment/eway/return_url');
			
			$request->RedirectUrl = $self_url;
			$request->CancelUrl   = base_url('payment/eway/cancle_url');
			$request->Method = $_POST['ddlMethod'];
			$request->TransactionType = $_POST['ddlTransactionType'];
		
			$request->LogoUrl = $_POST['txtLogoUrl'];
			$request->HeaderText = $_POST['txtHeaderText'];
			$request->CustomView = $_POST['txtTheme'];
			$request->CustomerReadOnly = true;
		
			if ($_POST['txtVerifyMobile']) $request->VerifyCustomerPhone = true;
			if ($_POST['txtVerifyEmail']) $request->VerifyCustomerEmail = true;
			
			// Call RapidAPI
			$eway_params = array();
			//if ($_POST['ddlSandbox']) $eway_params['sandbox'] = true;
			if ($_POST['ddlSandbox']) $eway_params['sandbox'] = false;
			$service = new eWAY\RapidAPI($_POST['APIKey'], $_POST['APIPassword'], $eway_params);
			$result = $service->CreateAccessCodesShared($request);
			/*echo $result->Errors;
			echo '<pre>';
			//print_r($_POST);
			echo 'hi';exit;*/
				// Check if any error returns
			if(isset($result->Errors)) 
			{
				// Get Error Messages from Error Code.
				$ErrorArray = explode(",", $result->Errors);
				$$this->data['lblError'] = "";
				foreach ( $ErrorArray as $error ) {
					$error = $service->getMessage($error);
					$$this->data['lblError'] .= $error . "<br />\n";
				}
			} else 
			{
				$_SESSION['eWAY_key'] = $_POST['APIKey'];
				$_SESSION['eWAY_password'] = $_POST['APIPassword'];
				$_SESSION['eWAY_sandbox'] = $_POST['ddlSandbox'];
		
				header("Location: " . $result->SharedPaymentUrl);
				exit();
			}
		}
		else
		{
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
					exit;	*/							
					$html=$this->load->view('payment/submit',$this->data);
				}
				else
				{
					echo 'Wrong access , Wrong Order Id  or user id';
					exit;
				}
			}
			else
			{
				echo 'wrong exsess';
			}			
		}
	}
	
	function return_url()
	{
		//$this->load->view('payment/loader');
		$this->loader_function();
		$this->data['in_page'] = 'view_result';
		$this->data['lblError']='';
		$this->data['order_id']='';
		if ( isset($_GET['AccessCode']) ) 
		{
			$AccessCode = $_GET['AccessCode'];
			// should be somewhere from config instead of SESSION
			if ($_SESSION['eWAY_key'] && $_SESSION['eWAY_password']) 
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
				$this->data['TokenCustomerID']=$result->TokenCustomerID;
				$this->data['ResponseCode']=$result->ResponseCode;
				
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
				if($result->ResponseCode=='58')
				{
					
					/*$ErrorArray = explode(",", $result->Errors);
					$$this->data['lblError'] = "";
					foreach ( $ErrorArray as $error ) 
					{
						$error = $service->getMessage($error);
						$$this->data['lblError'] .= $error . "<br />\n";
					}
					$html=$this->load->view('payment/return_page',$this->data,true);
					$mail_data=array('to'=>$email_to,
									 'subject'=>'Payment Status',
									 'message'=>$html);
					$this->send_email($mail_data);*/
					$da=array('val'=>array('TransactionID'=>$result->TransactionID,
										   'TokenCustomerID'=>$result->TokenCustomerID,
										   'ResponseCode'=>$result->ResponseCode,
										   'payment_mode'=>'2',
										   'payment_status'=>'4',
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
				}
				else
				{
					if($result->TransactionID=='')
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
											   'payment_type'=>'eway',
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
				
					if (isset($result->Errors)) 
					{
						//echo 'Errors';
						//exit;
						$ErrorArray = explode(",", $result->Errors);
						$$this->data['lblError'] = "";
						foreach ( $ErrorArray as $error ) 
						{
							$error = $service->getMessage($error);
							$$this->data['lblError'] .= $error . "<br />\n";
						}
						$html=$this->load->view('payment/return_page',$this->data,true);
						$mail_data=array('to'=>$email_to,
										 'subject'=>'Payment Status',
										 'message'=>$html);
						$this->send_email($mail_data);
						$da=array('val'=>array('TransactionID'=>$result->TransactionID,
											   'TokenCustomerID'=>$result->TokenCustomerID,
											   'ResponseCode'=>$result->ResponseCode,
											   'payment_mode'=>'2',
											   'payment_type'=>'eway',
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
									'note_detail'=>'Order by Cheapstore Site(Eway), order id:- '.$order_id,
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
											   'payment_type'=>'eway',
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
							redirect(online_Site_Url."success",'refresh');
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
							redirect(online_Site_Url."fail&payment=success",'refresh');
							//echo 'update for updating';
							//exit;
						}					
					}
				}
			}			
		}
		else
		{
			$html=$this->load->view('payment/return_page',$this->data,true);
			$mail_data=array('to'=>$email_to, 
							 'subject'=>'Payment Status',
							 'message'=>$html);
			$this->send_email($mail_data);
			$da=array('val'=>array('TransactionID'=>'',
								   'TokenCustomerID'=>'',
								   'payment_mode'=>'2',
								   'payment_type'=>'eway',
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
		//print_r($_REQUEST);
		//exit;
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