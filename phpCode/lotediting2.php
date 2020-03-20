<?php
session_start();

$id = $_POST['idu'];
$lotname = $_POST['lotname'];
$photo = $_FILES['docs'];
$price = $_POST['price'];
$description = $_POST['description'];
 // var_dump($photo);
require_once 'connectdb.php';
$time = time();
 $timecompletion = 1728000; // 20 дней

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

 	$sqldeletel = "DELETE FROM `lot` WHERE `lot`.`id` = {$id} ";
 	$sqldeletef = "DELETE FROM `photo` WHERE `photo`.`id_lot` = {$id} ";
 	$sqldeletep = "DELETE FROM `pricetable` WHERE `pricetable`.`price_id` = {$id} ";

 	$paramdeletel = $pdo->prepare($sqldeletel);
 	$paramdeletef = $pdo->prepare($sqldeletef);
 	$paramdeletep = $pdo->prepare($sqldeletep);

 	$paramdeletel->execute();
 	$paramdeletef->execute();
 	$paramdeletep->execute();




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



// $update_columns = array();
//     if(trim($book_title) !== "")   { $update_columns[] = "title = :title"; }
//     if(trim($book_author) !== "")  { $update_columns[] = "author = :author"; }
//     if(trim($book_price) !== "")   { $update_columns[] = "price = :price"; }
//     if(trim($book_discount) !== ""){ $update_columns[] = "discount = :discount"; }
//     if(trim($book_amount) !== "")  { $update_columns[] = "amount = :amount"; }
    
//     // Если есть хоть одно заполненное поле формы,
//     // то составляем запрос.    
//     if(sizeof($update_columns > 0)){
//         // Запрос на создание записи в таблице
//         $sql = "UPDATE books SET " . implode(", ", $update_columns) . " WHERE id=:id";
//         // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
//         // echo $sql;
//         // Например, если в форме заполнены поля: название, автор книги и номер Id=1,
//         // то запрос должен выглядеть следующим образом:
//         // "UPDATE books SET title = :title, author = :author WHERE id=:id"
        
//         // Подготовка запроса.
//         $statement = $db->prepare($sql);
 
//         // Привязываем к псевдо переменным реальные данные,
//         // если они существуют (пользователь заполнил поле в форме).        
//         $statement->bindParam(":id", $book_id);
//         if(trim($book_title) !== ""){
//             $statement->bindParam(":title", $book_title);
//         }
//         if(trim($book_author) !== ""){
//             $statement->bindParam(":author", $book_author);
//         }
//         if(trim($book_price) !== ""){
//             $statement->bindParam(":price", $book_price);
//         }
//         if(trim($book_discount) !== ""){
//             $statement->bindParam(":discount", $book_discount);
//         }
//         if(trim($book_amount) !== ""){
//             $statement->bindParam(":amount", $book_amount);
//         }
        
//         // Выполняем запрос.
//         $statement->execute();
    
//         echo "Запись c ID: " . $book_id . " успешно обновлена!";
//     }
// }
 
// catch(PDOException $e) {
//     echo "Ошибка при обновлении записи в базе данных: " . $e->getMessage();
// }
 
// // Закрываем соединение.
// $db = null;

header('Location: /myAuctions.php');
 ?>