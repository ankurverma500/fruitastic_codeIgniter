<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
	}
	
	function add()
	{
		$cart_check = $this->cart->contents();
		$product_id=array();
		 foreach ($cart_check as $item)
		 {
			 array_push($product_id,$item['id']);			
		 }
		 
        // Set array for send data.
		$insert_data = array(
			'id' => $this->input->post('id'),
			'image' => $this->input->post('image'),
			'name' => str_replace('-', ' ',preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $this->input->post('name')))),
			'price' => $this->input->post('price'),
			'was_price' => $this->input->post('was_price'),
			'product_gst' => $this->input->post('product_gst'),
			'qty' => $this->input->post('qty')
		);//htmlentities($input, ENT_QUOTES);
		//print_r(json_encode($insert_data));exit;
        // This function add items into cart.
		$log=$this->cart->insert($insert_data);	      
        // This will show insert data in cart.
		//redirect('shopping');
		$tt_product=0;
		if(in_array($this->input->post('id'),$product_id))
		{
			$action='update';	
			$tt_product=count($product_id);
		}
		else
		{
			$action='add';	
			$tt_product=(count($product_id)+1);
		}
		//print_r(json_encode($log));exit;
		if($log)
		{
			$this->session->set_flashdata('success', ADD_MESSAGE);
			//echo 'success';
			print_r(json_encode(array('res'=>true,'action'=>$action,'total'=>$tt_product,'rowid'=>$log))); 
		}
		else
		{
			$this->session->set_flashdata('error', ADD_MESSAGE_ERROR);
			//echo 'error';
			print_r(json_encode(array('res'=>false,'action'=>$action,'total'=>$tt_product,'rowid'=>$log))); 
		}
	}
	function update_cart()
	{
		
	
		$cart_check = $this->cart->contents();
		$tt_product=0;
		$status='';
		 foreach ($cart_check as $item)
		 {
			 //array_push($product_id,$item['id']);	
			 
			 $tt_product++;
			 if($item['id']==$this->input->post('id'))
			 {
					$rowid = $item['rowid'];	
									
					if($this->input->post('qty')<1)
					{
						$qty=0;	
						$status=false;
						$tt_product--;
					}
					else
					{
						$status=true;
						$qty=($this->input->post('qty'));
					}
					$this->cart->update(array(
						'rowid'   => $rowid,
						'id' => $this->input->post('id'),
						'image' => $this->input->post('image'),
						'name' => str_replace('-', ' ',preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $this->input->post('name')))),
						'price' => $this->input->post('price'),
						'was_price' => $this->input->post('was_price'),
						'product_gst' => $this->input->post('product_gst'),
						'qty' => $qty
					));
			 }
		}
		print_r(json_encode(array('res'=>$status,'action'=>'update','total'=>$tt_product)));
		//echo json_encode($status);
		//redirect('shopping');        
	}
	function remove($rowid) 
	{
		// Check rowid value.
		if ($rowid==="all")
		{
		   // Destroy data which store in  session.
			$this->cart->destroy();
		}
		else
		{
			// Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			 // Update cart data, after cancle.
			$this->cart->update($data);
		}	
		// This will show cancle data in cart.
		redirect(base_url('product/index'));
	}
	
	function remove_cart_ajax($rowid)
	{
		$res=$this->cart->remove($rowid);
		
		print_r(json_encode( array('res'=>$res) ));
	}
	function cart_destroy()
	{
		
		$this->cart->destroy();
	}
	
	function get_cart_details()
	{
		
		//$this->cart->destroy();
		//echo $this->cart->total_items();
		//echo $this->cart->total();
		 $cart_check = $this->cart->contents();
		 $ship='free';
		 $total=$this->cart->total();
		 if($this->cart->total()<40  && $this->cart->total()>0){$ship='$8.00';$total=$total+8;}
		print_r(json_encode(array('total_item'=>$this->cart->total_items(),
								  'sub_total_amount'=>number_format($this->cart->total(),2),
		 		   				  'total_amount'=>number_format($total,2),
								  'shipment_amount'=>$ship)));
		
	}
	/*
	
	function update_cart1()
	{
		// Recieve post values,calcute them and update
		$cart_info =  $_POST['cart'] ;
		foreach( $cart_info as $id => $cart)
		{	
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];			
			$data = array(
						'rowid'   => $rowid,
						'price'   => $price,
						'amount' =>  $amount,
						'qty'     => $qty
					);	 
			$this->cart->update($data);
		}
		//redirect('shopping');        
	}
	
    function billing_view()
	{
        // Load "billing_view".
		$this->load->view('billing_view');
    }
        
    public function save_order()
	{
        // This will store all values which inserted  from user.
		$customer = array(
			'name' 		=> $this->input->post('name'),
			'email' 	=> $this->input->post('email'),
			'address' 	=> $this->input->post('address'),
			'phone' 	=> $this->input->post('phone')
		);		
        // And store user imformation in database.
		$cust_id = $this->billing_model->insert_customer($customer);
		$order = array(
			'date' 			=> date('Y-m-d'),
			'customerid' 	=> $cust_id
		);
		$ord_id = $this->billing_model->insert_order($order);		
		if ($cart = $this->cart->contents()):
			foreach ($cart as $item):
				$order_detail = array(
					'orderid' 		=> $ord_id,
					'productid' 	=> $item['id'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price']
				);
               // Insert product imformation with order detail, store in cart also store in database.                 
		         $cust_id = $this->billing_model->insert_order_detail($order_detail);
			endforeach;
		endif;	      
	// After storing all imformation in database load "billing_success".
	$this->load->view('billing_success');
	}*/
	public function show_side_cart()
	{
		$cart_check = $this->cart->contents();
	  	$this->data['product_id']=array();
		$this->data['total_price_cart']=0;
		foreach ($cart_check as $item)
		 {
			 array_push($this->data['product_id'],$item['id']);	
			 $this->data['total_price_cart']=($this->data['total_price_cart']+($item['price']*$item['qty']));		
		 }		 
		print_r(($this->load->view('templates/pages/right_side_cart_page',$this->data,true)));
	}
	
	
	public function add_run_in_session($post_code=null)
	{
		if($this->input->post('run_detail_id'))
		{
			$run_detail_id=$this->input->post('run_detail_id');
			$run_date=$this->input->post('run_date');
			$run_day_name=$this->input->post('run_day_name');
			
			$run[]=array('run_detail_id'=>$run_detail_id,'run_date'=>$run_date,'run_day_name'=>$run_day_name);			
			$this->session->set_userdata('run_detail', array('run_type'=>'1','run'=>$run));
			
			/*$run_detail_id=$this->input->post('run_detail_id');
			$this->session->set_userdata('run_detail', array('run_type'=>'1','run_detail_id'=>$run_detail_id) );*/
			print_r(json_encode(array('res'=>true)));
		}
		else
		{
			print_r(json_encode(array('res'=>false)));
		}
	}
	public function remove_run_in_session($post_code=null)
	{
		unset($_SESSION['run_detail']);
		$this->session->unset_userdata('run_detail');
		print_r(json_encode(array('res'=>true)));
		/*if( $this->session->unset_userdata('run_dtail_id') )
		{			
			print_r(json_encode(array('res'=>true)));
		}
		else
		{
			print_r(json_encode(array('res'=>false)));
		}*/
	}
	public function apply_coupon_code()
	{
		//echo '<pre>';
		/*print_r($_POST);
		exit;*/
		if($this->session->userdata('admin_login'))
		{
			if($this->input->post('coupon_code'))
			{
				$voucher_code=$this->input->post('coupon_code');
				$total_price=$this->input->post('total_price_cart_run');
				$da=array('val'=>'*',
						  'table'=>'tbl_discount',
						  'where'=>array('code'=>$voucher_code,
										 'deleted'=>'0',
										 'status'=>'1',
										 /*'frutastic'=>'1',*/
										 'start_date<='=>$this->currentAddDate,
										 'expiry_date>='=>$this->currentAddDate
										 )
						  );
				$discount_value=$this->common->getdata($da);
				/*print_r(json_encode(array('res'=>false,'error'=>$discount_value) ) );
				exit;*/
				if($discount_value['res'])
				{
					/*if(($discount_value['rows'][0]->start_date<=$this->currentAddDate) && ($discount_value['rows'][0]->expiry_date>=$this->currentAddDate))
					{}
					else
					{
						print_r(json_encode(array('res'=>false,'error'=>'Oopps sorry!.Your Coupon code are Expired')));
					}*/					
					$minimum_order=$discount_value['rows'][0]->minimum_order;					
					if(intval($minimum_order) > intval(floatval($total_price)))
					{
						print_r(json_encode( array('res'=>false,
											'error'=>'Your Order is must greater than $ '.$minimum_order)));
					}
					else
					{
						if($discount_value['rows'][0]->discount_type=='1')
						{
							$discount_pv=$total_price-$discount_value['rows'][0]->discount_value;
							$discount_pv=$discount_value['rows'][0]->discount_value;
						}
						else
						{
							$discount_pv=$total_price-(($total_price*$discount_value['rows'][0]->discount_percentage)/100);					
							$discount_pv=(($total_price*$discount_value['rows'][0]->discount_percentage)/100);
						}
						$discount_type=$discount_value['rows'][0]->discount_type;
						
						$discount_array=array('res'=>true,
											  'discount_type'=>$discount_type,
											  'discount_pv'=>$discount_pv,
											  'discount_code'=>$voucher_code,
											  'minimum_order'=>$minimum_order,
											  'total_price'=>$total_price
											  );
						$this->session->set_userdata('discount',$discount_array);
						
						//print_r($discount_array);
						print_r(json_encode(array('res'=>true,
												  'error'=>'Your Coupon  code applied successfully',
												  'discount_array'=>$discount_array)));
					}
					
				}
				else
				{
					print_r(json_encode(array('res'=>false,'error'=>'Oopps sorry!.Your Coupon code are not valid')));
				}
				
			}
			else
			{
				print_r(json_encode(array('res'=>false,'error'=>'Oopps sorry!.Your Coupon code are not valid, Coupon code are not empty')));
			}
		}
		else
		{
			print_r(json_encode(array('res'=>false,'error'=>'invalid voucher (coupon) code, Login Please!.')));
		}
	}
	
	public function voucher_code()
	{
		if($this->session->userdata('admin_login'))
		{
			if($this->input->post('voucher_code'))
			{
				$voucher_code=$this->input->post('voucher_code');
				$total_price=$this->input->post('total_price');
				$da=array('val'=>'*',
						  'table'=>'tbl_discount',
						  'where'=>array('code'=>$voucher_code,
										 'deleted'=>'0',
										 'status'=>'1',
										 /*'frutastic'=>'1',*/
										 'start_date<='=>$this->currentAddDate,
										 'expiry_date>='=>$this->currentAddDate)
						  );
				$discount_value=$this->common->getdata($da);
				/*print_r(json_encode($discount_value) );
				exit;*/
				if($discount_value['res'])
				{
					$minimum_order=$discount_value['rows'][0]->minimum_order;
					if(intval($minimum_order) > intval(floatval($total_price)))
					{
						print_r(json_encode( array('res'=>false,
											'error'=>'Your Order is must greater than $ '.$minimum_order)));
					}
					else
					{
						if($discount_value['rows'][0]->discount_type=='1')
						{
							$discount_pv=$discount_code_value=$discount_value['rows'][0]->discount_value;
						}
						else
						{					
							$discount_pv=$discount_percentage=$discount_value['rows'][0]->discount_percentage;
						}
						$discount_type=$discount_value['rows'][0]->discount_type;
						
						$discount_array=array('res'=>true,
											  'discount_type'=>$discount_type,
											  'discount_pv'=>$discount_pv,
											  'discount_code'=>$voucher_code,
											  'minimum_order'=>$minimum_order
											  );
						$this->session->set_userdata('discount',$discount_array);
						print_r(json_encode(array('res'=>true,
												  'error'=>'Your Coupon  code applied successfully',
												  'discount_array'=>$discount_array)));
					}
				}
				else
				{
					print_r(json_encode(array('res'=>false,'error'=>'Oopps sorry!.Your Coupon code are not valid')));
				}
				
			}
			else
			{
				print_r(json_encode(array('res'=>false,'error'=>'Oopps sorry!.Your Coupon code are not valid')));
			}
		}
		else
		{
			print_r(json_encode(array('res'=>false,'error'=>'invalid voucher (coupon) code')));
		}
	}
	
}