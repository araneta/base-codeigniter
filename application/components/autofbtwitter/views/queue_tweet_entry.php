<?php
//var_dump($queue);
echo form_open(base_url('tweetqueue/save'));
echo form_hidden('id',$queue['id']);	
if(empty($queue['id'])){
	echo "<h3>Add a queue</h3>";
}else
{
	echo "<h3>Edit a queue</h3>";
}
?>
<fieldset>
	<dl>	            
		<dt><label for="name">Queue Name:</label></dt>
		<dd><?php echo form_input('name', set_value('name',$queue['name'])); ?></dd>
	</dl>
	<dl>	            
		<dt><label for="username">Username:</label></dt>
		<dd><?php echo form_dropdown('username', $usernames,$queue['com_autofbtwitter_account_id']); ?></dd>
	</dl>
	<dl>
		<dt><label for="start_date">Start Date:</label></dt>
		<dd><?php echo form_input('start_date', set_value('start_date',$queue['start_date']),'id="start_date" class="txtdate"'); ?> format: mm/dd/yyyy</dd>
	</dl>	
	<dl>
		<dt><label for="start_hhmm">Time:</label></dt>
		<dd><?php echo form_input('start_hhmm', set_value('start_hhmm',$queue['start_hhmm']),'id="start_hhmm"'); ?> format: HH:MM (24-hour)</dd>
	</dl>
	<dl>
		<dt><label for="timezone">Time Zone:</label></dt>
		<dd><?php get_tz_options('timezone',set_value('timezone',$queue['timezone'])); ?></dd>
	</dl>
	<dl>
		<dt><label for="interval">Send Interval:</label></dt>
		<dd>
			<?php echo form_input('interval', set_value('interval',$queue['interval'])); ?>
			<?php echo form_dropdown('interval_type', $interval_type,$queue['interval_type']); ?>
		</dd>
	</dl>
	<dl>
		<dt><label>&nbsp;</label></dt>
		<dd><?php echo form_submit('submit', 'Save');?></dd>
		<dd><?php echo form_button('cancel', 'Cancel', 'onClick="window.location=\''.base_url('tweetqueue/index').'\'"'); ?></dd>
	</dl>
</fieldset>
<?php
echo form_close();
?>
<script type="text/javascript">
$(function() {
	$(".txtdate").datepicker({
		  showTime: true,
		  constrainInput: false,
		  stepMinutes: 1,
		  stepHours: 1,
		  time24h: false,		  
		  dateFormat: "mm/dd/yy"
		});
});
</script>
