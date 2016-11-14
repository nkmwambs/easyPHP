<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Claims/medicalclaimrequest","[New Medical Request Form]");
}//elseif(Resources::session()->userlevel==='2'){
	echo Resources::a_href("Claims/medicalclaimapproval","[View Medical Requests]");
//}

echo "<br><hr><br>";
?>