<div class="left_footer_login">
<?php
if (isset($langs)){	
	foreach ($langs as $lang){
		echo "&nbsp;";
		echo anchor("lang/change/".$lang['name'],$lang['name']);
		echo "&nbsp;";
	}	
}
?>
</div>