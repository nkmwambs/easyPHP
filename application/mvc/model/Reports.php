<?php
class Reports_Model extends E_Model
{
   public function queryTables($getSql){
        $getQry = $this->conn->prepare($getSql);
		$getQry->execute();
        while ($row = $getQry->fetch(PDO::FETCH_OBJ)) {
            $rst[]=$row;
        }
        return $rst;
   } 
   
   public function cspRptQtrs(){
   		$sql = "SELECT period FROM csp_monthly_report GROUP BY period";
		$query = $this->conn->prepare($sql);
		$query->execute();
		while($row = $query->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row->period;
		}
		return $rst;
   }
}