<div id='right_bar' class="bars"><?php echo Resources::img("recent.png"); ?> Recent Activities<br>
    <ul style="list-style: none;">
     	<?php
        //print_r($data);
    if(is_array($data)){
 	foreach ($data as $value) {
		echo '<li>'.Resources::img($value->link_img).' '.Resources::a_href($value->url,$value->itemTitle,array('onclick'=>'recentItems("'.$value->itemTitle.'","'.$value->url.'","'.$_SESSION['ID'].'","'.$value->link_img.'");')).'</li>' ;
	 }
        }
 	?>
    </ul>
</div>
<?php

echo Resources::img("books.png",array("style"=>"width:50px;position:fixed;top:180px;right:20px;","id"=>"","class"=>"books"));
echo Resources::img("books.png",array("style"=>"width:50px;position:fixed;top:180px;left:10px;","id"=>"","class"=>"books"));
echo Resources::img("books.png",array("style"=>"width:50px;position:fixed;top:490px;left:10px;","id"=>"","class"=>"books"));
echo Resources::img("books.png",array("style"=>"width:50px;position:fixed;top:490px;right:20px;","id"=>"","class"=>"books"));
?>
</div>

<div id="foot"></div>
</div>

</body>
</html>