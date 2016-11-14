<?php
echo Resources::a_href("Exams/viewKcpe","[Back]");

//print_r($data);

echo "<br><hr><br>";

echo "<form id='adddetails'>";
echo "<table>";
echo "<caption>Editing record ID: ".$data['rid']." (".$data['childName'].")</caption>";
echo "<tr><th>1. Name of the Secondary school the students was called to?</th><td><INPUT class='req' TYPE='text' name='schoolto' value='".$data['schoolto']."'/></td></tr>";

//$schoollevel = $data['schoollevel'];

echo "<tr><th>2. Secodary School Level</th><td><SELECT name='schoollevel' class='req'><OPTION VALUE=''>Select a level ...</OPTION>";

if($data['schoollevel'] === 'National') $national = 'SELECTED'; ELSE $national='';
if($data['schoollevel'] === 'Extra-County') $Extra_County = 'SELECTED'; ELSE $Extra_County='';
if($data['schoollevel'] === 'County') $County = 'SELECTED'; ELSE $County='';
if($data['schoollevel'] === 'Sub-County') $Sub_County = 'SELECTED'; ELSE $Sub_County='';
if($data['schoollevel'] === 'Private') $Private = 'SELECTED'; ELSE $Private='';
if($data['schoollevel'] === 'Vocational Training College') $Vocational = 'SELECTED'; ELSE $Vocational='';
if($data['schoollevel'] === 'Other') $Other = 'SELECTED'; ELSE $Other='';

echo "<OPTION VALUE='National' {$national}>National School</OPTION>";

echo "<OPTION VALUE='Extra-County' {$Extra_County}>Extra-County School</OPTION>";

echo "<OPTION VALUE='County' {$County}>County School</OPTION>";

echo "<OPTION VALUE='Sub-County' {$Sub_County}>Sub-County School</OPTION>";

echo "<OPTION VALUE='Private' {$Private}>Private</OPTION>";

echo "<OPTION VALUE='Vocational Training College' {$Vocational}>Vocational Training College</OPTION>";

echo "<OPTION VALUE='Other' {$Other}>Other</OPTION>";

echo "</SELECT></td></tr>";

echo "<tr><th>3. Total School Fees Per Year (<i>Enter Numeric Only without Comma a Separators</i>)</th><td><INPUT TYPE='text' id='feesperyear' name='feesperyear' value='".$data['feesperyear']."' class='req'/></td></tr>";

$yes = "";
$no = "";
$s_yes = "";
$s_no ="";

if($data['enrolledtothis']==='Yes') $yes = 'CHECKED'; ELSE $no ='CHECKED'; 

echo "<tr><th>4. Has the Student joined this School?</th><td>Yes<INPUT name='enrolledtothis' {$yes} TYPE='radio' VALUE='Yes'/> No<INPUT name='enrolledtothis' {$no} TYPE='radio' VALUE='No'/></td></tr>";

echo "<tr><th>5. If No in 4 above, where is the child currently enrolled?</th><td><INPUT TYPE='text' name='whereenrolledifno' value='".$data['whereenrolledifno']."'/></td></tr>";

if($data['sponsored']==='Yes') $s_yes = 'CHECKED'; ELSE $s_no ='CHECKED'; 

echo "<tr><th>6. Is the student's education costs covered non-compassion Sponsorship?</th><td>Yes<INPUT name='sponsored' TYPE='radio' {$s_yes} VALUE='Yes'/> No<INPUT name='sponsored' TYPE='radio' {$s_no} VALUE='No'/></td></tr>";

echo "<tr><th>7. If Yes in 6 above, Enter the organization name?</th><td><TEXTAREA name='rsnnotenrolled' col='40' rows='5'>".$data['rsnnotenrolled']."</TEXTAREA></td></tr>";

//echo "<tr><td colspan='2' onclick='editingkcpedetails(\"adddetails\",\"".$data['rid']."\")'></td></tr>";
echo "</table>";
echo "</form>";

echo "<button onclick='editingkcpedetails(\"adddetails\",\"".$data['rid']."\")'>Edit/ Create</button>";
?>