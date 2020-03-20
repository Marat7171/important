<?php
$servername = "localhost";
$username = "mysql";
$password = "mysql";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE auction";
    $conn->exec($sql);
    // echo "Database created successfully<br>";
}
catch(PDOException $e)
{
    // echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

require_once 'phpCode/connectdb.php';

$pdo->query('CREATE TABLE `auction`.`users` ( `id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `rtime` INT(20) NOT NULL , INDEX (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci');

$pdo->query('CREATE TABLE `auction`.`lot` ( `id` INT(20) NOT NULL AUTO_INCREMENT , `lotname` VARCHAR(1000) NOT NULL , `useremail` VARCHAR(1000) NOT NULL , `description` TEXT NOT NULL , `price` VARCHAR(255) NOT NULL , `ltime` VARCHAR(255) NOT NULL , `timeLeft` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci');

$pdo->query('CREATE TABLE `auction`.`photo` ( `id` INT NOT NULL AUTO_INCREMENT , `id_lot` INT NOT NULL , `tmp` VARCHAR(255) NOT NULL , `ptime` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;');

$pdo->query('CREATE TABLE `auction`.`pricetable` ( `id` INT(20) NOT NULL AUTO_INCREMENT , `price_id` INT(20) NOT NULL , `price` INT(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;');


$pdo->query('ALTER TABLE `photo` ADD INDEX( `id_lot`)');


$pdo->query('ALTER TABLE `lot` ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`id`) REFERENCES `photo`(`id_lot`) ON DELETE RESTRICT ON UPDATE CASCADE;');
