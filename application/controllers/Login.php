<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
	public $data;
	public function __construct()
	{
		//$this->ci =& get_instance();
		//$this->ci->load->library(array('database','session','email','form_validation','user_agent'));
		//$this->ci->load->model('admin/admin');
		parent::__construct();		
		//$this->load->library(array('session','form_validation'));
		$this->load->model('admin');	
		$this->load->model('common');			
		//$this->styles[] ='pages/css/login-3.min';
	}

	public function index()
	{		
		if($this->session->userdata('admin_login') == true)
		{
			redirect('admin/dashboard');
			exit;
		}					
		if($this->input->post('loginForm')) 
		{
			
			$this->form_validation->set_error_delimiters('<span style="color:red;">','<span>');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');		
			if ($this->form_validation->run() == FALSE) 
			{
			} 
			else
			{
				
				$result = $this->admin->login();
				//print_r($_POST);
				//exit;
				if($result) 
				{
					/*** if remember me ***/
					if($this->input->post('remember'))
					{
						$username 		= $this->input->post('username');
						$password 	= $this->input->post('password');
						$this->input->set_cookie('email_customer_cookie', $this->input->post('username'), time()+86500); 	
						$this->input->set_cookie('password_customer_cookie', $this->input->post('password'), time()+86500); 
					}
					else
					{
						delete_cookie("email_customer_cookie");
						delete_cookie("password_customer_cookie");
					}
					redirect("admin/dashboard");					
				}
				else
				{
					$this->session->set_flashdata('error', INVALID_LOGIN);	
					redirect("admin/login");		
				}
			}
		}
	
		$content	=	$this->load->view('admin/login',$this->data,true);
		//	exit;
		//print_r($content);die("test");
		$this->data['content']	=	$content;
		$this->load->view('admin/layouts/login-default',$this->data);
		//$this->load->view('admin/login');
		
	}
	/******* Logout Admin *******/
	
	public function logout() 
	{
		$controller	=	$this->router->fetch_class();	
		if($this->admin->loggedin()) 
		{
			$this->admin->logout();
			$this->session->set_flashdata('success', 'user, You are succesfully logout ');
			redirect($_SERVER['HTTP_REFERER']);
			//$this->load->view('admin/logout');
			//redirect("admin/login");
		}
		else
		{
			redirect($_SERVER['HTTP_REFERER']);
			//$this->load->view('admin/logout');
			//redirect("admin/login");
		}
	}
	public function email_id_exists_or_not() 
	{
		
	}
	
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */