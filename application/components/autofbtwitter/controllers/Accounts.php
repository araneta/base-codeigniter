<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//account controller
class Accounts extends Comp{
	protected $m_view = 'user/dashboard';
	public function __construct() {		
		parent::__construct();
		//FAIL	
		$this->need_login();
	}
	/*
	 *controllers
	 */  
	function index(){					
		$this->data['title'] = 'Account List';
		$this->model('MAccount');
					
		//create table		
		$conf['base_url'] = site_url('accounts/index');
		//$conf['per_page'] =  1;		
		$actions[] = array('Delete',site_url('accounts/delete'));		
		$cols[] = array('Username','username',200,'scope="col" class="rounded-company"','asc');
		$cols[] = array('Type','type',100,'scope="col" class="rounded"');		
		
		$empty_msg = '<div class="warning_box">You have not added any account yet. please add</div>';
		$this->data['table'] = $this->create_table($conf,$cols,$actions,
			$this->MAccount,array('id_user'=>$this->session->userdata('userid')),			
			$empty_msg );
		
		$this->view('account_list',$this->data);
	}
	
	function addtwitter(){
		redirect($this->get_twitter_auth_url());
	}
	function addfacebook(){
		//get code from fb
		redirect($this->get_facebook_auth_url());
		
	}
	function twittercallback(){
		if(isset($_GET['oauth_token'])){	
			include 'lib/EpiCurl.php';
			include 'lib/EpiOAuth.php';
			include 'lib/EpiTwitter.php';
			include 'lib/secret.php';
			
			$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
			$twitterObj->setToken($_GET['oauth_token']);
			$token = $twitterObj->getAccessToken();
			$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);	  				
			$twitterInfo= $twitterObj->get_accountVerify_credentials();
			$twitterInfo->response;
			if(empty($token->oauth_token)||empty($token->oauth_token_secret)){
				$this->session->set_flashdata('error','twitter token is empty');	
			}else
			{				
				//TODO: check twitterinfo		
				$username = $twitterInfo->screen_name;	
				if(empty($username)){
					$this->session->set_flashdata('error','twitter username is empty');	
				}else{
					if(!$this->save_twitter($this->session->userdata('userid'),
					$username,$token->oauth_token,$token->oauth_token_secret))
					{
						$this->session->set_flashdata('error',$this->MAccount->print_error());
					}else
					{
						$this->session->set_flashdata('info','Account Saved');
					}
				}						
			}
		}else{
			$this->session->set_flashdata('error','twitter token is empty');
		}
		redirect(base_url('accounts/index'),'refresh' );
	}
	function fbcallback(){
		if(isset($_GET['code'])){
			//get access token						
			$content = $this->get_content($this->get_facebook_token_url($_GET['code']));
			if(!empty($content)){
				//echo $content;
				parse_str($content);
				//echo "token:".$access_token;
				if(isset($access_token)){
					$username = $this->get_facebook_username($access_token);
					if($username==null){
						$this->session->set_flashdata('error','Facebook username is empty');	
					}else{
						if(!$this->save_facebook($this->session->userdata('userid'),$username,$access_token)){						
							$this->session->set_flashdata('error',$this->MAccount->print_error());
						}else{
							$this->session->set_flashdata('info','Account Saved');
						}
					}
				}else
				{
					$this->session->set_flashdata('error','Facebook token is empty');	
				}
			}else
			{
				$this->session->set_flashdata('error','Facebook token is empty');
			}
		}else{
			$this->session->set_flashdata('error','Facebook code is empty');
		}
		redirect(base_url('accounts/index') );
	}
	function delete(){
		$id = $this->input->post('itemid');
		if(empty($id)){
			$this->session->set_flashdata('error','Item id is empty');
		}
		$id = intval($id);
		$this->model('MAccount');
		$criteria = array('id'=>$id,'id_user'=>intval($this->session->userdata('userid')));
		
		$account = $this->MAccount->get_by($criteria);
		if($account==null){
			$this->session->set_flashdata('error','Account can not be found');
		}else{
			if($this->MAccount->delete($id)==TRUE){
				$this->session->set_flashdata('info','Account deleted');
			}else{
				$this->session->set_flashdata('error','Account can not be deleted');
			}
		}
		redirect(base_url('accounts/index') );
	}
	/*
	 * process	 
	*/
	function save_facebook($userid,$username,$access_token){
		$this->model('MAccount');
		$account = array('type'=>2
				,'id_user'=>$userid
				,'username'=>$username
				);
		$accountex = array('access_token'=>$access_token	
				);
		return $this->MAccount->save($account,$accountex);
		
	}
	function save_twitter($userid,$username,$auth_token,$auth_token_secret){
		$this->model('MAccount');
		$account = array('type'=>1
				,'id_user'=>$userid
				,'username'=>$username
				);
		$accountex = array('token'=>$auth_token
				,'token_secret'=>$auth_token_secret	
				);
		return $this->MAccount->save($account,$accountex);
		
	}
	
	function get_content($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function get_twitter_auth_url(){
		include 'lib/EpiCurl.php';
		include 'lib/EpiOAuth.php';
		include 'lib/EpiTwitter.php';
		include 'lib/secret.php';		
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);	
		return $twitterObj->getAuthorizationUrl();
	}
	//get code
	function get_facebook_auth_url(){
		include 'lib/secret.php';		
		$url = sprintf('https://www.facebook.com/dialog/oauth?client_id=%s&scope=offline_access&redirect_uri=%s',
			$app_id,urlencode(base_url().'accounts/fbcallback'));
		return $url;		
	}
	//get token
	function get_facebook_token_url($code){
		include 'lib/secret.php';	
		$code = str_replace('#_=_','',$code);
		$url = sprintf('https://graph.facebook.com/oauth/access_token?client_id=%s&client_secret=%s&code=%s&redirect_uri=%s',
			$app_id,$app_secret,$code,urlencode(base_url().'accounts/fbcallback'));
		return $url;
		
	}
	function get_facebook_username($token){
		$url = sprintf('https://graph.facebook.com/me?access_token=%s',$token);
		$content = $this->get_content($url);
		if(!empty($content)){
			$obj = json_decode($content);
			return $obj->{'username'}; 
		}
		return null;
	} 
}
?>
