<?php
function financial_quarter($d){
	$months = range(1,12);
    $qtrs = array_chunk($months,3);
    $chk = array(3,4,1,2);
    $cb = array_combine($chk,$qtrs);
          foreach ($cb as $q => $m){
                $month = date('m',strtotime($d));
                $year = date('Y',strtotime($d));
                      if(in_array($month,$m)){
                           $qtr = $q;
                           $fy = ($qtr===1 || $qtr===2)?$year+1:$year;
                                                       
                       }
          } 
		  return $qtr;
}
?>