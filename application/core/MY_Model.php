<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	//table name
	protected $m_table;
	//column name in table
	public $m_cols = array();
    function __construct()
    {
        parent::__construct();
		
    }
	function get_data(&$q){
		$data = null;
		if($q->num_rows()>0)
		{
			$data = array();
			foreach($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$q->free_result();
		return $data;
	}
	function get_all(){
		return 	$this->get_data($this->db->get($this->m_table));
	}
	function get($id){
		$data = $this->get_data($this->db->get_where($this->m_table, array('id' => intval($id)), 1, 0));
		if($data!=null)
			return $data[0];
		return null;
	}
	function get_by($criteria,  $offset=null,$limit=null){
		if($limit==null && $offset==null)
			return 	$this->get_data($this->db->get_where($this->m_table, $criteria));
		return 	$this->get_data($this->db->get_where($this->m_table, $criteria,$limit,$offset));
	}
	function save($model){
		//var_dump($model);exit();
		if(!empty($model['id'])){
			$this->db->update($this->m_table, $model,array('id' => $model['id']));	
		}else{
			$this->db->insert($this->m_table, $model);	
		}	
		
	}
}
?>