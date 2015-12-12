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
$objPHPExcel->getProperties()->setDescription("Compassion Kenya Beneficiary Registration Form");

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
$table = "claims";
						
//PDO Database Connection
$conn = new PDO("mysql:host=$host;dbname=$dbase",$user,$pass);

//Start Date

$fromdate = '2015-11-01';
$todate = '2015-11-30';
$rmks=2;

$sql = "SELECT `claims` FROM ".$table." WHERE `rmks`=".$rmks." AND `date` > '".$fromdate."' AND `date` < '".$todate."'";
//if(isset($_GET['cst'])){
	//$sql .=" AND cst='".$_GET['cst']."'";
//}elseif(isset($_GET['icp'])){
	//$sql .=" AND pNo='".$_GET['icp']."'";
//}

						
$r=$conn->prepare($sql);
$r->execute();
									

$headStr=array(
				"KE No",
				"Cluster",
				"Child No",
				"Child Name",
				"Treatment Date",
				"Diagnosis",
				"Total Amount",
				"Caregiver Contribution",
				"NHIF Number",
				"Amount Reimbursement",
				"Facility Name",
				"Facility Type",
				"Claim Type",	
				"Claim Date",
				"Voucher Number"
			);
							
				
$arrVals=array();

while($row =$r->fetch(PDO::FETCH_ASSOC)){

	$arrVals[] = $row->proNo;
	$arrVals[] = $row->cluster;
	$arrVals[] = $row->childNo;
	$arrVals[] = $row->childName;
	$arrVals[] = $row->treatDate;
	$arrVals[] = $row->diagnosis;
	$arrVals[] = $row->totAmt;
	$arrVals[] = $row->careContr;
	$arrVals[] = $row->nhif;
	$arrVals[] = $row->amtReim;
	$arrVals[] = $row->facName;
	$arrVals[] = $row->facClass;
	$arrVals[] = $row->type;
	$arrVals[] = $row->date;
	$arrVals[] = $row->vnum;
	 
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
header('Content-Disposition: attachment;filename="Medical_Claims_Dowload_'.date('Y-m-d H:i:s').'.xlsx"');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();

$objWriter->save('php://output');

?>