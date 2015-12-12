<?php
	//print_r($data['info']);
	
	echo "<table>";
	echo "<form id='frmlemone'>";
	
	echo "<caption>Learning Evaluation Level 1</caption>";
	echo "<col style='width:40%;'/><col style='width:20%;'/><col style='width:10%;'/><col style='width:30%;'/>";
	echo "<tr><th colspan='2' style='text-align:left;'>Training Title:</th><th colspan='2' style='text-align:left;'>".$data['rec']['header']['tdesc']."</th></tr>";
	echo "<tr><th style='text-align:left;'>Training Start Date:</th><td style='text-align:left;'>".$data['rec']['header']['startdate']."</td><th style='text-align:left;'>Training End Date:</th><td style='text-align:left;'>".$data['rec']['header']['enddate']."</td></tr>";
	echo "<tr><th colspan='2' style='text-align:left;'>Training Goal/ Overall Objective:</th><td colspan='2' style='text-align:left;'>".$data['rec']['header']['goal']."</td></tr>";
	echo "<tr><th style='text-align:left;'>Target Group:</th><td colspan='3' style='text-align:left;'>".$data['rec']['header']['targetgroup']."</td></tr>";
	echo "<tr><th style='text-align:left;'>Training Level:</th><td>".$data['rec']['header']['level']."</td><th style='text-align:left;'>Facilitor(s):</th><td style='text-align:left;'>".$data['rec']['header']['facilitatorsource']."</td></tr>";
	
	$x=0;
	$z=0;
	foreach ($data['rec']['sess'] as $value) {
		echo "<tr><th colspan='4'>".$value['sessdesc']."</th></tr>";
		$y=0;
		foreach ($data['rec']['qstns'] as $val) {
			echo "<INPUT TYPE='hidden' name='trainingID[$x][$y]' value='".$data['rec']['header']['tID']."'/>";
			echo "<INPUT TYPE='hidden' name='sessionID[$x][$y]' value='".$value['sessID']."'/>";
			echo "<tr><td>".$val['qdesc']."<INPUT TYPE='hidden' name='questionID[$x][$y]' value='".$val['qID']."'/></td><td colspan='2'>";
			for ($i=1; $i < 6; $i++) {
				$chk = "";	
				$ans = $data['info'][$z]['score']-$i;
				if($ans===0){
					$chk='checked';	
				}	
				echo "<INPUT type='radio' name='score[$x][$y]' value='".$i."' {$chk}/> ".$i;
				
			}
					
			echo "</td><td><INPUT TYPE='text' name='comment[$x][$y]' value='".$data['info'][$z]['comment']."'/></td></tr>";
			echo "<INPUT TYPE='hidden' name='usertoken[$x][$y]' value='".md5(Resources::session()->userfirstname)."'/>";
			$z++;
			$y++;
		}
		$x++;
	}
	echo "</form>";
	echo "</table>";
	
	echo "<button onclick='savelemone(\"frmlemone\");'>Save</button><button>Submit</button>";
?>