<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Terms_of_service extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		$this->data['content']=$this->load->view('terms_of_service',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}
