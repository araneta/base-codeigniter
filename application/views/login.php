<div class="header_login">
    <div class="logo"><a href="<?= base_url();?>"><img src="images/logo.gif" alt="" title="" border="0" /></a></div> 
</div>                         
<div id="clock_a"></div>
<div class="login_form">
    <h3><?php echo $this->lang->line('logintitle');?></h3>    
    <a href="<?php echo base_url();?>register" class="register"><?php echo $this->lang->line('register');?></a> <?php echo anchor('forgot',$this->lang->line('forgot'),'class=forgot_pass')?>
    <?php
        if ($this->session->flashdata('message')){
            echo "<div class='error_box'>";
            echo $this->session->flashdata('message');
            echo "</div>";
        }   
    ?>
    <?php echo form_open('login/verify'); ?>    
    <fieldset>
        <dl>	            
            <dt><label for="username"><?php echo $this->lang->line('username');?></label></dt>
            <dd><?php echo form_input('username',set_value('username'),'size=54'); ?></dd>
        </dl>
        <dl>            
            <dt><label for="password"><?php echo $this->lang->line('password');?></label></dt>
            <dd><?php echo form_password('password',set_value('password'),'size=54'); ?></dd>
        </dl>        
        <dl>
            <dt><label></label></dt>
            <dd>
                <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>
            </dd>
        </dl>        
        <dl class="submit">
            <?php echo form_submit('submit',$this->lang->line('login')); ?>
        </dl>    
    </fieldset>
    <?php echo form_close(); ?>
</div>