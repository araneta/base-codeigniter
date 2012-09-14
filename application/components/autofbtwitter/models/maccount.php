<?php
//model to list account in system
class MAccount extends MY_Model
{
	protected $m_table = 'com_autofbtwitter_account';
	public $cols = array(
		'id'
		,'type'
		,'id_user'
		,'username'
		);
	function __construct()
	{		
		parent::__construct();		
	}
	
	function after_get_by($data){
		if($data!=null)
		{
			foreach($data as &$row){
				switch(intval($row['type'])){
					case 1:
						$type = 'Twitter';
						break;
					case 2:
						$type = 'Facebook';
						break;
				}		
				$row['type'] = $type;						
			}
		}
		return $data;
	}
	//overide
	function save($account,$accountex){
		$ret = true;
		$now = gmdate("Y-m-d\TH:i:s\Z");		
		date_default_timezone_set('UTC'); // make this match the server timezone				
		$this->db->trans_begin();
		$account['created_date'] = $now;		
		if(parent::save($account)==FALSE){
			$this->add_error('failed saving account');
			$ret = false;
		}else
		{
			switch($account['type']){
				case 1:
					if($this->save_twitter_token($account['id'],$accountex['token'],$accountex['token_secret'])==FALSE){
						$this->add_error('failed saving twitter');
						$ret = false;
					}
				break;
				case 2:
					if($this->save_access_token($account['id'],$accountex['access_token'])==FALSE){
						$this->add_error('failed saving facebook access token');
						$ret = false;
					}
				break;
			}			
		}
		if ($this->db->trans_status() === FALSE || $ret == false)
		{
			$this->db->trans_rollback();
			$this->add_error('Transaction failed');
			$ret = false;			
		} 
		else
		{
			$this->db->trans_commit();
		}
		return $ret;
	}
	function save_twitter_token($id_account,$token,$token_secret){
		$data = array(
			'com_autofbtwitter_account_id'=>id_clean($id_account)
			,'oauth_token_secret'=>db_clean($token_secret)
			,'oauth_token'=>db_clean($token)
			);
		$this->db->insert('com_autofbtwitter_twitter', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	function save_access_token($id_account,$access_token){
		$data = array(
			'com_autofbtwitter_account_id'=>id_clean($id_account)
			,'oauth_token'=>db_clean($access_token)
			);
		$this->db->insert('com_autofbtwitter_facebook', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}		
		return FALSE;
	}
	//override
	function delete($id){
		$ret = TRUE;
		$id = id_clean($id);
		$account = $this->get($id);
		//no checking:D
		$this->db->trans_begin();
		switch($account['type']){
			case 1:
				$this->db->delete('com_autofbtwitter_twitter', array('com_autofbtwitter_account_id' => $id));	
			break;
			case 2:
				$this->db->delete('com_autofbtwitter_facebook', array('com_autofbtwitter_account_id' => $id));	
			break;
		}
		if ($this->db->affected_rows() == '0')
		{
			return FALSE;
		}	
		$ret = parent::delete($id);
		if ($this->db->trans_status() === FALSE || $ret == false)
		{
			$this->db->trans_rollback();
			$this->add_error('Transaction failed');
			return FALSE;			
		} 
		else
		{
			$this->db->trans_commit();
		}
		return TRUE;
	}
	function get_twitter_token($user_id,$account_id){
		$this->db->select('oauth_token_secret,oauth_token');
		$this->db->from('com_autofbtwitter_twitter');
		$this->db->join('com_autofbtwitter_account','com_autofbtwitter_twitter.com_autofbtwitter_account_id = com_autofbtwitter_account.id');
		$this->db->where('com_autofbtwitter_account_id',id_clean($account_id));
		$this->db->where('id_user',id_clean($user_id));
		return $this->get_data($this->db->get());
		
	}
}
