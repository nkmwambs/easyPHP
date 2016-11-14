<?php
//if(Resources::session()->userlevel==='3'){
	echo Resources::a_href("Finance/civ","[CIV]");
//}

echo "<br>";
echo "<hr>";

echo "<table>";

echo "<caption><b>Extension of CIV ID ".$data['civaID']." for ".$data['icpNo']."</b></caption>";
echo "<form id='frmextcivdates'>";
echo "<tr><td><b>CIV ID:</b> </td><td><INPUT TYPE='text' VALUE='".$data['civaID']."' id='civaID' name='civaID' readonly/></td></tr>";
echo "<tr><td><b>CiV Name:</b> </td><td><INPUT TYPE='text' VALUE='".$data['desc']."' id='desc' readonly/></td></tr>";
echo "<tr><td><b>KE No:</b> </td><td><INPUT TYPE='text' VALUE='".$data['icpNo']."' id='icpNo' name='icpNo' readonly/></td></tr>";
echo "<tr><td><b>Orginal Date:</b> </td><td><INPUT TYPE='text' VALUE='".$data['origin']."' id='originalDate' name='originalDate' readonly/></td></tr>";
echo "<tr><td><b>New Date:</b> </td><td><INPUT TYPE='text' id='extDate' name='closureDate' readonly/></td></tr>";//.Resources::img("go.png",array("title"=>"Go","onclick"=>'extenddateforciv()'));
echo "</form>";
echo "<tr><td colspan='2'><button onclick='extenddateforciv()'>Extend</button></td></tr>";

echo "</table>";
?>