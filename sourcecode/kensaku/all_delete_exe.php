<?php

// エラーを出力する
ini_set('display_errors', "On");
require_once '../config/db_config.php';
session_start();
$pre_all_delete = $_SESSION['pre_all_delete'];


try {
	if (empty($pre_all_delete)) throw new Exception('Error');

	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM $dbtablename
                WHERE hizuke <= DATE_ADD(NOW(), INTERVAL -1 YEAR)";

	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$dbh = null;

        session_destroy();


	echo htmlspecialchars($pre_all_delete,ENT_QUOTES,'UTF-8') ."以上前のデータの削除が完了しました。<br>";
echo "<a href='../index.php'>引継ぎ簿に戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}