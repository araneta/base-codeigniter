<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MUser extends CI_Model {

	var $table_name = 'common_user';
	function __construct()
	{
		parent::__construct();
	}
		
	function AddUser($form_data)
	{		
		$this->db->insert($this->table_name, $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}	
	function Verify($username,$password){
		$sql = sprintf("select * from %s where username = '%s'",$this->table_name, $username);
		$q = $this->db->query($sql);
		if($q->num_rows()>0)
		{
			$row = $q->row_array();
			
			if(md5($pw)==$row['password'])
			{
				$_SESSION['userid'] = $row['idtuser'];
				$_SESSION['username'] = $row['username'];
			}
		}		
	}
}
?>
