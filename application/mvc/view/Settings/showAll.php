<?php
//print_r($data);
?>
<table class="designerTable">
    <caption>Menu List</caption>
    <tr><th>Menu ID</th><th>Self ID</th><th>Self Title</th><th>URL</th><th>User Levels</th><th>Expiry Date</th><th>Reoccurence</th></tr>
    <?php 
    foreach($data as $value_arr){
 
        echo "<tr><td>".$value_arr->mnID."</td>"
                . "<td id='".$value_arr->mnID."_".$value_arr->selfID."_selfID' ondblclick='editMenu(this);' onchange='removeInput(this);'>".$value_arr->selfID."</td>"
                . "<td id='".$value_arr->mnID."_".$value_arr->selfTitle."_selfTitle' ondblclick='editMenu(this);' onchange='removeInput(this);'>".$value_arr->selfTitle."</td>"
                . "<td id='".$value_arr->mnID."_".$value_arr->url."_url' ondblclick='editMenu(this);' onchange='removeInput(this);'>".$value_arr->url."</td>"
                . "<td id='".$value_arr->mnID."_".$value_arr->userlevel."_usrlvl' ondblclick='editMenu(this);' onchange='removeInput(this);'>".$value_arr->userlevel."</td>"
                . "<td id='".$value_arr->mnID."_".$value_arr->todate."_todate' ondblclick='editMenu(this);' onchange='removeInput(this);'>".$value_arr->todate."</td>"
                . "<td id='".$value_arr->mnID."_".$value_arr->reoccur."_reoccur' ondblclick='editMenu(this);' onchange='removeInput(this);'>".$value_arr->reoccur."</td>"
                . "</tr>";

    }
    ?>
    
</table>