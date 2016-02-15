<?php

class E_Model {
        
    protected $host;
    protected $user;
    protected $pass;
    protected $db;
    public $table;
    protected $dbase;
    protected $comments;
    protected $num_fields;
    protected $value_arr;
    protected $inner_arr;
    protected $combined;
    protected $selectdb;
   	protected $conn;
    


    public function __construct($table){
                       // $this->app=$GLOBALS['app'];
                        $this->host = DB_HOST;
                        $this->user = DB_USER;
                        $this->pass = DB_PASSWORD;
                        $this->dbase = DB_PREFIX.$GLOBALS['app'];
                        $this->table = $table;
                        //$this->db = mysql_connect($this->mysql_hostname, $this->mysql_user, $this->mysql_password) or die("Could not connect database");
                        //$this->selectdb = mysql_select_db($this->mysql_database, $this->db) or die("Could not select database");
    					//PDO Database Connection
    					$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbase",$this->user,$this->pass);
	}
    
public function condition($cond){
    //$cond = array(array("where","fld","val","operator"),array("OR","fld","val","operator"),array("AND","fld","val","operator"));
   if(is_array($cond)){
       $str ="";
       foreach($cond as $value):
           $str .=" ".$value[0]." ".$value[1]." ".$value[3]." '".$value[2]."' ";
       endforeach;
       return $str;
   }
} 
    
public function where($cond){
/*	
//$cond = array("where"=>array("fld","val","operator"),"OR"=>array("fld","val","operator"),"AND"=>array("fld","val","operator"));
    if(!array_key_exists("where", $cond)){
        return $this->condition($cond);
    }  else {
            
        if(is_array($cond)){
            $str = "";
            foreach($cond as $k=>$v){
                $str .=" ".$k." ".$v[0]." ".$v[2]." '".$v[1]."' ";
            }

            return $str;
        }
    }
 * 
 */
 
 //$cond = array("where"=>array("fld","val","operator"),"OR"=>array("fld","val","operator"),"AND"=>array("fld","val","operator"));
    //if(!array_key_exists("where", $cond)){
      //  return $this->condition($cond);
    //}  else {
            
        if(is_array($cond)){
            $str = "";     
            foreach($cond as $k=>$v){      
            	if(is_array($v[0])){
            		$str.=" ".$v[0][0]." (";
	            		foreach ($v as $ky => $val) {
	            			if($ky===0){
	            				$str .=" ".$val[1]." ".$val[3]." '".$val[2]."' ";
	            			}else{
	            				$str .=" ".$val[0]." ".$val[1]." ".$val[3]." '".$val[2]."' ";
	            			}		
						}
						
					$str.=")";
					
            	}else{
            		if($v[3]==='BETWEEN'){
            			$str .= " ".$v[0]." ".$v[1]." ".$v[3]." ".$v[2]." ";
					
					}
					else if($v[3]==='LIKE'){
						$str .= " ".$v[0]." ".$v[1]." LIKE '%".$v[2]."%' ";
					
            		}else{
            			$str .= " ".$v[0]." ".$v[1]." ".$v[3]." '".$v[2]."' ";
            		}
            		
            	}
            }

            return $str;
        }
    
	//}
    }

public function tableJoins($joins=array()){
	//array(JoinType=>array(table1=>table1Key,table2=>table2Key))
	
	//Output String
	$join_str="";
	
	//Joined Tables array
	$joinTables = array();
	
	//Join Fields
	$joinFields = array();
	
	//Join Fields Number
	$joinCount = sizeof($joins);
	
	foreach ($joins as $key => $value) {
		$join_str.=$key;
		$joinTables=array_keys($value);
		$joinFields=array_values($value);	
		
		$join_str .=" ".$joinTables[1]." ON ".$joinTables[0].".".$joinFields[0]."=".$joinTables[1].".".$joinFields[1]." ";
	}
	
	
	return $join_str;
}

public function getAllRecords($cond="",$_table="",$extra="",$fields_arr=array(),$join="")
	{
	
	$joins="";
	if(is_array($join)){
		$joins=$this->tableJoins($join);
	}
      if($_table===""){$_table=$this->table;}
       
                        $s = "SHOW FULL COLUMNS FROM `".$_table."` FROM `".$this->dbase."`";
                        $q = $this->conn->prepare($s);
						$q->execute();
						$this->num_fields=$q->rowCount();
                        $this->comments=  array();
                        while($rows= $q->fetch(PDO::FETCH_OBJ)){
                                array_push($this->comments,$rows->Field);
                        }
      
      
        //Selected Fields
		$fields_final="*";
		if(!empty($fields_arr)){
			$fields_final = " ";
			$count=1;
			$final_fld_arr = array();
			foreach ($fields_arr as $value) {
			
				if($count<count($fields_arr)){
					if(substr_count($value,":")>0){
						$rwfld = explode(":", $value);
						$fields_final .= $rwfld[0]." as '".$rwfld[1]."',";
						$final_fld_arr[]= $rwfld[1];
					}else{
						$fields_final .=$value.",";
						$final_fld_arr[]=$value;
					}
						
				}else{
					if(substr_count($value,":")>0){
						$rwfld = explode(":", $value);
						$fields_final .= $rwfld[0]." as '".$rwfld[1]."'";
						$final_fld_arr[]= $rwfld[1];
					}else{
						$fields_final .=$value;
						$final_fld_arr[]=$value;
					}
						
				}
				
				$count++;	
			}
				//$fields_final = implode(",", $fields_arr);
				$this->num_fields = sizeof($fields_arr);
				$this->comments=$final_fld_arr;
		}
		
        if($cond===""){
                $sql ="SELECT $fields_final FROM `".$_table."` $joins $extra";
            }else{
                
                $sql ="SELECT $fields_final FROM `".$_table."` $joins $cond $extra";
            }	
			
	//echo $sql;
                        $r=$this->conn->prepare($sql);
						$r->execute();
                        $num_rows = $r->rowCount();
                        if($extra!==""){
                            $sql .= $extra;
                        }

                        if($r){
                            $this->value_arr = array();
                            while ($row =$r->fetch(PDO::FETCH_BOTH)) {
                            $this->inner_arr = array();
                                for($i=0;$i<$this->num_fields;$i++){
                                    array_push($this->inner_arr,$row[$i]);
                                 }
                                 	$this->combined = array_combine($this->comments,$this->inner_arr);
                               		$this->value_arr[]=(object)$this->combined;
                            }
							
                            return $this->value_arr;//json_decode(json_encode($this->value_arr),FALSE);

                        }else {
                            return "Could not select the table ".$this->table;   
                          }
	}
	
        public function insertArray($getPost,$_table=""){
            //INSERT INTO tbname () VALUES(),(),()
            if($_table===""){
                $_table = $this->table;
            }
            $values_arr = array_values($getPost);
            $fields_arr = array_keys($getPost);
            
            $fields = "(";
            foreach ($fields_arr as $value) {
                $fields .="".$value.",";
            }
            $fields .= ")";
            
            $fields_final = substr_replace($fields,"",-2,1);
            
            
            $arr = array();
            for($h=0;$h<sizeof($values_arr[0]);$h++){
                for($i=0;$i<sizeof($values_arr);$i++){
                    $arr[$h][$i]=$values_arr[$i][$h];
                }
            }
            $str="";
            foreach($arr as $val_arr):
                $str.="(";
                foreach($val_arr as $elem):
                    $str.="'".addslashes($elem)."',";

                endforeach;
                $str .="),";
                //$str_final = substr_replace($str,"",-2,1);
            endforeach;
            $values_final = substr_replace(str_replace(",)",")",$str),"",-1,1);
            
            $sql = "INSERT INTO $_table $fields_final VALUES $values_final";
            //$query = mysql_query($sql);
            $q = $this->conn->prepare($sql);
			$q->execute();
            if($q){
                echo "Records posted successfully!";
            }  else {
                //echo "Error occurred: ".mysql_error();
                echo "Error occurred";
            }
        
        }


        public function insertRecord($getPost,$_table=""){
            if($_table===""){
                $_table = $this->table;
            }
            
            $values_arr = array_values($getPost);
            $fields_arr = array_keys($getPost);
            
            $fields = "(";
            foreach ($fields_arr as $key => $value) {
                $fields .="`".$value."`,";
            }
            $fields .= ")";
            
            
            $values = "(";
            foreach ($values_arr as $k => $v) {
                $values .="'".addslashes($v)."',";
            }
            $values.= ")";
            
        $fields_final = substr_replace($fields,"",-2,1);
        $values_final = substr_replace($values,"",-2,1);
            
       
        $sql = "INSERT INTO $_table $fields_final VALUES $values_final";
        //$qry = mysql_query($sql);
        $q=$this->conn->prepare($sql);
        $q->execute();
        if($q){
            return "Record added successfully";
        }  else {
            //return "Error Occurred in inserting record into table ".$this->table."!: ".mysql_error();
            return "Error Occurred in inserting record into table ".$this->table."!";
        }

        
    }

    public function deleteQuery($cond="",$_table=""){
        //DELETE FROM `table` WHERE $cond
        if($_table===""){$_table=$this->table;}
        
            if($cond===""){
                $sql ="DELETE FROM `".$_table."`";
            }else{
                
                $sql ="DELETE FROM `".$_table."` $cond";
            }
            //$qry = mysql_query($sql);
            //$num_affected = mysql_affected_rows($qry);
            $q=$this->conn->prepare($sql);
			$q->execute();
            if($q){
                return "Record(s) deleted!";
            }  else {
                //return "Found an error: No records deleted!<br>". mysql_error();
                return "Found an error: No records deleted!";
            }
    }
    
    public function updateQuery($sets,$cond="",$_table="") {
        //UPDATE `table` SET fld1=value1,fld2=value2 WHERE $cond
        //sets is an array: array("fld1"=>"value1","fld2"=>"value2");
         $str ="";   
        foreach($sets as $key=>$value){
            $str .=" `".$key."`='".$value."',";
        }
        
        $set_str = substr($str,0,-1);
        
        
            if($_table===""){$_table=$this->table;}
        
            if($cond===""){
                $sql ="UPDATE `".$_table."` SET $set_str";
            }else{
                
                $sql ="UPDATE  `".$_table."` SET $set_str $cond";
            }
            
            //$qry = mysql_query($sql);
            $q=$this->conn->prepare($sql);
			$q->execute();
            if($q){
                return 1;
            }  else {
                //return "Update error:<br>".mysql_error();
                return "Update error";
            }
        
    }
public function __destruct(){
	//$getPost =array("334","voucher_header","1","Add a Voucher");
	//$this->insertRecord($getPost,"history");
}


}