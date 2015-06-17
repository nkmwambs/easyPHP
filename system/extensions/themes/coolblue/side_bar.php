<div id="lt-bar" class="mid cntr">
                <div id="lt-block"><div id="hdr-lft">Navigation</div><br>
                    <div id="cnt-lt">
                        
                            <?php
                                if(!empty($data)){
                                    echo '<ul class="side-bar">';
                                       foreach ($data as $value) {
                                            echo '<li>'.Resources::img($value["img"]).' '.Resources::a_href($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>' ;
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