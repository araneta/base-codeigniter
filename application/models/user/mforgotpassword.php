<?php
class MForgotPassword extends MY_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getNewPass()
	{
	 	$str = sprintf("%d",mt_rand());
	    $new_password = "";
	    for($i=0;$i<strlen($str);$i++)
	    {
	        $new_password .= chr($str[$i]+65);
	    }
	    srand ((double) microtime() * 1000000);
	    $rand_number = rand(0, 999);
	    $new_password .= $rand_number;
	    return $new_password;		    
	}
	function reset($email)
	{
		$pw = $this->getNewPass();
		$this->load->helper('bcrypt');
		$bcrypt = new Bcrypt(15);
		$hash = $bcrypt->hash('password');
		$hash = $bcrypt->hash($pw);
		$sql = "update user set password = ? where email = ?";
		$this->db->query($sql,array($hash,db_clean($email)));
		return $pw;
	}
}
?>