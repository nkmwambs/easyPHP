<?php
if(Resources::session()->userlevel==="1"){
	$visibility="display:none;";
}else{
	$visibility="display:block;";
}
//print_r($data['rec']);
echo "<div style='".$visibility."'>";
echo "Select Query: <SELECT id='qrySelect' onchange='setQuery(\"frmQry\");'>";
echo "<option value=''>Select Query ... </option>";
foreach ($data['rec'] as $value) {
	echo "<option value='".$value->qryDetail."'>".$value->qryName."</option>";
}
echo "</SELECT><br><br>";
//echo "<div style='margin-left:auto;margin-right:auto;'>";
//echo "Query Name:<input type='text' id='qryName' name='qryName'/><br><br>";
//echo "<button onclick='newQuery(\"frmQry\");'>New Query</button><button onclick='highlight(\"qryView\");'>Update Query</button>"; 

//echo "<div style='".$visibility."'>";
echo "<form id='frmQry'>";
echo "SELECT: <textarea id='query' name='query' rows='5' cols='80' style='overflow:auto;'></textarea>";
echo "<br><br>";
echo "</form>";
echo "<button onclick='queryView(\"frmQry\");'>Search</button>";
echo "<button onclick='rstQry();'>Reset</button>";

//echo "</div>";

echo "<br><br><div id='qryView'></div><br>";
echo "<br><br><div id='rsView'></div>";
//echo "</div>";

echo "</div>";
?>