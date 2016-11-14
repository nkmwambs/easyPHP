<?php
echo Resources::a_href("Finance/fundssummary","[Back]");
echo "<br><hr><br><br>";

//echo "<button onclick='excelexport()'>Export</button><br><br>";

echo Resources::table_filters("Funds Schedule Filter",array("KENumber"=>"KE Number","AccountDescription"=>"Accounts Description","civCode"=>"CIV Code","Amount"=>"Amount","Month"=>"Period"),"Finance/loadschedule","Finance/editschedulegrid");
echo "<div id='rst'></div>";
?>