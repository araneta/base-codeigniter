<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	//table name
	protected $m_table;
	//error list
	protected $m_errors=array();
	//column name in table
	public $cols = array();
	public $m_paging_prm=array();
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
	function get_page($criteria){		
		return array(
			'total_count'=>$this->get_count($criteria),
			'data'=>$this->get_by(
				$criteria,null,
				$this->m_paging_prm['offset'],
				$this->m_paging_prm['per_page'],
				$this->m_paging_prm['sortname'],				
				$this->m_paging_prm['sortorder']
				)
		);
	}
	function get_all($cols=null,  $offset=null,$limit=null){
		if($cols!=null)
			$this->db->select($cols);
		if($limit==null && $offset==null)
			return 	$this->get_data($this->db->get($this->m_table));
		else
			return 	$this->get_data($this->db->get($this->m_table,$limit,$offset));
	}
	function get($id,$cols=null){
		if($cols!=null)
			$this->db->select($cols);
		$data = $this->get_data($this->db->get_where($this->m_table, array('id' => intval($id)), 1, 0));
		if($data!=null)
			return $data[0];
		return null;
	}
	function get_by($criteria,$cols=null,  $offset=null,$limit=null,$ordercol=null,$orderdir=null){
		if(method_exists($this,'before_get_by'))
			call_user_func(array($this,'before_get_by'));
		if($cols!=null)
			$this->db->select($cols);			
			
		if($ordercol!=null && $orderdir!=null){
			//echo $ordercol.' '.$orderdir;exit(0);
			$this->db->order_by($ordercol, $orderdir);
			
		}
		$data = array();
		if($limit==null && $offset==null)
			$data = $this->get_data($this->db->get_where($this->m_table, $criteria));
		else
			$data = $this->get_data($this->db->get_where($this->m_table, $criteria,$limit,$offset));
		if(method_exists($this,'after_get_by'))
			$data = call_user_func_array(array($this, 'after_get_by'), array($data)); 
		return $data;
	}
	function get_count($criteria){
		$this->db->where($criteria);
		return $this->db->count_all_results($this->m_table);
	}
	function save(&$rawmodel){
		$model = array();
		foreach($this->cols as $col){
			$model[$col] = $rawmodel[$col];
		}
		if(!empty($model['id'])){
			$this->db->update($this->m_table, $model,array('id' => $model['id']));	
		}else{
			$this->db->insert($this->m_table, $model);	
			$model['id'] = $this->db->insert_id();
		}	
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	function add_error($e){
		array_push($this->m_errors,$e);
	}
	function print_error(){
		return implode('<br />',$this->m_errors);
	}
	function delete($id){
		$this->db->delete($this->m_table, array('id' => $id));
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	
}
?>
