<?php
echo "<h4>External Links</h4>";
echo "<a href='http://www.compassionkenya.com/mwalimu' target='__blank'>Learning Management System</a><br>"; 
echo "<a href='http://www.forum.compassionkenya.com/forum' target='__blank'>Compassion Kenya Training and Support Board</a><br>";
if(Resources::session()->userlevel==='9'){
	echo "<a href='http://www.compassionkenya.com/phpjobscheduler/pjsfiles/' target='__blank'>Cron Job</a><br>";
}
if(Resources::session()->userlevel!=='1'){
	echo "<a href='http://www.compassionkenya.com/helpdesk' target='__blank'>Training and Support Ticketing</a>"; 	
}
//echo "<br><a href='http://www.compassionkenya.com/home/home.php' target='__blank'>CDPRs</a>"; 	

echo "<br><a href='http://compassion-ipg.com/cdu/Account/Login?ReturnUrl=%2fcdu' target='__blank'>Update Image Listing</a>";

//http://www.compassionkenya.com/mwalimu/
//echo "<br><a href='http://www.compassionkenya.com/mwalimu' target='__blank'>Learning Management System</a>"; 

echo "<br><a href='https://compassionintl.ethicspointvp.com/custom/compassionintl/childprotection/form_data.asp' target='__blank'>Ethics Point</a>"; 
//https://compassionintl.ethicspointvp.com/custom/compassionintl/childprotection/form_data.asp
?>
