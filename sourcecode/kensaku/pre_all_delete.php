<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ('../config/db_config.php');
session_start();
$_SESSION['pre_all_delete'] = $_POST['pre_all_delete'];
$pre_all_delete = $_POST['pre_all_delete'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="day.css">
<title>削除確認</title>
</head>
<body>
<h2>削除確認</h2>
<br>


<?php
try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename 
		WHERE hizuke <= DATE_ADD(NOW(), INTERVAL -$pre_all_delete YEAR)
	       ";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$dbh = null;
        if (empty($result)) {
             echo htmlspecialchars($_POST['pre_all_delete'],ENT_QUOTES,'UTF-8')."年以上前のデータはありません。<br><a href='../kako_kensaku.php'>前のページに戻る</a>";
             exit();
        } else {
             echo '<h1>';
             echo htmlspecialchars($_POST['pre_all_delete'],ENT_QUOTES,'UTF-8').'年以上前のデータをすべて削除します。';
             echo '</h1>';
             echo '下記の空欄に「sakujyo」と入力しクリックしてください。';
             echo '<form action = "./all_delete_exe.php" method="post">';
             echo '<textarea name="sakujyo" cols="7" rows="1" maxlength="7"></textarea>';
             echo '<input type="submit" name="exec" value="削除する">';
             echo '</form>';
        }

} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>


<br><br><br>
<h2>
<a href='../kako_kensaku.php'>削除せず前のページに戻る</a>
</h2>
</body>
</html>