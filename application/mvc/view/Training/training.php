<?php
//print_r($data['trainings']);
if(Resources::session()->userlevel==='1'){
			
		echo "<fieldset>";
		echo "<legend style='font-weight:bold;'>Choose a Training</legend>";
		echo "<INPUT TYPE='hidden' id='userdepartment' VALUE='".Resources::session()->department."'/>";
		echo "<INPUT TYPE='hidden' id='usertoken' VALUE='".md5(Resources::session()->userfirstname)."'/>";
		echo "Select a Training: <SELECT id='tID'>";
			echo "<OPTION VALUE=''>Select a Training ...</OPTION>";
			foreach ($data['trainings'] as $value) {
				echo "<OPTION VALUE='".$value->tID."'>".$value->tdesc."</OPTION>";
			}
		echo "</SELECT><br>";
		echo "<button onclick='loadlemoneform();'>Load Form</button>";
		echo "</fieldset>";
		
}elseif(Resources::session()->userlevel==='9'){
		echo Resources::a_href("Training/training", "[View Questions]")." ".Resources::a_href("Training/addlemquestion", "[Add a Question]")." ".Resources::a_href("", "[View Evaluation Results]");
		echo "<br><hr><br>";

		echo "<SELECT id='filterqstnstate'><OPTION VALUE=''>Select State ...</OPTION><OPTION VALUE='1'>Active</OPTION><OPTION VALUE='0'>Inactive</OPTION></SELECT>".Resources::img("go.png",array("style"=>"cursor:pointer;","onclick"=>'filterlemqstns();'));
		echo "<table id='info_tbl' style='margin-top:20px;'>";
			echo "<caption>Learning Evaluation One Questions<caption>";
			echo "<tr><th>QID</th><th>Details</th><th>State</th></tr>";
			$cnt=1;
			foreach ($data['qstns'] as $value) {
				$state = "";	
				if($value->status==='1'){
					$state=Resources::img("approved.png",array("style"=>"cursor:pointer;","onclick"=>"updatelemqstnstate(\"0\",\"".$value->qID."\",this);"));
				}else{
					$state=Resources::img("unapproved.png",array("style"=>"cursor:pointer;","onclick"=>"updatelemqstnstate(\"1\",\"".$value->qID."\",this);"));
				}
				echo "<tr><td>".$cnt."</td><td>".$value->qdesc."</td><td>".$state."</td></tr>";
				$cnt++;
			}
		echo "</table>";
}

?>