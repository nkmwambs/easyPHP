<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}



$keno="";
if((Resources::session()->userlevel==='2'&&!isset($data['setPF']))||isset($data['setOther'])){
	//goto PF;
		echo "<table id='info_tbl' style='margin-top:25px;'>";
		echo "<caption>Statistics Of Indexed Beneficiaries</caption>";
		echo "<tr><th>KE No.</th><th>Index Count</th></tr>";
		foreach ($data['caseGrpByIcp'] as $key => $value) {
			echo "<tr><td>".Resources::a_href("Reports/manageHvc/state/1/icpNo/".$key, $key)."</td><td>".count($data['caseGrpByIcp'][$key])."</td></tr>";
		}
		echo "</table>";
}elseif(Resources::session()->userlevel==='1'){
	$keno=Resources::session()->fname;
	//goto ICP;
			echo "<input type='hidden' id='keno' value='".$keno."'/>";
			echo Resources::a_href("Reports/hvcIndexing","<button>Back</button>");
			
			echo "Sort By Active State:";
			echo "<SELECT id='stateSort'>";
				echo "<option value=''>Select State ... </option>";
				echo "<option value='1'>Active</option>";
				echo "<option value='0'>Inactive</option>";
			echo "</SELECT>";
			echo Resources::img("go.png",array("title"=>"Go","onclick"=>'stateSort()'));
			
			echo "<table id='info_tbl' style='margin-top:25px;'>";
			echo "<caption>HVC Index</caption>";
			echo "<tr><th>Action</th><th>Index Key</th><th>Cluster</th><th>ICP No</th><th>Program</th><th>Child Number</th><th>Child Name</th><th>Date Of Birth</th><th>Age</th><th>Gender</th><th>Vulnerability</th><th>No. Of Months</th><th>Type of Intervention required through HVC support</th><th></th><th>Other Non-HVC Interventions Required</th><th>Intervention suitable for the child</th><th>Future sustainability strategy</th><th>Active Case</th><th>Repeats</th></tr>";
			foreach ($data['allCases'] as $value) {
				echo "<tr><td>";
				if($value->active==='1'){
					echo Resources::img("uncheck3.png",array("title"=>"Inactive Case","style"=>"cursor:pointer;","onclick"=>'inactivateCase("'.$value->indID.'");'));
				}else{
					echo Resources::img("uncheck.png");
				}
				echo "</td>";
					foreach ($value as  $val) {
						echo "<td>{$val}</td>";
					}
				echo "</tr>";
			}
			echo "</table>";
}elseif(isset($data['setPF'])){
	$keno=$data['icpNo'];
	//goto ICP;
		echo "<input type='hidden' id='keno' value='".$keno."'/>";
		echo Resources::a_href("Reports/hvcIndexing","<button>Back</button>");
		
		echo "Sort By Active State:";
		echo "<SELECT id='stateSort'>";
			echo "<option value=''>Select State ... </option>";
			echo "<option value='1'>Active</option>";
			echo "<option value='0'>Inactive</option>";
		echo "</SELECT>";
		echo Resources::img("go.png",array("title"=>"Go","onclick"=>'stateSort()'));
		
		echo "<table id='info_tbl' style='margin-top:25px;'>";
		echo "<caption>HVC Index</caption>";
		echo "<tr><th>Action</th><th>Index Key</th><th>Cluster</th><th>ICP No</th><th>Program</th><th>Child Number</th><th>Child Name</th><th>Date Of Birth</th><th>Age</th><th>Gender</th><th>Vulnerability</th><th>No. Of Months</th><th>Type of Intervention required through HVC support</th><th></th><th>Other Non-HVC Interventions Required</th><th>Intervention suitable for the child</th><th>Future sustainability strategy</th><th>Active Case</th><th>Repeats</th></tr>";
		foreach ($data['allCases'] as $value) {
			echo "<tr><td>";
			if($value->active==='1'){
				echo Resources::img("uncheck3.png",array("title"=>"Inactive Case","style"=>"cursor:pointer;","onclick"=>'inactivateCase("'.$value->indID.'");'));
			}else{
				echo Resources::img("uncheck.png");
			}
			echo "</td>";
				foreach ($value as  $val) {
					echo "<td>{$val}</td>";
				}
			echo "</tr>";
		}
		echo "</table>";
}elseif(Resources::session()->userlevel>2&&!isset($data['setOther'])){
			echo "<table id='info_tbl' style='margin-top:25px;'>";
		echo "<caption>Statistics Of Indexed ICPs</caption>";
		echo "<tr><th>KE No.</th><th>Index Count</th></tr>";
		foreach ($data['caseGrpByCst'] as $key => $value) {
			//echo "<tr><td>".Resources::a_href("Reports/manageHvc/cst/".$key, $key)."</td><td>".count($data['caseGrpByCst'][$key])."</td></tr>";
			echo "<tr><td onclick='toogleHvcView(\"".$key."\");' style='color:blue;cursor:pointer;text-decoration:underline;'>".$key."</td><td>".count($data['caseGrpByCst'][$key])."</td></tr>";
		}
		echo "</table>";
}


?>