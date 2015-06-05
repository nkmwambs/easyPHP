<?php
echo "<table  style='width:auto;' align='center'>";
echo "<tr><td>".a_tag("Resource/addMaterial",img_tag("view.png",  array("title"=>"View Manuals")))."</td><td>View Manuals</td></tr>";
if($_SESSION['usrlvl']==='9'){
echo "<tr><td>".a_tag("Resource/addMaterial",img_tag("diskadd.png",  array("title"=>"Add New Manual")))."</td><td>Add New Manual</td></tr>";
echo "<tr><td>".a_tag("Resource/addMaterial",img_tag("manage2.png",  array("title"=>"Manage Manuals")))."</td><td>Manage Manuals</td></tr>";
}
echo "</table>";
?>