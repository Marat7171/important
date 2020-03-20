<?php
session_start();

$editing = $_POST['editing'];
$delete = $_POST['delete'];


var_dump($editing);

require_once 'connectdb.php';

$query = $pdo->query("SELECT * FROM `lot` WHERE `id` = {$editing}");
$row = $query->fetch(PDO::FETCH_OBJ);
$queryf = $pdo->query("SELECT * FROM `photo` WHERE `id_lot` = {$editing}");


echo 'Название лота: ' . $row->lotname . '<br>';
echo 'Описание лота: ' . $row->description . '<br>';
echo 'Начальная ставка: ' . $row->price . '<br>';
echo 'Время добавления лота: ' . date("Y-m-d H:i:s", $row->ltime) . '<br>';
echo 'Время, когда лот закроется: ' . date("Y-m-d H:i:s", $row->timeLeft) . '<br>';

while ($rowf = $queryf->fetch(PDO::FETCH_OBJ)){
	echo "<img src=\"" . DIRECTORY_SEPARATOR .'photo'. DIRECTORY_SEPARATOR . $rowf->tmp . "\" width=\"auto\" height=\"330\">";

}

echo '<br>'; 
?>

<form action="lotediting2.php" enctype="multipart/form-data" method="post">
			<h1>Редактирование лота:</h1>
			<div>
				<input type="text" placeholder="Название" name="lotname" id="lotname" />
				<?php echo $_SESSION['lotl']['name'];
					  unset($_SESSION['lotl']['name']); ?>
			</div>
			<div>
				<input type="text" placeholder="Начальная цена" name="price" id="price" />
				<?php echo $_SESSION['lotl']['price'];
					  unset($_SESSION['lotl']['price']); ?>
			</div>
			<div>
				<textarea type="text" placeholder="Описание"
				name="description" id="description"></textarea>
				<?php echo $_SESSION['lotl']['description'];
					  unset($_SESSION['lotl']['description']); ?>
			</div>
			<div>
				<br>
				<p>Добавить фото:</p>
				<input type="file" name="docs[]" multiple><br>
			</div>
			<div>
				<input type="submit" name="idu" value="<?php echo $editing; ?>" />
			</div>
		</form>




