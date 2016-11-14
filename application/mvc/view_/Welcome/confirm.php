<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}

echo "<div id='error_div'>Action performed successfully. Click ".Resources::a_href($data['url'],'here')." to go back</div>";
?>