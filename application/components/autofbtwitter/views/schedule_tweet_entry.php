<?php
echo form_open(base_url('tweetscheduler/save'));
echo form_hidden('id',$schedule['id']);	
if(empty($schedule['id'])){
	echo "<h3>Add a schedule</h3>";
}else
{
	echo "<h3>Edit a schedule</h3>";
}
?>
<fieldset>
	<dl>	            
		<dt><label for="username">Username:</label></dt>
		<dd><?php echo form_dropdown('username', $usernames,$schedule['com_autofbtwitter_account_id'],'id="username"'); ?></dd>
	</dl>
	<dl>
		Your message will be scheduled for:
	</dl>
	<dl>
		<dt><label for="schedule_date">Date:</label></dt>
		<dd><?php echo form_input('schedule_date', set_value('schedule_date',$schedule['schedule_date']),'id="schedule_date"'); ?> format: mm/dd/yyyy</dd>
	</dl>
	<dl>
		<dt><label for="schedule_hhmm">Time:</label></dt>
		<dd><?php echo form_input('schedule_hhmm', set_value('schedule_hhmm',$schedule['schedule_hhmm']),'id="schedule_hhmm"'); ?> format: HH:MM (24-hour)</dd>
	</dl>
	<dl>
		<dt><label for="schedule_tz">Time Zone:</label></dt>
		<dd><?php get_tz_options('schedule_tz',set_value('schedule_tz',$schedule['schedule_tz'])); ?></dd>
	</dl>
	<dl>
		<dt><label for="message">Message:</label></dt>
		<dd><textarea name="message" id="message"><?php echo set_value('message',$schedule['message']);?></textarea></dd>
	</dl>
	<dl>
		<dt>&nbsp;</dt>
		<dd>			
			<input type="button" id="btnImgUpload" value="Add Image" />
			<input type="button" id="btnShortLink" value="Tiny Links" />
		</dd>		
	</dl>
	<dl>
		<dt><label>&nbsp;</label></dt>
		<dd><?php echo form_submit('submit', 'Save');?><?php echo form_button('cancel', 'Cancel', 'onClick="window.location=\''.base_url('tweetscheduler/index').'\'"'); ?></dd>
	</dl>
	
</fieldset>
<div id="upload-form"></div>
<?php
echo form_close();
?>
<script type="text/javascript">
$(function() {
	$("#schedule_date").datepicker({
		  showTime: true,
		  constrainInput: false,
		  stepMinutes: 1,
		  stepHours: 1,
		  time24h: false,		  
		  dateFormat: "mm/dd/yy"
		});		
   
   
		
	$( "#upload-form" ).dialog({
		autoOpen: false,
		height: 200,
		width: 400,
		modal: true,
		buttons: {
				Ok: function() {				
						$( this ).dialog( "close" );
				}
				,
				Cancel: function() {
					$( this ).dialog( "close" );
				}
		},
		close: function() {                    
		},
		open:function(){                			
			$( "#upload-form" ).load('<?php echo base_url('upload/index');?>',function(){
				$('#upload_file').submit(function(e) {
					$('#files').html('<img src="<?php echo base_url('images/ajax-loader.gif');?>" /><span>Uploading file...</span>'); 
				  e.preventDefault();
				  $.ajaxFileUpload({
					 url         :'<?php echo base_url('tweetscheduler/upload_file');?>',
					 secureuri      :false,
					 fileElementId  :'userfile',
					 dataType    : 'json',
					 data        : {
						<?php echo $this->security->get_csrf_token_name();?>:'<?php echo $this->security->get_csrf_hash();?>',
						'params':$('#username').val()
					 },
					 success  : function (data, status)
					 {
						if(data.status != 'error')
						{
						   $('#files').html('');
						   var temp = $('#message').val();
						   $('#message').val(temp+' '+data.msg);
						   $( "#upload-form" ).dialog( "close" );
						}else{
							alert(data.msg);
						}
					 }
				  });
				  return false;
			   });
			});                
		}
	});
	$( "#btnImgUpload" )            
		.click(function() {
				$( "#upload-form" ).dialog( "open" );
	});
	$('#btnShortLink').click(function(){		
		$.post(
			'<?php echo base_url('tweetscheduler/shorten_links');?>',
			{
				text:$('#message').val(),
				<?php echo $this->security->get_csrf_token_name();?>:'<?php echo $this->security->get_csrf_hash();?>'
			},
			function(data){
				if(data!=null)
				{
					$('#message').val(jQuery.trim(data));
				}
			}
		);
	});
});
</script>
