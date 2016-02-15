<?php
echo Resources::a_href("Students/newStudent/public/0",Resources::img("plus.png",array("title"=>"New Record"))." New Profile",array("class"=>"url"))." ".Resources::a_href("Students/draftStudentRecords/public/0",Resources::img("diskedit.png",array("title"=>"Draft Record"))." Draft Profile",array("class"=>"url"))." ".Resources::a_href("Students/manageStudents/public/0",Resources::img("manage2.png",array("title"=>"Manage Record"))." Manage Profile",array("class"=>"url"));
?>
<br>
<hr width='85%' style="float: left;"><br>
<?php
echo Resources::table_filters("Search Student",array("fname"=>"First Name","lname"=>"Last Name","sex"=>"Sex","draft"=>"Draft","active"=>"Active"),"Students/findstudent","Students/editprofile");
echo "<div id='rst'></div>";

?>