<?php //echo $_SESSION['admin'];

echo "<div id='offlineDiv' style='width: 50%;border: 2px wheat solid;margin-left:auto;margin:100px auto 0px auto;text-align:center;'>";
echo "This site is offline for maintainance. If this problem persists for more than 24 hours, please contact the site administrator at <a href='mailto:easyphp4u@gmail.com?Subject=Enquiry'>easyphp4u@gmail.com</a><br>";
echo img_tag("mantain.png");
echo "<form id='adminLog'>";
echo "<table style='width:50%;margin:20px auto 0px auto;'>";
    echo "<caption><b>Administrator Login</b></caption>";
    echo "<tr><td><label for='username'>Username</label></td><td><input type='text' name='username' id='username'/></td></tr>";
    echo "<tr><td><label for='password'>Password</label></td><td><input type='password' name='password' id='password'/></td></tr>";
    echo "<tr><td colspan='2'><button formaction='".url_tag("Welcome/login/public/1")."' formmethod='POST'>Log In</button></td></tr>";
echo "</table>";
echo "</form>";
echo "</div>";
