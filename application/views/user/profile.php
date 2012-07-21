<h1>
	<span class="title"><?php echo $user['firstname']." ".$user['lastname'];?></span>
</h1>
<div style="float:left;width:130px">
	<img src="<?php echo base_url();?>foto/48908_100000537723270_3522634_n.jpg"></img>
</div>
<div style="float:left;padding:0;">
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
<tr>
	<td><label><?php echo $this->lang->line('firstname');?></label></td>
	<td>
	<?php echo form_input('firstname',$user['firstname']); ?>		
	</td>
</tr>
<tr>
	<td><label><?php echo $this->lang->line('lastname');?></label></td>
	<td>
	<?php echo form_input('lastname',$user['lastname']); ?>	
	</td>
</tr>
<tr>
	<td><label><?php echo $this->lang->line('sex');?></label></td>
	<td>
		<select name="sex">
			<option value="m" <?php if($user['sex']=='m'){echo "selected"; }?> ><?php echo $this->lang->line('male');?></option>
			<option value="f" <?php if($user['sex']=='f'){echo "selected"; }?>><?php echo $this->lang->line('female');?></option>
		</select>			
	</td>
</tr>
<tr>
	<td><label><?php echo $this->lang->line('datebirth');?></label></td>
	<td>	
		<?php			
			$date = date_parse($user['dateofbirth']);				
		?>		
		<select name="month">
			
			<option value="0" <?php echo $this->lang->line('selectmonth');?></option>
			<option value="1" <?php if($date['month']=='1'){echo "selected"; }?> ><?php echo $this->lang->line('january');?></option>
			<option value="2" <?php if($date['month']=='2'){echo "selected"; }?> ><?php echo $this->lang->line('february');?></option>
			<option value="3" <?php if($date['month']=='3'){echo "selected"; }?> ><?php echo $this->lang->line('march');?></option>
			<option value="4" <?php if($date['month']=='4'){echo "selected"; }?> ><?php echo $this->lang->line('april');?></option>
			<option value="5" <?php if($date['month']=='5' ){echo "selected"; }?> ><?php echo $this->lang->line('may');?></option>
			<option value="6" <?php if($date['month']=='6'){echo "selected"; }?> ><?php echo $this->lang->line('june');?></option>
			<option value="7" <?php if($date['month']=='7'){echo "selected"; }?> ><?php echo $this->lang->line('july');?></option>
			<option value="8" <?php if($date['month']=='8'){echo "selected"; }?> ><?php echo $this->lang->line('august');?></option>
			<option value="9" <?php if($date['month']=='9'){echo "selected"; }?> ><?php echo $this->lang->line('september');?></option>
			<option value="10" <?php if($date['month']=='10'){echo "selected"; }?> ><?php echo $this->lang->line('october');?></option>
			<option value="11" <?php if($date['month']=='11'){echo "selected"; }?> ><?php echo $this->lang->line('november');?></option>
			<option value="12" <?php if($date['month']=='12'){echo "selected"; }?> ><?php echo $this->lang->line('december');?></option>
		</select>
		<select name="date">
			<option value="0"><?php echo $this->lang->line('selectdate');?></option>
			<?php
				for($i=1;$i<=31;$i++)
				{
					$sel = "";
					if($date['day']==$i){$sel = "selected"; }
					echo "<option value=\"$i\" $sel >$i</option>";
				} 
			?>
		</select>
		
		<select name="year">
			<option value="0"><?php echo $this->lang->line('selectyear');?></option>
			<?php
				for($i=1905;$i<=2011;$i++)
				{
					$sel = "";
					if($date['year']==$i){$sel = "selected"; }
					echo "<option value=\"$i\" $sel>$i</option>";
				} 
			?>
		</select>			
	</td>
</tr>	
</table>
<input type="submit" value="<?php echo $this->lang->line('save');?>" />
<?php echo form_close();?>
</div>