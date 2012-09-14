<?php
if ($this->session->flashdata('info')){
	echo "<div class='valid_box'>";
	echo $this->session->flashdata('info');
	echo "</div>";
}	
if ($this->session->flashdata('error')){
	echo "<div class='error_box'>";
	echo $this->session->flashdata('error');
	echo "</div>";
}
$val_errors = validation_errors();
if(!empty($val_errors)){
	echo "<div class='error_box'>";
	echo $val_errors;
	echo "</div>";
}
if ($this->session->flashdata('warning')){
	echo "<div class='warning_box'>";
	echo $this->session->flashdata('warning');
	echo "</div>";
}
?>
