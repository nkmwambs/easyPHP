<?php
echo "You currently using  <b>".$data."'s</b> user profile<br><br>";
echo "<form id='frmSwitch' class='switchElem'><label for='username'>Username</label> <input type='text' name='username' id='username'/></form>".img_tag("search.png",array("class"=>"switchElem","id"=>"searchglass","onclick"=>'searchUser("username");'))."<br><br><button id='btnUserSearch' onclick='switchUser(this);'>Switch?</button>";



?>