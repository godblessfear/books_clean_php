<?php
session_start();
?>

<?php
	session_start();
	require_once('aot.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Корзина</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="https://kit.fontawesome.com/7cfa51a297.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<?php #echo "<pre>"; var_dump($_SERVER); echo "</pre>"; ?>
<div class="header">
	<div class="container">
		<nav class="two">
		  <ul>
		    <li><a href="index.php"><i class="fa fa-home fa-fw"></i>Главная страница</a></li>
		    <li><a href="#"><i class="fas fa-list-ul"></i>Категории</a>
		    	<ul class="submenu">
		    		<?php
		    		$query = $db->query("SELECT * FROM `categories`");
		    		while ($cat = mysqli_fetch_array($query)) {
		    			echo "<li><a href='?cat={$cat['0']}''>{$cat['1']}</a></li>";
		    		}
		    		?>
		    		<li><a href="#">По авторам</a>
		    			<ul class="submenu" style="left: 100%; top: 0%;">
		    				<?php
				    		$query = $db->query("SELECT DISTINCT `author` FROM `books`");
				    		while ($cat = mysqli_fetch_array($query)) {
				    			echo "<li><a href='?cat={$cat['0']}''>{$cat['0']}</a></li>";
				    		}
				    		?>
			    		</ul>
		    		</li>

		    	</ul>
		    </li>
		    	
		    <li><a href="corzina.php"><i class="fas fa-shopping-basket"></i>Корзина</a></li>
		    <li><a href="#"><i class="fas fa-award"></i>Отзывы</a></li>
		    <li><a href="#"><i class="fas fa-map"></i>Контакты</a></li>
		  </ul>
		</nav>
		<div class="d7">
		<form>
		  <input type="text" placeholder="Искать здесь...">
		  <button type="submit" href='#'></button>
		</form>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="main">
	<div class="container">
		<div class="bordermain">
			<?php #echo "<pre>";echo var_dump($_SESSION);  echo"</pre>"; ?>
			<?php
				// $orders = GetOrderById($_SESSION['orderid']);
				// while ($order = mysqli_fetch_array($orders)) {
				// 	echo "<pre>";
				// 	var_dump($order);
				// 	echo "</pre>";
				// 	echo "<h1>-</h1>";
				// }
			?>
			<h1>Корзина</h1>
			<div class="corzinamain">
				<div class="containercorzinaleft">
			<?php
			if(isset($_SESSION['orderid']))
			{
				$sum = 0;
				$orders = GetOrderById($_SESSION['orderid']);
				while ($order = mysqli_fetch_array($orders)) {
					$book = GetBookById($order['isbn']);

					$sum += $order['item_price'];
print<<<HERE
					<div class="containercorzina">
						<div class="containercorzinamar">
							<div class="containercorzinamarleft">
								<img src='images/0104.jpg'>
								<h3>{$book['title']}</h3>
								<h6>{$book['author']}<h6>
								<br>
								<br>
								<a href="deletebook.php?id={$order['isbn']}"><h3>Удалить</h3></a>
								</div>
							<div class="containercorzinamarright">
								<input type="number" id="number" value="{$order['quantity']}">
								<h3>{$order['item_price']} ₽</h3>
							</div>						
							<div class="clearfix"></div>
						</div>
					</div>
							
HERE;
				}
echo "</div>";
echo "<div class='containercorzinasum'>";
					$num = $_SESSION['orderid'];
					$quantity = $db->query("SELECT COUNT(*) FROM `order_items` WHERE `orderid` = '$num'");
					$quantity = mysqli_fetch_array($quantity);
					echo "<h3>Всего товаров: {$quantity['0']}</h3>";
					echo "<h3>На сумму: {$sum} ₽</h3>";
echo "<a href='oplata.php'>Оплатить</a>";
echo "</div>";
echo "<div class='clearfix'></div>";


			}
			else
			{
				echo "<div class='corzinamain'>";
				echo "<h2>Вы ничего не добавили!</h2>";
				echo "</div>";
					
			}
				
			?>
			
			
		
		</div>	
		</div>
	</div>
	</div>
	</div>
<div class="footer">
	<div class="container">
		
	</div>
</div>
</body>
</html>