<div class="header_login">
    <div class="logo"><a href="<?= base_url();?>"><img src="images/logo.gif" alt="" title="" border="0" /></a></div> 
</div>                         
<div id="clock_a"></div>
<div class="signup_form">
    <h3>Signup</h3>    
        <?php echo validation_errors('<div class="error_box">','</div>'); ?>    
    <?php echo form_open('register/create'); ?>
    <fieldset>
        <dl>
            <dt><label><?php echo $this->lang->line('username');?></label></dt>
            <dd><?php echo form_input('username',set_value('username'),'size=54'); ?></dd>
        </dl>
        <dl>
            <dt><label><?php echo $this->lang->line('password');?></label></dt>
            <dd><?php echo form_password('password',set_value('password'),'size=54'); ?></dd>
        </dl>
        <dl>
            <dt><label><?php echo $this->lang->line('confirmpassword');?></label></dt>
            <dd><?php echo form_password('password2',set_value('password2'),'size=54'); ?></dd>
        </dl>
        <dl>
            <dt><label><?php echo $this->lang->line('email');?></label></dt>
            <dd><?php echo form_input('email',set_value('email'),'size=54'); ?></dd>
        </dl>
        <dl>
            <dt><label><?php echo $this->lang->line('captcha');?></label></dt>
            <dd><?echo $recaptcha ?></dd>
        </dl>    
        <dl class="submit"><input type="submit" value="<?php echo $this->lang->line('signup');?>" /></dl>
    </fieldset>
    <?php echo form_close();?>
</div>