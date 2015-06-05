<?php
echo "<form>";
echo "<table style='width:60%;margin-left:auto;margin-right:auto;'>";
echo "<caption><b>User Profile</b></caption>";
echo "<thead>";
echo "</thead>";
echo "<tbody>";
echo "<tr><td><label for='fname'>First Name</label></td><td><input style='width:100%;' type='text' id='fname' name='fname' value='".$_SESSION['username']."' readonly/></td></tr>";
echo "<tr><td><label for='lname'>Last Name</label></td><td><input style='width:100%;'  type='text' id='lname' name='lname' value='".$_SESSION['lname']."' readonly/></td></tr>";
echo "<tr><td><label for='cname'>Cluster</label></td><td><input style='width:100%;'  type='text' id='cname' name='cname' value='".$_SESSION['cname']."' readonly/></td></tr>";
echo "<tr><td><label for='uname'>Email</label></td><td><input style='width:100%;'  type='text' id='uname' name='uname'  value='".$_SESSION['email']."'/></td></tr>";
echo "<tr><td><label for='oldPassword'>Old Password</label></td><td><input style='width:100%;'  type='text' id='oldPassword' name='oldPassword'/></td></tr>";
echo "<tr><td><label for='newPassword'>New Password</label></td><td><input style='width:100%;'  type='text' id='newPassword' name='newPassword'/></td></tr>";
echo "<tr><td><label for='newPasswordRepeat'>Repeat New Password</label></td><td><input style='width:100%;'  type='text' id='newPasswordRepeat' name='newPasswordRepeat'/></td></tr>";
echo "</tbody>";
echo "</form>";
echo "<tr><td colspan='2' style='text-align:center;padding-top:25px;'>".a_tag("Settings/profile",img_tag("diskedit.png", array("title"=>"Edit","onclick"=>"editUserProfile(\"Settings/profile\");")))."<td></tr>";
echo "</table>";
