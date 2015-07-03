<html>
	<head>
		<title>Error Message</title>
		<?php
		Resources::link();
		?>
	</head>
<body>
<?php
print("<div id='error_div'>".Resources::img("error.png")." Error Occurred:<br>The application requires Internet Explorer Version 11 and above! 
Please consider upgrading your browser or Installing the current version of Internet Explorer!</div>");
?>
</body>
</html>