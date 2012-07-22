<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {  
	public function __construct() {
		parent::__construct();	                				        	
		$this->set_lang_file('register');
	}
	
	function loadCaptcha()
	{		
    	$this->load->helper('recaptchalib');     	
	}
	function index()
	{				 
		$this->loadCaptcha();   	    	
		$this->data['title'] = $this->lang->line('signup');		
		$this->data['main'] = 'signup';
		$this->config->load('recaptcha');
	 	$public_key = $this->config->item('recaptcha_public_key');
		$this->data['recaptcha'] = recaptcha_get_html($public_key);
		$this->load->view('template',$this->data);
	}
	function username_check($str)
	{
		if($this->MUser->usernameExists($str))
		{
			$this->form_validation->set_message('username_check',$this->lang->line('usernameexists'));
			return FALSE;
		}
		return TRUE;
	}
	function email_check($str)
	{
		if($this->MUser->emailExists($str))
		{
			$this->form_validation->set_message('email_check',$this->lang->line('emailexists'));
			return FALSE;
		}
		return TRUE;
	}
	
	function submitValidate()
	{
		
		$this->form_validation->set_rules('username', 'lang:username', 'required|alpha_numeric|min_length[6]|max_length[256]');
		$this->form_validation->set_rules('username', 'lang:username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'lang:password', 'required');
		$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
		$this->form_validation->set_rules('email', 'lang:email', 'callback_email_check');
		$this->form_validation->set_rules('recaptcha_challenge_field', 'lang:Recaptcha', 'required|recaptcha_matches');
		return ($this->form_validation->run());
	}
	
	function create()
	{	
		$this->load->model('user/MUser');	
		$this->loadCaptcha();				
		if($this->submitValidate()==FALSE)
		{
			$this->index();
			return;
		}
		else         
		{						
			$this->MUser->save($this->bind($this->MUser));					
			$this->session->set_flashdata('message',$this->lang->line('successregister'));
			redirect('login','refresh');
		}		
	}
}
?>
