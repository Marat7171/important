<?php session_start(); ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form on HTML5</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Paper Stack</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="/phpCode/add.php" enctype="multipart/form-data" method="post">
			<h1>Добавить лот</h1>
			<div>
				<input type="text" placeholder="Название" name="lotname" id="lotname" />
				<?php if (isset($_SESSION['lotl']['name'])) {
						echo $_SESSION['lotl']['name'];
					  	unset($_SESSION['lotl']['name']); } ?>
			</div>
			<div>
				<input type="text" placeholder="Начальная цена" name="price" id="price" />
				<?php if (isset($_SESSION['lotl']['price'])) {
						echo $_SESSION['lotl']['price'];
						unset($_SESSION['lotl']['price']); } ?>
			</div>
			<div>
				<textarea type="text" placeholder="Описание"
				name="description" id="description"></textarea>
				<?php if (isset($_SESSION['lotl']['description'])) { 
					  	echo $_SESSION['lotl']['description'];
					  	unset($_SESSION['lotl']['description']); } ?>
			</div>
			<div>
				<br>
				<p>Добавить фото:</p>
				<input type="file" name="docs[]" multiple><br>
			</div>
			<div>
				<input type="submit" value="Добавить" />
				<a href="index.php">Перейти на главную страницу</a>
				<a href="/myAuctions.php">Посмотреть мои лоты</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
  
  
</body>
</html>
