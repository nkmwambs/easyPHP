<?php
echo Resources::a_href("Reports/cdpr","[New Assessment]")." ".Resources::a_href("Reports/viewcdprgrid","[View Assessments]");
echo "<hr><br>";
echo "<table>";
echo "<caption>Individual Child Assessment: Search Beneficiary</caption>";
echo "<INPUT TYPE='hidden' id='KeNo' VALUE='".Resources::session()->fname."'/>";
echo "<tr><td>Child Number:</td><td><INPUT TYPE='text' id='childNo' name='childNo' onchange='checkcdprchildnumberformat();'/></td><td>Cognitve Age Group:</td><td><SELECT id='cognitiveagegroup' name='cognitiveagegroup'><OPTION VALUE=''>Select Age Group ...</OPTION><OPTION VALUE='3-5'>3-5</OPTION><OPTION VALUE='6-8'>6-8</OPTION><OPTION VALUE='9-11'>9-11</OPTION><OPTION VALUE='12-14'>12-14</OPTION><OPTION VALUE='15-18'>15-18</OPTION><OPTION VALUE='19+'>19+</OPTION></SELECT></td></tr>";
echo "</table>";
echo "<button onclick='getChildDetailsforCDPR();'>Load Form</button>";
?>