<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>検索結果</title>
</head>
<body>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once '../config/db_config.php';

try {

	if (empty($_POST['min_hizuke'])) {
             echo 'はじまりの日付が入力されていません。';
             exit();
        }
	if (empty($_POST['max_hizuke']))  {
             echo '終わりの日付が入力されていません。';
             exit();
        }
        $min_hizuke = $_POST['min_hizuke'];
        $max_hizuke = $_POST['max_hizuke'];
	$shinkou = $_POST['shinkou'];
        $kategori = $_POST['kategori'];

        echo "<h3>{$min_hizuke}～{$max_hizuke} 検索結果</h3>";

	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	$sql = "SELECT * FROM $dbtablename
                WHERE category = $kategori
                  AND shinkou = $shinkou
		  AND hizuke BETWEEN '$min_hizuke' AND '$max_hizuke'
		ORDER BY hizuke";



	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>日付</th><th>内容</th><th>担当</th><th>カテゴリ</th><th>進行状況</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars($row['hizuke'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td width=50%>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";
         require_once '../function_gather/function_category.php'; //関数呼び出し
         $tmp = categoryDisplay_function($row); 
		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

         require_once '../function_gather/function_shinkou.php'; //関数呼び出し
         $tmpshinkou = shinkouDisplay_function($row); 
		echo "<td>" . htmlspecialchars($tmpshinkou ,ENT_QUOTES,'UTF-8') . "</td>\n";



		echo "<td>\n";
		echo "|<a href=../edit.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=../predelete.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";


		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

      echo "<h3>{$min_hizuke}～{$max_hizuke} 検索結果</h3>";

?>

<h3>
<a href="../kako_kensaku.php">前のページに戻る</a>&nbsp;&nbsp;
<a href="../index.php">一覧に戻る</a>
</h3>
</body>
</html>
