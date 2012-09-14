<?php
//model to list queue in system
class MQueue extends MY_Model
{
	protected $m_table = 'com_autofbtwitter_queue';
	public $cols = array(
		'id'
		,'name'
		,'start_date'		
		,'start_hhmm'
		,'interval_in_minute'
		,'com_autofbtwitter_account_id'
		,'timezone'
		,'created_date'
		,'last_update'
		,'id_user'
		,'start_date_server_time'		
		,'interval'
		,'interval_type'
		);
	function __construct()
	{		
		parent::__construct();		
	}
	//overide
	function save($queue){
		date_default_timezone_set('UTC'); // make this match the server timezone		
		$now = gmdate("Y-m-d\TH:i:s\Z");
		//convert from mm/dd/yy to yyyy-mm-dd
		list($mmstart,$ddstart,$yystart)=explode("/",$queue['start_date']);		
		$queue['start_date'] = sprintf('%s-%s-%s',$yystart,$mmstart,$ddstart);		
		//convert queue date to server date
		$start  = date("Y-m-d H:i:s", strtotime($queue['start_date'].' '.$queue['start_hhmm']));
		$date = new DateTime($start,new DateTimeZone($queue['timezone']));
		$date->setTimezone(new DateTimeZone($this->config->item('server_tz')));
		$queue['start_date_server_time'] =$date->format('Y-m-d H:i:s');		
		//interval in minute
		$inmin = 0;
		switch(intval($queue['interval_type'])){
			case 1://minute
				$inmin = $queue['interval'];
			break;
			case 2://hour
				$inmin = $queue['interval']*60;
			break;
			case 3://day
				$inmin = $queue['interval']*60*24;
			break;
			case 4://week
				$inmin = $queue['interval']*60*24*7;
			break;
		}
		$queue['interval_in_minute'] = $inmin;
		//if create new
		if(empty($queue['id'])){						
			$queue['created_date'] = $now;			
			$queue['last_update'] = $now;
		}else{
			$queue['last_update'] = $now;
		}
		return parent::save($queue);		
	}
	
	function before_get_by(){	
		$this->db->select('
			com_autofbtwitter_queue.*
			,com_autofbtwitter_account.username
			,com_autofbtwitter_interval_type.name as typename
			');
		$this->db->join('com_autofbtwitter_account',
			'com_autofbtwitter_account.id = com_autofbtwitter_queue.com_autofbtwitter_account_id','left');
		$this->db->join('com_autofbtwitter_interval_type',
			'com_autofbtwitter_interval_type.id = com_autofbtwitter_queue.interval_type','left');
	}
	function after_get_by($data){
		if($data!=null)
		{
			foreach($data as &$row){				
				$row['start_date'] = date("m/d/Y", strtotime($row['start_date']));					
				//$row['start_date'] = date("m/d/Y", strtotime($row['start_date'])).'  '.$row['start_hhmm'];
			}
		}
		return $data;
	}
	function get_interval_type(){
		return $this->get_data($this->db->get('com_autofbtwitter_interval_type'));
	}
}
?>
