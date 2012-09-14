<?php
//model to list queue message
define('QSTAT_PENDING',0);
define('QSTAT_SENDING',1);
define('QSTAT_SUCCESS',2);
define('QSTAT_FAILED',3);
class MTweetQueueMessage extends MY_Model
{
	protected $m_table = 'com_autofbtwitter_queue_message';
	public $cols = array(
		'id'
		,'com_autofbtwitter_queue_id'		
		,'id_user'		
		,'message'
		,'created_date'
		,'last_update'
		,'scheduled_date_time_server_time'
		);
	function __construct()
	{		
		parent::__construct();		
	}
	//overide
	function save($message){
		date_default_timezone_set('UTC'); // make this match the server timezone		
		$now = gmdate("Y-m-d\TH:i:s\Z");		
		$queue_id = id_clean($message['com_autofbtwitter_queue_id']);
		$criteria = array(
			'com_autofbtwitter_queue_id'=>$queue_id
			,'id_user'=>id_clean($message['id_user'])
			);
		//var_dump($criteria);		
		//if create new
		if(empty($message['id'])){						
			$message['created_date'] = $now;			
			$message['last_update'] = $now;
						
			$message['scheduled_date_time_server_time'] = $this->get_schedule_time($queue_id);
			
		}else{
			$message['last_update'] = $now;
		}
		return parent::save($message);		
	}
	function get_queue($id){
		$queue = $this->get_data($this->db->get_where('com_autofbtwitter_queue', array('id' => intval($id)), 1, 0));
		if($queue!=null)
			return $queue[0];
		return null;
	}
	function get_schedule_time($queue_id){
		$queue = $this->get_queue($queue_id);		 
		$interval = $queue['interval_in_minute']*60;
		$time = $queue['start_date_server_time'];
		
		$sql = sprintf('select scheduled_date_time_server_time 
			from %s 
			where 
			com_autofbtwitter_queue_id = %d
			order by id desc
			limit 0,1
			',
			$this->m_table,id_clean($queue_id)
			);
		$q = $this->db->query($sql);		
        if($q->num_rows()>0)
        {
			
            $row = $q->row_array();
            $timex = strtotime($row['scheduled_date_time_server_time'])+$interval;
			$start  = date("Y-m-d H:i:s", $timex);
			$date = new DateTime($start,new DateTimeZone($this->config->item('server_tz')));			
			$time = $date->format('Y-m-d H:i:s');	
        }
        $q->free_result();
        return $time;
	}
	
	function recalculate_schedule_time($queue_id){
		date_default_timezone_set('UTC'); // make this match the server timezone		
		
		$criteria = array('com_autofbtwitter_queue_id'=>id_clean($queue_id));
		$messages = $this->get_by($criteria,null,null,null,'id','asc');
		if($messages!=null){
			$queue = $this->get_queue($queue_id);
			if($queue!=null){								
				$interval = $queue['interval_in_minute']*60;
				$start = strtotime($queue['start_date_server_time']);
				$time = $start;
				$tz = $this->config->item('server_tz');
				foreach($messages as $msg){
					$now = gmdate("Y-m-d\TH:i:s\Z");		
					$msg['last_update'] = $now;					
					$date = new DateTime(date("Y-m-d H:i:s", $time),new DateTimeZone($tz));								
					$msg['scheduled_date_time_server_time'] = $date->format('Y-m-d H:i:s');					
					$this->save($msg);
					$time += $interval;
				}
			}
			
		}
		
	}
	function after_get_by($data){
		if($data!=null)
		{
			$sample = $data[0];
			$queue_id = $sample['com_autofbtwitter_queue_id'];
			$queue = $this->get_queue($queue_id);
			if($queue!=null){
				$user_tz = $queue['timezone'];
				$server_tz = $this->config->item('server_tz');
				//convert from server time to user timezone
				foreach($data as &$row){				
					$time = strtotime($row['scheduled_date_time_server_time']);
					$date = new DateTime(date("Y-m-d H:i:s", $time),new DateTimeZone($server_tz));								
					$date->setTimezone(new DateTimeZone($user_tz));					
					$row['start_date'] = $date->format('m/d/Y');					
					$row['start_hhmm'] = $date->format('H:i:s');	
					
					switch($row['state']){
					case QSTAT_PENDING:
						$row['status'] = 'Pending';
					break;
					case QSTAT_SENDING:
						$row['status'] = 'Sending';
					break;
					case QSTAT_SUCCESS:
						$row['status'] = 'Sent';
					break;
					case QSTAT_FAILED:
						$row['status'] = 'Error:'.$row['error_message'];
					break;
				}				
					//$row['start_date'] = date("m/d/Y", strtotime($row['start_date'])).'  '.$row['start_hhmm'];
				}
				
			}
			
		}
		return $data;
	}
	
}
?>
