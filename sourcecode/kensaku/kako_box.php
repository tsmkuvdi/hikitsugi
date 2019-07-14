<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="refresh" content="180" >
<meta charset="UTF-8">
<title>過去１年引継内容検索</title>
</head>
<body>
<h3>過去１年引継内容検索結果</h3>
<?php
require_once '../config/db_config.php';


try {
	if (empty($_POST['kenid'])) throw new Exception('Error');
	$aimaiken = '%'.$_POST['kenid'].'%';
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM $dbtablename where naiyou like '$aimaiken' 
		AND  hizuke >= DATE_ADD(NOW(), INTERVAL -1 YEAR)
		ORDER BY hizuke";


	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>日付</th><th>内容</th><th>担当</th><th>カテゴリ</th><th>進行状況</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td width=13%>" . htmlspecialchars($row['hizuke'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td width=50%>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";

         require_once '../function_gather/function_category.php';
         $tmp = categoryDisplay_function($row); //関数呼び出し
		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

          require_once ('../function_gather/function_shinkou.php');
         $tmpshinkou = '';
         $tmpshinkou = shinkouDisplay_function($row); //function_shinkou.php読み込み
		echo "<td>" . htmlspecialchars($tmpshinkou ,ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=../edit.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "<a href=../predelete.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "<a href=../print.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">印刷</a>\n";
		echo "</td>\n";

		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>
<h3>
<a href="../kako_kensaku.php">前のページに戻る</a>&nbsp;&nbsp;
<a href="../index.php">一覧に戻る</a>
</h3>

</body>
</html>
