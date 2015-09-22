<?php
function mpdf_output($html){
		Resources::import("mpdf/mpdf");
		$mpdf=new mPDF('c'); 
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
}
?>