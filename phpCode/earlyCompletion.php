<?php

$editing = $_POST['editing'];

$timeLeft = 0;

require_once 'connectdb.php';

$sth = $pdo->prepare('UPDATE `lot` SET `timeLeft`=:timeLeft WHERE `id`=:id LIMIT 1');
$data = array('id' => $editing, 'timeLeft' => $timeLeft);
$sth->execute($data);

header('Location: /index.php');