<?php
//echo Resources::a_href("Finance/feeStructure","[New Fees Structure]")." ".Resources::a_href("Finance/viewfeesstructure","[View Fees Structure]");

//echo "<br><hr><br>";

//print_r($data['grade']);
$list = "";

foreach ($data['grade'] as $value) {
	$list .=$value->levelName."<INPUT TYPE='checkbox' name='grade[]' class='chkgrade' VALUE='".$value->lvlID."' CHECKED/>";
}

$fees = "";

foreach ($data['fees'] as $value) {
	$fees .= "<OPTION VALUE='".$value->fID."'>".$value->feestructurename."</OPTION>";
}

//View Fees Structure
$view =  "<b>Choose A Grade:</b> ";
$view .=  "<SELECT id='gradelevels'>";
$view .=  "<OPTION VALUE=''>Select a Grade Level</OPTION>";
foreach ($data['grades'] as $value) {
	$view .=  "<OPTION VALUE='".$value->lvlID."'>".$value->levelName."</OPTION>";
}
$view .=  "</SELECT> ";

$view .=  " <b>Choose Academic Year:</b> ";

$view .=  "<SELECT id='academicyear'>";
$view .=  "<OPTION VALUE=''>Select Academic Year</OPTION>";
foreach ($data['acYr'] as $value) {
	$view .=  "<OPTION VALUE='".$value->academicyear."'>".$value->academicyear."</OPTION>";
}
$view .=  "</SELECT> ";

$view .=  "<INPUT TYPE='button' VALUE='View Structure' onclick='getfeesstructure()'/>";

$grid=array();

$grid['Fees Structure']['Create a Fees Structure']=array(
	"<INPUT TYPE='text' id='feestructurename' placeholder='Fee Structure Name'/>",
	"<INPUT TYPE='text' name='' id='newfeestructureyear' placeholder='Academic Year'/>",
	"<INPUT TYPE='button' VALUE='Create' id='' name='' onclick='newfeestructure()'/>"
);

$grid['Fees Structure']['Add Details to Fees Structure']=array(
	"<form id='frmStructure'><SELECT name='fID'><OPTION VALUE=''>Select a Fee Structure</OPTION>".$fees."</SELECT>",
	"<FIELDSET><LEGEND>Grade Levels [Check/ Uncheck All <INPUT TYPE='checkbox' id='' CHECKED onclick='chkallcreatestructure(this)'/>]</LEGEND>",
	$list,
	"</FIELDSET><hr>",
	"<INPUT TYPE='button' id='' VALUE='Add Row' onclick='addstructureitem()'/>",
	"<INPUT TYPE='button' id='' VALUE='Remove Row' onclick='removefeesrow()'/>",
	"<table id='tbl_dividers'>",
	"<tr><th>Check</th><th>Description</th><th>Amount</th><th>Period</th><th>Category</th></tr>",
	"</table></form>",
	"<INPUT TYPE='button' id='' VALUE='Add' style='margin-bottom:30px;' onclick='createnewstructure()'/>"
);
$grid['Fees Structure']['Edit Fees Structure']=array(
	"<SELECT name='fID'><OPTION VALUE=''>Select a Fee Structure</OPTION>".$fees."</SELECT><INPUT TYPE='button' VALUE='Search' onclick='selectfeesstructureforedit()' />",
);

$grid['Fees Structure']['Copy Fees Structure']=array(
	"<SELECT id='moveSel'><OPTION VALUE=''>Select a Fee Structure</OPTION>".$fees."</SELECT>",
	"<INPUT TYPE='text' id='' placeholder='Copy To Year'/>",
	"<INPUT TYPE='button' onclick='movefeestructure()' VALUE='Copy'/>"
);

$grid['Fees Structure']['Delete Fees Structure']=array(
	"<SELECT id='selFees'><OPTION VALUE=''>Select a Fee Structure</OPTION>".$fees."</SELECT>",
	"<INPUT TYPE='button' onclick='deletefeestructure()' VALUE='Delete'/>"
);

$grid['Fees Structure']['View Fees Structure']=array(
	$view
);
echo Resources::smart_grid($grid);

?>