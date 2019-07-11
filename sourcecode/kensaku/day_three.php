<!DOCTYPE html>
<head>
<meta http-equiv="refresh" content="180" >
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="day.css">
<title>3日間の引継事項</title>
</head>
<body>

<?php
// エラーを出力する
ini_set('display_errors', "On");

$weekday = array('日','月','火','水','木','金','土');

$datetime = new DateTime("Asia/Tokyo");

/* 現在の年、月を取得 */
$year = $datetime->format('Y');
$month = $datetime->format('n');
$day = $datetime->format('j');
$week = $datetime->format('w');

?>

<h1><?=$year.'年'.$month.'月'.$day.'日&nbsp;'.$weekday[$week].'曜日'.'&nbsp;&nbsp;&nbsp;&nbsp;3日間の引継事項'?></h1>

<form>
  <div align="right">
    <input type="button" value="印刷" onclick="window.print();" /> </div>
</form>


<?php
require_once '../config/db_config.php';
require_once '../function_gather/function_category.php';
try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM $dbtablename 
		WHERE  hizuke >= DATE_ADD(NOW(), INTERVAL -3 DAY)
		ORDER BY category";


	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>内容</th><th>担当</th><th>カテゴリ</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";

		echo "<td width=80%>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";


         $tmp = categoryDisplay_function($row);
		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

		if ($row['shinkou'] === '1') $zap = "未了";
		if ($row['shinkou'] === '2') $zap = "済";
		echo "<td>" . htmlspecialchars($zap ,ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

?>
<a href="../kako_kensaku.php">前のページに戻る</a>&nbsp;&nbsp;
<a href="../index.php">一覧に戻る</a>

</body>
</html>
