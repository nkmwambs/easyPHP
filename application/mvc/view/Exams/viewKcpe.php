<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Exams/kcpe","[New K.C.P.E. Results]")." ".Resources::a_href("Exams/viewsecschoolenrollment","[View Enrollment]");
}


echo "<br><br><hr>";

echo "<b>Choose Acdemic Year:</b> <SELECT id='selacYr' onchange='changeacyr()'>";
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
<caption style='text-align: left;font-weight: bold;'>View K.C.P.E. Results</caption>
    <thead>
    <tr><th>Action</th></th><th>Child Name</th><th>Child Number</th><th>ICP No</th><th>Cluster</th><th>Sex</th><th>Date Of Birth</th><th>English</th><th>Kiswahili</th><th>Science</th><th>Mathematics</th><th>S/ Studies/RE</th><th>Total Marks</th><th>Academic Year</th></tr>
    </thead>
    <tbody>
    <?php
        foreach($data as $value){
            echo "<tr><td>".Resources::img("uncheck3.png",array("Title"=>'Delete Record',"onclick"=>'deleteresult("'.$value->rID.'",this);'))." ".Resources::img("plus.png",array("Title"=>"Add Details","onclick"=>"addkcpedetails(\"".$value->rID."\",this)"))."</td><td>".$value->childName."</td><td>".$value->childNo."</td><td>".$value->pNo."</td><td>".$value->cstName."</td><td>".$value->sex."</td><td>".$value->dob."</td><td>".$value->eng."</td><td>".$value->kis."</td><td>".$value->sci."</td><td>".$value->mat."</td><td>".$value->sstd."</td><td>".$value->totMrk."</td><td>".$value->acYr."</td></tr>";
        }
    ?>
    </tbody>
</table>

</div>