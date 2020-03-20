<?php
session_start();
$price = $_POST['price'];
$id = $_POST['editing'];

require_once 'connectdb.php';

$sql = "INSERT INTO pricetable(price_id, price) VALUES (:price_id, :price)";

$sqlf = "SELECT `id`, `price` FROM `lot` WHERE `id` = $id";
$paramsf = $pdo->query($sqlf);
$rowl = $paramsf->fetch(PDO::FETCH_OBJ);



$sqlp = "SELECT * FROM `pricetable` WHERE `price_id` = $id";
$paramsp = $pdo->query($sqlp);


$total = 0;
$rowprice = $paramsp->fetch(PDO::FETCH_OBJ);

while ($rowprice = $paramsp->fetch(PDO::FETCH_OBJ)) {
	if( $rowprice->price > $total) {
		$total = $rowprice->price;
		
	}
}

if (($price > $total) && ($price > $rowl->price)){

	$params = $pdo->prepare($sql);
	$params->execute(['price_id' => $id, 'price' => $price]);

} else {
	$_SESSION['lot']['price'] = 'Нужно указать ставку, которая превышает начальную';
	$_SESSION['lot']['priceid'] = $id;
}

header('Location: /index.php');
