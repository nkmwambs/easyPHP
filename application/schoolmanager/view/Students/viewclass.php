<?php
echo Resources::a_href("Students/classmanager","[Back]")." ".Resources::a_href("Students/createclass","[Create a Class]");
 echo "<br><hr><br>";
 
 $grades = "";
 
 foreach ($data['gradelevels'] as $value) {
     $grades .="<OPTION VALUE='".$value->lvlID."'>".$value->levelName."</OPTION>";
 }
 
 $arr = array();
 
 $arr['View/ Manage Class By Criteria']['Criteria'] = array(
 			"<INPUT TYPE='text' class='req' id='classname' placeholder='Search By Class Name'/>",
 			"<SELECT id='gradelevel' class='req'><OPTION VALUE=''>Select Grade Level ...</OPTION>".$grades."</SELECT>",
 			"<INPUT TYPE='text' id='academicyear' class='req' placeholder='Academic Year'/>",
 			"<INPUT TYPE='button' id='' VALUE='Search' onclick='searchclass()'/>"
 );
 
 echo Resources::smart_grid($arr);
 
?>