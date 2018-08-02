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
			$this->form_validation->set_error_delimiters('<span style="color:red;" >','<span>');
			
			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
           // $this->form_validation->set_rules('last_name','Last Name','trim|required');			
			//$this->form_validation->set_rules('primary_contact_name','Primary Contact Number','required');			
			$this->form_validation->set_rules('contact_no','Contact','trim|required');	
			$this->form_validation->set_rules('address','Address','trim|required');				
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
					$message='<table width="700" border="0" cellspacing="0" cellpadding="0">
					 <tr><td>name</td><td><p>'.$da['val']['name'].'</p></td></tr>
					 <tr><td>email</td><td><p>'.$da['val']['email'].'</p></td></tr>
					 <tr><td>contact no</td><td><p>'.$da['val']['contact_no'].'</p></td></tr>
					 <tr><td>message</td><td><p>'.$da['val']['message'].'</p></td></tr>
				  </table>';
					$send_mail_data=array('to'=>$this->admin_email,'subject'=>'Welcome to Fruitilious ','message'=>'Contact Us </br>'.$message);	
					$this->send_email($send_mail_data);
					$this->session->set_flashdata('success', 'Thank you! We appreciate you contacting us about getting in touch.');
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
