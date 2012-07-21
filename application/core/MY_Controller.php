<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	protected $subdomain_info;
	protected $current_lang;
	protected $data = array();
	
    function __construct()
    {
        parent::__construct();
		session_start();	
		if(empty($_SESSION['language']))
		{
			$_SESSION['language'] = 'english';
		}
		$this->current_lang = $_SESSION['language'];		
			
		
    }
}
?>