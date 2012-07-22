<?php
class Lang extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		//$this->lang->load('form_validation', $lang);	
	}
	public function change($name)
	{
		$this->session->set_userdata('language',$name);
		$this->session->set_flashdata('message','you are using '.$this->session->userdata('language'));
		redirect('login','refresh');
	}
}
?>