<h2>
    <span class="title"><?php echo $user['username'];?></span>
</h2>
<div class="form">
<img src="<?php echo base_url();?>foto/48908_100000537723270_3522634_n.jpg"></img>
            <?php echo form_open('user/profile/save'); ?>
        <?php
            if ($this->session->flashdata('message')){
                echo "<div class='message'>";
                echo $this->session->flashdata('message');
                echo "</div>";
            }	
        ?>
        <?php echo validation_errors('<p class="error">','</p>'); ?>
        <table align="center">
            <tr>
                <td><label><?php echo $this->lang->line('username');?></label></td>
                <td>
                    <label><?php echo $user['username'];?></label>		
                    <?php echo form_hidden('username',$user['username']); ?>	
                    <?php echo form_hidden('id',$user['id']); ?>	
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
                    <?php echo form_input('email',$user['email']); ?>	
                </td>
            </tr>
        </table>
        <input type="submit" value="<?php echo $this->lang->line('save');?>" />
        <?php echo form_close();?>
</div>