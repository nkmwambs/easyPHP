<?php
echo Resources::a_href("","[My Site]");

echo "<br><hr><br>";

$msgtype = "";

foreach ($data['rst'] as $value) {
	$msgtype .="<OPTION VALUE='".$value->typeID."'>".$value->msgtype."</OPTION>";
}

//List logos: Change Logo

$list = "<table>";
$list .="<caption><b>Choose Logo ...</b></caption>";
$list .="<tr><th>Action</th><th>Logo</th><th>Site Title</th></tr>";
foreach($data['logos'] as $value){
	$list .="<tr><td><INPUT TYPE='radio' name='sellogo' value='".$value->logoID."'/></td><td>".Resources::img("logos/".$value->url,array("style"=>"max-width:35px;max-heigth:45px;"))."</td><td> ".$value->title."</td><tr>";
}
$list .= "</table>";

//List logos: Delete Logo

$dellist = "<table>";
$dellist .="<caption><b>Delete a Logo and Site Title</b></caption>";
$dellist .="<tr><th>Action</th><th>Logo</th><th>Site Title</th></tr>";
foreach($data['logos'] as $value){
	$dellist .="<tr><td><INPUT TYPE='button' name='sellogo' id='".$value->logoID."' value='Delete' onclick='deleteLogo(this)'/></td><td>".Resources::img("logos/".$value->url,array("style"=>"max-width:35px;max-heigth:45px;"))."</td><td> ".$value->title."</td><tr>";
}
$dellist .= "</table>";


$arr = array();

$arr['My Site']['Create Pages & Documentation'] = array(
		"<INPUT TYPE='button' VALUE='Pull Existing Message' onclick='pullexistingmessage()'/><br>",
		"<INPUT TYPE='text' placeholder='Message Title' class='req' id='boardname'/>",
		"<INPUT TYPE='text' placeholder='Message Pointer' class='req'  id='pointer'/>",
		"<SELECT id='msg_type' class='req' ><OPTION VALUE=''>Select Message Type ...</OPTION>".$msgtype."</SELECT>",
		"<TEXTAREA class=''  id='msg' cols='105' rows='10' placeholder='Type in message here ...'></TEXTAREA><br>",
		"<INPUT TYPE='button' VALUE='Post' onclick='postmsg()'/>"
);

$arr['My Site']['Site Logo'] = array(
		"<b>Upload/ Replace Logo</b>",
		"<hr>",
		"<form id='frmlogo' enctype='multipart/form-data'>",
		"<b>Site Title:</b><TEXTAREA id='sitetitle' cols='60' rows='10' placeholder='Type Site Title here ...'></TEXTAREA><br>",
		"<b>Choose Site Logo</b> <INPUT TYPE='file' id='imglogo' name='imglogo'/>",
		//"<INPUT TYPE='text' placeholder='Site Name' name='sitetitle' id='sitetitle'/>",
		//$dellist,
		"</form>",
		"<INPUT TYPE='button' VALUE='Post' onclick='postlogo()'/>",
		"<hr>",
		$dellist,
		"<hr>",
		"<b>Change Default Logo</b>",
		"<form id='frmsetlogo'>",
		$list,
		"</form>",
		"<INPUT TYPE='button' VALUE='Change' onclick='changedefaultlogo()'/>"
);

echo Resources::smart_grid($arr);

?>