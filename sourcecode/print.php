<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once 'config/db_config.php';


try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename WHERE id_hikitsugi = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
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
<title>引継内容印刷</title>
</head>
<body>
   <form>
    <div align="right"><input type="button" value="このページを印刷する" onclick="window.print();" /></div>
   </form>
<br>
<table width=100% border=1 cellspacing=1>
 <tr><th>日付</th><th>内容</th><th>担当</th></tr>
 <tr>
  <td width=13%><?php echo htmlspecialchars($result['hizuke'], ENT_QUOTES, 'UTF-8'); ?></td>
  <td><?php echo nl2br(htmlspecialchars($result['naiyou'], ENT_QUOTES, 'UTF-8')); ?></td>
  <td width=13%><?php echo htmlspecialchars($result['tantou'], ENT_QUOTES, 'UTF-8'); ?></td>
</table>
<br>
<br>
<a href='index.php'>引継ぎ簿に戻る</a>

</body>
</html>