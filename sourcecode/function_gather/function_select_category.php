<?php
//edit.phpより呼び出し

function category_select($result){
?>

<option value="1" <?php if($result['category'] === 1) echo "selected" ?>>カテゴリ１</option>
<option value="2" <?php if($result['category'] === 2) echo "selected" ?>>カテゴリ２</option>
<option value="3" <?php if($result['category'] === 3) echo "selected" ?>>カテゴリ３</option>
<option value="4" <?php if($result['category'] === 4) echo "selected" ?>>カテゴリ４</option>

<?php

}
?>