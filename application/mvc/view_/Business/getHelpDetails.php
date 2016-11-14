<?php
$priority =array("Low","Medium","High");
$state=array("New","In-Progress","Resolved","Closed");
if($_SESSION['userlevel']==='14'||$_SESSION['userlevel']==='15'){$disp="block";}else{$disp="none";}
 echo '<div>'.Resources::a_href("Business/helpdesk",Resources::img("doc.png")).' View |</div>';
?>
<div style="background-color: lightcoral;padding: 10px; border-radius: 8px;color:white;">
<?php
        echo "<b>Ticket Details:</b><br> "
                . "<div class='span'><i>From:</i></div><div class='span'><u>".trim($data['original'][0]->fromName)."</u></div><br>"
                . "<div class='span'><i>Ticket Number: </i></div><div class='span'><u>".trim($data['original'][0]->reqID)."</u></div><br>"
                . "<div class='span'><i>Priority Date: </i></div><div class='span'><u>".  trim($data['original'][0]->reqAttendDate)."</u></div><br>"
                . "<div class='span'><i>Priority: </i></div><div class='span'><u>".  trim($priority[$data['original'][0]->reqPriority])."</u></div><br>" 
                . "<div class='span'>&nbsp;</div><div class='span'><select style='display:".$disp."' onchange='changePriority();'><option>Change Priority ... </option><option>Low</option><option>Medium</option><option>High</option></select></div><br>"
                . "<div class='span'><i>State: </i></div><div class='span'><u>".  trim($state[$data['original'][0]->reqState])."</u></div><br>"
                ."<div class='span'>&nbsp;</div><div class='span'><select style='display:".$disp."' onchange='changeState();'><option>Change State ... </option><option>New</option><option>In_progress</option><option>Resolved</option><option>Closed</option></select></div><br>"
                . "<div class='span'><i>Period Taken: </i></div><div class='span'><u>".trim($data['original'][0]->reqPeriod)." Days</u></div><br>";
?>
</div>
<div style="background-color: lightblue;padding: 10px; border-radius: 8px;margin-top: 15px;">
<div style="margin: 10px 0px 10px 0px;color: green;">Conversation</div>
<div style="border:2px white solid;padding:0px 10px 0px 10px;margin-top: 10px;min-height: 50px;">
    <?php
        echo "<b>".$data['original'][0]->fromName.": </b><i>".trim($data['original'][0]->reqDetails)."</i>";
    ?>
</div>
<?php
foreach($data['feedback'] as $fdbck):
    echo '<div style="border:2px white solid;padding:0px 10px 0px 10px;margin-top: 10px;min-height: 50px;">';
        echo "<b>".$fdbck->respBy.": </b><i>".trim($fdbck->fDetails)."</i>";
    echo '</div>';
endforeach;
?>
</div>
<div style="margin: 10px 0px 10px 0px;color: green;">Type your response here:</div>
<form id='frmhelpFeedback'>
<input type="hidden" name='user' value="<?php echo $_SESSION["username"]; ?>"/>
<input type="hidden" name='reqID' value="<?php echo $data["original"][0]->reqID; ?>"/>
<textarea cols="15" rows="5" class='msg' name='tadetails' id='tadetails'></textarea>
</form>
<br>
<button onclick='postHelpFeedback("frmhelpFeedback")'>Post</button>