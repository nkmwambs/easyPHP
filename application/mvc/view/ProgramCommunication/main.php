<?php //if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
//print_r($data['infotype']);

echo "<div id='rplc'>";
/*
echo "<table id='info_tbl' style='margin-bottom:50px;margin-top:25px;'>";
echo "<caption>Information Type Statistics</caption>";
echo "<tr><th>Information Type</th><th>New Record</th><th>Processed Record</th><th>Declined Record</th><th>Total Number Of Beneficiaries</th></tr>";
foreach ($data['infotype'] as $value) {
	if($value->InfoType==='1'){
		echo "<tr><td>Initial Registration</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>".$value->cnt."</td></tr>";
	}elseif($value->InfoType==='2'){
		echo "<tr><td>Information Update</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>".$value->cnt."</td></tr>";
	}
	
}
echo "</table>";

 * 
 */
 
//Search Status
echo "<form id='frmSelects'>";
echo "<span style='font-weight:bold;'>Pull By ICPs Status:</span>";
echo "<SELECT id='pullicps' name='pullicps'>";
	echo "<OPTION value=''>Select Status</OPTION>";
	echo "<OPTION value='5' selected>All States</OPTION>";
	echo "<OPTION value='0'>New</OPTION>";
	echo "<OPTION value='2'>Processed</OPTION>";
	echo "<OPTION value='4'>Flagged</OPTION>";
	echo "<OPTION value='6'>Resolved Flags</OPTION>";
	echo "<OPTION value='3'>Archived</OPTION>";
	echo "<OPTION value='1'>Declined</OPTION>";
echo "<SELECT><br>";

echo "<fieldset>";
echo "<legend style='font-weight:bold;'>Information Type</legend>";
echo "<INPUT TYPE='radio' name='infotype' id='infotype1' value='1'/> Initial Registration";
echo "<INPUT TYPE='radio' name='infotype' id='infotype2' value='2'/> Information Update";
echo "<INPUT TYPE='radio' name='infotype' id='infotype2' value='0' checked/> All Information Types";
echo "</fieldset>";
echo "</form>";
echo "<button onclick='pullipcs(\"frmSelects\");'>Find</button><br><br>";


//Get ICP Records
echo "<div id='icpsdrop'>";
   echo "<form id='frmDownloadBl'>";
   echo "<input type='hidden' id='state' name='state' value='".$data['state']."'/>";
   echo "<input type='hidden' id='infotype' name='infotype' value='".$data['info']."'/>";
   	echo "Select a Project: <SELECT name='icpNo' id='icpNo'>";
	echo "<option value=''>Select Project ...</option>";
   foreach ($data['icpNos'] as $row) {
       echo "<option value='".$row->ID2."'>KE".number_format($row->ID2)."</option>";
   }
   	echo "</SELECT>";
	
	echo "</form>";
	echo "<button onclick='downloadblforms(\"frmDownloadBl\");'>Find</button>";
echo "</div>";

echo "</div>";
?>