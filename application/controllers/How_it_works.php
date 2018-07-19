<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class How_it_works extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();	
			
		$this->load->model('common');			
	}
	public function index()
	{
		$this->data['content']=$this->load->view('how_it_works',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}