<?php
echo Resources::a_href("Finance/fundsUpload","[Funds Upload]")." ".Resources::a_href("Finance/civ","[View Uploaded Funds]")." ".Resources::a_href("Finance/civ","[CIV]")." ".Resources::a_href("Finance/civedit","[Back]");
echo "<br>";
echo "<hr>";
echo "<br>";

//print_r($data['civaAc']);

echo "Change Month</td><td><INPUT TYPE='text' id='newMonth'/>".Resources::img("go.png",array("title"=>"Go","onclick"=>"changeMonthforciv()"));

echo "<table>";
echo "<caption>Add New CIV Code to ".$data['curDate']." Fund Schedule</caption>";

echo "<tr><th>Fund Description</th><td>";
echo "<SELECT id='fund' onchange=updatecivcode()>";
foreach ($data['funds'] as $value) {
	echo "<OPTION VALUE='".$value->fund."'>".$value->fund."</OPTION>";
}
echo "</SELECT>";
echo "</td></tr>";
echo "<tr><th>Schedule Month</th><td><INPUT TYPE='text' VALUE='".$data['curDate']."' id='month' readonly/></td></tr>";
echo "<tr><th>Preferred CIV Schedule Code</th><td><INPUT TYPE='text' id='civCode'/></td></tr>";
echo "<tr><td><button onclick='addfundtocivschedule();'>Add to Schedule</button></td></tr>";

echo "</table>";

?>