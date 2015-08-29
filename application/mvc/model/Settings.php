<?php
class Settings_Model extends E_Model
{
	public function fetchSchedulesforFy($cond){
		$sql = "SELECT * FROM planheader RIGHT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID $cond";
		$qry = $this->conn->prepare($sql);
		$qrys->execute();
		$rst=array();
		while($row=$qry->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row;
		}
		return $rst;;
		
	}
		public function scheduleCount($cond){
		$sql = "SELECT  planHeaderID,count(`planHeaderID`) as planID FROM plansschedule";
		$qry = $this->conn->prepare($sql);
		$qry->execute();
		$rst=array();
		while($row=$qry->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row;
		}
		return $rst;;
		
	}
		
public function getUsersByPosition($cond){
		$sql = "SELECT users.ID,users.username,users.userfirstname,users.userlastname,users.fname,users.cname,users.email,users.admin,users.delegated_role,users.department,users.logs_after_register,users.auth,users.reffererID FROM users LEFT JOIN positions ON users.userlevel=positions.pstID $cond";
		$qry = $this->conn->prepare($sql);
		$qry->execute();
		$rst=array();
		while($row=$qry->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row;
		}
		return $rst;
}

public function getUserLogs(){
		$sql = "SELECT users.cname as Cluster,users.fname as KENo, from_unixtime(max(user_sessions.sess_start)) as log_time,users.logs_after_register as No_Of_Logs FROM user_sessions LEFT JOIN users ON user_sessions.user_id=users.ID GROUP BY users.fname ORDER BY users.cname";
		$qry = $this->conn->prepare($sql);
		$qry->execute();
		$rst=array();
		while($row=$qry->fetch(PDO::FETCH_OBJ)){
			$rst[]=$row;
		}
		return $rst;
}
     
}