<?php 
	if(isset($table)){
		$id = 'form'.rand();
		$attributes = array('id' => $id);
		echo form_open($config['base_url'],$attributes); 
		echo $table;
		echo '<div class="pagepnl">'.$pagination.'</div>';
		echo '<input type="hidden" name="itemid" id="'.$id.'itemid" />';
		echo form_close();
		?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				var formid = '<?php echo $id;?>';
				var actions = <?php 
				$acts = array();
				foreach($actions as $action){
					$acts[strtolower(str_replace(' ','',$action[0]))] = $action[1];
				}
				echo json_encode($acts);
				?>;
				$('a[type="actlnk"]').click(function(){
					var act = $(this).attr('act');
					var id = $(this).attr('itemid');
					$('#'+formid).attr('action',actions[act]);
					$('#'+formid+'itemid').val(id);
					$('#'+formid).submit();
				});
			});
		</script>

		<?php
	}else{
		echo $empty_msg;
	}
?> 
