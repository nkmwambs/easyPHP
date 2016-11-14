<?php
echo "<b>Toolkit Users</b>";
echo "<br><hr><br>";

$icp="";
foreach ($data['users'] as $value) {
	if($value->department!=='0'){
		$icp = "(".$value->fname.")";
	}
	echo "<INPUT TYPE='radio' name='users' onclick='window.opener.getUser(\"".$value->username."\");window.close()'/> <span class='items'>".$value->userfirstname." - ".$value->userlastname." ".$icp."</span><br>";
}
?>