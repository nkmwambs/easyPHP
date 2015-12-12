<?php
       	//$file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cst.DS.$icpNo.DS.$bsKey;
       	$cst = $_POST['cst'];
       	$icpNo = $_POST['icpNo'];
       	$bsKey=$_POST['bsKey'].".pdf";
       	
       	$file ="../../ftp/finance/bankstatements/".$cst."/".$icpNo."/".$bsKey;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
?>