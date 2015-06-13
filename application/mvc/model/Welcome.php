<?php

class Welcome_Model extends E_Model{
    public function searchUsers($user){
        $cond_user = " `username` LIKE '%".$user."%' OR `username` LIKE '%".$user."' OR `username` LIKE '".$user."%' ";
        $cond_lname = " `lname` LIKE '%".$user."%' OR `lname` LIKE '%".$user."' OR `lname` LIKE '".$user."%' ";
        $cond_fname = " `fname` LIKE '%".$user."%' OR `fname` LIKE '%".$user."' OR `fname` LIKE '".$user."%' ";
        $cond_cname = " `cname` LIKE '%".$user."%' OR `cname` LIKE '%".$user."' OR `cname` LIKE '".$user."%' ";
        $sql = "SELECT * FROM `users` WHERE $cond_user OR $cond_lname OR $cond_fname OR $cond_cname";
        //$qry = mysql_query($sql);
        $q=$this->conn->prepare($sql);
		$q->execute();
        $rst = array();
        while ($row = $q->fetch(PDO::FETCH_OBJ)) {
            $rst[]=$row;
        }
        return $rst;
    }
}