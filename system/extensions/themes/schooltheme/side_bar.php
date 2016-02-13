 <div id='left_bar' class='bars'>
     <?php if(count($data)===0){ echo "Items Unavailable";?>
     <?php }else{?>
          <ul class='side_bar_list'>
 	<?php
     //print_r($data);
 	foreach ($data['side'] as $value) {
		echo '<li>'.Resources::img($value["img"]).' '.Resources::a_href($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>' ;
	 }
 	?>
          </ul>
     <?php } ?>
      </div>
      
