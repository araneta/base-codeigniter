<?php
//model to check login of a user
class MLogin extends MY_Model
{
	protected $m_table = 'user';
	function __construct ()
	{
		parent::__construct();
	}
	function verifyUser($u,$pw)
	{
		$users = $this->get_by(array('username'=>db_clean($u)),0,1);
		if($users!=null){
			$user= $users[0];
			$this->load->helper('bcrypt');
			$bcrypt = new Bcrypt(15);
			$isGood = $bcrypt->verify($pw, $user['password']);
			if($isGood){
				$this->session->set_userdata('userid',$user['id']);
				$this->session->set_userdata('username',$user['username']);
				return true;
			}
		}
		return false;	
	}
}