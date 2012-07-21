<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {  
	public function __construct() {
		parent::__construct();	                				        	
		$this->lang->load('login',$this->current_lang);
	}
	public function index(){	
		$this->data['main'] = 'login';
        $this->load->view('page/index', $this->data);  
	}
	function verify(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->load->model('MUser');
			if ($this->input->post('username')){
				$u = $this->input->post('username');
				$pw = $this->input->post('password');
				$this->MUser->Verify($u,$pw);
				if (!empty($_SESSION['userid'])&&$_SESSION['userid'] > 0){
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
}
?>
