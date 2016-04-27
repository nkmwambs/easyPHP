<?php

//Categories
$img = "";
$title = '';
$categories = "<table>";
$categories .= "<tr><th>Action</th><th>Category Title</th><th>Description</th></tr>";
foreach ($data['cat'] as $value) {
	if($value->active==='1'){
		$img='reject.png';
		$title = "Deactivate Category";
	}else{
		$img = "activate.png";
		$title = 'Activate Category';
	}
	
	$categories .= "<tr><td>".Resources::img($img,array("Title"=>$title,"style"=>"cursor:pointer;","onclick"=>"categoryactivation(\"".$value->catID."\",this)"))." ".Resources::img("editplain.png",array("Title"=>"Edit Category","style"=>"cursor:pointer;","onclick"=>"editcategory(\"".$value->catID."\",this)"))."</td><td>".$value->categoryname."</td><td>".$value->desc."</td></tr>";
}

$categories .="</table>";

$grid['Accounts Categories']['Add Categories']=array(
	"<INPUT TYPE='text' id='categoryname' placeholder='Category Title'/><br>",
	"<b>Category Description</b><br><TEXTAREA cols='150' rows='60' id='desc'></TEXTAREA>",
	"<INPUT TYPE='button' VALUE='Add Category' onclick='addcategory()'/>"
);
$grid['Accounts Categories']['Edit/ Delete Categories']=array(
	$categories
);

echo Resources::smart_grid($grid);
?>