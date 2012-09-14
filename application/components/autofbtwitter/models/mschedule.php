<?php
//model to list account in system
define('QSTAT_PENDING',0);
define('QSTAT_SENDING',1);
define('QSTAT_SUCCESS',2);
define('QSTAT_FAILED',3);
class MSchedule extends MY_Model
{
	protected $m_table = 'com_autofbtwitter_schedule';
	public $cols = array(
		'id'
		,'com_autofbtwitter_account_id'
		,'schedule_date'
		,'schedule_hhmm'
		,'schedule_tz'
		,'message'
		,'created_date'
		,'last_update'
		,'id_user'
		,'scheduled_date_time_server_time'
		,'state'
		,'error_message'
		);
	function __construct()
	{		
		parent::__construct();		
	}
	//overide
	function save($schedule){
		date_default_timezone_set('UTC'); // make this match the server timezone		
		$now = gmdate("Y-m-d\TH:i:s\Z");
		//convert from mm/dd/yy to yyyy-mm-dd
		list($mm,$dd,$yy)=explode("/",$schedule['schedule_date']);
		$schedule['schedule_date'] = sprintf('%s-%s-%s',$yy,$mm,$dd);
		//convert scheduled time to server time
		$scheduled_time  = date("Y-m-d H:i:s", strtotime($schedule['schedule_date'].' '.$schedule['schedule_hhmm']));
		$date = new DateTime($scheduled_time,new DateTimeZone($schedule['schedule_tz']));
		$date->setTimezone(new DateTimeZone($this->config->item('server_tz')));
		$schedule['scheduled_date_time_server_time'] =$date->format('Y-m-d H:i:s');
		$schedule['state'] = QSTAT_PENDING;
		$schedule['error_message']='';
		//if create new
		if(empty($schedule['id'])){						
			$schedule['created_date'] = $now;			
			$schedule['last_update'] = $now;
		}else{
			$schedule['last_update'] = $now;
		}
		return parent::save($schedule);		
	}
	
	function before_get_by(){
		$this->db->select('com_autofbtwitter_schedule.*,com_autofbtwitter_account.username');
		$this->db->join('com_autofbtwitter_account',
			'com_autofbtwitter_account.id = com_autofbtwitter_schedule.com_autofbtwitter_account_id');
		
	}
	function after_get_by($data){
		if($data!=null)
		{
			foreach($data as &$row){				
				$row['schedule_date'] = date("m/d/Y", strtotime($row['schedule_date']));						
				//$row['schedule_date'] = date("m/d/Y", strtotime($row['schedule_date'])).' '.$row['schedule_hhmm'];						
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
			}
		}
		return $data;
	}
}
?>
