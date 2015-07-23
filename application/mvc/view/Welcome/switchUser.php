<?php
echo "You currently using  <b>".$data."'s</b> user profile<br><br>";
echo "<form id='frmSwitch' class='switchElem'>";
echo "<label for='username'>Username</label> <input type='text' name='username' id='username'/>";
echo "</form>";
//echo img_tag("search.png",array("onclick"=>'searchUser("username");'))."<br><br><button id='btnUserSearch' onclick='switchUser(this);'>Switch?</button>";
//echo "<button id='btnUserSearch' onclick='switchUser(this);'>Switch?</button>";
echo "<button  id='btnUserSearch' onclick='switchUser(this);'>Switch?</button>";

?>