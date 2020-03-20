<?php
session_start();

$lotname = $_POST['lotname'];
$photo = $_FILES['docs'];
$price = $_POST['price'];
$description = $_POST['description'];
 // var_dump($photo);
require_once 'connectdb.php';
$time = time();
 $timecompletion = 1728000; // 20 дней
 $Error = 0;

 if (strlen($lotname) < 3) {
 	$_SESSION['lotl']['name'] = 'Напишите название лота (больше 2х символов)';
 	$Error = 1;
 }

 if (is_numeric($price) == false) {
 	$_SESSION['lotl']['price'] = 'Начальная цена должна быть в цифрах(рубли), без указания валюты';
 	$Error = 1;
 }
 
 if (strlen($price) < 3) {
 	$_SESSION['lotl']['description'] = 'Напишите описание лота(больше 2х символов)';
 	$Error = 1;
 }

 if ($Error == 0) {

 	$sqlf = 'INSERT INTO photo(id_lot, tmp, ptime) VALUES (:id_lot, :tmp, :ptime)';
 	$paramsf = $pdo->prepare($sqlf);
 	$tmpinitially = 'noLot.jpg';

 	if (!empty($photo['name']['0'])) {
 		foreach ($photo['tmp_name'] as $a => $tmpPath) {
 			if (!array_key_exists($a, $photo['name'])) {
 				continue;
 			}

 			move_uploaded_file($tmpPath, realpath(__DIR__ . '/..') .DIRECTORY_SEPARATOR.'photo'.DIRECTORY_SEPARATOR.$photo['name'][$a]);
 			$paramsf->execute(['id_lot' => $time, 'tmp' => $photo['name'][$a], 'ptime' => $time]);

 		}
 	} else {
 		$paramsf->execute(['id_lot' => $time, 'tmp' => $tmpinitially, 'ptime' => $time]);
 	}


 	$sql = 'INSERT INTO lot(id, lotname, useremail, description, price, ltime, timeLeft) VALUES (:id, :lotname, :useremail, :description, :price, :ltime, :timeLeft)';
 	$params = $pdo->prepare($sql);
 	$params->execute(['id' => $time, 'lotname' => $lotname, 'useremail' => $_SESSION['lot']['useremail'], 'description' => $description, 'price' => $price, 'ltime' => $time, 'timeLeft' => $time+$timecompletion]);
 }

 header('Location: /lotAdding.php');
