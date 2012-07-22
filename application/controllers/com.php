<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//component base
class Com extends MY_Controller {  
	public function __construct() {
		parent::__construct();	                				        	
		//$this->set_lang_file('register');
	}
	function index(){
		echo "component";
	}
	function _remap($method)
	{
		$param_offset = 2;
		// Default to index
		if ( ! method_exists($this, $method))
		{
		// We need one more param
			$param_offset = 1;
			$method = 'index';
		}

		// Since all we get is $method, load up everything else in the URI
		$params = array_slice($this->uri->rsegment_array(), $param_offset);

		// Call the determined method with all params
		call_user_func_array(array($this, $method), $params);
	} 
}
?>
