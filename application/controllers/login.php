<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {  
	
	public function __construct() {
		parent::__construct();	         
		$this->set_lang_file('login');		
		if ($this->session->userdata('userid')){
			redirect('user/dashboard','refresh');
			//return;
		}
	}
	public function index() {		
		$this->load->model('MLanguages');
		$this->data['title'] = $this->lang->line('login');		
		$this->data['main'] = 'login';		
		$this->data['langs'] = $this->MLanguages->get_all();		
		$this->load->view('template',$this->data);		
	}

	public function verify() 
	{
		$this->load->model('user/MLogin');
		if ($this->input->post('username')){
			$u = $this->input->post('username');
			$pw = $this->input->post('password');
			if($this->MLogin->verifyUser($u,$pw)){
				redirect('user/dashboard','refresh');
				return;
			}else
			{
				$this->session->set_flashdata('message',$this->lang->line('wronglogin'));
			}
		}else
		{
			$this->session->set_flashdata('message',$this->lang->line('wronglogin'));
		}
		redirect('login','refresh');	
	}
}
?>
