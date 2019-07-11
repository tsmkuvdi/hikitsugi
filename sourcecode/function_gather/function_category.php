<?php
//index.php,kakoyear_kensaku.php,kako_done_finished.php,cat_one.php(各カテゴリページ)から呼び出し
function categoryDisplay_function($row){
  if ($row['category'] === '1') $tmp = "その他";
  if ($row['category'] === '2') $tmp = "カテゴリ２";
  if ($row['category'] === '3') $tmp = "カテゴリ３";
  if ($row['category'] === '4') $tmp = "カテゴリ４";

return $tmp;

}

/**
呼び出し元と処理を共有したい場合、多くの場合は切り出しただけでは
期待通りには動作しない。
（変数のスコープ、関数の引数、関数の戻り値)
関数の中で$rowを使うには呼び出し側から渡してもらわないといけない
関数定義時に指定した変数に呼び出し元から渡された値が入って使えるようになる
*/
