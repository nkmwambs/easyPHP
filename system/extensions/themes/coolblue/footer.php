                       
           </div> 
                        
			</div>  
            <div id="rt-bar" class="mid">
                <div id="lt-block"><div id="hdr-lft"><?php echo Resources::translate_item("recent_item_footer");?></div><br>
                    <div id="cnt-lt">
                        
                            <?php
                                if(is_array($data)){
                                    echo '<ul class="side-bar">';
                                //if(is_array($data)){
                                    foreach ($data as $value) {
                                    	//if(isset($value->langid)||!empty($value->langid)){
                                    		//echo '<li>'.Resources::img($value->link_img).' '.Resources::a_href($value->url,Resources::translate_item($value->langid),array('onclick'=>'recentItems("'.$value->itemTitle.'","'.$value->url.'","'.$_SESSION['ID'].'","'.$value->link_img.'");')).'</li>' ;
                                    	//}else{
                                    		echo '<li>'.Resources::img($value->link_img).' '.Resources::a_href($value->url,$value->itemTitle,array('onclick'=>'recentItems("'.$value->itemTitle.'","'.$value->url.'","'.$_SESSION['ID'].'","'.$value->link_img.'","None");')).'</li>' ;
                                    	//}
                                        	
                                    }
                                    //}
                                    echo '</ul>';
                                }  else {
                                    echo "No Items";
                                }
                            ?>
                       
                        
                    </div>
                </div>
                
            </div><br>
             
        <!--<div id="footer" class="cntr"><h8>Compassion Kenya Toolkit 2.0 &copy; 2015</h8></div>-->
        <?php
        	if(Resources::session()->userlevel!=='0'){
        ?>
        	<div id='chat_main_div' onclick="expandchatbox()"><div id='chat_header'>Toolkit ChatBox &#9679;</div></div>
        <?php
        }
        ?>

    </body>
</html>