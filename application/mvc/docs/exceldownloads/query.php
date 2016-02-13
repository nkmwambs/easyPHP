<?php
 require_once ("../../../../system/libs/PHPExcel/Classes/PHPExcel.php");
 //require_once ("Classes/PHPExcel/IOFactory.php");
 require_once ('../../../../system/libs/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');
 
 $objPHPExcel = new PHPExcel();
 
  
  //Set workbook properties
$objPHPExcel->getProperties()->setCreator("Compassion Kenya Toolkit");
$objPHPExcel->getProperties()->setLastModifiedBy("Compassion Kenya Toolkit");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Compassion Kenya Downloads");

$objPHPExcel->setActiveSheetIndex(0);
 
 /*
  * 
  * $host = "localhost";
*	$user = "compatl8_root";
*	$pass = "R3@l!s!ngCh!ldr3n"; 
*	$dbase = "compatl8_mvc";
*	$table = "indexing";
  * 
  */

$host = "localhost";
$user = "root";
$pass = "";
$dbase = "mvc";
//$table = "indexing";
						
//PDO Database Connection
$conn = new PDO("mysql:host=$host;dbname=$dbase",$user,$pass);

//Start Date

$sql = $_POST['sql'];

						
$r=$conn->prepare($sql);
$r->execute();
									

$headStr=explode(",", $_POST['headstr']);
							
				
$arrVals=array();

while($row =$r->fetch(PDO::FETCH_ASSOC)){

	$arrVals[] = array_values($row);
	 
}

$highestRow = sizeof($arrVals)-1;

$highestColumnIndex = sizeof($arrVals[0])-1;

for($i=0;$i<sizeOf($headStr);$i++){
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i,2,$headStr[$i]);
}



for ($rows = 0; $rows <= $highestRow; ++$rows) {
  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $rows+3,$arrVals[$rows][$col]);
  }

}

//End of Data


header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="download_'.date('Y-m-d H:i:s').'.xlsx"');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();

$objWriter->save('php://output');

?>