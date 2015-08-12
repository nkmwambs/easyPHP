<html>
	<head>
		<title>Offline Site</title>
	</head>
	<script>
	var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        
		function login(){
		    var frm = document.getElementById('frmLogin');  
		    var frmData = new FormData(frm);
		            xmlhttp.onreadystatechange=function() {
		            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
						//document.write(xmlhttp.responseText);
						//location.reload();
						document.getElementById('contains').innerHTML=xmlhttp.responseText;
		            }
		            
		        };
		                                               
		         xmlhttp.open("POST",path+"/mvc/Welcome/show/public/0",true);
		         xmlhttp.send(frmData);
		}
	</script>
</html>
<?php
echo "<div id='contains'>";
echo "<div style='margin-left:400px;'>The site if offline for maintainance. You can login if you are an administrator</div>";
echo "<div style='width:180px;border-radius:5px;border:1px solid brown;margin-left:580px;padding:10px 10px 10px 10px;'>";
echo "<div style='color:red;margin-bottom:5px;'>".$data['return']."</div>";
echo "<form id='frmLogin'>";
echo "Username:<input type='text' name='username' id='username' placeholder='Username'/>";
echo "Username:<input type='password' name='password' id='password' placeholder='Password'/>";
echo "</form>";
echo "<button style='margin-top:15px;'  onclick='login();'>Login</button><button style='margin-top:15px;'>Reset</button>";
echo "<div>";
echo "</div>";
?>