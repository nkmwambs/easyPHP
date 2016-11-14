<?php

echo "<INPUT type='hidden' id='KENo' value='".Resources::session()->fname."'/>";
echo "<INPUT type='hidden' id='pNo' value='".Resources::session()->cname."'/>";

echo Resources::a_href("Exams/viewKcpe","[View K.C.P.E Results]");

echo "<hr>";
echo "<br>";

//echo "<button>View Results</button>";
echo "<button onclick='addNewAc(\"tblAc\");'>Add Record</button>";
echo "<button id='deleteRow' style='display:none;' onclick='delRow(\"tblAc\")'>Remove Row</button>";
echo "<button onclick='submitAc(\"frmShw\");'>Submit</button>";

echo "<br><br>";

echo "<hr>";

echo "<br>";

echo "<div id='shwAc' style='overflow-x:auto;'>";
echo "<b>Academic Year:</b> <INPUT type='text' value='2015' id='acYr' style='width:60px;' readonly='readonly'/><br>";
echo "<b>Count for Current Year: </b> ".$data;
echo "<form id='frmShw' style='width:100%;'>";
echo "<table id='tblAc' style='width:100%;font-size:8pt;'>";
echo "<tr><th colspan='18'>K.C.P.E Academic Results</th></tr>";
echo "<tr><th>Select</th><th>Cluster</th><th>ICP No.</th><th>Child No</th><th>Child Name</th><th>Date Of Birth</th><th>Gender</th><th>Index Number</th><th>English</th><th>Kiswahili</th><th>Science</th><th>Mathematics</th><th>Social Studies/ RE</th><th>Total Marks</th><th>Academic Year</th></tr>";


echo "</table>";
echo "</form>";
?>