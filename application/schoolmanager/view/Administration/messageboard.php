<?php
echo Resources::a_href("","[My Site]");

echo "<br><hr><br>";

$msgtype = "";

foreach ($data['rst'] as $value) {
	$msgtype .="<OPTION VALUE='".$value->typeID."'>".$value->msgtype."</OPTION>";
}

//List logos

$list = "<table style='max-width:260px;border:1px red solid;'>";
$list .="<caption><b>Choose Logo ...</b></caption>";
foreach($data['logos'] as $value){
	$list .="<tr><td><INPUT TYPE='radio' name='sellogo' value='".$value->logoID."'/>".Resources::img("logos/".$value->url,array("style"=>"max-width:35px;max-heigth:45px;"))." ".substr($value->title,0,15)."...</td><tr>";
}
$list .= "</table>";

$arr = array();

$arr['My Site']['Create Pages & Documentation'] = array(
		"<INPUT TYPE='button' VALUE='Pull Existing Message' onclick='pullexistingmessage()'/><br>",
		"<INPUT TYPE='text' placeholder='Message Title' class='req' id='boardname'/>",
		"<INPUT TYPE='text' placeholder='Message Pointer' class='req'  id='pointer'/>",
		"<SELECT id='msg_type' class='req' ><OPTION VALUE=''>Select Message Type ...</OPTION>".$msgtype."</SELECT>",
		"<TEXTAREA class='req'  id='msg' cols='105' rows='10' placeholder='Type in message here ...'></TEXTAREA><br>",
		"<INPUT TYPE='button' VALUE='Post' onclick='postmsg()'/>"
);

$arr['My Site']['Site Logo'] = array(
		"<b>Upload/ Replace Logo</b>",
		"<hr>",
		"<form id='frmlogo' enctype='multipart/form-data'>",
		"<b>Choose Site Logo</b> <INPUT TYPE='file' id='imglogo' name='imglogo'/>",
		"<INPUT TYPE='text' placeholder='Site Name' name='sitetitle' id='sitetitle'/>",
		$list,
		"</form>",
		"<INPUT TYPE='button' VALUE='Post' onclick='postlogo()'/>",
		"<hr>",
		"<b>Change Default Logo</b>",
		"<form id='frmsetlogo'>",
		$list,
		"</form>",
		"<INPUT TYPE='button' VALUE='Change' onclick='changedefaultlogo()'/>"
);

echo Resources::smart_grid($arr);

?>