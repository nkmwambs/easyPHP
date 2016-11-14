<?php
if(Resources::session()->userlevel==='19'){
	//echo "<a href='http://localhost/tcpt/main.php' target='__blank'>Beneficiary Registration Forms</a>"; 
	echo Resources::a_href("ProgramCommunication/main", "Beneficiary Registration Forms");
}
?>