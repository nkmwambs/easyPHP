<?php

class Claims_Model extends E_Model
{
    public function chatFrmUsersNames($frmid="",$toid=""){
        if($frmid!==""){
            $sql = "SELECT * FROM users WHERE ID=$frmid";
        }elseif ($toid!=="") {
            $sql = "SELECT * FROM users WHERE ID=$toid";
        }
        //$query =mysql_query($sql);
        $query = $this->conn->prepare($sql);
		
        if($query){
        	$query->execute();
            //$obj = mysql_fetch_object($query);
            $obj = $query->fetch(PDO::FETCH_OBJ);
            return $obj->fname;
        }  else {
            return 0;
        }
    }
    
    public function chatToUserId($toFname) {
        $sql = "SELECT * FROM users WHERE fname='".$toFname."'";
        //$query =mysql_query($sql);
        $query=$this->conn->prepare($sql);
        if($query){
        	$query->execute();
			$num=$query->rowCount();
            //$num = mysql_num_rows($query);
            if($num>0){
            	$obj=$query->fetch(PDO::FETCH_OBJ);
                //$obj = mysql_fetch_object($query);
                return $obj->ID;
            }else{
                return 0;
            }
        }  else {
            echo "Error Occurred!". $this->conn->errorInfo();
        }
    }
    
    public function batchUpdateMedical($rmk,$rec) {
        if(is_array($rec)){
            $sql = "UPDATE claims SET rmks = $rmk WHERE rec IN(".implode(",",$rec).")";
            //$query = mysql_query($sql);
            $query=$this->conn->prepare($sql);
            if($query){
            	$query->execute();
                //$cnt_affected_rows = mysql_affected_rows();
                return 1;//$cnt_affected_rows." record(s) updated successfully!"; 
            }  else {
                return 0;//"Error occurred: ".mysql_error();
            }
        }
    }
    
    public function uploadReceipt($randNo,$rec,$newfilename,$grp){
    	$sql = "UPDATE claims SET randomID='".$randNo."',rct='".$newfilename."' WHERE rec='".$rec."'";
		$grp="";
    	if($grp==='supportdocs'){
    		$sql = "UPDATE claims SET randomID='".$randNo."',refNo='".$newfilename."' WHERE rec='".$rec."'";
    	}
            
            //$qry = mysql_query($sql);
            $qry = $this->conn->prepare($sql);
            if($qry){
            	$qry->execute();
                return 1;
            }  else {
                return "Error in updating random number: ".$this->conn->errorInfo();
            }
    }
	    public function uploadRef($randNo,$rec,$newfilename){
            $sql = "UPDATE claims SET randomID='".$randNo."',refNo='".$newfilename."' WHERE rec='".$rec."'";
            //$qry = mysql_query($sql);
            $qry = $this->conn->prepare($sql);
            if($qry){
            	$qry->execute();
                return 1;
            }  else {
                return "Error in updating random number: ".$this->conn->errorInfo();
            }
    }
            
}
