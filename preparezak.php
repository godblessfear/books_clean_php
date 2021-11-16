<?php
session_start();
if(isset($_POST))
{
	echo $_POST['isbn'];
}
else
{
	echo 'Такой страницы не существует<br>';

}

?>
