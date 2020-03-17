<?php
session_start();

$namedb = htmlspecialchars((trim($_POST['username']));
$emaildb = htmlspecialchars(trim($_POST['email']));
$passworddb1 = htmlspecialchars(trim(password_hash(trim($_POST['password']), PASSWORD_DEFAULT)));
$passworddb2 = htmlspecialchars(trim(password_hash(trim($_POST['confirmPassword']), PASSWORD_DEFAULT)));

require_once 'connectdb.php';

if (strlen($namedb) < 3) {
	$_SESSION['users']['name'] = 'Недопустимое количество символов(меньше 3)';
	$Error = 1;
}

if (strlen($emaildb) < 3) {
	$_SESSION['users']['email'] = 'Недопустимое количество символов(меньше 3)';
	$Error = 1;
}

if (strlen(trim($_POST['password'])) < 3) {
	$_SESSION['users']['password'] = 'Недопустимое количество символов(меньше 3)';
	$Error = 1;
}

if (!(trim($_POST['password']) == trim($_POST['confirmPassword']))) {
	$_SESSION['users']['confirmPassword'] = 'Пароли не совпадают';
	$Error = 1;
}


//  if(!$pdo)
//  { 
//  	try {
//      foreach($pdo->query('SELECT * from users') as $row) 
//      {
//          print_r($row);
//      }
//  		} catch (PDOException $e)
//  		{
//      		print "Error!: " . $e->getMessage() . "<br/>";
//      		die();
//  		}
// }



// $sqlo = 'SELECT email FROM users WHERE email = :email';
// $params = [':email' => $email];
// $stmto = $pdo->prepare($sqlo);
// $stmto->execute($params);
// $rod = $stmto->fetch(PDO::FETCH_OBJ);
// print_r($rod);

$selectQuery = "SELECT email FROM `users`";
$row = $pdo->query($selectQuery)->fetchall(PDO::FETCH_ASSOC);
//var_dump($row[1]);
 foreach ($row as $a => $b) {
	if ($emaildb == $b['email']) {
		$_SESSION['users']['email'] = "Такой email уже есть";
		$Error = 1;
	}
}				

if(!($Error == 1)) {
$sql = 'INSERT INTO users(name, email, password, rtime) VALUES (:name, :email, :password, :rtime)';
$params = $pdo->prepare($sql);
$params->execute(['name' => $namedb, 'email' => $emaildb, 'password' => $passworddb1, 'rtime' => time()]);
}

if ($Error == 1){
 header('Location: /registration.php');
} else {
	header('Location: /authorization.php');
}
