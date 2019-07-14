<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="refresh" content="180" >
<meta charset="UTF-8">
<title>引継ぎ簿</title>
</head>
<body>
<h3>引継ぎ簿　過去3ヶ月表示</h3>
<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ('config/db_config.php');

try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename 
		WHERE  hizuke >= DATE_ADD(NOW(), INTERVAL -3 MONTH)
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
         require_once ('function_gather/function_category.php');
         $tmp = categoryDisplay_function($row);
  //呼び出し元からは関数内で必要な引数を渡してやる必要がある($row)
  //処理結果を共有するには戻り値で受け取ってやる必要がある($tmp)


		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

		if ($row['shinkou'] === '1') $zap = "未了";
		if ($row['shinkou'] === '2') $zap = "済";
		echo "<td>" . htmlspecialchars($zap ,ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=edit.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "<a href=predelete.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "<a href=print.php?id=" . htmlspecialchars($row['id_hikitsugi'],ENT_QUOTES,'UTF-8') . ">印刷</a>\n";
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
    <td>
     <div align="left"><a href="form.php">引継簿新規登録</a></div>
    </td>
    <td>
       <form action = "category_select_3month.php" method="post">
           <?php require_once ('function_gather/function_category_linkhtml.php'); ?>
           <?php category_Html_link(); ?>
    </td>
  </tr>
</table>

<table>
  <tr>
    <td>
      <form action = "box_kensaku.php" method="post">
        <input type="text" name="kenid">
        <input type="submit" name="exec" value="内容検索">
      </form>
    </td>
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td>
      <a href="kako_kensaku.php">３ヶ月以上前の引継</a>
    </td>
  </tr>
</table>
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
