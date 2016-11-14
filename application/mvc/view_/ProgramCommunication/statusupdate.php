<?php
	$status = $_GET['status'];
	$recID=$_GET['rID'];
	$icpNo=$_GET['icpNo'];
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbase = "mvc";
    $table = "beneficiaryform";
						
    //PDO Database Connection
    $conn = new PDO("mysql:host=$host;dbname=$dbase",$user,$pass);
	
	$sql = "UPDATE ".$table." SET status=$status WHERE rID=$recID";
						
	$r=$conn->prepare($sql);
	$r->execute();
	
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=downloadforms.php?icpNo=$icpNo\">";
?>