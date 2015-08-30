<div id="lt-bar" class="mid cntr">
                <div id="lt-block"><div id="hdr-lft"><?php echo Resources::translate_item("navigate_side_menu");?></div><br>
                    <div id="cnt-lt">
                        
                            <?php
                                if(!empty($data)){
                                    echo '<ul class="side-bar">';
                                       foreach ($data['side'] as $value) {
                                            echo '<li>'.Resources::img($value["img"]).' '.Resources::a_href($value["url"],Resources::translate_item($value["langid"]),array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>' ;
                                        }
                                    echo '</ul>';
                                }  else {
                                    echo "No Items";
                                }
                            ?>
                       
                        
                    </div>
                </div>
                
                
                <div id="lt-block" style="margin-bottom: 150px;"><div id="hdr-lft"><?php echo Resources::translate_item("who_online_side_menu");?> (Last 10 Users)</div><br>
                    <div id="cnt-lt">
                        
                            <?php
                                if(!empty($data)){
                                    echo '<ul class="side-bar">';
                                       foreach ($data['users'] as $value) {
                                            //echo '<li>'.Resources::img($value["img"]).' '.Resources::a_href($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>' ;
                                       		echo "<li>".Resources::img("user.png")." ".$value->user_fname."</li>";
                                        }
                                    echo '</ul>';
                                }  else {
                                    echo "No Items";
                                }
                            ?>
                       
                        
                    </div>
                </div>
                
            </div>
            
                        <div id="content" class="mid">