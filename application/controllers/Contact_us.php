<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact_us extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		if($this->input->post('submit'))
		{
			$this->form_validation->set_error_delimiters('<span style="color:red; position:absolute;" >','<span>');
			
			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
           // $this->form_validation->set_rules('last_name','Last Name','trim|required');			
			//$this->form_validation->set_rules('primary_contact_name','Primary Contact Number','required');			
			$this->form_validation->set_rules('contact_no','Contact','trim|required');	
			//$this->form_validation->set_rules('delivery_address_Apartment','Delivery Apartment No','trim|required');				
			$this->form_validation->set_rules('message','Message ','trim|required');
			$this->form_validation->set_rules('captcha_value','Captcha value ','trim|required|numeric');//|min_length[2]|max_length[2]
			//print_r( 	$this->form_validation->error_array());
			//echo validation_errors();
			if($this->form_validation->run() == false && ($this->input->post('captcha_value')!=12))
			{		
				if($this->input->post('captcha_value')!=12)
				{
				$this->form_validation->set_message('captcha_value','Captcha value Equals 12 Only ');
				}		
				$this->data['content']=$this->load->view('contact_us',$this->data,true);
				$this->load->view('layouts/pages',$this->data);
			}
			else 
			{
				$da=array('val'=>array('name'=>$this->input->post('name'),
									   'message'=>$this->input->post('message'),
									   'contact_no'=>$this->input->post('contact_no'),
									   'email'=>$this->input->post('email'),
									   /*'address'=>$this->input->post('address'),*/
									   'customer_type_from_id'=>'3'),
					  'table'=>'tbl_enquiry',
					  'where'=>array()
					  );//Residential
					 /* echo '<pre>';
					  print_r($_POST);
				print_r($da);
				exit;*/
				$result=$this->common->add_data($da);
				$last_insert_order_id=$this->db->insert_id();
				//SELECT `id`, `name`, `email`, `contact_no`, `message`, `created` FROM `tbl_bulk_order` WHERE 1
				$not_data=array('note_to_tbl_name'=>'tbl_admin',
								'note_to_id'=>'1',
								'note_from_tbl_name'=>'tbl_enquiry',//tbl_order
								'note_from_id'=>'', 
								'note_titel'=>'New Enquiry add',
								'note_detail'=>'Order by fruitastic site, enquiry id:- '.$last_insert_order_id,
								'page_link'=>'',
								'icon'=>'enquiry'
								);
				$this->notification->set($not_data);
				if($result)
				{
					$this->session->set_flashdata('success', ADD_MESSAGE);
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$this->session->set_flashdata('error', ADD_MESSAGE_ERROR);
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
		else
		{
		$this->data['content']=$this->load->view('contact_us',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
		}
	}
}
