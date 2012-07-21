<?php
class Lang extends Controller {

	public function Lang() {
		parent::Controller();	
		session_start();
		if(!empty($_SESSION['language']))
			$lang = $_SESSION['language'];
		else
		{
			$lang = $this->config->item('language');
			$_SESSION['language'] = $lang;
		}
		//$this->lang->load('login', $lang);
		//$this->lang->load('form_validation', $lang);	
	}
	public function change($name)
	{
		$_SESSION['language'] = $name;
		$this->session->set_flashdata('message','you are using '.$_SESSION['language']);
		redirect('login','refresh');
	}
}
?>