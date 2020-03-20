<?php
$driver = 'mysql';
$host = 'localhost';
$dbname = 'auction';
$db_user = 'mysql';
$db_pass = 'mysql';
$charset = 'utf8';
$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

$base = "$driver:host=$host;dbname=$dbname;charset=$charset";
$pdo = new PDO ($base, $db_user, $db_pass, $option);


// CREATE TABLE `auction`.`users` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `login` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `rtime` INT(20) NOT NULL , INDEX (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

// CREATE TABLE `auction`.`lot` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `lotname` VARCHAR(1000) NOT NULL , `description` TEXT NOT NULL , `price` VARCHAR(255) NOT NULL , `ltime` VARCHAR(255) NOT NULL , `timeLeft` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;