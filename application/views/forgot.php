<div class="header_login">
    <div class="logo"><a href="<?= base_url();?>"><img src="images/logo.gif" alt="" title="" border="0" /></a></div> 
</div>                         
<div id="clock_a"></div>
<div class="login_form">
    <h3><?php echo $this->lang->line('forgottitle');?></h3>
    <?php echo form_open('forgot/submit'); ?>
    <fieldset>
        <?php
            if ($this->session->flashdata('message')){
                echo "<div class='message'>";
                echo $this->session->flashdata('message');
                echo "</div>";
            }	
        ?>	
        <dl>
            <dt><label for="email"><?php echo $this->lang->line('email');?></label></dt>
            <dd><?php echo form_input('email',set_value('email'),'size=54'); ?></dd>
        </dl>	
        <dl class="submit">
            <?php echo form_submit('submit',$this->lang->line('send')); ?>
        </dl>
    </fieldset>
    <?php echo form_close(); ?>
</div>