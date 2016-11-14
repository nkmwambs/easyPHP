<?php
//print_r($data);
echo "<fieldset style='width:300px;'>";
echo "<form id='frmFundsUpload'>";
echo "<legend>Funds Balances Upload</legend>";
echo "<SELECT id='icpNo' name='icpNo'><OPTION VALUE=''>Select ICP ... </OPTION>";
foreach ($data as $value) {
	echo "<OPTION VALUE='".$value->fname."'>".$value->fname."</OPTION>";
}
echo "</SELECT>";
echo "<INPUT TYPE='text' id='closureDate' name='closureDate' readonly='readonly'/>";
echo "<INPUT TYPE='file' name='fundsCsv' id='fundsCsv'/>";
echo "</form>";
echo "<BUTTON onclick='massFundsUpload(\"frmFundsUpload\");'>Upload</BUTTON><BUTTON>Reset</BUTTON>";
echo "</fieldset>";
?>