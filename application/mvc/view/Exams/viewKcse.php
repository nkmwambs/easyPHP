<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Exams/kcse","[New K.C.S.E. Results]");
}


echo "<br><br><hr>";

echo "<b>Choose Acdemic Year:</b> <SELECT id='selacYr' onchange='changekcseacyr()'>";
	echo "<OPTION VALUE=''>Select Academic Year</OPTION>";
	echo "<OPTION VALUE='2014'>2014</OPTION>";
	echo "<OPTION VALUE='2015'>2015</OPTION>";
	echo "<OPTION VALUE='2016'>2016</OPTION>";
	echo "<OPTION VALUE='2017'>2017</OPTION>";
	echo "<OPTION VALUE='2018'>2018</OPTION>";
	echo "<OPTION VALUE='2019'>2019</OPTION>";
	echo "<OPTION VALUE='2020'>2020</OPTION>";
echo "</SELECT>";

echo "<br><hr><br>";

echo "<br><button  id='' onclick='excelexport()'>Export</button><br><br>";

echo "<div id='rst'>";

if(empty($data)){
	echo "<div id='error_div'>No records found</div>";
	exit;
}
echo "<b>Count Of Records: </b> ".count($data);

?>

<table class='info_tbl' id='info_tbl' style='margin-top: 25px;'>
<caption style='text-align: left;font-weight: bold;'>View K.C.S.E. Results</caption>
    <thead>
    <tr><th>Action</th></th><th>Child Name</th><th>Child Number</th><th>ICP No</th><th>Cluster</th><th>Sex</th><th>Date Of Birth</th><th>Index Number</th><th>English</th><th>Kiswahili</th><th>Mathematics</th><th>Chemistry</th><th>Biology</th><th>Physics</th><th>Grade</th><th>Academic Year</th></tr>
    </thead>
    <tbody>
    <?php
        foreach($data as $value){
        	$grades = array("","E","D-","D","D+","C-","C","C+","B-","B","B+","A-","A");
            echo "<tr><td>".Resources::img("uncheck3.png",array("Title"=>'Delete Record',"onclick"=>'deletekcseresult("'.$value->rID.'",this);'))." ".Resources::img("plus.png",array("Title"=>"Add Details","onclick"=>"addkcsedetails(\"".$value->rID."\",this)"))."</td><td>".$value->childName."</td><td>".$value->childNo."</td><td>".$value->pNo."</td><td>".$value->cstName."</td><td>".$value->sex."</td><td>".$value->dob."</td><td>".$value->indx."</td><td>".$grades[$value->eng]."</td><td>".$grades[$value->kis]."</td><td>".$grades[$value->maths]."</td><td>".$grades[$value->chem]."</td><td>".$grades[$value->bio]."</td><td>".$grades[$value->phy]."</td><td>".$grades[$value->grade]."</td><td>".$value->acYr."</td></tr>";
        }
    ?>
    </tbody>
</table>

</div>