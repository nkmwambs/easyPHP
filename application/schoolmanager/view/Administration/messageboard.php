<?php
echo Resources::a_href("","[Message Board]")." ".Resources::a_href("","[Manage Board]");

echo "<br><hr><br>";

$msgtype = "";

foreach ($data['rst'] as $value) {
	$msgtype .="<OPTION VALUE='".$value->typeID."'>".$value->msgtype."</OPTION>";
}

$arr = array();

$arr['Create Message']['New Message'] = array(
		"<INPUT TYPE='text' placeholder='Message Title' class='req' id='boardname'/>",
		"<INPUT TYPE='text' placeholder='Message Pointer' class='req'  id='pointer'/>",
		"<SELECT id='msg_type' class='req' ><OPTION VALUE=''>Select Message Type ...</OPTION>".$msgtype."</SELECT>",
		"<TEXTAREA class='req'  id='msg' cols='105' rows='10' placeholder='Type in message here ...'></TEXTAREA><br>",
		"<INPUT TYPE='button' VALUE='Post' onclick='postmsg()'/>"
);

echo Resources::smart_grid($arr);

?>