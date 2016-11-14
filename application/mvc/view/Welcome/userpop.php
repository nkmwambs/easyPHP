<?php
echo "<b>Toolkit Users</b>";
echo "<br><hr><br>";


foreach ($data['users'] as $value) {
	$icp="";
	if($value->userlevel==='1'){
		$icp = "(".$value->fname.")";
	}
	echo "<INPUT TYPE='radio' name='users' onclick='window.opener.getUser(\"".$value->username."\");window.close()'/> <span class='items'>".$value->userfirstname." ".$value->userlastname." ".$icp."</span><br>";
}
?>