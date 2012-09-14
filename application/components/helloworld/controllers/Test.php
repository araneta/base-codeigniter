<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//sample controller
class Test extends Comp{
	protected $m_view = 'user/dashboard';
	public function __construct() {
		parent::__construct();	                				        	
	}
	function index(){
		echo 'index';
	}
	function oo($p){
		$this->data['testj'] = 'this is sample component <br/>';
		$this->data['title'] = 'sample component';
		$this->model('MUser');
		$this->data['users'] = $this->MUser->get_all();
		
		$this->view('testview',$this->data);
		
	}
	 
}
?>
