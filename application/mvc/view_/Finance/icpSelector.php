<?php
//print_r($data);
echo "<form id='frmIcpSelector'>";
echo "<label for='icpSelector'>Select ICP</label><br><select id='icpSelector' name='icpSelector'>";
foreach($data as $arr):
    echo "<option value='".$arr->fname."'>".$arr->fname."</option>";
endforeach;
echo "</select><br><button formaction='".Resources::url("Finance/ecjOther")."' formmethod='POST'>Go</button>";
echo "</form>";
?>
