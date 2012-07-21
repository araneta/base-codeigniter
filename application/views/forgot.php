<div id="forgot_form">
	<p class="heading"><?php echo $this->lang->line('forgottitle');?></p>
	<?php echo form_open('forgot/submit'); ?>
	<?php
	if ($this->session->flashdata('message')){
		echo "<div class='message'>";
		echo $this->session->flashdata('message');
		echo "</div>";
	}	
	?>	
	<p>
		<label for="email"><?php echo $this->lang->line('email');?></label>
		<?php echo form_input('email',set_value('email')); ?>
	</p>	
	<p>
		<?php echo form_submit('submit',$this->lang->line('send')); ?>
	</p>
	<?php echo form_close(); ?>
</div>