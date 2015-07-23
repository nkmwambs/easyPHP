<?php
//print_r($data);
echo "<fieldset style='width:250px;float:left;'>";
echo "<legend>Budget Headers</legend>";
echo "<form  enctype='multipart/form-data' method='POST' name='frmPlansHeader' id='frmPlansHeader'>";
echo "<select name='fy' id='fy'><option value=''>Select FY ...</option><option value='15'>FY15</option><option value='16'>FY16</option><option value='17'>FY17</option><option value='18'>FY18</option></select>";
echo "<input type='file' name='plansheader' id='plansheader'/><br>";

echo "</form>";
echo "<button onclick='uploadPlans(\"frmPlansHeader\");'>Upload</button><button onclick='planHeaderView();'>View</button>";
echo "</fieldset>";

echo "<fieldset style='width:450px;float:left;'>";
echo "<legend>Budget Schedules</legend>";
echo "<form  enctype='multipart/form-data' method='POST' name='frmPlansSchedules' id='frmPlansSchedules'>";
echo "<select name='fy2' id='fy2'><option value=''>Select FY ...</option><option value='15'>FY15</option><option value='16'>FY16</option><option value='17'>FY17</option><option value='18'>FY18</option></select>";
echo "<SELECT id='icpNo' name='icpNo'><option value=''>Select KE No</option>";
	foreach ($data as $value) {
		echo "<option value='".$value->fname."'>".$value->fname."</option>";
	}
echo "</SELECT>";
echo "<SELECT id='planType' name='planType'><option value=''>Select Plan Type</option><option value='1'>Annual</option><option value='2'>Supplementary</option></SELECT>";
echo "<input type='file' name='plansschedules' id='plansschedules'/><br>";
echo "</form>";
echo "<button onclick='uploadSchedules(\"frmPlansSchedules\");'>Upload</button>";
echo "</fieldset>";
echo "<div id='planView' style='position:relative;top:70px;left:-2z0px;'></div>";
?>