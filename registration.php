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
		<form action="/phpCode/reg.php" method="post">
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" name="username" id="username" />
			</div>
			<?php echo $_SESSION['users']['name'];
				  unset($_SESSION['users']['name']); 	
			 ?>
			<div>
				<input type="text" placeholder="Email" name="email" id="email" />
			</div>
			<?php echo $_SESSION['users']['email'];
				  unset($_SESSION['users']['email']); 	
			 ?>
			<div>
				<input type="password" placeholder="Password" name="password" id="password" />
			</div>
			<?php echo $_SESSION['users']['password'];
				  unset($_SESSION['users']['password']); 	
			 ?>
			<div>
				<input type="password" placeholder="Confirm password" name="confirmPassword" id="confirmPassword" />
			</div>
			<?php echo $_SESSION['users']['confirmPassword'];
				  unset($_SESSION['users']['confirmPassword']); 	
			 ?>
			<div>
				<input type="submit" value="Log in" />
				<a href="#">Lost your password?</a>
				<a href="#">Register</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
  
  
</body>
</html>
