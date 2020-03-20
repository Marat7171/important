<?php

function accountEntry($pdo0, $namedb0, $emaildb0, $passworddb10) {
	$sql = 'INSERT INTO users(name, email, password, rtime) VALUES (:name, :email, :password, :rtime)';
	$params = $pdo0->prepare($sql);
	$params->execute(['name' => $namedb0, 'email' => $emaildb0, 'password' => $passworddb10, 'rtime' => time()]);
}

