<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Terms_of_sale extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();	
			
		$this->load->model('common');			
	}
	public function index()
	{
		$this->data['content']=$this->load->view('terms_of_sale',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}