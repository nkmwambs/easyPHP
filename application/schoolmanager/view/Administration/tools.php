<?php
//print_r($data['tools']);
echo "<table>";
echo "<caption  style='font-weight:bolder;text-decoration:underline;'>Developer Tools</caption>";
//echo "<tr><th>Tool</th><th>Description</th></tr>";
foreach ($data['tools'] as $value) {
	echo "<tr><td><a href='".HOST_NAME."/tools/".$value->url."' target='__blank'>".$value->title."<a/></td><td style='padding-left:30px;'>".$value->desc."</td></tr>";
}
echo "</table>";
?>