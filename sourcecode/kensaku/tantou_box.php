<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="refresh" content="180" >
<meta charset="UTF-8">
<title>過去3ヶ月・1年担当検索</title>
</head>
<body>


<?php
// エラーを出力する
ini_set('display_errors', "On");

require_once ( __DIR__ .'/../db_config.php');
require_once '../function_gather/function_category.php';


        $monthid = $_POST['monthid'];
        $donefinished = $_POST['donefinished'];

try {
	if (empty($_POST['tantouid'])) throw new Exception('Error');
	$aimaiken = '%'.$_POST['tantouid'].'%';
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM $dbtablename where tantou like '$aimaiken'
                AND shinkou = $donefinished 
		AND  hizuke >= DATE_ADD(NOW(), INTERVAL -$monthid MONTH)
		ORDER BY hizuke
                ";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

              $hyouji = ''; 
            if ($monthid == 12) {          //=でなく、==
                 $hyouji = "過去1年";
            } elseif ($monthid == 3) {
                 $hyouji = "過去３ヶ月";
            }

	$tantou = $_POST['tantouid'];
        echo "<h3>{$hyouji} {$tantou}担当 検索結果</h3> \n";
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>日付</th><th>内容</th><th>担当</th><th>カテゴリ</th><th>進行状況</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars($row['hizuke'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";

         $tmp = categoryDisplay_function($row); //関数呼び出し
		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

		if ($row['shinkou'] === '1') $zap = "未了";
		if ($row['shinkou'] === '2') $zap = "済";
		echo "<td>" . htmlspecialchars($zap ,ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "|<a href=../edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=../predelete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";

		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

        echo "<h3>{$hyouji} {$tantou}担当 検索結果</h3> \n";
?>


<h3>
<div align="left"><a href="../list.php">引継一覧に戻る</a></div>
</h3>

</body>
</html>
