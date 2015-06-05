<table id="usrs">
<?php
foreach($data as $value):
    echo "<tr><td onclick='addUser($value->username);'; style='cursor:pointer;'>{$value->username}<td></tr>";
endforeach;
?>
</table>