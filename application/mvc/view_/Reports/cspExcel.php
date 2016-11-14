<?php
 Resources::import("PHPExcel.Classes.PHPExcel");
 //require_once ("Classes/PHPExcel/IOFactory.php");
 Resources::import('PHPExcel.Classes.PHPExcel.Writer.Excel2007');
 
 $objPHPExcel = new PHPExcel();
 
  //Set workbook properties
$objPHPExcel->getProperties()->setCreator("Compassion Kenya Toolkit");
$objPHPExcel->getProperties()->setLastModifiedBy("Compassion Kenya Toolkit");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Compassion Kenya Cash Journal");

$objPHPExcel->setActiveSheetIndex(0);

$period="Q3";

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="CSP Report for '.$period.'.xlsx"');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');