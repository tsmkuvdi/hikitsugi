<?php
require_once 'config/db_config.php';
require_once 'config/config_post.php';

try {
	if (empty($_POST['id'])) throw new Exception('Error');
	$id = (int) $_POST['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE $dbtablename SET hizuke = ?, naiyou = ?, tantou = ?,category = ?, shinkou = ? WHERE id = ?";  //主キーは最後にWHERE
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $hizuke, PDO::PARAM_INT);
	$stmt->bindValue(2, $naiyou, PDO::PARAM_STR);
	$stmt->bindValue(3, $tantou, PDO::PARAM_STR);
	$stmt->bindValue(4, $category, PDO::PARAM_INT);
	$stmt->bindValue(5, $shinkou, PDO::PARAM_INT);
	$stmt->bindValue(6, $id, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."引継内容の更新が完了しました。<br>";
echo "<br>";
echo "<a href='list.php'>引継ぎ簿に戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}