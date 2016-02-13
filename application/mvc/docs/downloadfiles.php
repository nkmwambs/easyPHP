<?php

$file_name = $_GET['file_name'];
$cst = $_GET['cst'];
$icp = $_GET['icp'];
$grp = $_GET['grp'];

//$file_name = "KE787-0109_1341.docx";
//$cst = "Malindi-Kilifi";
//$icp = "KE787";


$filename = "../ftp/medical/".$grp."/".$cst."/".$icp."/".$file_name;

 if(file_exists($filename)){
 	    header('Content-type: application/force-download');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($filename));
        header('Accept-Ranges: bytes');
        @readfile($filename);
 }else{
 	echo "File not found";
 }


?>