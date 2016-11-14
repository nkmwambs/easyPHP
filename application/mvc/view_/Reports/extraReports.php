<?php
echo "<button onclick='getQueryResults()'>Run</button><br><br><br>";
//Query Fieldset
echo "<form id='qryfld'>";
echo "<fieldset style='width:30%;border:2px orange solid;float:left;'>";
echo "<legend style='font-weight:bold;'>Query Title</legend>";
	foreach($data['relate'] as $value):
		echo "<input type='radio' name='qryTitle' value='".$value->rID."' onclick='runquery(this)'/>".$value->qryTitle."<br>";
	endforeach;
echo "</fieldset>";


//Conditions Fieldset

echo "<fieldset id='conditions' style='border:2px orange solid;float:left;min-width:490px;min-height:50px;'>";
echo "<legend style='font-weight:bold;'>Conditions</legend>";

echo "</fieldset>";

echo "</form>";


//echo "<div id='query'></div>";
//echo "<div id='qryView'></div>";
echo "<div id='rsView'></div>";
?>