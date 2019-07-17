<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>引継簿3ヶ月以前その他検索</title>
</head>
<body>
<h1>引継簿3ヶ月以前その他検索</h1>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once './config/db_config.php';

try {
	$dbh = new PDO("mysql:host=localhost;
                        dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT MAX(hizuke) AS maxhizuke, MIN(hizuke) AS minhizuke
                FROM $dbtablename";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

echo '引継ぎ簿入力期間&nbsp;&nbsp;&nbsp;&nbsp;'.htmlspecialchars($result['minhizuke'],ENT_QUOTES,'UTF-8').' ～ '.htmlspecialchars($result['maxhizuke'],ENT_QUOTES,'UTF-8');

?>

<table border="1" width="100%">
  <tr>
    <td COLSPAN="2">
       <form action = "kensaku/kako_shinkou.php" method="post">
　　    <input type="date" name="min_hizuke" >から
        <input type="date" name="max_hizuke" >まで
        <select name="kategori" size="4">
           <?php require_once ('function_gather/function_category_html.php'); ?>
           <?php category_Html_Select(); ?>
        </select>

        <select name="shinkou" size="2">
           <?php require_once ('function_gather/function_shinkou_html.php'); ?>
           <?php shinkou_Html_Select(); ?>
        </select>
         <input type="submit" name="exec" value="検索">
       </form>
     </td>
  </tr>
  <tr>
    <td>過去３ヶ月「未了」<br>
           <?php require_once ('function_gather/function_shinkou_linkhtml.php'); ?>
           <?php shinkou_Html_link(); ?>
     </td>
     <td>

     </td>
  </tr>
  <tr>
    <td>
       過去1年「内容」自由検索<br>
      <form action = "kensaku/kako_box.php" method="post">
       <input type="text" name="kenid">
       <input type="submit" name="exec" value="検索">
       </form>
     </td>
     <td>
       <?php
         // エラーを出力する
         ini_set('display_errors', "On");
         $weekday = array('日','月','火','水','木','金','土');
         $datetime = new DateTime("Asia/Tokyo");

         /* 現在の年、月を取得 */
         $year = $datetime->format('Y');
         $month = $datetime->format('n');
         $day = $datetime->format('j');
         $week = $datetime->format('w');
         ?>

         <?=$year.'年'.$month.'月'.$day.'日&nbsp;'.$weekday[$week].'曜日'?>




       <a href="kensaku/honjitsu_hiki.php">本日の引継事項（昨日、今日の日付）</a>
     </td>
  </tr>
  <tr>
    <td>
           過去3ヶ月・1年「担当者」検索<br><br>
      <form action = "kensaku/tantou_box.php" method="post">
       <input type="text" name="tantouid">
        <select name="monthid" size="2">
         <option value="3" selected>3ヶ月</option>
         <option value="12">1年</option>
        </select>
        <select name="donefinished" size="2">
         <option value="1" selected>未了</option>
         <option value="2">済</option>
        </select>
         <input type="submit" name="exec" value="検索">
      </form>
    </td>
    <td>
      <a href="kensaku/day_three.php">3日間の引継事項（一昨日、昨日、今日）</a>
    </td>
  </tr>
  <tr>
    <td>
      まとめて削除
      <form action = "kensaku/pre_all_delete.php" method="post">
        <select name="pre_all_delete" size="3">
         <option value="1">1年以上前削除</option>
         <option value="3">3年以上前削除</option>
         <option value="5">5年以上前削除</option>
        </select>
         <input type="submit" name="exec" value="削除">
      </form>
    </td>
    <td>
      <a href="prebackup.html">バックアップ</a>
    </td>
  </tr>
</table>

<a href="index.php">一覧に戻る</a>

</body>
</html>