<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Reports/malnutrition","[Malnutrition Report]");
}else{
	echo Resources::a_href("Reports/nonicpmalnutrition","[Malnutrition Report]");
	echo Resources::a_href("Reports/viewhealthreportresponses","[Health Reports Feedback]");
}

echo "<hr><br>";

echo '<iframe src="https://docs.google.com/forms/d/1qXEBFcz8I1bAbrZpNDcUmoCV8oHz5EofLCF6TfXEDi4/viewform?embedded=true" style="width:100%;height:1800px;" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>';

?> 