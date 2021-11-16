<?php
session_start();
include('aot.php');

$query = $db->query("SELECT MAX(`isbn`) FROM `books`");
$maxid = mysqli_fetch_array($query);
$maxid = (int)$maxid['0'];

if(isset($_GET['id']))
{
	$bookid = $_GET['id'];

	$bookidnum = (int)$bookid;

	if ($bookidnum <= $maxid) {
		$book = GetBookById($bookid);
		$bookid = $book['isbn'];
		$bookprice = $book['price'];
		
		if($_SESSION['orderid'])
		{
			$orderid = $_SESSION['orderid'];
		}
		else
		{
			$query = $db->query("SELECT MAX(`orderid`) FROM `order_items`");
			$orderid = mysqli_fetch_array($query);
			$orderid = $orderid['0'];
			$orderid = $orderid + 1;
		}
		$sql = $db->query("INSERT INTO `order_items` (`orderid`, `isbn`, `item_price`, `quantity`) VALUES ('$orderid', '$bookid', '$bookprice', '1');");
		if($sql)
		{
			header("Location: corzina.php");
			$_SESSION['orderid'] = $orderid;
		}

		
	}
	else
	{
		echo "Такой айди книги не существует";
	}
}
else
{
	echo "Нет параметра";
}



?>