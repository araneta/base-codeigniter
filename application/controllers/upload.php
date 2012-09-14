<?php
class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	
	/*
	*	Display upload form uploadify
	*/
	/*
	public function index()
	{
		$data['uploaddir'] =  $this->input->get('dir');
		$data['target'] = $this->input->get('target');
		$data['params'] = $this->input->get('params');
		$this->load->view('upload/view',$data);
	}
	*/
	public function index()
	{		
		$this->load->view('upload/simple');
	}
	/*
	*	Handles JSON returned from /js/uploadify/upload.php
	*/
	public function uploadify()
	{		
		
		//Decode JSON returned by /js/uploadify/upload.php
		$file = $this->input->post('filearray');
		$data['json'] = json_decode($file);
		
		$this->load->view('upload/uploadify',$data);
	}	
	
}
/* End of File /application/controllers/upload.php */
