<?php
echo Resources::a_href("Students/classmanager","[Back]")." ".Resources::a_href("Students/createclass","[Create a Class]");
 echo "<br><hr><br>";
 
 $grades = "";
 
 foreach ($data['gradelevels'] as $value) {
     $grades .="<OPTION VALUE='".$value->lvlID."'>".$value->levelName."</OPTION>";
 }
 
 $arr = array();
 
 $arr['View/ Manage Class By Criteria']['Criteria'] = array(
 			"<INPUT TYPE='text' class='' id='classname' placeholder='Search By Class Name'/>",
 			"<SELECT id='gradelevel' class=''><OPTION VALUE=''>Select Grade Level ...</OPTION>".$grades."</SELECT>",
 			"<INPUT TYPE='text' id='academicyear' class='' placeholder='Academic Year'/>",
 			"<INPUT TYPE='button' id='' VALUE='Search' onclick='searchclass()'/>"
 );
 
  $arr['View/ Manage Class By Criteria']['Documented']=array(
  			"Criteria"=>"Provide the criteria to search a class. You can provide all criteria or a few. \n If you leave all fields empty, all classes created will be viewed.\n Click on the Search button to see your results.\n On the results grid, click on the Purple colored values to view more details"
  );
 
 echo Resources::smart_grid($arr);
 
?>