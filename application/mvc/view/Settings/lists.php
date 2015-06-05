<?php
//print_r($data);
?>
<html>
    <head>
        <title>Positions</title>
    </head>
    <body>
        <table class="designerTable">
            <thead><tr><th>Position ID</th><th>Position</th></tr></thead>
            <tbody>
                <?php foreach($data as $value){ ?>
                <tr><td><?php echo $value->pstID  ?></td><td onclick='xmlhttprequest("mvc/Positions/deletePosition/dsgn/<?php echo $value->dsgn;?>","1","0");'><?php echo $value->dsgn  ?></td></tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>