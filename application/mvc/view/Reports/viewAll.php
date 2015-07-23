<?php
//echo $data;
//print_r($data);
echo "Select Query: <SELECT id='qrySelect' onchange='setQuery(\"frmQry\");'>";
echo "<option value=''>Select Query ... </option>";
foreach ($data as $value) {
	echo "<option value='".$value->qryDetail."'>".$value->qryName."</option>";
}
echo "</SELECT><br><br>";
echo "<div style='margin-left:auto;margin-right:auto;'>";


if(Resources::session()->userlevel==="1"){
	$visibility="display:none;";
}else{
	$visibility="display:block;";
}

//echo "<div style='".$visibility."'>";
echo "<form id='frmQry'>";
echo "Query Name:<input type='text' id='qryName' name='qryName'/><br><br>";
echo "SELECT: <textarea id='query' name='query' rows='5' cols='80' style='overflow:auto;' style='".$visibility."'></textarea>";
echo "<br><br>";
echo "</form>";
echo "<button onclick='queryView(\"frmQry\");' style='".$visibility."'>Search</button><button onclick='newQuery(\"frmQry\");' style='".$visibility."'>New Query</button><button onclick='highlight(\"qryView\");' style='".$visibility."'>Update Query</button><button onclick='rstQry();' style='".$visibility."'>Reset</button>";

//echo "</div>";

echo "<br><br><div id='qryView'></div><br>";
echo "<br><br><div id='rsView'></div>";
echo "</div>";
?>