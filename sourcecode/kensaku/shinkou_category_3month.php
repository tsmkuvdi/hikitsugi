<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カテゴリ別過去3ヶ月</title>
</head>
<body>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once '../config/db_config.php';

try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$category = (int) $_GET['id'];
        $shinkou = (int) $_GET['shinkou'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename
                WHERE category = $category
                AND shinkou = $shinkou
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
		echo "<td width=13%>" . htmlspecialchars($row['hizuke'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td width=50%>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";

          require_once ('../function_gather/function_category.php');
         $tmp = '';
         $tmp = categoryDisplay_function($row); //function_category.php読み込み


		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

          require_once ('../function_gather/function_shinkou.php');
         $tmpshinkou = '';
         $tmpshinkou = shinkouDisplay_function($row); //function_shinkou.php読み込み
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
?>


<h3>
<table  width=100%>
  <tr>
    <td>
      <a href="../kako_kensaku.php">前のページに戻る</a>
      <a href="../index.php">一覧に戻る</a>
    </td>
    <td>
      <FORM>
       <div align="left">
       <INPUT TYPE="button" VALUE="再読込" onClick="window.location.reload();">
       </div>
      </FORM>
    </td>
    <td>
           <?php
            if (empty($tmp)) {
                 echo 'データがありません。';
                 exit();
            }
           ?>
   </td>
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
