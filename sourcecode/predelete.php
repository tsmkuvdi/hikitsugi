<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once './config/db_config.php';
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id_hikitsugi = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename WHERE id_hikitsugi = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id_hikitsugi, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbh = null;
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>削除確認</title>
</head>
<body>
<h1>削除確認</h1>
<br>
<form method="post" action="delete.php">
<br>
<table width=80% border=1 cellspacing=1>
 <tr><th>日付</th><th>内容</th><th>担当</th></tr>
 <tr>
  <td width=13%><?php echo htmlspecialchars($result['hizuke'], ENT_QUOTES, 'UTF-8'); ?></td>
  <td><?php echo nl2br(htmlspecialchars($result['naiyou'], ENT_QUOTES, 'UTF-8')); ?></td>
  <td width=13%><?php echo htmlspecialchars($result['tantou'], ENT_QUOTES, 'UTF-8'); ?></td>
</table>
<br>
<input type="hidden" name="id_hikitsugi" value="<?php echo htmlspecialchars($result['id_hikitsugi'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="submit" value="削除する">
<br>
<br>
<a href='index.php'>削除せず引継ぎ簿に戻る</a>
</form>
</body>
</html>