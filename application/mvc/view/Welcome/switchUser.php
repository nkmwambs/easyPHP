<?php
echo "You currently using  <b>".$data."'s</b> user profile. Your original Profile is <b>".Resources::session()->userfirstname_backup."</b><br><br>";
echo "<div id='frmSwitch' class='switchElem'>";
echo "<label for='username'>Username</label> <input type='text' name='username' id='username' readonly/>";
echo "</div>";

/*
<!--<a href="http://localhost/easyPHP/mvc/Welcome/userpop" onclick="javascript:void window.open('http://localhost/easyPHP/mvc/Welcome/userpop','searchusers','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">[Search User]</a>-->
*/

echo Resources::a_href("","[Search Users]",array("onclick"=>'javascript:void window.open("http://localhost/easyPHP/mvc/Welcome/userpop","searchusers","width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0");return FALSE'));
echo Resources::img('go.png',array("Title"=>"Search",'onclick'=>'switchUser(this)','id'=>'btnUserSearch'));
?>