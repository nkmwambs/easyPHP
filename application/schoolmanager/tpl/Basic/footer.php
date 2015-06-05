<div id='right_bar' class="bars"><?php echo img_tag("recent.png"); ?> Recent Activities<br>
    <ul style="list-style: none;">
     	<?php
        //print_r($data);
        if(is_array($data)){
 	foreach ($data as $value) {
		echo '<li>'.img_tag($value->link_img).' '.a_tag($value->url,$value->itemTitle,array('onclick'=>'recentItems("'.$value->itemTitle.'","'.$value->url.'","'.$_SESSION['ID'].'","'.$value->link_img.'");')).'</li>' ;
	 }
        }
 	?>
    </ul>
</div>
<?php

echo img_tag("books.png",array("style"=>"width:50px;position:absolute;top:10px;right:-90px;","id"=>"","class"=>"books"));
echo img_tag("books.png",array("style"=>"width:50px;position:absolute;top:10px;left:-90px;","id"=>"","class"=>"books"));
echo img_tag("books.png",array("style"=>"width:50px;position:absolute;top:310px;left:-90px;","id"=>"","class"=>"books"));
echo img_tag("books.png",array("style"=>"width:50px;position:absolute;top:310px;right:-90px;","id"=>"","class"=>"books"));
?>
</div>

<div id="footer"><?php echo a_tag("","Site Map");?></div>

</body>
</html>