<?php

?>
<table class='designerTable'>
    <thead>
    <tr><th>Child Name</th><th>Child Number</th><th>ICP No</th><th>Cluster</th><th>Sex</th><th>Date Of Birth</th><th>English</th><th>Kiswahili</th><th>Science</th><th>Mathematics</th><th>S/ Studies/RE</th><th>Total Marks</th></tr>
    </thead>
    <tbody>
    <?php
        foreach($data as $value){
            echo "<tr><td>".$value->childName."</td><td>".$value->childNo."</td><td>".$value->pNo."</td><td>".$value->cstName."</td><td>".$value->sex."</td><td>".$value->dob."</td><td>".$value->eng."</td><td>".$value->kis."</td><td>".$value->sci."</td><td>".$value->mat."</td><td>".$value->sstd."</td><td>".$value->totMrk."</td></tr>";
        }
    ?>
    </tbody>
</table>