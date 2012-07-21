<?php
    if ($this->session->flashdata('message')){
            echo "<div class='message'>";
            echo $this->session->flashdata('message');
            echo "</div>";
    }

?>
<div id="signin_form">
	<h3><?php echo $this->lang->line('logintitle');?></h3>
        <?php echo anchor('forgot',$this->lang->line('forgotlink'),'class="forgot_pass"')?> 
	<?php echo form_open('login/verify'); ?>
        <fieldset>	            
            <label for="username"><?php echo $this->lang->line('username');?></label>
            <br />
            <?php echo form_input('username',set_value('username')); ?>
            <br /><br />            
            <label for="password"><?php echo $this->lang->line('password');?></label>
            <br />
            <?php echo form_password('password'); ?>
            <br /><br />
            <?php echo form_submit('submit',$this->lang->line('login')); ?>
            <br />
	
        </fieldset>
	<?php echo form_close(); ?>
	
</div>