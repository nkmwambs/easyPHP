<?php
//print_r($data['menu']);
//Position List
$list = "";

foreach ($data['pos'] as $value) {
	$list .= "<INPUT TYPE='checkbox' name='pos[]' VALUE='".$value->posID."'/> ".$value->title."<br>";
}

//Icons
$icons = "";

foreach ($data['icons'] as $value) {
	$icons .= "<div style='border:1px solid black;padding:5px;width:80px;height:40px;float:left;'><INPUT TYPE='radio' name='link_img' VALUE='".$value."'/>".Resources::img($value)."</div>";
}


//Menu Table

$menu = "<table>";
$menu .= "<tr><th>Title</th><th>Icon</th><th>Administrator?</th></tr>";
$rw = 0;
foreach ($data['menu'] as $value) {
	$menu .= "<tr><td class='tds' id='".$rw."_".$value->selfTitle."_selfTitle' onclick='editmenu(this)'>".$value->selfTitle."</td><td  class='tds' id='".$rw."_".$value->link_img."_img' onclick='editmenu(this)'>".$value->link_img." ".Resources::img($value->link_img)."</td><td  class='tds' id='".$rw."_".$value->admin."_admin' onclick='editmenu(this)'>".$value->admin."</td></tr>";
	$rw++;
}
$menu .= "</table>";


$grid['Menu Manager']['New Menu']=array(
	"<form id='frmcreatemenu'>",
	"<INPUT TYPE='text' placeholder='Title' name='selfTitle'/>",
	"<INPUT TYPE='text' placeholder='Category' name='controller'/>",
	"<INPUT TYPE='text' placeholder='Sub-Category' name='method'/><br>",
	"<fieldset style='width:30%;float:left;'>",
	"<legend>User Levels</legend>",
	$list,
	"</fieldset>",
	"<fieldset style='width:60%;'>",
	"<legend>Menu Icons</legend>",
	$icons,
	"</fieldset><br>",
	"Is Top Menu <INPUT TYPE='checkbox' name='top' VALUE='1'/><br>",
	"Is Administrator <INPUT TYPE='checkbox' name='admin' VALUE='1'/><br>",
	"Is Public <INPUT TYPE='checkbox' name='public' VALUE='1'/>",
	"</form>",
	"<INPUT TYPE='button' VALUE='Create' onclick='createmenu()'>"
	
	
);
$grid['Menu Manager']['Edit/ Delete Menu']=array(
	$menu
);
//$grid['Menu Manager']['Delete Menu']=array();
$grid['Menu Manager']['Upload Menu Icon']=array();

echo Resources::smart_grid($grid);

?>