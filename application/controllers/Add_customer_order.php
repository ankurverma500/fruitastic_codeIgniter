<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_customer_order extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
		
	}
	public function add()
	{
	
	//{customer_id: "9", product_id: "16", qty: "1", total_price: "100", order_id: "7"}
		$order_id		=	$this->input->post("order_id");
		$customer_id	=	$this->input->post("customer_id");		
		$product_id		=	$this->input->post("product_id");
		$qty			=	$this->input->post("qty");
		$total_price	=	$this->input->post("total_price");
		$cost_per_unit	=	$this->input->post("cost_per_unit");
		$Delivery_Charges=$this->input->post('Delivery_Charges');
		$this->currentAddDate;
		$this->currentAddDate_time;
		$da=array('val'=>'*',
				  'table'=>'tbl_order_summary',
				  //'where'=>array('user_id'=>$customer_id,'product_id'=>$product_id,'order_run_id'=>'','payment_mode'=>'')
				  'where'=>array('order_id'=>$order_id,'product_id'=>$product_id)//sess_id
				  );
		 
       	$coustomer_order_summary=$this->common->getdata($da);
		/*
		INSERT INTO `tbl_order_summary_tracking` (`order_id`, `product_id`, `user_id`, `order_summary_id`, `new_order`, `new_order_date`) VALUES ('51', '1', '9', 27, 1, '2017-09-27 12:04:39')
		
		INSERT INTO `tbl_order_summary` (`order_id`, `product_id`, `qty`, `amount`) VALUES ('52', '1', '1', '1.10')
		*/
		 //print_r(json_encode( $coustomer_order_summary ) );
		//print_r( json_encode($this->db->last_query()) );		
		//print_r(json_encode($_POST));
		//exit;
		$this->db->query("UPDATE `tbl_order` SET `amount`=($total_price+amount),ship_amount=$Delivery_Charges,amount_total=(($total_price+$Delivery_Charges)+amount)
		 WHERE `id`=$order_id");
		
		/*print(json_encode($this->db->last_query()) );
		exit;*/
		
		if($coustomer_order_summary['res'])
		{			
			/*
			$cod=$coustomer_order_summary['rows'][0];			
			$data=array('table'=>'tbl_order_summary',
						'where'=>array('order_id'=>$order_id,
					        	 	   'product_id'=>$product_id),
						'val'=>array('qty'=>$qty, //($all_product['rows'][0]->quantity+$qty)
									 'amount'=>$amount)
						);
       		 $log=$this->common->update_data($data);*/
			$log = $log1= $this->db->query("UPDATE `tbl_order_summary` SET qty=(qty+$qty), `amount`=($total_price+amount) WHERE `id`=$order_id AND product_id='$product_id'");
			 
		}
		else
		{	
		
			/*
			echo json_encode($data);
			//exit;
			
			*/
			$data=array('table'=>'tbl_order_summary',
						'val'=>array('order_id'=>$order_id,
					        	 	 'product_id'=>$product_id,
									 'product_price'=>$cost_per_unit,
									 'qty'=>$qty,
									 'amount'=>$total_price));			
			$log=$this->common->add_data($data);
			$last_id=$this->db->insert_id();
			//echo json_encode($this->db->last_query());
			//exit;
			$data1=array('table'=>'tbl_order_summary_tracking',
						'val'=>array('order_id'=>$order_id,
					        	 	 'product_id'=>$product_id,
									 'user_id'=>$customer_id,
									 'order_summary_id'=>$last_id,
									 'new_order'=>1,
									 'new_order_date'=>$this->currentAddDate_time));			
			$log1=$this->common->add_data($data1);
			//print_r( json_encode($data));
			//exit;
			//echo json_encode( $this->db->last_query() );
			//exit;
		}
		
		if($log && $log1)
		{
			$this->session->set_flashdata('success', ADD_MESSAGE);
			echo json_encode('success');			
			exit;
		}
		else
		{
			$this->session->set_flashdata('error', 'Order is not created.');
			echo json_encode('error');
			exit;
		}		
	}
	
	function add_subtract_order_item()
	{	
	/*print_r(json_encode($_POST));
	exit;*/
		$cost_per_unit=$this->input->post('cost_per_unit');
		$customer_id=$this->input->post('customer_id');
		$order_id=$this->input->post('order_id');
		$product_id=$this->input->post('product_id');
		$qty=$this->input->post('qty');
		$sub_total=$this->input->post('sub_total');
		$total_cost=$this->input->post('total_cost');
		$Delivery_Charges=$this->input->post('Delivery_Charges');
		$data=array('table'=>'tbl_order',
					'val'=>array('amount'=>$total_cost,'amount_total'=>($total_cost+$Delivery_Charges),'ship_amount'=>$Delivery_Charges),
					'where'=>array('id'=>$order_id));
		
		$log=$this->common->update_data($data);
		$data=array('table'=>'tbl_order_summary',
						'val'=>array('qty'=>$qty,'product_price'=>$cost_per_unit,'amount'=>$sub_total),
						'where'=>array('order_id'=>$order_id,
									 'product_id'=>$product_id)
						);
       		 $log=$this->common->update_data($data);
		/*print_r(json_encode($_POST));	
		exit;*/
		// print_r(json_encode($this->db->last_query()));
		// print_r(json_encode($data));
		//	exit;
		
		if($log)
		{
			
			echo json_encode('success');			
			//exit;
		}
		else
		{
			echo json_encode('error');
		}	
		//print_r(json_encode($_POST));
		//echo json_encode('sadsad');
		exit;
	}
	function add_order_customer_stap1()
	{
		$pin_code=$this->input->post("postal_code");
		$delivery_location=$this->input->post("delivery_location");
		$delivery_notes=$this->input->post("delivery_notes");
		$packing_notes=$this->input->post("packing_notes");
		$address = urlencode($delivery_location);
		//$address = urlencode(' West Melbourne, Victoria ');
		$data = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$address.',+AU&key=AIzaSyCvjYUNMayAdpHVsyYtzVlQhsyxQHlsQ5U'), true);
		/*echo "<pre>";
		print_r($data);
		exit;*/
		$pinpos = count($data['results'][0]['address_components']);
		for($i=0;$i<$pinpos;$i++)
		{
			if($data['results'][0]['address_components'][$i]['types'][0]=='postal_code')
			{
				$pin_code= $data['results'][0]['address_components'][$i]['long_name'];
			}
		}
		$postal_cod= end($data['results'][0]['address_components']);
		//$pin_code=$postal_cod['long_name'];
		/*print_r(json_encode($data['results'][0]['address_components']));
		exit;*/
		$formatted_address=$data['results'][0]['formatted_address'];
		$geometry_location_lat=$data['results'][0]['geometry']['location']['lat'];
		$geometry_location_lng=$data['results'][0]['geometry']['location']['lng'];
			/*print_r($data);
			exit;
			print_r(json_encode($_POST));
			exit;
			*/
		$this->session->set_userdata('zip_code',$pin_code);		
		$data=array('table'=>'tbl_order',
					'val'=>array(
								'longitude'=>$geometry_location_lng,
								'latitude'=>$geometry_location_lat,
								'zip_code'=>$pin_code,
								 'address'=>$delivery_location,
								 'delivery_notes'=>$delivery_notes,
								 'packing_note'=>$packing_notes
								  ),
					'where'=>array('user_id'=>$this->input->post("customer_id"),'id'=>$this->input->post("order_id"))	
					);
			
			$log=$this->common->update_data($data);	
			//echo json_encode($this->db->last_query());
			//exit;
					echo json_encode('pin code is-> '.$pin_code);	
					exit;	
			if($log)
			{
				//$this->session->set_flashdata('success', UPDATE_MESSAGE);
				echo json_encode('success');			
				//exit;
			}
			else
			{
				$this->session->set_flashdata('error', 'Item not  Delete successfully in Customer Order');
				echo json_encode('error');
			}
			
	}
	function add_order_run_one_time()
	{
		$order_id=$this->input->post("order_id");
		$customer_id=$this->input->post("customer_id");
		$run_detail_id=$this->input->post("run_detail_id");
		$run_day_name=$this->input->post("run_day_name");
		$run_date=$this->input->post("run_date");
		$this->currentAddDate;
		$this->currentAddDate_time;
		$sess 	= 	$this->session->userdata('admin_login');
		$ar 	= 	unserialize($sess);
		$admin_id	=  $ar['id'];
		$da=array('table'=>'tbl_recurring_order_master',
				  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id)
				  );
       	$recurring_order=$this->common->delete_data($da);
		/*
		echo json_encode($this->db->last_query());
		exit;
		*/
		$da=array('val'=>'*',
				  'table'=>'tbl_recurring_order',
				  'where'=>array('order_id'=>$order_id,
				  				 'customer_id'=>$customer_id/*,
								 'on_days'=>$run_day_name, 
								 'run_date'=>$run_date*/)
				  );		 
       	$recurring_order=$this->common->getdata($da);
		
		if($recurring_order['res'])
		{	
			$data=array('table'=>'tbl_recurring_order',
						'val'=>array('on_days'=>$run_day_name,
									 'weekly'=>$run_day_name,
									 'run_date'=>$run_date,
									 // on time and change time 
									 
									 'run_detail_id'=>$run_detail_id,
									 'modified_by'=>$admin_id,
									 'modified_date'=>$this->currentAddDate_time,
									 'status'=>'1'),
						'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id/*,'on_days'=>$run_day_name,'run_date'=>$run_date*/)						
						);
       		 $log=$this->common->update_data($data);
			 
			 //$last_id=$recurring_order['rows'][0]->id;
		}
		else
		{
			
			$data1=array('table'=>'tbl_recurring_order',
						'val'=>array('order_id'=>$order_id,
									 'customer_id'=>$customer_id,
									 'on_days'=>$run_day_name,
									 'weekly'=>$run_day_name,
									 'run_date'=>$run_date,
									 'run_detail_id'=>$run_detail_id,
									 'added_by'=>$admin_id,
									 'add_date'=>$this->currentAddDate_time,
									 'status'=>'1'));			
			$log=$this->common->add_data($data1);
			
			//$last_id=$this->db->insert_id();
		}
		
		$data1=array('table'=>'tbl_order',
					'val'=>array(
									'order_type'=>'1',
									'order_run_id'=>$run_detail_id, 
								 	'run_day'=>$run_day_name),
					'where'=>array('id'=>$order_id,'user_id'=>$customer_id)						
					);
		 $log1=$this->common->update_data($data1);
		
		if($log)
		{
			echo json_encode('success');
		}
		else
		{				
			echo json_encode('error');
		}
	}
	function add_order_run_recuring()
	{
		$order_id=$this->input->post("order_id");
		$customer_id=$this->input->post("customer_id");
		$run_detail_id=$this->input->post("run_detail_id");
		$tbl_run_id=$this->input->post("tbl_run_id");
		$run_day_name=$this->input->post("run_day_name");
		$run_date=$this->input->post("run_date");
		$fortnight=$this->input->post("fortnight");
		//fortnight
		$this->currentAddDate;
		$this->currentAddDate_time;
		$sess 	= 	$this->session->userdata('admin_login');
		$ar 	= 	unserialize($sess);
		$admin_id	=  $ar['id'];
		$da=array('table'=>'tbl_recurring_order',
				  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id)
				  );
       	$recurring_order=$this->common->delete_data($da);
		$da=array('val'=>'*',
				  'table'=>'tbl_recurring_order_master',
				  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id,'on_days'=>$run_day_name, 'run_date'=>$run_date)//'run_detail_id'=>'',
				  );
       	$recurring_order=$this->common->getdata($da);
		if($recurring_order['res'])
		{	
			$data=array('table'=>'tbl_recurring_order_master',
						'val'=>array('run_detail_id'=>$run_detail_id, 
									  'tbl_run_id'=>$tbl_run_id,
									 'modified_by'=>$admin_id,
									 'modified_date'=>$this->currentAddDate_time,
									 'status'=>'1'),
						'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id,'on_days'=>$run_day_name,'run_date'=>$run_date)						
						);
						if($fortnight)
						{
							$data['val']['fortnight']='1';
						}
       		 $log=$this->common->update_data($data);			 
		}
		else
		{
			$da=array('val'=>'count(*) as total_order',
					  'table'=>'tbl_recurring_order_master',
					  'where'=>array('customer_id'=>$customer_id)//,'order_id'=>$order_id
					  );
		  
       	$d_order=$this->common->getdata($da);
		$recuring_order_counter_id='Ro';
		if($d_order['res'])
		{
			$recuring_order_counter_id.='.'.($d_order['rows'][0]->total_order+1);
		}else{
			$recuring_order_counter_id.='.1';
		}
		
			$data1=array('table'=>'tbl_recurring_order_master',
						'val'=>array('order_id'=>$order_id,
									 'recuring_order_counter_id'=>$recuring_order_counter_id,
									 'customer_id'=>$customer_id,
									 'on_days'=>$run_day_name,
									 'weekly'=>$run_day_name,
									 'run_date'=>$run_date,
									 'run_detail_id'=>$run_detail_id,
									 'tbl_run_id'=>$tbl_run_id,
									 'added_by'=>$admin_id,
									 'add_date'=>$this->currentAddDate_time,
									 'status'=>'1'));
			if($fortnight)
			{
				$data1['val']['fortnight']='1';
			}			
			$log=$this->common->add_data($data1);			
		}
		/*echo json_encode($this->db->last_query());
		exit;*/
		if($log)
		{
			echo json_encode('success');
		}
		else
		{				
			echo json_encode('error');
		}
	}
	function delete_order_run()
	{
		$order_id=$this->input->post("order_id");
		$customer_id=$this->input->post("customer_id");
		$run_detail_id=$this->input->post("run_detail_id");
		$run_day_name=$this->input->post("run_day_name");
		$run_date=$this->input->post("run_date");
		$this->currentAddDate;
		$this->currentAddDate_time;
		/*$da=array('table'=>'tbl_recurring_order',
				  'where'=>array('customer_id'=>$customer_id,'on_days'=>$run_day_name,'run_date'=>$run_date)
				  );//'order_id'=>$order_id,
       	$log=$this->common->delete_data($da);
		
		$da=array(
				  'val'=>'*',
				  'table'=>'tbl_order',
				  'where'=>array('order_recurring_id'=>$order_id,'user_id'=>$customer_id)
				  );
		//$result=$this->common->getdata($da);
       	$log=$this->common->delete_data($da);*/
		
		$da=array('table'=>'tbl_recurring_order_master',
				  'where'=>array('order_id'=>$order_id,'customer_id'=>$customer_id,'on_days'=>$run_day_name,'run_date'=>$run_date)
				  );
       	$log=$this->common->delete_data($da);		
		//echo json_encode($this->db->last_query());
		//exit;
		if($log)
		{
			echo json_encode('success');
		}
		else
		{				
			echo json_encode('error');
		}
	}
	function add_order_type_stap2()
	{
							
		$data=array('table'=>'tbl_order',
					'val'=>array('order_type'=>$this->input->post("order_type"),								 
								 'order_repeat_status'=>'0' ),
					'where'=>array('user_id'=>$this->input->post("customer_id"),'id'=>$this->input->post("order_id"))	
					);
			if($this->input->post("order_type")=='2')
			{
				$data['val']['order_shown_id']='RO.'.$this->input->post("order_id");
			}else
			if($this->input->post("order_type")=='3')
			{
				$data['val']['order_shown_id']='FO.'.$this->input->post("order_id");
			}
			else
			{
				$data['val']['order_shown_id']='ORDIDA.'.$this->input->post("order_id");
			}
			$log=$this->common->update_data($data);	
			/*print_r(json_encode($this->db->last_query()));
			exit;*/
			if($log)
			{
				echo json_encode('success');
			}
			else
			{
				$this->session->set_flashdata('error', 'Item not  Delete successfully in Customer Order');
				echo json_encode('error');
			}
			
	}
	function add_order_type_stap3()
	{
		
		$bill_receipt_number=$this->input->post("bill_receipt_number");
		$customer_id=$this->input->post("customer_id");
		$order_id=$this->input->post("order_id");
		$value=$this->input->post("value");
		$data=array('table'=>'tbl_order',
					'val'=>array('payment_mode'=>$value,'order_source'=>'5'),
					'where'=>array('user_id'=>$customer_id,'id'=>$order_id)	
					);
		$res=$this->common->getdata($data);
		$shipping_amount=0;
		if($res['rows'][0]->amount >=40)
		{
			$data['val']['ship_amount']='0';
			$data['val']['payment_status']=$value;
		}
		else
		{		
			$data['val']['ship_amount']='8';
			$data['val']['payment_status']=$value;	
			/*
			if($total_order_price>40)
			{
				$amount_total=floatval($total_order_price-$discount_code_value);
			}
			else
			{}*/
			/*$shipping_amount=8;
			$amount_total=floatval(($total_order_price+8)-$discount_code_value);			
			$or_id='ORDIDA'.$last_insert_order_id;
			$this->db->query("UPDATE `tbl_order` SET  ship_amount='$shipping_amount', amount_total='$amount_total', amount='$total_order_price', `order_id`='$or_id' WHERE id =".$last_insert_order_id);*/
		}		
		if($value==2)
		{
			$data['val']['payment_mode']='3';
			$data['val']['payment_status']='1';
			$data['val']['payment_type']='Credit / Debit Card / Direct Debit';			
		}
		if($value==1)
		{
			$data['val']['payment_mode']='1';
			$data['val']['payment_status']='1';
			$data['val']['payment_type']='Payment On Delivery';			
		}
		if($value==3)
		{
			$data['val']['payment_mode']='7';
			$data['val']['payment_type']='Manual';
			$data['val']['payment_status']='3';
			$data['val']['payment_date']=$this->currentAddDate;
			$data['val']['TransactionID']=$bill_receipt_number;
		}
		if($value==4)
		{
			
			$data['val']['payment_status']='2';
			$data['val']['tbl_customer_payment_options_id']=$bill_receipt_number;
			$days=0;
			$mm=0;
			if($bill_receipt_number=='7'){$days=7;$mm=4;}
			else if($bill_receipt_number=='8'){$days=15;$mm=5;}
			else if($bill_receipt_number=='9'){$days=30;$mm=6;}
			else{$days=0;$mm=666;}
			$data['val']['payment_mode']=$mm;
			$data['val']['payment_type']='Manual '.$days.' Days';
			$data['val']['tbl_customer_payment_options_no_day']=$days;
			$data['val']['tbl_customer_payment_options_date']=date('Y-m-d',date(strtotime("+".$days." day", strtotime($this->currentAddDate))));;
		}//
		$log=$this->common->update_data($data);	
		//print_r(json_encode($this->db->last_query()));
		//exit;		
		//$this->load->library('notification');
		$not_data=array('note_to_tbl_name'=>'tbl_admin',
						'note_to_id'=>'1',
						'note_from_tbl_name'=>'tbl_customer',//tbl_order
						'note_from_id'=>$customer_id, 
						'note_titel'=>'New Order add',
						'note_detail'=>'Order by admin, order id:- '.$res['rows'][0]->order_id,
						'page_link'=>'admin/customer/edit_order/'.$customer_id.'/'.$order_id,
						'icon'=>'ORDER'
						);
		$this->notification->set($not_data);
			
		if($log)
		{
			
			$this->session->set_flashdata('success', 'Order is successfully done');
			echo json_encode('success');
		}
		else
		{
			$this->session->set_flashdata('error', 'Item not  Delete successfully in Customer Order');
			echo json_encode('error');
		}
	}
	function delete_order_item()
	{
		//{order_detail_id:order_detail_id,customer_id:customer_id,price:price},
		$order_detail_id=$this->input->post('order_detail_id');
		$order_id=$this->input->post('order_id');
		$customer_id=$this->input->post('customer_id');
		$price=$this->input->post('price');
		
		$this->db->query("UPDATE `tbl_order` SET `amount`=(amount-$price) WHERE `id`=$order_id");
		
		$data=array('table'=>'tbl_order_summary',
						'where'=>array('id'=>$order_detail_id));
		$log=$this->common->delete_data($data);
		
		
		$data1=array('table'=>'tbl_order_summary_tracking',
					'where'=>array('order_id'=>$order_id,
								 'user_id'=>$customer_id,
								 'order_summary_id'=>$order_detail_id));
		$log1=$this->common->delete_data($data1);
		
		
		if($log)
		{
			$this->session->set_flashdata('success', DELETE_MESSAGE);
			echo json_encode('success');			
			//exit;
		}
		else
		{
			$this->session->set_flashdata('error', 'Item not  Delete successfully in Customer Order');
			echo json_encode('error');
		}	
		//print_r(json_encode($_POST));
		//echo json_encode('sadsad');
		exit;
	}
	function edit_order_popup()
	{
		/*$products=$this->input->post('products');
		$data='';
		foreach($products as $p)
		{
			$data.=$p['qty'].'-'.$p['id'].',';
		}
		print_r( json_encode($data));
		//print_r( json_encode($products[0]['qty']));
		exit;*/
		$order_id=$this->input->post('order_id');
		$customer_type=$this->input->post('customer_type');
		$this->data['customer_type']=$customer_type;
		$customer_id=$this->input->post('customer_id');
		$this->data['customer_id']=$customer_id;
		$this->data['order_id']=$order_id;
		$this->currentAddDate;
		$this->currentAddDate_time;
		$da=array('val'=>'*',
				  'table'=>'tbl_order',
				  'where'=>array('id'=>$order_id,'user_id'=>$customer_id)//sess_id
				  );		 
       	$this->data['coustomer_order']=$this->common->getdata($da);
			
		$comment1=array('table'=>'tbl_order_summary as tos',
						'val'=>'*, tos.id as tblid, tp.product_id as product_id, tp.id as prod_id,tos.amount as os_amount ',
						'where'=>array('tos.order_id'=>$this->data['order_id']),//"tos.product_id"=>'tp.id',
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tos.id',
						'orderas'=>'DESC');
	
				$multijoin1=array(
					array('table'=>'tbl_product as tp','on'=>'tp.id=tos.product_id','join_type'=>'')           
				);         
		$this->data['all_order_product']=$this->common->multijoin($comment1,$multijoin1);
		$da=array('val'=>'product_id',
				  'table'=>'tbl_order_summary',
				  'where'=>array('order_id'=>$this->data['order_id']));
		$all_product=$this->common->getdata($da);			
		foreach($all_product['rows'] as $aa)
		{
			$ar[]=$aa->product_id;
		}
		$data['all_product']=$all_product;
		$comment1=array('table'=>'tbl_product as tp',
						'val'=>'*,tp.product_id as product_id, tp.id as id, 
						tp.product_name as product_name ,tp.cost_per_unit as cost_per_unit',
						'where'=>array("tp.status"=>1),
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tp.id',
						'orderas'=>'DESC');
		$multijoin1=array(
			//array('table'=>'tbl_product_box as tpb','on'=>'tpb.product_id==tp.id','join_type'=>'left')           
		);
		if($all_product['res'])
		{
			$this->db->where_not_in('tp.id', $ar);
		}
		$this->data['result_product']=$data['result_product']=$this->common->multijoin($comment1,$multijoin1);
		print_r( json_encode($this->load->view('admin/customer/edit_order_popup',$this->data,true)) );
		//$this->load->view('/admin/customer/edit_order');
	}
	
	function view_order_popup()
	{
		$order_id=$this->input->post('order_id');
		$customer_id=$this->input->post('customer_id');
		$customer_type=$this->input->post('customer_type');
		
		$this->data['order_id']=$order_id;
		$this->data['customer_id']=$customer_id;		
		$this->data['customer_type']=$customer_type;		
		$this->currentAddDate;
		$this->currentAddDate_time;
		$da=array('val'=>'*',
				  'table'=>'tbl_order',
				  'where'=>array('id'=>$order_id,'user_id'=>$customer_id)//sess_id
				  );		 
       	$this->data['coustomer_order']=$this->common->getdata($da);
			
		$comment1=array('table'=>'tbl_order_summary as tos',
						'val'=>'*, tos.id as tblid, tp.product_id as product_id, tp.id as prod_id,tos.amount as os_amount ',
						'where'=>array('tos.order_id'=>$this->data['order_id']),//"tos.product_id"=>'tp.id',
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tos.id',
						'orderas'=>'DESC');
	
				$multijoin1=array(
					array('table'=>'tbl_product as tp','on'=>'tp.id=tos.product_id','join_type'=>'')           
				);         
		$this->data['all_order_product']=$this->common->multijoin($comment1,$multijoin1);
		$da=array('val'=>'product_id',
				  'table'=>'tbl_order_summary',
				  'where'=>array('order_id'=>$this->data['order_id']));
		$all_product=$this->common->getdata($da);			
		foreach($all_product['rows'] as $aa)
		{
			$ar[]=$aa->product_id;
		}
		$data['all_product']=$all_product;
		$comment1=array('table'=>'tbl_product as tp',
						'val'=>'*,tp.product_id as product_id, tp.id as id, 
						tp.product_name as product_name ,tp.cost_per_unit as cost_per_unit',
						'where'=>array("tp.status"=>1),
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tp.id',
						'orderas'=>'DESC');
		$multijoin1=array(
			//array('table'=>'tbl_product_box as tpb','on'=>'tpb.product_id==tp.id','join_type'=>'left')           
		);
		if($all_product['res'])
		{
			$this->db->where_not_in('tp.id', $ar);
		}
		$this->data['result_product']=$data['result_product']=$this->common->multijoin($comment1,$multijoin1);
		print_r( json_encode($this->load->view('admin/customer/view_order',$this->data,true)) );
		//$this->load->view('/admin/customer/edit_order');
	}
	
	function get_run_by_zipcode()
	{
		$this->data['order_id']=$this->input->post('order_id');
		$this->data['customer_id']=$this->input->post('customer_id');
		$da=array('val'=>'*',
				  'table'=>'tbl_recurring_order_master',
				  'where'=>array('order_id'=>$this->data['order_id'],'customer_id'=>$customer_id));
		$this->data['recurring_order']=$this->common->getdata($da);
		print_r( json_encode($this->load->view('admin/customer/get_run_by_zip_code',$this->data,true)) );
	}
	
	function product_search()
	{
		$order_id=$this->input->post('order_id');
		$search_value=$this->input->post('search_value');
		$customer_id=$this->input->post('customer_id');
		$customer_type=$this->input->post('customer_type');
		$this->load->model('admin/customer_model');
		$row	=	$this->customer_model->findByCustomer_id($customer_id);
		if(!$row)
		{
		redirect("admin/customer/index/");
		print_r($row);
		exit;
		}
		$this->data['row']	=	$row;
		$da=array('val'=>'product_id',
				  'table'=>'tbl_order_summary',
				  'where'=>array('order_id'=>$this->data['order_id']));
		$all_product=$this->common->getdata($da);			
		foreach($all_product['rows'] as $aa)
		{
			$ar[]=$aa->product_id;
		}
		$data['all_product']=$all_product;
		$comment1=array('table'=>'tbl_product as tp',
						'val'=>'*,tp.product_id as product_id, tp.id as id, 
						 tp.product_name as product_name ,tp.cost_per_unit as cost_per_unit',
						'where'=>array("tp.status"=>'1','deleted'=>'0'),
						'minvalue'=>'',
						'group_by'=>'',
						'start'=>'',
						'orderby'=>'tp.id',
						'orderas'=>'ASC');
		$multijoin1=array(
			//array('table'=>'tbl_markups as tm','on'=>'tm.product_id=tp.id','join_type'=>'left')
			//array('table'=>'tbl_product_box as tpb','on'=>'tpb.product_id==tp.id','join_type'=>'left')
		);
		if($all_product['res'])
		{
			$this->db->where_not_in('tp.id', $ar);
		}
		$this->db->like('tp.product_name', $search_value);
		$this->db->or_like('tp.product_id', $search_value);
		$this->db->or_like('tp.product_type', $search_value);
		$this->db->or_like('tp.package_cost', $search_value);
		$this->db->or_like('tp.unit_per_package', $search_value);
		$this->db->or_like('tp.cost_per_unit', $search_value);
		
		$this->data['result_product']=$this->common->multijoin($comment1,$multijoin1);	
		
		print_r( $this->load->view('admin/customer/all_active_products_for_order',$this->data,true) );
		//exit;
		
	}
	function order_Delivery_Charges()
	{
		$order_id=$this->input->post('order_id');
		$Delivery_Charges=$this->input->post('Delivery_Charges');
		$total_cost=$this->input->post('total_cost');
		$customer_id=$this->input->post('customer_id');
		$customer_type=$this->input->post('customer_type');
		$data=array('table'=>'tbl_order',
					'val'=>array('amount_total'=>$total_cost,'ship_amount'=>$Delivery_Charges),
					'where'=>array('id'=>$order_id));		
		$log=$this->common->update_data($data);
	}
	
	function coupon_code_try_it()
	{
		$customer_id=$this->input->post('customer_id');
		$customer_type=$this->input->post('customer_type');
		$order_id=$this->input->post('order_id');
		$coupon_code=$this->input->post('coupon_code');
		//School  Childcare   Corporate  Residential
		$da=array('val'=>'*',
				  'table'=>'tbl_discount',
				  'where'=>array('code'=>$coupon_code,
				  				 'deleted'=>'0',
								 'status'=>'1',
								 /*'frutastic'=>'1',*/
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
			$minimum_order=$discount_value['rows'][0]->minimum_order;
			$da=array('val'=>'*',
					  'table'=>'tbl_order',
					  'where'=>array('id'=>$order_id)
					  );
			$order=$this->common->getdata($da);
			if($order['res'])
			{
				$order_value=$order['rows'][0]->amount;
				
				if(intval($minimum_order) > intval(floatval($order_value)))
				{
					print_r(json_encode( array('res'=>false,
										'error'=>'Your Order is must greater than $ '.$minimum_order)));
				}
				else
				{
				//print_r(json_encode( array('res'=>false,'error'=>intval($order_value) )  ));
				//exit;
					if($discount_percentage!='')
					{	//(500/100)*50
						$dd_value=(($order_value/100)*$discount_percentage);
						//echo json_encode('p '.$discount_percentage.' t '.$total_order_price.' dv '.$dd_value);
					}
					else
					{
						$dd_value=($discount_code_value);
						//echo json_encode('v '.$discount_code_value.' t '.$total_order_price.' dv '.$dd_value);
					}
					$order_value=($order_value-$dd_value);
					$log=$this->db->query("UPDATE `tbl_order` SET 
										  `discount`='$dd_value', `discount_code`='$coupon_code',
										   amount_total='$order_value'
									 	   WHERE id =".$order_id);
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
					if($log)
					{
						print_r(json_encode( array('res'=>true,
													'error'=>'Your Coupon  code applied successfully',
													'discounted_amount'=>$dd_value)));
					}
					else
					{
						print_r(json_encode( array('res'=>false,
												'error'=>'Oopps sorry!.Your order id not updated successfully')));
					}
				}
			}
			else
			{
				print_r(json_encode( array('res'=>false,
								'error'=>'Oopps sorry!.Your order id  is not valid')));
			}
		}
		else
		{
			print_r(json_encode( array('res'=>false,
								'error'=>'Oopps sorry!.Your Coupon code are not valid')));
		}
	}
	
	function get_formated_address()
	{	
		$delivery_location=$this->input->post('address');
		$address = urlencode($delivery_location);
		//$address = urlencode(' West Melbourne, Victoria ');
		$data = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$address.',+AU&key=AIzaSyCvjYUNMayAdpHVsyYtzVlQhsyxQHlsQ5U'), true);		
		$pinpos = count($data['results'][0]['address_components']);
		for($i=0;$i<$pinpos;$i++)
		{
			if($data['results'][0]['address_components'][$i]['types'][0]=='postal_code')
			{
				$pin_code= $data['results'][0]['address_components'][$i]['long_name'];
			}
		}
		$postal_cod= end($data['results'][0]['address_components']);		
		$formatted_address=$data['results'][0]['formatted_address'];
		$geometry_location_lat=$data['results'][0]['geometry']['location']['lat'];
		$geometry_location_lng=$data['results'][0]['geometry']['location']['lng'];
		echo json_encode($formatted_address);
		
	}
}
