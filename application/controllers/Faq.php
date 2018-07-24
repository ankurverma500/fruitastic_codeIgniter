<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();	
			
		$this->load->model('common');			
	}
	public function index()
	{
		$this->data['content']=$this->load->view('faq',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}