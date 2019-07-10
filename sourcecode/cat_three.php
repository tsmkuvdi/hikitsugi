<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>設備</title>
</head>
<body>
<h3>設備</h3>
<?php
require_once 'db_config.php';
require_once ('function_gather/function_category.php');

try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename where category = 3 
		AND  hizuke >= DATE_ADD(NOW(), INTERVAL -3 MONTH)
		ORDER BY hizuke";

	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>日付</th><th>内容</th><th>担当</th><th>カテゴリ</th><th>進行状況</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars($row['hizuke'],ENT_QUOTES,'UTF-8') . "</td>\n";;
		echo "<td>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";

         $tmp = categoryDisplay_function($row); //function_category.php読み込み

		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

		if ($row['shinkou'] === '1') $zap = "未了";
		if ($row['shinkou'] === '2') $zap = "済";
		echo "<td>" . htmlspecialchars($zap ,ENT_QUOTES,'UTF-8') . "</td>\n";


		echo "<td>\n";
		echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=predelete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
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
<table  width=100%>
  <tr>
    <th>
      <div align="left"><a href="list.php">一覧に戻る</a></div>
    </th>
    <th>
      <FORM>
        <div align="left">
         <INPUT TYPE="button" VALUE="再読込" onClick="window.location.reload();">
        </div>
      </FORM>
    </th>
    <th>
      <div align="left">設備 引継</div>
    </th>
  </tr>
<table>
</h3>

<!---- フッター ---->
<div id="footer"
style="width:1px; height:1px;">
</div>

<!---- JavaScript フッタを入れフッタまで強制スクロール ---->
<script type="text/javascript">
var to = document.getElementById("footer").offsetTop;
window.scrollTo( 0, to );
</script>


</body>
</html>
