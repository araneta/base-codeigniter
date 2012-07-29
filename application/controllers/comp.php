<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//component base

class Comp extends MY_Controller {
	
	public function __construct() {
		parent::__construct();	                				        	
	}
	function index(){
		echo "component";
	}
	function view($name,$data){
		/*
		$view_file_name = $name.EXT;
		$view_dir = $this->m_curr_comp['dir'].'/views';
		$view_path = $view_dir .'/'. $view_file_name;
		if(file_exists($view_path)){
			ob_start();
			extract($data);
			include $view_path;
			$buffer = ob_get_contents();
			@ob_end_clean();
			$this->data['main'] = 'component';		
			$this->data['buffer'] = $buffer;
			$this->load->view($this->m_view,$this->data);	
		}else{
			echo $view_path .' not found';
		}
		*/
		$this->data['main'] = 'component';		
		$this->data['buffer'] = $this->load->view(COMP_DIR.'/views/'.$name,$data,true);
		$this->load->view($this->m_view,$this->data);
		
	}
	function model($model_name){/*
		$model_file_name = strtolower($model_name).EXT;
		$model_dir = $this->m_curr_comp['dir'].'/models';
		$model_path = $model_dir .'/'. $model_file_name;
		if(file_exists($model_path)){
			include $model_path;
			if(class_exists($model_name)){
				$this->load->model('Model');
				$this->$model_name = new $model_name();		
			}else{
				echo $model_name .' not found';
			}			
		}else{
			echo $model_path .' not found';
		}
		*/
		$this->load->model(COMP_DIR.'/models/'.$model_name);
	}

	public function _remap($method)
	{
		$dir = str_replace('\\', '/', getcwd()). '/application/components/'.$method;
		
		if(is_dir($dir)==TRUE)
		{
			$controller_dir = $dir . '/controllers';
			$view_dir = $dir . '/views';
			if(is_dir($controller_dir))
			{
				$param_offset = 2;
				$params = array_slice($this->uri->rsegment_array(), $param_offset);
				
				if(count($params)>1){
					$class_method = $params[1];
				}else
				{
					$class_method = 'index';
				}
				//print_r($params);
				$controller_name = ucfirst($params[0]);
				$controller_file_name = $controller_name.EXT;
				$controller_path = $controller_dir. '/'.$controller_file_name;
				if(file_exists($controller_path)){
					include $controller_path;
					if(class_exists($controller_name)){
						//$this->m_curr_comp['name'] = $method;
						//$this->m_curr_comp['dir'] = $dir;
						define('COMP_DIR','../components/'.$method);
						
						$class = new $controller_name();
						if (method_exists($class, $class_method))
						{
							return call_user_func_array(array($class, $class_method), array_slice($params,1));
						}else
						{
							echo $controller_name.'::'.$class_method.' not found';
						}
					}
				}else{
					$controller_path . ' not found';
				}
			}else{
				echo $controller_dir . ' not found';
			}
		}else
		{
			echo $dir .' not found';
		}
	} 
	 
}
?>
