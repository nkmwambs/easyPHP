<?php
//print_r($data['funds']);
echo "<table style='width:100%;'>";
echo "<caption>Funds View for ID # ".$data['funds'][0]->balHdID."</caption>";
echo "<tr><th>Funds</th><th>Amount</th></tr>";
foreach ($data['funds'] as $value) {
	echo "<tr><td>".$value->funds."</td><td>".$value->amount."</td></tr>";
}
echo "</table>";
?>