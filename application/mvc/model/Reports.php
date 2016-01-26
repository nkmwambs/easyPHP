<?php
class Reports_Model extends E_Model
{
   public function queryTables($getSql){
        $getQry = $this->conn->prepare($getSql);
		$getQry->execute();
		$rst = array();
        while ($row = $getQry->fetch(PDO::FETCH_OBJ)) {
            $rst[]=$row;
        }
        return $rst;
   } 
   
   public function cspRptQtrs(){
   		$sql = "SELECT period FROM csp_monthly_report GROUP BY period";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$rst = array();
		while($row = $query->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row->period;
		}
		return $rst;
   }
   
   public function getTableColumns($tbl){
   		 	$s = "SHOW FULL COLUMNS FROM `".$tbl."` FROM `mvc`";
         	$q = $this->conn->prepare($s);
			$q->execute();
			while($row = $q->fetch(PDO::FETCH_OBJ)){
				$rst[$row->Field]=$row->Comment;
			}
			return $rst;
   }
}