<?php
if(Resources::session()->userlevel==='5'||Resources::session()->userlevel==='8'||Resources::session()->userlevel==='9'||Resources::session()->userlevel==='10'||Resources::session()->userlevel==='11'){
		echo Resources::a_href("Training/register", "[New Participant]")." ".Resources::a_href("Training/viewparticipants", "[View Participation Sheet]");
		echo "<br><hr><br>";
		
		//print_r($data['icps']);
		
		echo "<table>";
		echo "<caption>Participants Register</caption>";
		echo "<tr><th>Training:</th><td>";
			echo "<SELECT id='training'>";
				echo "<OPTION VALUE=''>Select a Training ...</OPTION>";
				foreach ($data['rec'] as $value) {
					echo "<OPTION VALUE='".$value->tID."'>".$value->tdesc."</OPTION>";
				}
			echo "</SELECT>";
		echo "</td></tr>";
		
		echo "<tr><th>KE No:</th><td>";
			echo "<SELECT id='keno'>";
				echo "<OPTION VALUE=''>Select a KE No ...</OPTION>";
				foreach ($data['icps'] as $value) {
					echo "<OPTION VALUE='".$value."'>".$value."</OPTION>";
				}
			echo "</SELECT>".Resources::img("go.png",array("style"=>"cursor:pointer;","onclick"=>"retrievestaff();"));
		echo "</td></tr>";
		
		echo "<tr><th>Participants Name:</th><td>";
			echo "<SELECT id='participantsname'>";
			echo "<OPTION VALUE=''>Select Participant ...</OPTION>";
			echo "</SELECT>";
		echo "</td></tr>";
		
		echo "</table>";
		
		echo "<button onclick='checkregister();'>Mark Attended</button>";
}else{
	
}

?>