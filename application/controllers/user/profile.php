<?php
	class Profile extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->need_login();
			$this->set_lang_file('user/profile');
			
			date_default_timezone_set('UTC'); // make this match the server timezone
		}
		function index()
		{			
			$this->load->model('user/MUser');						
			$user = $this->MUser->get($this->session->userdata('userid'));													
			
			$data['user'] = $user;
			$data['title'] = $this->lang->line('profiletitle');		
			$data['main'] = 'user/profile';			
			$this->load->view('user/dashboard',$data);	
		}		
		function email_check($email)
		{				
			if($this->MUser->isUserEmail($email,$this->session->userdata('userid')))
			{				
				return TRUE;
			}else
			{
				if($this->MUser->emailExists($email))
				{
					$this->form_validation->set_message('email_check',$this->lang->line('emailexists'));
					return FALSE;
				}
			}			
		}
		
		function submitValidate()
		{			
			$this->form_validation->set_rules('password', 'lang:password', 'required');
			$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
			$this->form_validation->set_rules('email', 'lang:email', 'callback_email_check');
			return ($this->form_validation->run());
		}
		
		function save()
		{
			$this->load->model('user/MUser');
			if($this->submitValidate()==FALSE)
			{
				$this->index();
				return;
			}
			else         
			{						
				$this->MUser->save($this->bind($this->MUser));					
				$this->session->set_flashdata('message',$this->lang->line('success'));
				redirect('user/profile','refresh');
			}		
		}
	}
?>