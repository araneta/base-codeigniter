<?php 
if (isset($navlist)&&count($navlist)){
	echo "<ul>";
	foreach ($navlist as $id => $name){
		echo "<li>";
		echo anchor("welcome/cat/$id",$name);
		echo "</li>";
	}
	echo "</ul>";
}
?>