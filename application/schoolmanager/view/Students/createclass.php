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
					"<INPUT TYPE='text' placeholder='Class Name' id='classname' class='req mandatory'/>",
					"<SELECT class='req mandatory' id='gradelevel'><OPTION VALUE=''>Select Grade ...</OPTION>".$sel."</SELECT>",
					"<SELECT class='req mandatory' id='tutorid'><OPTION VALUE=''>Select Tutor ...</OPTION>".$selTutor."</SELECT>",
					"<INPUT class='req mandatory' TYPE='text' placeholder='Academic Year' id='academicyear'/>",
					"<INPUT TYPE='button' onclick='createclass()' value='Create'/>"
				); 

$gridArr['Create Class']['Search Enrolled Student'] =array(
					"<INPUT TYPE='text' class='mandatory' id='searchstudent' placeholder='Search Student'/>",
					"<INPUT TYPE='button' VALUE='Search' onclick='studentinclasssearch()'/>"
);

$gridArr['Create Class']['Add/ Delete Students from Class'] = array(
					"<INPUT TYPE='text' class='mandatory' id='admissionnum' placeholder='Student Admission Number'/>",
					"<SELECT id='classid' class='mandatory'><OPTION VALUE=''>Choose Class ...</OPTION>".$classes."</SELECT>",
					"Add <INPUT id='chk' class='mandatory' TYPE='checkbox' onclick='togglebutton()' CHECKED/>",
					"<INPUT TYPE='button' id='delstudent' onclick='enrollstudent()' value='Add'/>"
					
				); 		
$gridArr['Create Class']['Documented'] = array(
					"Add Class"=>"Allows you create a new class. It has 4 required fields: \n Class Name - This is a given name as agreed by the school, \nSelect Grade - Formal class level. Grade levels can be changed by changed by an administrator, \nSelect Tutor - Must be a registrered user in the system, \nAcademic Year - Should be given in four digit number",
					"Search Enrolled Student"=>"You will be required to provide the full admission number \nof the student you would want to search details for",
					"Add/ Delete Students from Class"=>"This allows you to add students to a class.\n To Add a student you have to provide the student full admission number and the class the student is to be added. \n Make sure the Add checkbox in checked and click on the Add button. \n To remove a student from a class uncheck the Add checkbox and click on Delete"
				);					

echo Resources::smart_grid($gridArr);

?>