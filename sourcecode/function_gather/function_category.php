<?php

function categoryDisplay_function($row){
  if ($row['category'] === '1') $tmp = "届出 報告書 その他";
  if ($row['category'] === '2') $tmp = "危険物";
  if ($row['category'] === '3') $tmp = "設備";
  if ($row['category'] === '4') $tmp = "防火管理";

return $tmp;

}

/**
呼び出し元と処理を共有したい場合、多くの場合は切り出しただけでは
期待通りには動作しない。
（変数のスコープ、関数の引数、関数の戻り値)
関数の中で$rowを使うには呼び出し側から渡してもらわないといけない
関数定義時に指定した変数に呼び出し元から渡された値が入って使えるようになる
*/
