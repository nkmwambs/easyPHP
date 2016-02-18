<?php
echo Resources::a_href("Finance/feeStructure","[New Fees Structure]")." ".Resources::a_href("","[View Fees Structure]");

echo "<br><hr><br>";

//print_r($data['grade']);
$list = "";

foreach ($data['grade'] as $value) {
	$list .=$value->levelName."<INPUT TYPE='checkbox' name='grade[]' class='chkgrade' VALUE='".$value->lvlID."' CHECKED/>";
}

$grid=array();

$grid['Fees Structure']['Create Fees Structure']=array(
	"<form id='frmStructure'><INPUT TYPE='text' id='' name='academicayear' placeholder='Academic Year'/>",
	"<FIELDSET><LEGEND>Grade Levels [Check All <INPUT TYPE='checkbox' id='' CHECKED onclick='chkallcreatestructure(this)'/>]</LEGEND>",
	$list,
	"</FIELDSET><hr>",
	"<INPUT TYPE='button' id='' VALUE='Add Item' onclick='addstructureitem()'/>",
	"<INPUT TYPE='button' id='' VALUE='Remove Item'/>",
	"<table id='tbl_dividers'>",
	"<tr><th>Description</th><th>Amount</th></tr>",
	"</table></form>",
	"<INPUT TYPE='button' id='' VALUE='Create' style='margin-bottom:30px;' onclick='createnewstructure()'/>"
);
$grid['Fees Structure']['Edit Fees Structure']=array();
$grid['Fees Structure']['Delete Fees Structure']=array();

echo Resources::smart_grid($grid);

?>