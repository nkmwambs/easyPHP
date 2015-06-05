<?php
echo "<h4>External Links</h4>";
//print_r($data);

echo "<ul>";
foreach($data as $key=>$vals):
        echo "<li><a href='".$vals['href']."' target='".$vals['target']." style='".$vals['style']."'>".$vals['text']."</a></li>";
endforeach;
echo "</ul>";
