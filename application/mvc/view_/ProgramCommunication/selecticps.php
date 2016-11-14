<?php
//Get ICP Records
echo "<span style='font-weight:bold;'>State:</span> ".$data['state_tag']."<br>";
echo "<span style='font-weight:bold;'>Information Type:</span> ".$data['info_tag']."<br>";
   echo "<form id='frmDownloadBl'>";
   echo "<input type='hidden' id='state' name='state' value='".$data['state']."'/>";
   echo "<input type='hidden' id='infotype' name='infotype' value='".$data['infotype']."'/>";
   	echo "Select a Project: <SELECT name='icpNo' id='icpNo'>";
	echo "<option value=''>Select Project ...</option>";
	echo "<option value='0' SELECTED>All</option>";
   foreach ($data['icpNos'] as $row) {
       echo "<option value='".$row->ID2."'>KE".number_format($row->ID2)."</option>";
   }
   	echo "</SELECT>";
	
	echo "</form>";
	echo "<button onclick='downloadblforms(\"frmDownloadBl\");'>Find</button>";
?>