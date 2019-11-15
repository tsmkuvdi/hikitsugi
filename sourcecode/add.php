<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once './config/db_config.php';
require_once './config/config_post.php';

if  (empty ($_POST['hizuke'])) {
    echo '日付が空白です。<br>';
    echo "<a href='form.php'>入力フォームに戻る</a>";
 } elseif (empty($_POST['naiyou'])) {
    echo '内容が空白です。<br>';
    echo "<a href='form.php'>入力フォームに戻る</a>";
 } elseif (empty($_POST['tantou'])) {
    echo '担当名が空白です。<br>';
    echo "<a href='form.php'>入力フォームに戻る</a>";
 } else {

try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO $dbtablename (hizuke, naiyou, tantou, category, shinkou) VALUES (?, ?, ?, ?,?)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $hizuke, PDO::PARAM_STR);
	$stmt->bindValue(2, $naiyou, PDO::PARAM_STR);
	$stmt->bindValue(3, $tantou, PDO::PARAM_STR);
	$stmt->bindValue(4, $category, PDO::PARAM_INT);
	$stmt->bindValue(5, $shinkou, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "引継事項の登録が完了しました。<br>";
echo "<a href='index.php'>引継ぎ簿に戻る</a>";
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
}