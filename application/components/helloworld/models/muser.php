<?php
//model to list user in system
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
	
}