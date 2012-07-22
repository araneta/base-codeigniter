<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends MY_Controller {  
	public function __construct() {
		parent::__construct();	                				        	
	}
	public function index(){			
        $this->load->view('home', $this->data);  
	}
}
?>
