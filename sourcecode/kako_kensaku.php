<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>引継簿3ヶ月以前検索</title>
</head>
<body>
<h1>引継簿3ヶ月以前検索</h1>

<table border="1" width="100%">
  <tr>
    <td>
      <form action = "kensaku/kakoyear_kensaku.php" method="post">
　　   西暦<input type="number" min="2018" max="2050" name="yearid" style="width:100px;">年
        <input type="submit" name="exec" value="検索">
       </form>
     </td>
     <td>

     </td>
  </tr>
  <tr>
    <td>
     過去1年
      <form action = "kensaku/kako_catone.php" method="post">
       <input type="submit" name="exec" value="1番">
      </form>
       <br>
      <form action = "kensaku/kako_cattwo.php" method="post">
       <input type="submit" name="exec" value="2番">
      </form>
       <br>
      <form action = "kensaku/kako_catthree.php" method="post">
       <input type="submit" name="exec" value="3番">
      </form>
       <br>
      <form action = "kensaku/kako_catfour.php" method="post">
       <input type="submit" name="exec" value="4番">
      </form>
     </td>
     <td>
       <form action = "kensaku/kako_done_finished.php" method="post">
　　    <input type="number" min="1" max="12" name="monthid" style="width:40px;">ヶ月前
        <select name="kategori" size="4">
           <?php require_once ('function_gather/function_category_html.php'); ?>
           <?php category_Html_Select(); ?>
        </select>

        <select name="donefinished" size="2">
         <option value="1">未了</option>
         <option value="2">済</option>
        </select>
         <input type="submit" name="exec" value="検索">
       </form>
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
      
    </td>
    <td>
      <a href="prebackup.html">バックアップ</a>
    </td>
  </tr>
</table>

<a href="index.php">一覧に戻る</a>

</body>
</html>