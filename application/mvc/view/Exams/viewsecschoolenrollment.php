<?php

echo Resources::a_href("Exams/viewKcpe","[Back]");

echo "<br><br><hr>";

echo "<b>Choose Acdemic Year:</b> <SELECT id='selacYr' onchange='changeenrollyr()'>";
	echo "<OPTION VALUE=''>Select Academic Year</OPTION>";
	echo "<OPTION VALUE='2014'>2014</OPTION>";
	echo "<OPTION VALUE='2015'>2015</OPTION>";
	echo "<OPTION VALUE='2016'>2016</OPTION>";
	echo "<OPTION VALUE='2017'>2017</OPTION>";
	echo "<OPTION VALUE='2018'>2018</OPTION>";
	echo "<OPTION VALUE='2019'>2019</OPTION>";
	echo "<OPTION VALUE='2020'>2020</OPTION>";
echo "</SELECT>";

echo "<br><hr><br>";

if(empty($data)){
	echo "<div id='error_div'>No records found</div>";
	exit;
}

//print_r($data);

//$hdr = array_keys($data[0]);

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<tr>";
foreach ($data[0] as $key=>$value) {
	echo "<th>".$key."</th>";
}
echo "</tr>";

foreach ($data as $value) {
	echo "<tr>";
	foreach ($value as $val) {
		echo "<td>".$val."</td>";
	}
	echo "</tr>";
}

echo "</table>";


?>