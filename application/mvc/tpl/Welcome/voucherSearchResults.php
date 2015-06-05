<?php
//print_r($data);
echo a_tag("Finance/viewAll","<button>Search</button>")." ".img_tag("print.png",array("onclick"=>'printData("tblSearchResults");'));
if(is_array($data)&&!empty($data)){
$keys = array_keys((array)$data[0]);
//print_r($keys);
echo "<br><br><div id='divResults' onmouseover='displayScroll(this);' onmouseout='hideScroll(this);'>";
echo "<table border='1' id='tblSearchResults'><tr>";
foreach($keys as $value):
   echo "<th>".$value."</th>";
endforeach;
echo "</tr>";
foreach($data as $val):
    echo "<tr>";
        foreach($val as $ky=>$elem):
            //if($ky==='studentKey'){
              //  echo "<td>".img_tag("manage2.png",array("title"=>$elem,"onclick"=>'completeDraftStudent(this);'))."</td>";
            //}else{
                echo "<td>".$elem."</td>";
            //}
        
        endforeach;
    echo "</tr>";
endforeach;
echo "</table>";
echo "</div>";
}else {
    echo "<div id='error_msg'>Error: The search could not be completed!<div>";
}
?>
