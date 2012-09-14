<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//scheduler controller
class Tweetmessage extends Comp{
	protected $m_view = 'user/dashboard';
	public function __construct() {		
		parent::__construct();
		//FAIL	
		$this->need_login();
	}
	/*
	 *controllers
	 */  
	 
	function index($offset=0){	
		$id = $this->session->userdata('queue_id');
		if(empty($id))
			die('invalid itemid');
		$id = intval($id);
		
		$this->model('MQueue');
		$criteria = array(
			'com_autofbtwitter_queue.id_user'=>$this->session->userdata('userid')
			,'com_autofbtwitter_queue.id'=>$id
		);
		$queue = $this->MQueue->get_by($criteria);
		if($queue==null)
			die('queue not found');
		$queue = $queue[0];
		$this->data['title'] = 'Tweet Queue : Messages';	
		$this->model('MTweetQueueMessage');					
		$conf['base_url'] = site_url('tweetmessage/index?itemid='.$id);
		$conf['show_no'] = TRUE;
		$actions[] = array('Delete',site_url('tweetmessage/delete'));		
		$actions[] = array('Edit',site_url('tweetmessage/edit'));					
		$cols[] = array('Message','message',200,'scope="col" class="rounded"');		
		$cols[] = array('Date','start_date',50,'scope="col" class="rounded"');		
		$cols[] = array('Time','start_hhmm',50,'scope="col" class="rounded"');		
		$cols[] = array('Status','status',100,'scope="col" class="rounded"');	
		$criteria = array(
			'com_autofbtwitter_queue_message.id_user'=>$this->session->userdata('userid')
			,'com_autofbtwitter_queue_id'=>$id
		);
		$empty_msg = '<div class="warning_box">You have not added any message yet. please add</div>';
		$this->data['table'] = $this->create_table($conf,$cols,$actions,$this->MTweetQueueMessage,$criteria,$empty_msg );
		$this->data['queue'] = $queue;
		//get the queue scheduled time
		$newtime = strtotime($this->MTweetQueueMessage->get_schedule_time($id));
		//convert from server tz to user tz
		$server_tz = $this->config->item('server_tz');
		$user_tz = $queue['timezone'];
		$start  = date("Y-m-d H:i:s", $newtime);
		$date = new DateTime($start,new DateTimeZone($server_tz));			
		$date->setTimezone(new DateTimeZone($user_tz));		
		
		$message=array();
		$message['id'] = null;
		$message['message'] = null;
		$message['scheduled_date_time_server_time'] = null;
		$message['start_date'] = $date->format('Y-m-d');
		$message['start_hhmm'] = $date->format('H:i:s');	
		$this->data['message'] = $message;
		$this->data['jsfiles'] = array('jquery-ui-1.8.16.custom.min.js','ajaxfileupload.js');		
		$this->data['cssfiles'] = array('redmond/jquery-ui-1.8.16.custom.css');					
		$this->view('queue_message_list',$this->data);
	}
	function edit(){
		$id = $_REQUEST['itemid'];
		if(empty($id))
			die('invalid itemid');
		$idmessage = intval($id);
		//get the message
		$this->model('MTweetQueueMessage');		
		$criteria = array(
			'id_user'=>$this->session->userdata('userid')
			,'id'=>intval($id)
		);
		$message = $this->MTweetQueueMessage->get_by($criteria);
		if($message==null)
			die('message not found');
		$message = $message[0];
		//get the queue
		$queueid = intval($message['com_autofbtwitter_queue_id']);
		$this->model('MQueue');
		$criteria = array(
			'com_autofbtwitter_queue.id_user'=>$this->session->userdata('userid')
			,'com_autofbtwitter_queue.id'=>$queueid
		);
		$queue = $this->MQueue->get_by($criteria);
		if($queue==null)
			die('queue not found');
				
		$this->data['title'] = 'Tweet Queue : Edit Message';	
		$conf['base_url'] = site_url('tweetmessage/index');
		$conf['show_no'] = TRUE;
		$actions[] = array('Delete',site_url('tweetmessage/delete'));		
		$actions[] = array('Edit',site_url('tweetmessage/edit'));				
			
		$cols[] = array('Message','message',200,'scope="col" class="rounded"');		
		$cols[] = array('Date','start_date',50,'scope="col" class="rounded"');		
		$cols[] = array('Time','start_hhmm',50,'scope="col" class="rounded"');		
		$cols[] = array('Status','status',100,'scope="col" class="rounded"');	
		$criteria = array(
			'com_autofbtwitter_queue_message.id_user'=>$this->session->userdata('userid')
			,'com_autofbtwitter_queue_id'=>$queueid
		);
		$empty_msg = '<div class="warning_box">You have not added any message yet. please add</div>';
		$this->data['table'] = $this->create_table($conf,$cols,$actions,$this->MTweetQueueMessage,$criteria,$empty_msg );
		$this->data['queue'] = $queue[0];
		$this->data['message'] = $message;
		
		$this->data['jsfiles'] = array('jquery-ui-1.8.16.custom.min.js','ajaxfileupload.js');		
		$this->data['cssfiles'] = array('redmond/jquery-ui-1.8.16.custom.css');					
		$this->view('queue_message_list',$this->data);
	}
	function delete(){
		$id = $this->input->post('itemid');
		if(empty($id)){
			$this->session->set_flashdata('error','Item id is empty');
		}
		$id = intval($id);
		$this->model('MTweetQueueMessage');
		$criteria = array(
			'id_user'=>$this->session->userdata('userid')
			,'id'=>intval($id)
		);
		$message = $this->MTweetQueueMessage->get_by($criteria);
		
		if($message==null){
			$this->session->set_flashdata('error','Message can not be found');
		}else{
			if($this->MTweetQueueMessage->delete($id)==TRUE){
				$message = $message[0];
				$this->MTweetQueueMessage->recalculate_schedule_time($message['com_autofbtwitter_queue_id']);
				$this->session->set_flashdata('info','Message deleted');
			}else{
				$this->session->set_flashdata('error','Message can not be deleted');
			}
		}
		redirect(base_url('tweetmessage/index') );
	}
	function saveValidate()
	{		
		$this->form_validation->set_rules('message', 'lang:Message', 'required');		
		return ($this->form_validation->run());
	}
	function save(){			
		if($this->saveValidate()==FALSE)
		{
			$this->index();
			return;
		}
		else         
		{			
			$this->model('MTweetQueueMessage');			
			$message = $this->bind($this->MTweetQueueMessage);		
			$message['id_user'] = intval($this->session->userdata('userid'));
			
			if($this->MTweetQueueMessage->save($message)==TRUE)				
				$this->session->set_flashdata('info','Message saved');
			else
				$this->session->set_flashdata('error','Error saving message');			
		}		
		redirect(base_url('tweetmessage/index'));
	}
	
	function upload_file(){
		$status = "";
		$msg = "";
		$file_element_name = 'userfile';
		
		$account_id = $this->input->post('params');
		if(empty($account_id)){
			echo json_encode(array('status'=>'error','msg'=>'account not found'));
			exit(0);
		}	   
		$this->model('MAccount');
		$tokens = $this->MAccount->get_twitter_token($this->session->userdata('userid'),$account_id);
		if($tokens==null)
		{
			echo json_encode(array('status'=>'error','msg'=>'token not found'));
			exit(0);
		}
		$token = $tokens[0];
	   
		$config['upload_path'] = '/opt/lampp/htdocs/uploads';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = 1024 * 8;
		$config['encrypt_name'] = TRUE;
 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload($file_element_name))
		{
			$status = 'error';
			$msg = $this->upload->display_errors('', '');
		}
		else
		{
			$data = $this->upload->data();
			
			require (dirname(__FILE__).'/lib/tmhOAuth.php');
			require (dirname(__FILE__).'/lib/tmhUtilities.php');
			require (dirname(__FILE__).'/lib/secret.php');

			$tmhOAuth = new tmhOAuth(array(
					 'consumer_key'    => $consumer_key,
					 'consumer_secret' => $consumer_secret,
					 'user_token'      => $token['oauth_token'],
					 'user_secret'     => $token['oauth_token_secret'],
			));
			
			$image = $data['full_path'];

			$code = $tmhOAuth->request( 'POST','https://upload.twitter.com/1/statuses/update_with_media.json',
			   array(
					'media[]'  => "@{$image};type=image/jpeg;filename={$image}",
					'status'   => $data['orig_name'],
			   ),
				true, // use auth
				true  // multipart
			);

			if ($code == 200){
				//tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
				$status = "success";
				//$msg = $tmhOAuth->response['response'];
				$data = json_decode($tmhOAuth->response['response']);				
				$entities = $data->{'entities'};
				$media =$entities->{'media'};
				$xmedia = $media[0];
				$msg = 'http://'.$xmedia->{'display_url'};
			}else{
				//tmhUtilities::pr($tmhOAuth->response['response']);
				$status = "error";
				$msg = 'Error uploading file to twitter';//$tmhOAuth->response['response'];
			   
			}	
			@unlink($image);					

		}
		@unlink($_FILES[$file_element_name]);
	   
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}	

	function shorten_links(){
		$text = $this->input->post('text');
		if(empty($text)){
			echo "";
			exit(0);
		}		
		// Explode the submited text
		$pieces = explode(" ", $text);	
		if(count($pieces)>0){	 
			require (dirname(__FILE__).'/lib/secret.php');
			// For each element in array check if it is a link, shorten and replace it in passed text
			foreach ($pieces as $piece) {
				if($this->startsWith(trim($piece),'http://bit.ly'))
					continue;
				if (preg_match("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", $piece)) {
					$newsmallurl = $this->get_bitly_short_url($piece,$bitly_username,$bitly_api_key);
					if($newsmallurl!='INVALID_URI')
						$text = str_replace($piece, $newsmallurl, $text);
				}
			}
		}
		echo $text;		
	}
	//http://davidwalsh.name/bitly-api-php
	
	function get_bitly_short_url($url,$login,$appkey,$format='txt') {
	  $connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
	  return $this->curl_get_result($connectURL);
	}
	function curl_get_result($url) {
	  $ch = curl_init();
	  $timeout = 5;
	  curl_setopt($ch,CURLOPT_URL,$url);
	  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}
	function startsWith($haystack, $needle)
	{
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}
}
