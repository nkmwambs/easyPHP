<?php
class Settings_Model extends E_Model
{
	public function fetchSchedulesforFy($cond){
		$sql = "SELECT * FROM plansheader RIGHT JOIN plansschedule ON plansheader.planHeaderID=plansschedule.planHeaderID $cond";
		$qry = $this->conn->prepare($sql);
		$qry->execute();
		$rst=array();
		while($row=$qry->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row;
		}
		return $rst;;
		
	}
     
}