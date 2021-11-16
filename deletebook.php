<?php
session_start();
var_dump($_SESSION);
require_once('aot.php');
	if(isset($_GET['id']))
	{
		
	}
	else
	{
		header("Location: index.php");
	}

?>