<html>
	<head>
		<title>Offline Site</title>
	</head>
	<script>

	</script>
</html>
<?php
//echo "<div style='margin-left:400px;'>The site if offline for maintainance. You can login if you are an administrator</div>";
echo "<div style='width:180px;border-radius:5px;border:1px solid brown;margin-left:580px;padding:10px 10px 10px 10px;'>";
echo "<div style='color:red;margin-bottom:5px;'>".$data['msg']."</div>";

echo Resources::img('mantain.png');

echo "<form id='frmLogin' action='https://www.compassionkenya.com/easyPHP/mvc/Welcome/admin_log' method='POST'>";
echo "Username:<input type='text' name='username' id='username' placeholder='Username'/>";
echo "Password:<input type='password' name='password' id='password' placeholder='Password'/>";
echo "<INPUT TYPE='submit' style='margin-top:15px;' value='Login'/><button style='margin-top:15px;'>Reset</button>";
echo "</form>";

echo "</div>";
?>