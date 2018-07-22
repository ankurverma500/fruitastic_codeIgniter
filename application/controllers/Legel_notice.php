<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Legel_notice extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();	
			
		$this->load->model('common');			
	}
	public function index()
	{
		$this->data['content']=$this->load->view('legel_notice',$this->data,true);
		$this->load->view('layouts/pages',$this->data);
	}
}