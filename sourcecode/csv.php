<?php
// エラーを出力する
ini_set('display_errors', "On");
// 出力情報の設定
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=backup_hikitsugi.csv");
header("Content-Transfer-Encoding: binary");


// 変数の初期化
$csv = null;

// 出力したいデータのサンプル
require_once './config/db_config.php';
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 1行目のラベルを作成
$csv = '"ID","日付","内容","担当","カテゴリ","進行状況"' . "\n";



// 出力データ生成
foreach( $result as $value ) {
	$csv .= '"' . $value['id_hikitsugi'] . '","' . $value['hizuke'] . '","' . $value['naiyou'] . '","' . $value['tantou'] . '","' . $value['category'] . '","' . $value['shinkou'] . '"' . "\n";

}


$csv = mb_convert_encoding($csv,"SJIS","UTF-8");

// CSVファイル出力
echo $csv;
return;