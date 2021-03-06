<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once 'config/db_config.php';
require_once ('function_gather/function_select_category.php');


try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id_hikitsugi = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename WHERE id_hikitsugi = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id_hikitsugi, PDO::PARAM_INT);
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
<link rel="stylesheet" type="text/css" href="option_select.css">

<title>引継ぎ変更入力フォーム</title>
</head>
<body>
引継ぎ内容変更<br>
<form method="post" action="update.php">
<br>
日付:
<input type="date" name="hizuke" value="<?php echo htmlspecialchars($result['hizuke'], ENT_QUOTES, 'UTF-8'); ?>">
<br>
内容：
<textarea name="naiyou" cols="40" rows="4"><?php echo htmlspecialchars($result['naiyou'], ENT_QUOTES, 'UTF-8'); ?></textarea>
<br>
担当：<input type="text" name="tantou" value="<?php echo htmlspecialchars($result['tantou'], ENT_QUOTES, 'UTF-8'); ?>"><br>
<br>
カテゴリ：
<select name="category">
     <?php category_select($result);  ?>  <!-- function_select_category.php呼び出し-->
　　　　<!-- 元の記述-->
</select>
      <!-- 上記元の記述内容
        <option value="1" <?php if($result['category'] === 1) echo "selected" ?>>カテゴリ１</option>
        <option value="2" <?php if($result['category'] === 2) echo "selected" ?>>カテゴリ２</option>
        <option value="3" <?php if($result['category'] === 3) echo "selected" ?>>カテゴリ３</option>
       <option value="4" <?php if($result['category'] === 4) echo "selected" ?>>カテゴリ４</option>
      -->



<br>
進行状況：
<label>
 <input type="radio" name="shinkou" value="1" <?php if($result['shinkou'] === 1) echo "checked" ?>>未了
</label>
<label>
 <input type="radio" name="shinkou" value="2" <?php if($result['shinkou'] === 2) echo "checked" ?>>済
</label>
<br>
<input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id_hikitsugi'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="submit" value="送信">
<br>
<br>
<a href='index.php'>変更せず引継ぎ簿に戻る</a>
</form>
</body>
</html>