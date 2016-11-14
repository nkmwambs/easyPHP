<?php
echo "<h4>External Links</h4>";
echo "<a href='http://www.compassionkenya.com/mwalimu' target='__blank'>Learning Management System</a>"; 
if(Resources::session()->userlevel!=='1'){
	echo "<a href='http://www.compassionkenya.com/helpdesk' target='__blank'>Training and Support Ticketing</a>"; 	
}
//print_r($data);

//echo "<ul>";
//foreach($data as $key=>$vals):
  //      echo "<li><a href='".$vals['href']."' target='".$vals['target']." style='".$vals['style']."'>".$vals['text']."</a></li>";
//endforeach;
//echo "</ul>";
