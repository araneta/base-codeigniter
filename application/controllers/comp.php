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
		$this->data['main'] = 'component';		
		$this->data['buffer'] = $this->load->view(COMP_DIR.'/views/'.$name,$data,true);
		$this->load->view($this->m_view,$this->data);
		
	}
	function model($model_name){
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
	
	//http://blog.avinash.com.np/tag/codeigniter-2/
	function create_table($config,$cols,$actions,$model,$criteria,$empty_msg='The table is empty'){
		$this->load->library('table');
		$this->load->library('pagination');
		//default setting
		if(array_key_exists('per_page',$config)==FALSE)
			$config['per_page'] = 10;
		if(array_key_exists('col_id',$config)==FALSE)
			$config['col_id'] = 'id';
		if(array_key_exists('show_no',$config)==FALSE)
			$config['show_no'] = FALSE;
		
		$model->m_paging_prm['per_page'] = $config['per_page'];
		
		//get all the URI segments for pagination and sorting
		$segment_array=$this->uri->segment_array();
		$segment_count=$this->uri->total_segments();
		 
		//for ordering the data items
		$do_orderby = array_search("orderby",$segment_array);
		$model->m_paging_prm['offset'] = 0;
		$model->m_paging_prm['sortname']=null;
		$model->m_paging_prm['sortorder'] = null;
		$this->data['page']=NULL;
		$model->m_paging_prm['per_page'] = $config['per_page'];
		if (ctype_digit($segment_array[$segment_count])) {
			$this->data['page']=$segment_array[$segment_count];
			$model->m_paging_prm['offset'] = $segment_array[$segment_count];
			$model->m_paging_prm['per_page'] = $config['per_page'];
			array_pop($segment_array);
		}
		//find default order
		if($do_orderby===FALSE){			
			foreach($cols as $col){
				if(isset($col[4])){
					$model->m_paging_prm['sortname']=$col[0];
					$model->m_paging_prm['sortorder'] = $col[4];
					break;
				}
			}			
		}else{
			$model->m_paging_prm['sortname']=$this->uri->segment($do_orderby+1);
			$model->m_paging_prm['sortorder']= $this->uri->segment($do_orderby+2);	
			
		}
		
		$search_result = $model->get_page($criteria);		
		$config['total_rows'] = $search_result['total_count'];				
		
		$action_col = FALSE;
		if($actions!=null){
			$action_col = TRUE;
		}
					
		$tmpl = array( 'table_open'    => '<table id="rounded-corner" >',
					'row_alt_start'  => '<tr class="zebra">',
					'heading_row_start'   => '<tr>',
					'heading_row_end'     => '</tr>',
					'heading_cell_start'  => '',
					'heading_cell_end'    => '',
					'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);

		$colname = array();		
		$colid = array();
		$sort = array();
		if($config['show_no']==TRUE){
			$colname[] = '<th scope="col" class="rounded-company" width="20">No</th>';
		}
		foreach($cols as $col){
			
			//sorting link on header
			if(isset($col[4]))
				$sort[$col[1]] =$col[4];
			else
				$sort[$col[1]] = 'asc';
				
			//check to toggle asc and desc sorting in columns
			if($do_orderby !== FALSE) {
				$sort[$segment_array[$do_orderby+1]]= $segment_array[$do_orderby + 2] == 'desc' ? 'asc' : 'desc' ;
			} 
			$extra = '';
			if(isset($col[3]))
				$extra = $col[3];
			$coltext = $col[0];
			if(isset($col[4])){
				$coltext = sprintf('<a href="%s/orderby/%s/%s/%s">%s</a>',$config['base_url'],$col[1],$sort[$col[1]],$this->data['page'],$coltext);				
			}
			$colname[] = sprintf('<th width="%d" %s>%s</th>',$col[2],$extra, $coltext);
			$colid[] = $col[1];	
					
		}
		
		if($action_col==TRUE)
			$colname[] = '<th class="rounded-q4">Action</th>';
		$this->table->set_heading($colname);
				
		$rows = $search_result['data'];
		//var_dump($rows);
		//var_dump($criteria);
		if($rows != null && count($rows)>0){
			$img_acts = array(
				'Edit'=>base_url("images/user_edit.png"),
				'Delete'=>base_url("images/trash.png")
			);
			$i = 1;
			$offset = $model->m_paging_prm['offset'] ;
			foreach($rows as $row){
				//var_dump($row);
				$newrow = array();
				if($config['show_no']==TRUE){
					$newrow[] = $offset +$i;
				}
				foreach($colid as $id){
					$newrow[] = $row[$id];
				}
				$act = '';
				foreach($actions as $action){
					if(isset($action[2])){
						$img = $action[2];
					}else
					{
						$img = $img_acts[$action[0]];
					}
					$act .= '<a type="actlnk" href="#" alt="'.$action[0].'" 
					act="'.strtolower(str_replace(' ','',$action[0])).'" itemid="'.$row[$config['col_id']].'">
					<img src="'.$img.'" /></a>';
					if($act!='')
						$act .= '&nbsp;';
				}
				if($act!='')
					$newrow[] = $act;
				$this->table->add_row($newrow);
				//print_r($row);
				$i++;
			}
			
			$config['base_url'] = site_url(join("/",$segment_array));
			$config['uri_segment'] =count($segment_array)+1;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['table'] = $this->table->generate();
			$data['config'] = $config;
			$data['actions'] = $actions;
			
		}else{
			$data['empty_msg'] = $empty_msg;
		}
				
		return $this->load->view('table',$data,true);
	}
	 
}
?>
