<?php
	session_start();
	require_once('aot.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Сайт с книгами</title>
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
		<br>
			<?php
				if(isset($_GET['cat']))
				{
					$catid = $_GET['cat'];
					$query = $db->query("SELECT * FROM `books` WHERE `catid` = '$catid'");
					while ($book = mysqli_fetch_array($query)) {
						echo "<div class='book'>";
						echo "<div class='border-book'>";
						echo "<a href='#'><img src='images/0104.jpg'></a>";
						echo "<h3><a href='#'>{$book['title']}</a></h3>";
						echo "<h5>{$book['author']}</h5>";
						echo "<p>{$book['price']} <i class='fas fa-ruble-sign'></i></p>";
						#echo "<button><i class='fas fa-shopping-cart'></i>Купить</button><br><br></div></div>";
						#echo "<form method='POST' action='preparezak.php'><input type='hidden' value='{$book['isbn']}'><input type='submit' value='Купить'></form><br><br></div></div>";

					}
				}
				else
				{
					$query = $db->query("SELECT * FROM `books`");
					while ($book = mysqli_fetch_array($query)) {
						echo "<div class='book'>";
						echo "<div class='border-book'>";
						echo "<a href='#'><img src='images/0104.jpg'></a>";
						echo "<h3><a href='#'>{$book['title']}</a></h3>";
						echo "<h5>{$book['author']}</h5>";
						echo "<p>{$book['price']} <i class='fas fa-ruble-sign'></i></p>";
						#echo "<button><i class='fas fa-shopping-cart'></i>Купить</button><br><br></div></div>";
						#echo "<form method='POST' action='preparezak.php'><input type='hidden' value='{$book['isbn']}' name='isbn'><input type='submit' value='Купить'></form><br><br></div></div>";
						echo "<a href='addcart.php?id={$book['isbn']}'>Добавить в корзину</a><br><br></div></div>";

					}
				}
				
			
			?>
			<a href="addcart.php?id={$book['isbn']}"></a>
			<div class="clearfix"></div>
			<form method="post" action="preparezak.php"></form>
		</div>		
	</div>
</div>
<div class="footer">
	<div class="container">
		
	</div>
</div>
</body>
</html>