<?php
echo Resources::a_href("Students/classmanager","[Back]")." ".Resources::a_href("Students/viewclass","[View a Class]");
 echo "<br><hr><br>";

$sel = "";

foreach ($data['rst'] as $value) {
	$sel .="<OPTION VALUE='".$value->lvlID."'>".$value->levelName."</OPTION>";
}

$selTutor = "";
foreach ($data['tutor'] as $value) {
	$selTutor .="<OPTION VALUE='".$value->ID."'>".$value->fname." ".$value->lname."</OPTION>";
}


$classes = "";
foreach ($data['class'] as $value) {
	$classes .="<OPTION VALUE='".$value->classID."'>".$value->classname."</OPTION>";
}

$gridArr[]= array();
$gridArr['Create Class']['Add Class'] = array(
					"<INPUT TYPE='text' placeholder='Class Name' id='classname' class='req'/>",
					"<SELECT class='req' id='gradelevel'><OPTION VALUE=''>Select Grade ...</OPTION>".$sel."</SELECT>",
					"<SELECT class='req' id='tutorid'><OPTION VALUE=''>Select Tutor ...</OPTION>".$selTutor."</SELECT>",
					"<INPUT class='req' TYPE='text' placeholder='Academic Year' id='academicyear'/>",
					"<INPUT TYPE='button' onclick='createclass()' value='Create'/>"
				); 

$gridArr['Create Class']['Search Enrolled Student'] =array(
					"<INPUT TYPE='text' id='searchstudent' placeholder='Search Student'/>",
					"<INPUT TYPE='button' VALUE='Search' onclick='studentinclasssearch()'/>"
);

$gridArr['Create Class']['Add/ Delete Students from Class'] = array(
					"<INPUT TYPE='text' id='admissionnum' placeholder='Student Admission Number'/>",
					"<SELECT id='classid' ><OPTION VALUE=''>Choose Class ...</OPTION>".$classes."</SELECT>",
					"Add <INPUT id='chk' TYPE='checkbox' onclick='togglebutton()' CHECKED/>",
					"<INPUT TYPE='button' id='delstudent' onclick='enrollstudent()' value='Add'/>"
					
				); 				

echo Resources::smart_grid($gridArr);

?>