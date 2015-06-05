<?php

class Claims_Model extends E_Model
{
    public function chatFrmUsersNames($frmid="",$toid=""){
        if($frmid!==""){
            $sql = "SELECT * FROM users WHERE ID=$frmid";
        }elseif ($toid!=="") {
            $sql = "SELECT * FROM users WHERE ID=$toid";
        }
        $query =mysql_query($sql);
        if($query){
            $obj = mysql_fetch_object($query);
            return $obj->fname;
        }  else {
            return 0;
        }
    }
    
    public function chatToUserId($toFname) {
        $sql = "SELECT * FROM users WHERE fname='".$toFname."'";
        $query =mysql_query($sql);
        if($query){
            $num = mysql_num_rows($query);
            if($num>0){
                $obj = mysql_fetch_object($query);
                return $obj->ID;
            }else{
                return 0;
            }
        }  else {
            echo mysql_error();
        }
    }
    
    public function batchUpdateMedical($rmk,$rec) {
        if(is_array($rec)){
            $sql = "UPDATE claims SET rmks = $rmk WHERE rec IN(".implode(",",$rec).")";
            $query = mysql_query($sql);
            if($query){
                //$cnt_affected_rows = mysql_affected_rows();
                return 1;//$cnt_affected_rows." record(s) updated successfully!"; 
            }  else {
                return 0;//"Error occurred: ".mysql_error();
            }
        }
    }
    
    public function uploadReceipt($randNo,$rec,$newfilename){
            $sql = "UPDATE claims SET randomID='".$randNo."' WHERE rec='".$rec."'";
            $qry = mysql_query($sql);
            if($qry){
                return 1;
            }  else {
                return "Error in updating random number: ".mysql_error();
            }
    }
            
}
