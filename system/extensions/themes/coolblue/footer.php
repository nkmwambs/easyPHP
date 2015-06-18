            </div>            
            <div id="rt-bar" class="mid">
                <div id="lt-block"><div id="hdr-lft">Recent Items</div><br>
                    <div id="cnt-lt">
                        
                            <?php
                                if(is_array($data)){
                                    echo '<ul class="side-bar">';
                                //if(is_array($data)){
                                    foreach ($data as $value) {
                                        echo '<li>'.Resources::img($value->link_img).' '.Resources::a_href($value->url,$value->itemTitle,array('onclick'=>'recentItems("'.$value->itemTitle.'","'.$value->url.'","'.$_SESSION['ID'].'","'.$value->link_img.'");')).'</li>' ;
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

            
        </div>   
        <!--<div id="footer" class="cntr"><h8>Compassion Kenya Toolkit 2.0 &copy; 2015</h8></div>-->
    </body>
</html>