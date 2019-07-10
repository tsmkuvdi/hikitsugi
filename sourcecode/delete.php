<?php
require_once './config/db_config.php';
try {
	if (empty($_POST['id_hikitsugi'])) throw new Exception('Error');

/*ここではpostで受け取る。トップページからurlの末尾にid番号指定の
場合はgetだが、一度predeleteでgetで受け取った後にこのページに来るため。*/

	$id_hikitsugi = (int) $_POST['id_hikitsugi'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM $dbtablename WHERE id_hikitsugi = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id_hikitsugi, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id_hikitsugi,ENT_QUOTES,'UTF-8') ."の削除が完了しました。<br>";
echo "<a href='index.php'>引継ぎ簿に戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}