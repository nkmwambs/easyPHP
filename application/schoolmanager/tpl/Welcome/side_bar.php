 <div id='left_bar' class='bars'>
     <?php if(count($data)===0){ echo "Items Unavailable";?>
     <?php }else{?>
          <ul class='side_bar_list'>
 	<?php
                   // print_r($data);
 	foreach ($data as $value) {
		echo '<li>'.img_tag($value["img"]).' '.a_tag($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>' ;
	 }
 	?>
          </ul>
     <?php } ?>
      </div>