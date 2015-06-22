<?php
class Finance_Model extends E_Model
{
    public function dbTables(){
        $arr_tables = array(array("voucher_header","voucher_body","hID"),array("plansheader","plansbody","planHeaderID"));
        return $arr_tables;
    }

    public function getMonthByNumber($mth,$icp){
            $sql = "SELECT COUNT(*) as Num FROM voucher_header WHERE Month(TDate)=".$mth." AND icpNo='".$icp."'";
            //$qry = mysql_query($sql);
            //$row = mysql_fetch_object($qry);
            $q=$this->conn->prepare($sql);
			$q->execute();
			$row=$q->fetch(PDO::FETCH_OBJ);
            return $row->Num;
    }
    public function chk_skipped_chq($icp,$chq){
        $prev_chq = $chq-1;
        if($prev_chq!==0){
            $sql = "SELECT * FROM voucher_header WHERE icpNo='".$icp."' AND ChqNo=".$prev_chq;
            //$qry = mysql_query($sql);
            //$cnt = mysql_num_rows($qry);
            $q = $this->conn->prepare($sql);
			$q->execute();
			$cnt = $q->rowCount();
            return $cnt;
        }else{
            return 0;
        }
    }
    public function chqIntel($icp,$chq){
        if($chq!==""){    
         //   $num_skipped = $this->chk_skipped_chq($icp,$chq);
        //if($num_skipped===0){
            $s = "SELECT * FROM voucher_header WHERE icpNo='".$icp."' AND ChqNo=".$chq;
            //$q = mysql_query($s);
            //$num = mysql_num_rows($q);
            $q=$this->conn->prepare($s);
			$q->execute();
			$num=$q->rowCount();
            return $num;
        } // else {
           // return "x";
        //}
      //}
    }
    
    public function maxVoucher(){
        $s = "SELECT Max(hID) as vID FROM voucher_header";
        //$q = mysql_query($s);
        //$ob = mysql_fetch_object($q);
        $q = $this->conn->prepare($s);
		$q->execute();
		$ob = $q->fetch(PDO::FETCH_OBJ);
        return $maxID = $ob->vID;
    }

        public function postVoucherBody($arr,$acc){
        
        if ($acc > 0) {
            $insertArr = array();
            for ($i=0; $i<$acc; $i++) {
                $insertArr[] = "('".mysql_real_escape_string($arr['hID'][$i])."','" . mysql_real_escape_string($arr['icpNo'][$i])  . "', '" . mysql_real_escape_string($arr['VNumber'][$i]) . "','" . mysql_real_escape_string($arr['TDate'][$i]) . "','" . mysql_real_escape_string($arr['qty'][$i]) . "','" . mysql_real_escape_string($arr['desc'][$i]) . "','" . mysql_real_escape_string($arr['unit'][$i]) . "','" . mysql_real_escape_string($arr['cost'][$i]) . "','" . mysql_real_escape_string($arr['acc'][$i]) . "','" . mysql_real_escape_string($arr['VType'][$i]) . "','" . mysql_real_escape_string($arr['ChqNo'][$i]) . "','".mysql_real_escape_string($arr['unixStmp'][$i]) ."')";
        }

         $sql = "INSERT INTO voucher_body (hID,icpNo, VNumber,TDate,Qty,Details,UnitCost,Cost,AccNo,VType,ChqNo,unixStmp) VALUES " . implode(", ", $insertArr);
         //$qry = mysql_query($sql);// or trigger_error("Insert failed: " . mysql_error());
         $q=$this->conn->prepare($sql);
		 $q->execute();
         if(!$q){
             return "Error in Inserting Records!";
            }
        }
       return "Voucher posted successfully!";
    }
    
    public function accounts(){
        $sql = "SELECT * FROM accounts WHERE AccGrp<2 AND Active=1 ORDER BY AccGrp DESC,AccNo ASC";
        //$qry = mysql_query($sql);
        $q = $this->conn->prepare($sql);
		$q->execute();
        $ac = array();
        while($row = $q->fetch(PDO::FETCH_ASSOC)) {
            //$ac[$row['AccText']]=$row['AccNo'];
            $ac[]=$row;
        }
        return json_decode(json_encode($ac),FALSE);
    }

        public function getVoucherForEcj($cnd){
    //return $this->getAllRecords($cnd,"voucher_header");
    
        $s = "SELECT * FROM voucher_header $cnd";
        //$q = mysql_query($s);
        $q=$this->conn->prepare($s);
		$q->execute();
        $vch =array();
        $inner = array();
        while($rw=  $q->fetch(PDO::FETCH_ASSOC)){
            $hno = $rw['hID'];
            $sq = "SELECT AccNo as AccNo,SUM(`Cost`) as Cost FROM voucher_body WHERE hID=".$hno." GROUP BY AccNo";
            //$qr = mysql_query($sq);
            $qr = $this->conn->prepare($sq);
			$qr->execute();
            while($rws=  $qr->fetch(PDO::FETCH_ASSOC)){
                $rw["Ac".$rws['AccNo']]=$rws['Cost'];
            }
            $vch[]=$rw;
        }
        return json_decode(json_encode($vch),FALSE);
    }
    
    public function showVoucher($VNumber,$icpNo){
        $getSql = "SELECT * FROM voucher_body INNER JOIN voucher_header ON voucher_body.hID=voucher_header.hID WHERE voucher_body.VNumber= ".$VNumber." AND               voucher_body.icpNo= '".$icpNo."' ORDER BY voucher_body.AccNo DESC";
        //$getQry = mysql_query($getSql);
        $getQry = $this->conn->prepare($getSql);
		$getQry->execute();
        while ($row = $getQry->fetch(PDO::FETCH_OBJ)) {
            $rst[]=$row;
        }
        return $rst;
    }
 public function getVoucherTableFields($tbl){
                        //$s = "SHOW FULL COLUMNS FROM `".$tbl."` FROM `mvc`";
                        $s1 = "SHOW FULL COLUMNS FROM `".$tbl[0]."` FROM `mvc`";
                        //$q1 = mysql_query($s1);
                        //$this->num_fields = mysql_num_rows($q1);
                        $q1 = $this->conn->prepare($s1);
						$q1->execute();
						$this->num_fields=$q1->rowCount();

                        $this->comments_one=  array();

                        while($rows=$q1->fetch(PDO::FETCH_OBJ)){
                                array_push($this->comments_one,$rows->Field);
                        }
                        //return $this->comments;
                        
                        $s2 = "SHOW FULL COLUMNS FROM `".$tbl[1]."` FROM `mvc`";
                        //$q2 = mysql_query($s2);
                        //$this->num_fields = mysql_num_rows($q2);
                        
						$q2 = $this->conn->prepare($s2);
						$q2->execute();
						$this->num_fields=$q2->rowCount();
                        $this->comments_two=  array();

                        while($rows=$q2->fetch(PDO::FETCH_OBJ)){
                                array_push($this->comments_two,$rows->Field);
                        }
                        return array_merge($this->comments_one,$this->comments_two);
    }
    public function searchResultsQuery($array){
        $tbls = $this->dbTables();
        $tbl_logic = $tbls[$array['tblList']][0]." INNER JOIN ".$tbls[$array['tblList']][1]." ON ".$tbls[$array['tblList']][0].".".$tbls[$array['tblList']][2]."=".$tbls[$array['tblList']][0].".".$tbls[$array['tblList']][2]."";
        $qry = str_replace("%MyTable%",$tbl_logic,$array['results_sql']);
        //$rst = mysql_query($qry);
        $rst = $this->conn->prepare($qry);
        $rst->execute();
        $rst_arr=array();
    try{
        if($rst){
            while ($row = $rst->fetch(PDO::FETCH_OBJ)) {
                $rst_arr[]=$row;
            }
            return $rst_arr;
        }  else {
            throw new customException("Query not Valid!");
        }
        
    }catch(customException $e){
        return $e->errorMessage();
    }

}
public function getPpbfModel($cond){
    $s = "SELECT * FROM plansheader INNER JOIN plansbody ON plansheader.planHeaderID=plansbody.planHeaderID $cond";
    //$q = mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst = array();
    while($rows=  $q->fetch(PDO::FETCH_OBJ)){
        $rst[]=$rows;
    }
    return $rst;
}
public function civaAccountsMerge($cond,$VType){
    $s = "SELECT * FROM accounts LEFT JOIN civa ON accounts.accID=civa.accID $cond AND (accounts.Active=1 OR civa.open=1 AND closureDate>CURDATE())";
    if($VType==="CHQ"){
        $s.=" OR AccGrp=3 ";
    }
    $s.=" ORDER BY AccNo ASC, prg DESC";
    //$q = mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rs = array();
    while($rows= $q->fetch(PDO::FETCH_OBJ)){
        $rs[]=$rows;
    }
    return $rs;
}
public function civaExpenseAccounts($cond){
    $s = "SELECT * FROM accounts RIGHT JOIN civa ON accounts.accID=civa.accID $cond ORDER BY AccNo ASC, prg DESC";
    //$q = mysql_query($s);
    $q=$this->conn->prepare($s);
    $q->execute();
    $rs = array();
    while($rows=  $q->fetch(PDO::FETCH_OBJ)){
        $s1 = "SELECT sum(Cost) as amt FROM voucher_body WHERE civaCode=$rows->civaID";
        //$q1 =  mysql_query($s1);
        //$obj = mysql_fetch_object($q1);
        $q1 = $this->conn->prepare($s1);
		$q1->execute();
		$obj = $q1->fetch(PDO::FETCH_OBJ);
        $rows->AmountDisbursed=0;
        $rows->AmountSpent=$obj->amt;
        $rs[]=$rows;
    }
    return $rs;     
}
public function getClusters(){
    $s="SELECT cname as cluster FROM users WHERE cname<>'KE'  GROUP BY cname";
    //$q=mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $clusters = array();
    while($rows=  $q->fetch(PDO::FETCH_ASSOC)){
            $s1 = "SELECT fname as fname FROM users WHERE cname='".$rows['cluster']."'  AND userlevel='1'";
            //$q1 = mysql_query($s1);
            $q1=$this->conn->prepare($s1);
			$q1->execute();
            while($row= $q1->fetch(PDO::FETCH_ASSOC)){
                $clusters[$rows['cluster']][]=$row['fname'];
            }
    }
    return $clusters;
}

public function uploadFunds($lists,$file){
    set_time_limit(3600); 
    //get the csv file
    //$file = $_FILES[csv][tmp_name];
    $handle = fopen($file,"r");
   
  // $counter = 0;
    $data=array();
   
    //loop through the csv file and insert into database
    
    if($lists === 'fundsSchedules') {
    
    do {
       // if ($data[0]) {
            //mysql_query("INSERT INTO batch_list (ChildNo, ChildName) VALUES
            $this->conn->query("INSERT INTO fundsschedule (KENumber, AccountCode,AccountDescription,Amount,Month) VALUES
                (
                    '".addslashes($data[0])."',
                    '".addslashes($data[1])."',
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."',
                    '".addslashes($data[4])."'
                )
            ") or die(mysql_error());
            //if($query){
              //  echo "Upload Completed";
            //}  else {
              //  echo "Error in uploading: ".mysql_error();
           // }
            
            //if($counter = 10) break;
            //$counter++;
            //$_SESSION['cnt']=$counter;
            //echo 'counter ='.$counter;
        //}
    } while ($data = fgetcsv($handle,1000,",","'"));
    }
    elseif($lists=="projectsDetails")
    {
	    do {
       // if ($data[0]) {
            $this->conn->query("INSERT INTO projectsdetails (KENumber, ProjectName,AccNumber,AccountName,Bank,Branch,BranchCode,PFName,Cluster,PEmail) VALUES
            
                (
                    '".addslashes($data[0])."',
                    '".addslashes($data[1])."',
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."',
                    '".addslashes($data[4])."',
                    '".addslashes($data[5])."',
                    '".addslashes($data[6])."',
                    '".addslashes($data[7])."',
                    '".addslashes($data[8])."',
                    '".addslashes($data[9])."'
               
                )
            ") or die(mysql_error());
            
            //if($counter = 10) break;
            //$counter++;
            //$_SESSION['cnt']=$counter;
            //echo 'counter ='.$counter;
        //}
    } while ($data = fgetcsv($handle,1000,",","'"));    
    
    }
    elseif($lists=="specialgifts")
    {
	    do {
       // if ($data[0]) {
            $this->conn->query("INSERT INTO specialgifts (KENumber,ChildNumber,Amount,Instructions,Month) VALUES
            
                (
                    '".addslashes($data[0])."',
                    '".addslashes($data[1])."',
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."',
                    '".addslashes($data[4])."'
               
                )
            ") or die(mysql_error());
            
            //if($counter = 10) break;
            //$counter++;
            //$_SESSION['cnt']=$counter;
            //echo 'counter ='.$counter;
        //}
    } while ($data = fgetcsv($handle,1000,",","'"));    
    
    }
    //
        $sql = "DELETE FROM fundsschedule WHERE KENumber=''";
        $this->conn->query($sql);
}
public function fundsPerICP($cst){
    $s = "SELECT fname FROM users WHERE cname='".$cst."' AND userlevel<>2";
    //$q = mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst = array();
    while($rows= $q->fetch(PDO::FETCH_ASSOC)){
        $s2 = "SELECT * FROM fundsschedule WHERE KENumber='".$rows['fname']."'";
        //$q1 = mysql_query($s2);
        $q1=$this->conn->prepare($s2);
        $q1->execute();
        while($row = $q1->fetch(PDO::FETCH_ASSOC)){
            $rst[$rows['fname']][$row['AccountDescription']][]=$row['AccountDescription'];
            $rst[$rows['fname']][$row['AccountDescription']][]=$row['Amount'];
        }
        //$rst[]=$rows;
    }
    return $rst;
}
public function accountsForMfr($cond){
    $s = "SELECT * FROM accounts RIGHT JOIN voucher_body ON accounts.AccNo=voucher_body.AccNo $cond ORDER BY accounts.AccGrp DESC, accounts.AccNo ASC,  accounts.prg DESC";
    //$q = mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst = array();
    while($rows=  $q->fetch(PDO::FETCH_OBJ)){
        $rst[]=$rows;
    }
    return $rst;
}
public function balFundsBf($cond){
    $s="SELECT * FROM opfundsbalheader LEFT JOIN opfundsbal ON opfundsbalheader.balHdID=opfundsbal.balHdID $cond";
    //$q=  mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst =array();
    //$obj = new stdClass();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    //$rst[]=$obj;
    return $rst;
    
}
public function getSchedule($cond){
    $s="SELECT * FROM planheader LEFT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID $cond";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    return $rst;
}
public function getScheduleWithAcNames($cond){
    $s="SELECT * FROM planheader LEFT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID LEFT JOIN accounts ON plansschedule.AccNo=accounts.AccNo $cond";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
    $q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    return $rst;
}
public function getScheduleIDs($cond){
    $s="SELECT plansschedule.scheduleID as id FROM planheader LEFT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID LEFT JOIN accounts ON plansschedule.AccNo=accounts.AccNo $cond";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
    $q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row->id;
    }
    return $rst;
}
public function getSchedulesSummaryWithAcNames($cond){
    $s="SELECT accounts.AccText,accounts.AccName,planheader.fy,plansschedule.AccNo,plansschedule.totalCost,sum(plansschedule.JulAmt) as JulTot, sum(plansschedule.AugAmt) as AugTot, sum(plansschedule.SepAmt) as SepTot, sum(plansschedule.OctAmt) as OctTot, sum(plansschedule.NovAmt) as NovTot, sum(plansschedule.DecAmt) as DecTot, sum(plansschedule.JanAmt) as JanTot, sum(plansschedule.FebAmt) as FebTot, sum(plansschedule.MarAmt) as MarTot, sum(plansschedule.AprAmt) as AprTot, sum(plansschedule.MayAmt) as MayTot, sum(plansschedule.JunAmt) as JunTot FROM planheader LEFT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID LEFT JOIN accounts ON plansschedule.AccNo=accounts.AccNo $cond GROUP BY plansschedule.AccNo";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    return $rst;
}
public function getBudgetTotalArray($cond){
    $s="SELECT sum(plansschedule.totalCost) as totalCost,sum(plansschedule.JulAmt) as JulTot, sum(plansschedule.AugAmt) as AugTot, sum(plansschedule.SepAmt) as SepTot, sum(plansschedule.OctAmt) as OctTot, sum(plansschedule.NovAmt) as NovTot, sum(plansschedule.DecAmt) as DecTot, sum(plansschedule.JanAmt) as JanTot, sum(plansschedule.FebAmt) as FebTot, sum(plansschedule.MarAmt) as MarTot, sum(plansschedule.AprAmt) as AprTot, sum(plansschedule.MayAmt) as MayTot, sum(plansschedule.JunAmt) as JunTot FROM planheader LEFT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID $cond";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
    $q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst=$row;
    }
    return $rst;
}
public function getRequestsQuery($cond){
    $s = "SELECT users.fname,users.lname,plansrequests.rqMessage,plansschedule.details FROM users RIGHT JOIN plansrequests ON users.ID = plansrequests.senderID LEFT JOIN plansschedule ON plansrequests.scheduleID=plansschedule.scheduleID $cond";
        //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
    $q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    return $rst;
}
public function countNewSchedules($cond){
    $s = "SELECT planheader.icpNo,count(plansschedule.approved) as cnt,sum(plansschedule.totalCost) as Cost FROM planheader RIGHT JOIN plansschedule ON planheader.planHeaderID=plansschedule.planHeaderID LEFT JOIN users ON planheader.icpNo=users.fname $cond GROUP BY planheader.icpNo";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    return $rst;
    
}
public function viewFundsBal($cond){
    $s = "SELECT  opfundsbalheader.closureDate, opfundsbal.funds,opfundsbalheader.icpNo,opfundsbal.amount FROM opfundsbal LEFT JOIN opfundsbalheader ON opfundsbal.balHdID=opfundsbalheader.balHdID $cond";
    //$q =  mysql_query($s);
    $q=$this->conn->prepare($s);
	$q->execute();
    $rst=array();
    while ($row = $q->fetch(PDO::FETCH_OBJ)) {
        $rst[]=$row;
    }
    return $rst;	
}
}

