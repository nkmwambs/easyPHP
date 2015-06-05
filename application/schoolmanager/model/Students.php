<?php
class Students_Model extends E_Model{
    public function getStudentsTableFields(){
                        $s = "SHOW FULL COLUMNS FROM `students` FROM `schoolmanager`";
                        $q = mysql_query($s);
                        $this->num_fields = mysql_num_rows($q);

                        $this->comments=  array();

                        while($rows=mysql_fetch_object($q)){
                                array_push($this->comments,$rows->Field);
                        }
                        return $this->comments;
    }
    public function searchResultsQuery($array){
        
        $qry = str_replace("%MyTable%","students",$array['results_sql']);
        $rst = mysql_query($qry);
        $rst_arr=array();
        while ($row = mysql_fetch_object($rst)) {
            $rst_arr[]=$row;
        }
        return $rst_arr;
    }
}
?>