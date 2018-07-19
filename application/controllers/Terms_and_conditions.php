<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Terms_and_conditions extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		$this->data['content']=$this->load->view('terms_and_conditions',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}
