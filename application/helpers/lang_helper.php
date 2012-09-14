<?php
function getLang()
{
	if(empty($_SESSION['language']))
	{
		$_SESSION['language'] = 'english';
	}
	return $_SESSION['language'];
}	
?>