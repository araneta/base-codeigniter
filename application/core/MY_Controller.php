<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	//current language: english, indonesia,..
	protected $m_current_lang;
	//data to be passed to view
	protected $m_data = array();
	
    function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('language'))
		{
			$this->session->set_userdata('language','english');
		}
		$this->m_current_lang = $this->session->userdata('language');		
		
    }
	function bind($model){
		$data = array();
		foreach($model->cols as $col){
			$data[$col] = db_clean($this->input->post($col));
		}
		return $data;
	}
	function set_lang_file($file){
		$this->lang->load($file,$this->m_current_lang);
	}
	function need_login(){
		if (!$this->session->userdata('userid')){
			redirect('login','refresh');
			//return;
		}
	}

}
?>