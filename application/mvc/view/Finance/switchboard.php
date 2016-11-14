<?php 
//print_r($data);
echo "<INPUT TYPE='hidden' id='tym' value='".strtotime(date('Y-m-d'))."'/>";

echo "<table id='tblFinanceView'>";
echo "<caption style='color:red;font-weight:bold;'>".Resources::img("inform.png")." Click on one of the content buttons followed by an ICP Tab</caption>";
echo "<tr><td colspan='2'>"; 
    echo "<fieldset style='margin:5px 5px 5px 5px;'>";
        echo "<legend>Content</legend>";
        echo "<input type='radio' name='chkContent' value='1' onclick='optionsSelect(this);'   id='rdecj' class='rds' checked/> Cash Journal";
        echo "<input type='radio' name='chkContent' value='2' onclick='optionsSelect(this);'   id='rdppbf' class='rds'/> PPBF";
        echo "<input type='radio' name='chkContent' value='3' onclick='optionsSelect(this);'   id='rdmfr' class='rds'/> Monthly Financial Report";
        echo "<input type='radio' name='chkContent' value='4' onclick='optionsSelect(this);'   id='rdciv' class='rds'/> CIVs";
        echo "<input type='radio' name='chkContent' value='5' onclick='optionsSelect(this);'   id='rdfunds' class='rds'/> Funds Disbursement";
    echo "</fieldset>";
	
	echo "<fieldset style='margin:5px 5px 5px 5px;display:none;'>"; 
	echo "<legend>Period</legend>";
	
	echo "<SELECT id='fy' style='display:none;float:left;'>";
		echo "<OPTION>Select FY ...</OPTION>";
		echo "<OPTION VALUE='16'>16</OPTION>";
		echo "<OPTION VALUE='17'>17</OPTION>";
		echo "<OPTION VALUE='18'>18</OPTION>";
		echo "<OPTION VALUE='19'>19</OPTION>";
		echo "<OPTION VALUE='20'>20</OPTION>";
	echo "</SELECT>";
	
	echo "<SELECT id='month' style='float:left;'>";
		echo "<OPTION VALUE=''>Select Month ...</OPTION>";
		echo "<OPTION VALUE='01'>January</OPTION>";
		echo "<OPTION VALUE='02'>February</OPTION>";
		echo "<OPTION VALUE='03'>March</OPTION>";
		echo "<OPTION VALUE='04'>April</OPTION>";
		echo "<OPTION VALUE='05'>May</OPTION>";
		echo "<OPTION VALUE='06'>June</OPTION>";
		echo "<OPTION VALUE='07'>July</OPTION>";
		echo "<OPTION VALUE='08'>August</OPTION>";
		echo "<OPTION VALUE='09'>September</OPTION>";
		echo "<OPTION VALUE='10'>October</OPTION>";
		echo "<OPTION VALUE='11'>November</OPTION>";
		echo "<OPTION VALUE='12'>December</OPTION>";
	echo "</SELECT>";  
	
	echo "<SELECT id='year' style='float:left;'>";
		echo "<OPTION VALUE=''>Select Year ...</OPTION>";
		echo "<OPTION VALUE='2015'>2015</OPTION>";
		echo "<OPTION VALUE='2016'>2016</OPTION>";
		echo "<OPTION VALUE='2017'>2017</OPTION>";
		echo "<OPTION VALUE='2018'>2018</OPTION>";
		echo "<OPTION VALUE='2019'>2019</OPTION>";
		echo "<OPTION VALUE='2020'>2020</OPTION>";
	echo "</SELECT>";  
	
	echo "</fieldset>";
	
echo "</td></tr>";
echo "<tr><th>Cluster</th><th>Implementing Church Partners</th></tr>";
foreach($data as $key=>$value):
    echo "<tr><td>".$key." (".count($data[$key]).")</td><td>";
    foreach ($data[$key] as $icp):
        echo "<div class='icpDivs' onclick='showContents(this);'>".$icp."</div>";
    endforeach;
    echo "</td></tr>";
endforeach;
echo "</table>";
?>