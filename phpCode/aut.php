<?php
session_start();

$logindb = htmlspecialchars(trim($_POST['email']));
$passworddb1 = htmlspecialchars(trim($_POST['password']));

require_once 'connectdb.php';
	
$selectQuery = "SELECT email, password, name FROM `users`";
$row = $pdo->query($selectQuery)->fetchall(PDO::FETCH_ASSOC);



$Errore = 1;
$Errorp = 1;

foreach ($row as $a => $b) {
	if ($logindb == $b['email']) {
		$Errore = 0;

		if (password_verify($passworddb1, $b['password'])) {
		$Errorp = 0;
		$_SESSION['users']['username'] = $b['name'];
		$_SESSION['lot']['useremail'] = $b['email'];
		}
	}
}

if ($Errore == 1){
	$_SESSION['users']['emaila'] = 'Наша база данных не нашла Ваш email';
}

if ($Errorp == 1){
	$_SESSION['users']['passworda'] = 'Вы ввели неверный пароль';
}

if (($Errore == 1) || ($Errorp == 1)){
 header('Location: /authorization.php');
} else {
	header('Location: /index.php');
}
