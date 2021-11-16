<?php
function GetBookById($bookid){
	include("db_connection.php");
	$sql = $db->query("SELECT * FROM `books` WHERE `isbn` = '$bookid'");
	$book = mysqli_fetch_array($sql);
	return $book;
}
function GetOrderById($orderid){
	include("db_connection.php");
	$orders = $db->query("SELECT * FROM `order_items` WHERE `orderid` = '$orderid'");
	return $orders;
}
?>
