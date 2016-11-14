<?php
echo "<button onclick='adjust_financial_year(\"p\");' style='float:left;'><< FY</button><input style='float:left;height:30px;width:50px;margin-right:10px;' type='text' id='curFy' value='".$data[0]."' readonly/><button onclick='adjust_financial_year(\"n\");' style='float:left;'>FY >></button>";
echo "<br><br><hr>";
echo "<button onclick='showNewPlansItems();'>New Items</button><button onclick='viewPlans();'>Schedules and Summaries</button>";
echo "<br><br><hr>";
echo "<div id='resultsDiv'>View Results Here</div>";
?>