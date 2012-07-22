<?php
//model to register a user into the system
class MUser extends MY_Model
{
	protected $m_table = 'user';
	public $cols = array(
		'id'
		,'username'
		,'password'
		,'email'
		);
	function __construct()
	{		
		parent::__construct();
		
	}
	//override
	function save($user)
	{
		$this->load->helper('bcrypt');
		$bcrypt = new Bcrypt(15);
		$hash = $bcrypt->hash('password');
		$user['password'] = $bcrypt->hash($user['password']);
		$now = gmdate("Y-m-d\TH:i:s\Z");
		//if create new user
		if(empty($user['id'])){
			date_default_timezone_set('UTC'); // make this match the server timezone		
			
			$user['created_date'] = $now;
			$user['last_login'] = $now;
			$user['id_language'] = 1;//english;
			$user['last_update'] = $now;
		}else{
			$user['last_update'] = $now;
		}
		parent::save($user);		
	}
	function usernameExists($username)
	{
		$user = $this->get_by(array('username'=>db_clean($username)));
		if($user==null)
			return false;
		return true;
	}
	function emailExists($email)
	{
		$user = $this->get_by(array('email'=>db_clean($email)));
		if($user==null)
			return false;
		return true;
	}	
	function isUserEmail($email,$userid)
	{		
		$users = $this->get_by(array('email'=>db_clean($email),'id'=>id_clean($userid)),0,1);
		if(sizeof($users)==0)
		{			
			return FALSE;
		}
		return TRUE;
	}
}