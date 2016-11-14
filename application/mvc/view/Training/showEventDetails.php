<?php 
print_r($data[0]);

/*
$urgency_arr=array("Low","Medium","High");
$active_arr =array("Not Active","Active");
$rec = $data[0];?>
<table id="viewMoreEvent" style="min-width:80%;">
    <caption>View Event <?php if($_SESSION['ID']===$rec->eventOwner&&$rec->eventActive==='1'){echo Resources::img("diskedit.png",array("onclick"=>"editEvent($rec->eventID);","style"=>"cursor:pointer;"));}?><br> Owner: <?php echo $rec->eventOwnerName;?></caption>
<?php
echo "<tr><td><b>Event Title: </b></td><td>{$rec->eventTitle}</td><td><b>Event Date: </b></td><td>{$rec->eventDate}</td><td><b>Event Location: </b></td><td>{$rec->eventLoc}</td></tr>";

echo "<tr><td colspan='6'><b>Event Description: </b></td></tr>";

echo "<tr><td colspan='6'>{$rec->eventDesc}</td><tr>";

echo "<tr><td><b>Invitees</b></td><td>{$rec->eventInivitees}</td><td><b>Urgency</b></td><td>{$urgency_arr[$rec->eventUrgency]}</td><td><b>Active?</b></td><td>{$active_arr[$rec->eventActive]}</td></tr>";

echo "<tr><td><b>Users Confirmed Attendance</b></td><td>&nbsp;</td><td colspan='4'>&nbsp;</td></tr>";

?>
</table>


