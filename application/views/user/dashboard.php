<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>		
	<link href="<?= base_url();?>css/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>css/default.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		//<![CDATA[
		var base_url = '<?= base_url();?>';
		//]]>
	</script>
	
	<?php
	if (isset($cssfiles) && count($cssfiles)){		
		foreach ($cssfiles as $css){
			echo "<link href=\"". base_url(). "css/$css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";			
		}		
	} 
	?>	
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<?php $this->load->view("user/user_header");?>
		</div>		
                <div class="maincontent">
                    <div id="ad">
                    <?php $this->load->view("ads");?>
                    </div>
                    <div id="main" >
                            <?php $this->load->view($main);?>
                    </div>					
                </div>
		<div id="footer">
			<?php $this->load->view("user/user_footer");?>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.4.min.js"></script>
	<?php
	if(isset($jslang))
	{
	?>
		<script type="text/javascript" src="<?php echo base_url();?>javalang/f/<?php echo $jslang; ?>"></script>
	<?php
	}
	if (isset($jsfiles) && count($jsfiles)){		
		foreach ($jsfiles as $js){
			echo "<script type=\"text/javascript\" src=\"".base_url()."js/$js\"></script>\r\n";			
		}		
	} 	
	?>
</body>
</html>
