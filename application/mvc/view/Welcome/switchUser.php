<?php
echo "You currently using  <b>".$data."'s</b> user profile<br><br>";
echo "<div id='frmSwitch' class='switchElem'>";
echo "<label for='username'>Username</label> <input type='text' name='username' id='username'/>";
echo "</div>";
//echo Resources::img("search2.png",array("onclick"=>'searchUser();','id'=>'glass'));
echo Resources::img('go.png',array("Title"=>"Search",'onclick'=>'switchUser(this)','id'=>'btnUserSearch'));
?>