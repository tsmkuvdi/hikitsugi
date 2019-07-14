<?php
//kako_shinkou.php,shinkou_category_3month.php,box_tantou_kensaku.php,box_kensaku.php,tantou_box.php,kako_box.phpから呼び出し
function shinkouDisplay_function($row){
  if ($row['shinkou'] === '1') $tmpshinkou = "未了";
  if ($row['shinkou'] === '2') $tmpshinkou = "済";

return $tmpshinkou;

}

/**
呼び出し元と処理を共有したい場合、多くの場合は切り出しただけでは
期待通りには動作しない。
（変数のスコープ、関数の引数、関数の戻り値)
関数の中で$rowを使うには呼び出し側から渡してもらわないといけない
関数定義時に指定した変数に呼び出し元から渡された値が入って使えるようになる
*/
