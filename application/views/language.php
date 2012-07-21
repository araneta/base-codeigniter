<div class="lang">
<?php
if (isset($langs)){	
	foreach ($langs as $idtlanguage => $name){
		echo "&nbsp;";
		echo anchor("lang/change/$name",$name);
		echo "&nbsp;";
	}	
}
?>
</div>