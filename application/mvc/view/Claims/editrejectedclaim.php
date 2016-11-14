<?php
//echo $data['rec'];
echo Resources::a_href("Claims/viewMedicalClaims","[Back]");
echo "<br><hr><br><br>";

echo "<form id='editclaim'>";

echo "<table id='info_tbl'>";
echo "<caption style='font-weight:bold;'>Edit A Claim for ".$data['childName']." (Record ID: ".$data['rec'].")</caption>";

echo "<INPUT TYPE='hidden' name='rec' VALUE='".$data['rec']."'/>";
echo "<tr><th align='left'>Payment Date</th><td><INPUT TYPE='text' id='treatDate' name='treatDate' VALUE='".$data['treatDate']."' readonly/></td></tr>";
echo "<tr><th align='left'>Diagnosis</th><td><INPUT TYPE='text' id='diagnosis' name='diagnosis' VALUE='".$data['diagnosis']."' /></td></tr>";
echo "<tr><th align='left'>Total Amount</th><td><INPUT TYPE='text' id='totAmt' name='totAmt' VALUE='".$data['totAmt']."' /></td></tr>";
echo "<tr><th align='left'>Caregiver Contribution</th><td><INPUT TYPE='text' id='careContr' name='careContr' readonly VALUE='".$data['careContr']."' /></td></tr>";
echo "<tr><th align='left'>N.H.I.F</th><td><INPUT TYPE='text' id='nhif' name='nhif' VALUE='".$data['nhif']."' /></td></tr>";
echo "<tr><th align='left'>Amount Reimbursable</th><td><INPUT TYPE='text' id='amtReim' name='amtReim' readonly VALUE='".$data['amtReim']."' /></td></tr>";
echo "<tr><th align='left'>Facility Name</th><td><INPUT TYPE='text' id='facName' name='facName' VALUE='".$data['facName']."' /></td></tr>";
echo "<tr><th align='left'>Voucher No</th><td><INPUT TYPE='text' id='vnum' name='vnum' VALUE='".$data['vnum']."' /></td></tr>";
echo "<tr><th align='left'>Re-Upload Receipt</th><td><INPUT TYPE='file' name='rct' id='rct'/></td></tr>";
echo "<tr><th align='left'>Re-Upload Approval Document</th><td><INPUT TYPE='file' name='refNo' id='refNo'/></td></tr>";
echo "<INPUT TYPE='hidden' name='reinstatementdate' id='reinstatementdate' value='".date('Y-m-d')."'/>";
echo "</table>";

echo "</form>";

echo "<button onclick='editclaim(\"editclaim\")'>Update</button>";
?>