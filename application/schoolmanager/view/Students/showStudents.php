<?php
$arr = array();

$levels = "";

//print_r($data['rec']);

foreach ($data['dropdwns']['classes'] as $value) {
	$levels .="<OPTION VALUE='".$value->classID."'>".$value->classname."</OPTION>";
}

$arr['Students\'s List']['records'] = $data['rec'];
$arr['Students\'s List']['Resources']=array(
										"<SELECT id='promote_to_grade' class='req'><OPTION VALUE=''>Promote/ Demote To</OPTION>".$levels."</SELECT>",
										"<INPUT TYPE='text' class='req' id='acyear' placeholder='New Academic Year' VALUE='".date("Y")."'/>",
										//"<INPUT TYPE='button' VALUE='Promote/ Demote All' id='' onclick='promoteallstudents()' style='margin-right:15px;'/>",
										"<INPUT TYPE='button' VALUE='Promote/ Demote Selected' id='' style='margin-left:15px;' onclick='promoteselectedstudents()'/>"
);

echo Resources::db_table($arr,1);
?>