<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->set_lang_file('user/dashboard');		
		$this->need_login();	    
	}
	function index()
	{				 		 		
		$data['title'] = $this->lang->line('title');		
		$data['main'] = 'user/user_home';			
		$this->load->view('user/dashboard',$data);				
	}
	function logout(){
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('message',"You've been logged out!");
		redirect('login','refresh');
	}		
}
?>
