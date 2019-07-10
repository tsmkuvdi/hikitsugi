<?php
//edit.phpより呼び出し

function category_select($result){
?>

<option value="1" <?php if($result['category'] === 1) echo "selected" ?>>届出 報告書 その他</option>
<option value="2" <?php if($result['category'] === 2) echo "selected" ?>>危険物</option>
<option value="3" <?php if($result['category'] === 3) echo "selected" ?>>設備</option>
<option value="4" <?php if($result['category'] === 4) echo "selected" ?>>防火管理</option>

<?php

}
?>