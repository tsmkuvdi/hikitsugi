<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>入力フォーム</title>
</head>
<body>
引継ぎ簿新規登録入力フォーム<br>
<form method="post" action="add.php">
日付：
<input type="date" name="hizuke" >
<br>
内容：
<br>
<textarea name="naiyou" cols="40" rows="6" maxlength="250"></textarea>
<br>
担当名：
<textarea name="tantou" cols="15" rows="2" maxlength="40"></textarea>
<br>
カテゴリ：
<select name="category">
<!--
<option value="">選択してください</option>
-->
           <?php require_once ('function_gather/function_category_html.php'); ?>
           <?php category_Html_Select(); ?>
<!-- php関数呼び出し-->

</select>
<br>

進行状況：
<select name="shinkou">
<!--
<option value="">選択してください</option>
-->
           <?php require_once ('function_gather/function_shinkou_html.php'); ?>
           <?php shinkou_Html_Select(); ?>
<!-- php関数呼び出し-->

</select>

<br>
<br>
<input type="submit" value="送信">
<br>
<br>
<a href='index.php'>入力せず引継ぎ簿に戻る</a>
</form>
</body>
</html>