<?php
session_start();

$namedb = htmlspecialchars((trim($_POST['username'])));
$emaildb = htmlspecialchars(trim($_POST['email']));
$passworddb1 = htmlspecialchars(trim(password_hash(trim($_POST['password']), PASSWORD_DEFAULT)));
$passworddb2 = htmlspecialchars(trim(password_hash(trim($_POST['confirmPassword']), PASSWORD_DEFAULT)));

require_once 'connectdb.php';
require_once 'myFunction.php';

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
	

$selectQuery = "SELECT email FROM `users`";
$row = $pdo->query($selectQuery)->fetchall(PDO::FETCH_ASSOC);
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
accountEntry($pdo, $namedb, $emaildb, $passworddb1);
}

if ($Error == 1){
 header('Location: /registration.php');
} else {
	header('Location: /authorization.php');
}
