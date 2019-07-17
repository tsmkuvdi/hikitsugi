<?php
// エラーを出力する
ini_set('display_errors', "On");
session_start();
$_SESSION['pre_all_delete'] = $_POST['pre_all_delete'];

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

<h1>
<?php

echo htmlspecialchars($_POST['pre_all_delete'],ENT_QUOTES,'UTF-8').'年以上前のデータをすべて削除します。';

?>
</h1>

    <form action = "./all_delete_exe.php" method="post">
         <input type="submit" name="exec" value="削除する">
    </form>
<br><br><br>
<h2>
<a href='../kako_kensaku.php'>削除せず前のページに戻る</a>
</h2>
</body>
</html>