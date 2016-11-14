<?php
		//print_r($data['staff']);
		echo "<table>";
		echo "<form id='frmmark'>";
		echo "<caption>Invitation Register</caption>";
		echo "<tr><th>Staff Name</th><th>KE Number</th><th>Attended <INPUT TYPE='checkbox' onclick='chkAll(this);'/></th></tr>"; 
		
		foreach ($data['staff'] as $value) {
			$chked = "";
			//if($value->trainingID>0){
				//$chked="checked";
			//}
			echo "<tr><td><INPUT TYPE='hidden' VALUE='".$value->ID."' name='userID[]'/>".$value->userfirstname." ".$value->userlastname."</td><td>".$value->fname."</td><td><INPUT TYPE='checkbox' class='chks' $chked name='attended[]'/></td></tr>";
		}
		echo "</form>";
		echo "<tr><td colspan='3'><button onclick='markAttended(\"frmmark\");'>Mark Attended</button></td></tr>";
		echo "</table>";
		

?>