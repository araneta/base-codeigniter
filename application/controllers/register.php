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
		if(empty($str))
			return FALSE;
		if($this->MUser->emailExists($str))
		{
			
			$this->form_validation->set_message('email_check',$this->lang->line('emailexists'));
			return FALSE;
		}
		return TRUE;
	}
	function password2_check($str){
		if(empty($str))
			return FALSE;
		if($this->input->post('password')!=$this->input->post('password2')){
			$this->form_validation->set_message('password2_check',$this->lang->line('passmissmatch'));
			return FALSE;
		}
	}
	function submitValidate()
	{
		
		$this->form_validation->set_rules('username', 'lang:username', 'required|alpha_numeric|min_length[4]|max_length[256]|callback_username_check');
		$this->form_validation->set_rules('password', 'lang:password', 'required');
		$this->form_validation->set_rules('password2','lang:confirmpassword', 'required|callback_password2_check');
		$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules('recaptcha_challenge_field', 'lang:Recaptcha', 'required|callback_recaptcha_matches');
		return ($this->form_validation->run());
	}
	function recaptcha_matches()
    {
        $this->CI =& get_instance();
        $this->CI->config->load('recaptcha');
        $public_key = $this->CI->config->item('recaptcha_public_key');
        $private_key = $this->CI->config->item('recaptcha_private_key');
        $response_field = $this->CI->input->post('recaptcha_response_field');
        $challenge_field = $this->CI->input->post('recaptcha_challenge_field');
        $response = recaptcha_check_answer($private_key,
                                           $_SERVER['REMOTE_ADDR'],
                                           $challenge_field,
                                           $response_field);
        if ($response->is_valid)
        {
            return TRUE;
        }
        else
        {
            $this->CI->form_validation->recaptcha_error = $response->error;
            $this->CI->form_validation->set_message('recaptcha_matches', 'The %s is incorrect. Please try again.');
            return FALSE;
        }
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
			$this->session->set_flashdata('info',$this->lang->line('successregister'));
			redirect('login','refresh');
		}		
	}
}
?>
