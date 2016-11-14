<?php
//print_r($data[1]);
$rec= $data[1][0];
?>
<form id="tblNewEvent">
<table style="border:1px orange solid;max-width:80%;">
    <caption><?php echo img_tag("diskedit.png",array("onclick"=>"postEditedEvent();","style"=>"cursor:pointer;"));?> Edit Event ID - <?php echo $data[0];?></caption>
    <tr><td><input type="text" id="eventTitle" name="eventTitle" title="Event Title" placeholder="Event Title" value="<?php echo $rec->eventTitle;?>"/></td><td><input type="text" id="eventDate" name="eventDate" readonly="readonly" placeholder="Event Date" title="Event Date" value="<?php echo $rec->eventDate;?>"/></td><td><input type="text" id="eventLoc" name="eventLoc" placeholder="Event Location" title="Event Location"  value="<?php echo $rec->eventLoc;?>"/></td><td colspan="3" align='center'></td><td rowspan="3" style="border-left:1px black solid;padding:0px 10px 0px 10px;">
            Event Re-Occurence<br>
            <div style="max-width:100%;">
                <select name="occurSeq" id="occurSeq"><option value='0'>For</option><option value="1">Every</option>
                <input type="text" id="occurNum" name="occurNum" placeholder="Number Of" title="Number Of"/>
                <select name="occurPeriod" id="occurPeriod"><option value="0">Days</option><option value="1">Weeks</option><option value="2">Months</option></select>
                <input type="checkbox" id="occurWdy" name="occurWdy" value="0"/> Include Weekends
            </div>
            </td>
        </tr>
        <tr><td colspan="3" align='center'><textarea id="eventDesc" name="eventDesc" rows='10' cols="70" placeholder="Event Description" title="Event Description" style="overflow:auto;"><?php echo $rec->eventDesc;?></textarea></td></tr>
    <tr><td colspan=""><div style="float: left;width:50%;"><input type="text" id="eventInivitees" name="eventInivitees" placeholder="Invite Users" title="Invite Users" readonly value="<?php echo $rec->eventInivitees;?>"/></div><div style="float: left;width: 50%;"><?php echo img_tag("search2.png",array("style"=>"cursor:pointer;position:relative;left:55px;top:5px;"));?></div></td><td><select id="eventUrgency" name="eventUrgency" title="Urgency"><option value="">Choose Urgency</option><option value="0">Low</option><option value="1">Medium</option><option value="2">High</option></select></td><td>&nbsp;</td></tr>
    <tr><td colspan="4" align='center'><?php echo img_tag("disksave.png",array("title"=>"Add Event","onclick"=>"newEvent(tblNewEvent);"))." ".img_tag("clear.png",array("title"=>"Reset"));?></td></tr>
    
    

</table>
</form>