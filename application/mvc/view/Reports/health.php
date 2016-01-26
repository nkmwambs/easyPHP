<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Reports/malnutrition","[Malnutrition Report]");
}else{
	echo Resources::a_href("Reports/nonicpmalnutrition","[Malnutrition Report]");
}

echo "<hr>";
?>