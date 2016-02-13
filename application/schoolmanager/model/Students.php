<?php
class Students_Model extends E_Model{
    public function getStudentsTableFields(){
        $s = "SHOW FULL COLUMNS FROM `students` FROM `schoolmanager`";
		$q = $this->conn->prepare($s);
		$q->execute();
		$this->num_fields=$q->rowCount();
        $this->comments=  array();

        while($rows=$q->fetch(PDO::FETCH_OBJ))
        {
             array_push($this->comments,$rows->Field);
        }
        return $this->comments;
    }
    public function searchResultsQuery($array){
        
        $qry = str_replace("%MyTable%","students",$array['results_sql']);
        //$rst = mysql_query($qry);
        $rst = $this->conn->prepare($qry);
		$rst->execute();
        $rst_arr=array();
        while ($row=$rst->fetch(PDO::FETCH_OBJ)) {
            $rst_arr[]=$row;
        }
        return $rst_arr;
    }
}
?>