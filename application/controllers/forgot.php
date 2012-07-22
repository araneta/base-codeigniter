<?php
	class Forgot extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->set_lang_file('forgot');			
		}
		function index() {			
			$data['title'] = $this->lang->line('forgot');
			$data['main'] = 'forgot';		
			$this->load->view('template',$data);		
		}
		function submit()
		{			
			$this->load->model('user/MUser');
			if ($this->input->post('email')){	
				$email = $this->input->post('email');							
				if ($this->MUser->emailExists($email)){
					$this->load->model('user/MForgotPassword');
					$this->load->library('email');					
					$newpwd = $this->MForgotPassword->reset($email);					
					$this->sendEmail($email,$newpwd);									
					$this->session->set_flashdata('message', $this->lang->line('sentinfo').' '.$email . $newpwd);

				}else
				{
					$this->session->set_flashdata('message',$this->lang->line('emailnotfound'));
				}
			}else
			{
				$this->session->set_flashdata('message',$this->lang->line('enteremail'));
			}
			redirect('forgot','refresh');
		}
		function sendEmail($email,$newpwd)
		{
			$subject = $this->lang->line('msgsubject');
			$msg = $this->lang->line('msgemail');
			
			$this->email->clear();
			$this->email->from($this->config->item('adminemail','support'));
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($msg);
			$this->email->send();
		}				
	}
?>