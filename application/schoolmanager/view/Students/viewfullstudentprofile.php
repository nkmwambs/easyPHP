<?php
//print_r($data['rec']);

$grid = array();

$refBio  = array();
$refLoc  = array();

foreach ($data['bio'][0] as $key=>$value) {
	$refBio[$key] = "<SPAN  style='float:left;margin:0px 25px 20px 15px;' id='".$key."'><span style='float:left;font-weight:bolder;color:black;'>".$key."</span>: ".$value."</SPAN>";
}
foreach ($data['loc'][0] as $key=>$value) {
	$refLoc[$key] = "<SPAN  style='float:left;margin:0px 25px 20px 15px;' id='".$key."'><span style='float:left;font-weight:bolder;color:black;'>".$key."</span>: ".$value."</SPAN>";
}

	$grid['Student Profile']['Bio-Data'] = $refBio;
	$grid['Student Profile']['Location Details'] = $refLoc;


echo Resources::smart_grid($grid);
?>