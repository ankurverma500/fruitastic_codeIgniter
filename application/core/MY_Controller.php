<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_DEPRECATED);
//require_once('../controllers/admin/Notes.php');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
//date_default_timezone_set('Australia/Melbourne');
/*if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('GMT');
}*/

class MY_Controller extends CI_Controller 
{
		
	public $currentAddDate=0;
	public $currentAddDate_time=0;
	public $currentAdd_time=0;
	public $added_by='';
	public $session_id=0;
	public $ip_address=0;
	public $admin_email='sksr2050@gmail.com';
	public $data;
	public $customer_type='';
	public $customer_type_id;
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('session'); 
		//$this->load->library(array('form_validation','email','user_agent'));
		//,'session','form_validation','email','user_agent'		
		$this->load->model('common');		
		//$this->load->helper('cookie');
		$this->load->helper('common');		
        //$this->load->helper('url'); 
		$this->load->library('common_lb');
		//$this->load->library('common_lb');
		$this->load->library('notification');
		//echo base_url;
		//paking/print_order_product
		$this->load->library('cart');
		$this->data['con'] = $this->router->fetch_class();
  		$this->data['method'] = $this->router->fetch_method();
		
		$this->currentAddDate = date('Y-m-d');
		$this->currentAddDate_time = date('Y-m-d H:i:s');
		$this->currentAdd_time = date('H:i:s');
		if($this->session->userdata('admin_login'))
		{
			$sess 	= 	$this->session->userdata('admin_login');
			$ar 	= 	unserialize($sess);		
			$this->added_by=$ar['id'];
			$this->name=$ar['name'];
			$this->payment_option=$ar['payment_option'];
			$this->customer_type=$ar['customer_type'];
			$this->customer_type_id=$ar['customer_type_id'];
			$this->api_token=$ar['api_token'];
			$this->admin_email='';
		}
		//echo $this->added_by;exit;
		
		//DEV
		$this->session->set_userdata('eWAY_key', '60CF3Czk1Y+NyyE+BDrNcQm144QfqVO+QRKTjVjMIbrxPaE4l5G1TV09bot9w0XX3B0Jps');
		$this->session->set_userdata('eWAY_pass', 'qa1YKyqN');
		//Live
		//$this->session->set_userdata('eWAY_key', 'C3AB9A9513buqjwUlEtJr4n8URX4eCjueL19dW3yOU2bNKHgOKOoVhLGopxiCuN9SQpout');
		//$this->session->set_userdata('eWAY_pass', '0Gz1Ghp2');
		
		$this->session_id = session_id();
	    $this->ip_address=$_SERVER['REMOTE_ADDR'];
	}
	
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
	
	function send_email($mail_data=null)
	{
		 $this->load->library('email');
		 $config=array(
						'charset'=>'utf-8',
						'wordwrap'=> TRUE,
						'mailtype' => 'html'
						);
		$this->email->initialize($config);
		//$this->email->clear();
		$this->email->from('ankur@efrog.in', 'Ankur','ankur@efrog.in');
		$this->email->set_newline("\r\n");
		$this->email->to($mail_data['to']);
		//$this->email->cc('another@another-example.com');
		$this->email->bcc('ankurverma500@gmail.com');	
		//$this->email->attach('http://example.com/filename.pdf');	
		$this->email->subject($mail_data['subject']);
		$this->email->message($mail_data['message']);		
		$res=$this->email->send();
		if($res)
		{
			//echo 'done';
		}
		else
		{
			//echo 'error';
			//$this->email->print_debugger(array('headers'));
		}
		//$this->email->clear(TRUE);		
	}
	
	public function  send_user_register_mail($name)
	{
		return $message='<table width="700" border="0" cellspacing="0" cellpadding="0">
					 <tr>
							<td>
							  <p>Welcome on board '.$name.'</p>
						   </td>
					</tr>
					<tr>
						<td>
						  <p>Thank you so much for allowing us to supply you with your weekly fruit and veg needs. We are committed to providing our customers with Australia’s finest farm fresh produce and a service level that’s rarely seen these days. Our team is dedicated to you and your order.</p>
					   </td>
					</tr>
					<tr>
						<td>
						  <p>We are very glad you chose us as your preferred fruit and veg specialists, and hope you will take advantage of our product range including locally sourced South Gippsland Free Range Eggs which are picked for us daily, and our Mornington Peninsula Freshly squeezed Juice range just to name a few fresh ideas that are packed full of goodness, and priced below recommended retail to help you save further. </p>
					   </td>
					</tr>
					<tr>
						<td>
						  <p>We will be adding Milk and Bread lines to our list of offerings very soon, so please keep an eye out for these on our online store, and add them to your calendar of daily/weekly deliveries. If you’re thinking about going organic, or have family or friends wanting to use our service but are after organics, there’s great news for you also. <strong>Organics commence first quarter 2018.</strong></p>
					   </td>
					</tr>
					<tr>
						<td>
						  <p>Keeping up with us and our growers has been simplified for you. Simply visit our web site www.fruitastic.com.au  to find our social links at the top of our page. We endeavour to keep our content educational and fun to watch. New how-to videos are posted weekly. Perhaps you’re wanting professional tips on how to store an item, or best cleaning practices of a fruit or vegetable. These tips and ideas can all be found within these pages.</p>
					   </td>
					</tr>
					<tr>
						<td>
						  <p>From our family to yours, we truly are excited to have you on board. Our team strives to fill each and every order to the absolute highest of standards to help you eat well, save you time and effort and keep you up to date with everything Fruitastic. We are always open to suggestions, and requests. So please feel free to shoot us a line at service@fruitastic.com.au or a comment on our facebook page, www.facebook/com/FruitasticMelbourne and we will endeavour to full fill your wish if possible.</p>
					   </td>
					</tr>	
						<tr>
						<td>
							<p>Enjoy your delivery and see you soon. </p>
							</td>
							</tr>
				  </table>';
	}
	
	public function login_check()
	{
		if(!$this->session->userdata('admin_login'))
		{
			$this->session->set_flashdata('error','Please login first' );
			redirect(base_url("checkout/your_detail"),'refresh');
		}
	}
	
	public function after_place_order_split_it($order_id)
	{
		$data=array('table'=>'tbl_order',
					'val'=>'*',//array('payment_mode'=>$value,'order_source'=>'5')
					'where'=>array('id'=>$order_id)	
					);
		$res=$this->common->getdata($data);
		$order_type=$res['rows'][0]->order_type;
		$customer_id=$res['rows'][0]->user_id;
		//====================================================================================//
		//copy all order data to onther
			if($order_type!='1')
			{
				$data3=array('table'=>'tbl_recurring_order_master',
							'val'=>'*',
							'where'=>array('order_id'=>$order_id)//'customer_id'=>$customer_id,	
							);
				$rom=$this->common->getdata($data3);
				$rom_counter=1;
				//print_r(json_encode($rom));
				//exit;
				if($rom['res'])
				{
					foreach($rom['rows'] as $rom_res)
					{
						if($rom_counter>1)
						{
						$query="INSERT INTO `tbl_order`
								(`order_recurring_id`,`order_type`, `payment_mode`, `order_source`, `user_id`, `name`, 
								`contact_no`, `email`, `zip_code`, `longitude`, `latitude`, `address`, `order_status`, 
								`approved_order`, `added_date`, `delivery_status`,   `payment_type`,`payment_status`, 
								`shipment`,  `warehouse_id`, `order_run_id`, `run_day`, `total`, 
								`delivery_notes`, `packing_note`, `deleted`,`amount`,`ship_amount`,`amount_total`,
								formated_address,
								tbl_customer_payment_options_id,
								tbl_customer_payment_options_day,
								tbl_customer_payment_options_date,
								tbl_customer_payment_options_no_day,
								tbl_customer_type_from_id,
								TokenCustomerID)
								
							(SELECT `order_recurring_id`,`order_type`,`payment_mode`,`order_source`, `user_id`,`name`,
								`contact_no`, `email`, `zip_code`, `longitude`, `latitude`, `address`,`order_status`,
								`approved_order`, `added_date`, `delivery_status`,  `payment_type`,'2',
								`shipment`,  `warehouse_id`, `order_run_id`, `run_day`, `total`,
								`delivery_notes`, `packing_note`, `deleted`,`amount`,`ship_amount`,`amount_total`,
								formated_address,
								tbl_customer_payment_options_id,
								tbl_customer_payment_options_day,
								tbl_customer_payment_options_date,
								tbl_customer_payment_options_no_day,
								tbl_customer_type_from_id,
								TokenCustomerID
								FROM `tbl_order` 
								WHERE `id`='$order_id')
								";
						$this->db->query($query);
						//$this->db->last_query();
						$last_id=$this->db->insert_id();
						$this->db->query("INSERT INTO `tbl_order_summary`
						( `order_id`, `product_id`, `product_price`, `qty`,`product_gst`, `amount`, `not_managed_by_admin`, `added_date`, `deleted`)  
						(SELECT  $last_id, `product_id`, `product_price`, `qty`,`product_gst`, `amount`, `not_managed_by_admin`, `added_date`, `deleted` FROM `tbl_order_summary` WHERE `order_id`='$order_id')");					
						
						$this->db->query("INSERT INTO `tbl_order_summary_tracking`( `user_id`, `product_id`, `order_id`, `order_summary_id`, `new_order`, `new_order_date`, `receive_order`, `receive_order_date`, `cancel_by_admin`, `cancel_by_admin_date`, `cancel_by_user`, `cancel_by_user_date`, `po`, `po_date`, `packaging`, `packaging_date`, `dispatched`, `dispatched_date`, `delivered`, `delivered_date`, `returned`, `returned_date`, `driver_id`, `vehicle_id`, `warehouse_id`) (SELECT `user_id`, `product_id`, $last_id, `order_summary_id`, `new_order`, `new_order_date`, `receive_order`, `receive_order_date`, `cancel_by_admin`, `cancel_by_admin_date`, `cancel_by_user`, `cancel_by_user_date`, `po`, `po_date`, `packaging`, `packaging_date`, `dispatched`, `dispatched_date`, `delivered`, `delivered_date`, `returned`, `returned_date`, `driver_id`, `vehicle_id`, `warehouse_id` FROM `tbl_order_summary_tracking` WHERE `order_id`='$order_id')");
						
						$data5=array('table'=>'tbl_order',
									'val'=>array('order_id'=>'ORDIDA.'.$last_id),
									'where'=>array('id'=>$last_id));
						
						
						if($order_type=='2')
						{
							$data5['val']['order_shown_id']='RO.'.$last_id;
						}
						else if($order_type=='3')
						{								
							$data5['val']['order_shown_id']='FO.'.$last_id;
						}
						
						$this->common->update_data($data5);
						
						
						$data4=array('table'=>'tbl_recurring_order_master',
									'val'=>array('order_id'=>$last_id), 
									'where'=>array('id'=>$rom_res->id)	
									);
						$rom=$this->common->update_data($data4);
												
						}
						$rom_counter++;
					}
				}
			}//end
			//====================================================================================//
					
	}
	
}
