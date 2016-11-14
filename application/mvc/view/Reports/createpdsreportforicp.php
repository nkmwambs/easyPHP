<?php
	echo Resources::a_href("Reports/pdsreportviewpf","[PD's Report Dashboard]");
	echo "<hr><br><br>";
echo "<b>Choose ICP</b>";
echo "<SELECT id='icpNo'>";
echo "<OPTION value=''>Choose ICP...</OPTION>";
	foreach ($data['rst'] as $value) {
		echo "<OPTION value='".$value->fname."'>".$value->fname."</OPTION>";
	}
echo "</SELECT>";

echo "<b>Period (First Day of the Month)</b><INPUT TYPE='text' id='toDate' placeholder='First day of the month'/>";

echo Resources::img("go.png",array("Title"=>"Create","onclick"=>'createpdsreportbypf()'));
?>