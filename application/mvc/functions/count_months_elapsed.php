<?php
function count_months_elapsed($date1, $date2)
{
$datetime1 = date_create($date1);
$datetime2 = date_create($date2);
$interval = date_diff($datetime1, $datetime2);
return $interval->format('%m')+1;
}
?>