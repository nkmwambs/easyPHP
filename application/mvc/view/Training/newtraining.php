<?php
echo Resources::a_href("Training/newtraining", "[Register New Training]")." ".Resources::a_href("Training/calender", "[View Trainings]");
echo "<br><hr><br>";

echo "<button onclick='addtrainingsession();'>Add Session</button><button onclick='posttraining(\"frmtraining\");'>Post Training</button><button onclick='delRow(\"tbltrainingsessions\");' id='btnDelRow' style='display:none;'>Delete Row</button>";
echo "<form id='frmtraining'>";
echo "<table id='tbltraining'>";
echo "<caption>New Training</caption>";
echo "<tr><th colspan='4'>Training Profile</th></tr>";
echo "<tr><th>Training Title:</th><td colspan='3'><INPUT TYPE='text' id='tdesc' name='tdesc' style='width:650px;'/></td></tr>";
echo "<tr><th>Start Date</th><td><INPUT TYPE='text' id='startdate' name='startdate'/></td><th>End Date</th><td><INPUT TYPE='text' id='enddate' name='enddate'/></td></tr>";
echo "<tr><th>Goal/ Objective(s)</th><td colspan='3'><TEXTAREA cols='80' rows='8' id='goal' name='goal'></TEXTAREA></td></tr>";
echo "<tr><th>Location</th><td><INPUT TYPE='text' id='location' name='location'/></td><th>Level</th><td><SELECT id='level' name='level'><OPTION VALUE=''>Select Level ...</OPTION><OPTION VALUE='1'>Cluster</OPTION><OPTION VALUE='2'>Regional**</OPTION><OPTION VALUE='3'>Country</OPTION></SELECT></td></tr>";
echo "<tr><th>Target Group</th><td><INPUT TYPE='text' id='targetgroup' name='targetgroup'/></td><th>Facilitator Source if External</th><td><INPUT TYPE='text' id='facilitatorsource' name='facilitatorsource'/></td></tr>";
echo "<tr><th>Training Type:</th><td><SELECT id='trainingtype' name='trainingtype'><OPTION VALUE=''>Select Type ...</OPTION><OPTION VALUE='1'>Planned</OPTION><OPTION VALUE='2'>Ad-hoc</OPTION></SELECT></td><th>Training Status:</th><td><SELECT id='status' name='status'><OPTION VALUE=''>Choose Status ...</OPTION><OPTION VALUE='1'>Active</OPTION><OPTION VALUE='2'>On Hold</OPTION><OPTION VALUE='3'>Deffered</OPTION></SELECT></td></tr>";
echo "<tr><td colspan='4'>";
echo "<table id='tbltrainingsessions'>";
	echo "<tr><th>Check</th><th>Session Title</th><th>Facilitator(s)</th></tr>";
echo "</table></td></tr>";
echo "</table>";
echo "</form>";
?>