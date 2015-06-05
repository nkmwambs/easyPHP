<?php
echo "<div>".a_tag("Business/newHelpRequest",img_tag("plus.png"))." New |</div>";
?>
<table id='helpTable'>
    <thead>
        <tr><th>Ticket ID</th><th>Ticket Date</th><th>Requestor Name</th><th>Ticket State</th></tr>
    </thead>
    <tbody>
        <?php
        $state=array("New","In-Progress","Closed");
            foreach($data as $ticket):
                
                echo "<tr><td>".a_tag("Business/getHelpDetails/rec/".$ticket->reqID,$ticket->reqID)."</td><td>{$ticket->reqDate}</td><td>{$ticket->fromName}</td><td>".$state[$ticket->reqState]."</td></tr>";
            endforeach;
        ?>        
    </tbody>
</table>