<div id="signup_form">
	<?php echo form_open('register/create'); ?>
	<?php echo validation_errors('<p class="error">','</p>'); ?>
	<table>
	<tr>
		<td><label><?php echo $this->lang->line('username');?></label></td>
		<td>
		<?php echo form_input('username',set_value('username')); ?>		
		</td>
	</tr>
	<tr>
		<td><label><?php echo $this->lang->line('password');?></label></td>
		<td>
		<?php echo form_password('password'); ?>	
		</td>
	</tr>
	<tr>
		<td><label><?php echo $this->lang->line('confirmpassword');?></label></td>
		<td>
		<?php echo form_password('password2'); ?>	
		</td>
	</tr>
	<tr>
		<td><label><?php echo $this->lang->line('email');?></label></td>
		<td>
		<?php echo form_input('email',set_value('email')); ?>	
		</td>
	</tr>
	<tr>
		<td>
			<label><?php echo $this->lang->line('captcha');?></label>
		</td>
		<td>
			<?echo $recaptcha ?>			
		</td>
	</tr>
	</table>
	<input type="submit" value="<?php echo $this->lang->line('signup');?>" />
	<?php echo form_close();?>
</div>