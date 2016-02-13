<?php
//print_r($data);

if(is_array($data)&&!empty($data)){
$keys = array_keys((array)$data[0]);
//print_r($keys);
echo "<div id='divResults' onmouseover='displayScroll(this);' onmouseout='hideScroll(this);'>";
echo "<table id='tblSearchResults'>";

echo "<tr><th>Action</th><th>Full Name</th><th>Gender</th><th>Date Of Birth</th><th>Admission Number</th></tr>";

foreach($data as $val):
  	echo "<tr>";
	echo "<td>".Resources::img("manage2.png",array("title"=>$val->studentKey,"onclick"=>'completeDraftStudent(this);',"style"=>'cursor:pointer;width:15px;height:15px;'))." ".Resources::img("print.png",array("onclick"=>"viewprintprofile(\"".$val->studentKey."\",this)","Title"=>'View/ Print  - '.$val->studentKey.'',"style"=>'cursor:pointer;width:15px;height:15px;'))."</td>";
   	echo "<td>".$val->fname." ".$val->lname."</td>";
	if($val->sex==='1'){
		echo "<td>Female</td>";
	}else{
		echo "<td>Male</td>";
	}
	echo "<td>".$val->dob."</td>";
	echo "<td>".$val->admNo."</td>";

    echo "</tr>";
endforeach;
echo "</table>";
echo "</div>";
}else {
    echo "<div id='error_msg'>Error: The search could not be completed!<div>";
}
?>


<div id="lblManage" style="display:none;"><div id="lbl_BioData" class="progress">Bio-Data</div> <div id="lbl_Location" class="progress">Location</div><div id="lbl_Parent" class="progress">Parent/ Guardian</div><div id="lbl_Academic" class="progress">Academic</div><div id="lbl_Talents" class="progress">Talents</div><div id="lbl_Health" class="progress">Health</div></div>
<form id="frmBioData" enctype="multipart/form-data">
<table id="tbl_BioData" style="border:1px solid orange;max-width:750px;display: none;">
    <caption><?php echo Resources::img("diskedit.png");?>Edit Record</caption>
    
    <tr><th colspan="3">Student's Bio-Data (Page 1/6)</th></tr>
    <tr>
        <td colspan="2">Student Image:<input type="file" name="studentImage" id="studentImage"/></td>
        <td>Admission Number: <input class="mandatory" type="text" onchange='clearHighlight(this);' id="admNo" name="admNo" title="Admission Number" placeholder="Admission Number"/></td>
    </tr>
    
    <tr><th colspan="3">&nbsp;</th></tr>
    
    <tr>
        <td>First Name: <input class="mandatory" type="text"  onchange='clearHighlight(this);' id="fname" name="fname" placeholder="First Name" title="First Name"/></td>
        <td>Last Name: <input  class="mandatory" type="text" onchange='clearHighlight(this);' id="lname" name="lname" placeholder="Last Name" title="Last Name"/></td>
        <td>Gender: <select class="mandatory"  id="sex" name="sex"><option>Gender ...</option><option value="1">Female</option><option value="2">Male</option></select></td>
    </tr>
    
    <tr><th colspan="3">&nbsp;</th></tr>
    
        <tr>
            <td>Date Of Birth: <input class="mandatory" type="text" onchange='clearHighlight(this);' id="dob" name="dob" placeholder="Date Of Birth" title="Date Of Birth" readonly="readonly"/></td>
            <td> Nationality: <input  class="mandatory" type="text" onchange='clearHighlight(this);' id="nationality" name="nationality" title="Nationality" placeholder="Nationality"/></td><td>Active? <select class="mandatory" id="active" name="active"><option value="">Active?</option><option value="Yes">Yes</option><option value="No">No</option></select></td>
            
        </tr>
    
    
   
            <tr><td colspan="3" align="center"><?php echo Resources::img("disksave.png",array("title"=>'Save',"onclick"=>'saveRecordNewStudent("frmBioData");',"style"=>"margin-left:auto;margin-right:auto;cursor:pointer;"))." ". Resources::img("next.png",array("title"=>"Next","onclick"=>'gotoFrame("tbl_BioData","tbl_Location");',"style"=>"float:right;cursor:pointer;"));?></td></tr>
    
</table>


<!-- Table Location-->

<table id="tbl_Location" class="sub_tbl studentdraft" style="border:1px solid orange;max-width:750px;">
    <caption><?php echo Resources::img("plus.png");?>New Student Profile</caption>
             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Residence/ Location (Page 2/6)</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
         <td colspan="2">County Of Residence: <input class="mandatory"  type="text" onchange='clearHighlight(this);' id="county" name="county" title="County" placeholder="County"/></td>
         <td colspan="2">Ward: <input class="mandatory"  type="text" onchange='clearHighlight(this);' id="ward" name="ward" title="Ward" placeholder="Ward"/></td>
     </tr>
     
         <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr>
        <td colspan="2"> Estate/ Area of Residence: <input class="mandatory"  type="text" onchange='clearHighlight(this);' id="area" name="area" title="Area/ Estate" placeholder="Area/ Estate"/></td>
         <td colspan="2">Street: <input type="text" onchange='clearHighlight(this);' id="street" name="street" title="Street" placeholder="Street"/></td>
     </tr>
     
         <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr><td colspan="4" align="center"><?php echo Resources::img("previous.png",array("title"=>"Previous","onclick"=>'gotoFrame("tbl_Location","tbl_BioData");',"style"=>"float:left;cursor:pointer;")). " ". Resources::img("disksave.png",array("title"=>'Save',"onclick"=>'saveRecordNewStudent("frmBioData");',"style"=>"margin-left:auto;margin-right:auto;cursor:pointer;"))." " . Resources::img("next.png",array("title"=>"Next","onclick"=>'gotoFrame("tbl_Location","tbl_Parent");',"style"=>"float:right;cursor:pointer;"));?></td></tr>
</table>



<!----- Table Parents-->


<table id="tbl_Parent" class="sub_tbl studentdraft" style="border:1px solid orange;max-width:750px;">
    <caption><?php echo Resources::img("plus.png");?>New Student Profile</caption>
             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Parent/ Guardian Information (Page 3/6)</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>

    <tr><td>Parent/Guardian 1</td><td><input class="mandatory"  type="text" onchange='clearHighlight(this);' id="parentOneFullname" name="parentOneFullname" title="Full Name" placeholder="Full Name"/></td><td><select class="mandatory"  id="parentOneRel" name="parentOneRel" title="Relationship"><option value="">Relationship ... </option><option value="1">Father</option><option value="2">Mother</option><option value="3">Brother</option><option value="4">Sister</option><option value="5">Aunt</option><option value="6">Uncle</option><option value="7">Grand-Father</option><option value="8">Grand-Mother</option><option value="9">Other</option></select></td><td><input type="text" onchange='clearHighlight(this);' id="parentOneRelOther" name="parentOneRelOther" title="Other Relationship" placeholder="If Other, Specify"/></td></tr>
    
    <tr><td><td><input class="mandatory"  type="text" onchange='clearHighlight(this);' id="parentOnePhone" name="parentOnePhone" title="Phone Number" placeholder="Phone Number"/></td></td><td><input type="text" onchange='clearHighlight(this);' id="parentOneEmail" name="parentOneEmail" title="Email" placeholder="Email"/></td><td><input type="text" onchange='clearHighlight(this);' id="parentOneJob" name="parentOneJob" title="Occupation" placeholder="Occupation"/></td></tr>
    
    <tr><td colspan="1">&nbsp;</td><td colspan="3"><input type="text" onchange='clearHighlight(this);' id="parentOneHome" name="parentOneHome" title="Residence" placeholder="Residence"/></td></tr>
    
    <tr><td colspan="4">&nbsp;</td></tr>

    <tr><td>Parent/Guardian 2</td><td><input  type="text" onchange='clearHighlight(this);' id="parentTwoFullname" name="parentTwoFullname" title="Full Name" placeholder="Full Name"/></td><td><select  id="parentTwoRel" name="parentTwoRel" title="Relationship"><option value="">Relationship ... </option><option value="1">Father</option><option value="2">Mother</option><option value="3">Brother</option><option value="4">Sister</option><option value="5">Aunt</option><option value="6">Uncle</option><option value="7">Grand-Father</option><option value="8">Grand-Mother</option><option value="9">Other</option></select></td><td><input type="text" onchange='clearHighlight(this);' id="parentTwoRelOther" name="parentTwoRelOther" title="Other Relationship" placeholder="If Other, Specify"/></td></tr>
    
    <tr><td><td><input  type="text" onchange='clearHighlight(this);' id="parentTwoPhone" name="parentTwoPhone" title="Phone Number" placeholder="Phone Number"/></td></td><td><input type="text" onchange='clearHighlight(this);' id="parentTwoEmail" name="parentTwoEmail" title="Email" placeholder="Email"/></td><td><input type="text" onchange='clearHighlight(this);' id="parentTwoJob" name="parentTwoJob" title="Occupation" placeholder="Occupation"/></td></tr>
    
    <tr><td colspan="1">&nbsp;</td><td colspan="3"><input type="text" onchange='clearHighlight(this);' id="parentTwoHome" name="parentTwoHome" title="Residence" placeholder="Residence"/></td></tr>       
    
    <tr><td colspan="4" align="center"><?php echo Resources::img("previous.png",array("title"=>"Previous","onclick"=>'gotoFrame("tbl_Parent","tbl_Location");',"style"=>"float:left;cursor:pointer;")). " ". Resources::img("disksave.png",array("title"=>'Save',"onclick"=>'saveRecordNewStudent("frmBioData");',"style"=>"margin-left:auto;margin-right:auto;cursor:pointer;"))." ". Resources::img("next.png",array("title"=>"Next","onclick"=>'gotoFrame("tbl_Parent","tbl_Academic");',"style"=>"float:right;cursor:pointer;"));?></td></tr>
</table>


<!-- Class Details-->

<table id="tbl_Academic" class="sub_tbl studentdraft" style="border:1px solid orange;max-width:750px;">
    <caption><?php echo Resources::img("plus.png");?>New Student Profile</caption>
             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Academic Information (Page 4/6)</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
             
    <tr>
        <td colspan="2">Class Admitted into: <select class="mandatory" id="entryClass" name="entryClass"><option value="">Entry Class</option><option value="1">Play Group</option><option value="2">Nursery</option><option value="3">Pre-School</option><option value="4">STD One</option><option value="5">STD Two</option><option value="6">STD Three</option><option value="7">STD Four</option><option value="8">STD Five</option><option value="9">STD Six</option><option value="10">STD Seven</option><option value="11">STD Eight</option></select></td>
        <td colspan="2">First School?: <select id="firstSchool" name="firstSchool"><option value="">First School? ... </option><option value="1">Yes</option><option value="0">No</option></select></td>
    </tr>
    <tr>
        <td colspan="2">If Yes, Name previous School: <input type="text" onchange='clearHighlight(this);' id="formerSchool" name="formerSchool" title="Former School" placeholder="If No, Former School"/></td>
        <td colspan="2">Last Exam score from last school: <input type="text" onchange='clearHighlight(this);' id="lastScore" name="lastScore" title="Last Score" placeholder="If No, Last Score"/></td>
    </tr>
    <tr><td colspan="2"> Interviewed?<input type="checkbox" name="interviewed" id="interviewed" value="1"/></td>
        <td colspan="2">If Yes, Interview Score<input type="text" onchange='clearHighlight(this);' id="interviewScore" name="interviewScore" title="Interview Score" placeholder="Interview Score"/></td>
    </tr>
    
             
             
        <tr><td colspan="4" align="center"><?php echo Resources::img("previous.png",array("title"=>"Previous","onclick"=>'gotoFrame("tbl_Academic","tbl_Parent");',"style"=>"float:left;cursor:pointer;")). " ".Resources::img("disksave.png",array("title"=>'Save',"onclick"=>'saveRecordNewStudent("frmBioData");',"style"=>"margin-left:auto;margin-right:auto;cursor:pointer;"))." " . Resources::img("next.png",array("title"=>"Next","onclick"=>'gotoFrame("tbl_Academic","tbl_Talents");',"style"=>"float:right;cursor:pointer;"));?></td></tr>         
</table>



<!--Table Talents-->

<table id="tbl_Talents" class="sub_tbl studentdraft" style="border:1px solid orange;max-width:750px;">
    <caption><?php echo Resources::img("plus.png");?>New Student Profile</caption>
             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Talents Information (Page 5/6)</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
             
             <tr><td colspan="4">
                <div style="float: left;"><select id="selectTalent" multiple style="height:125px;min-width:250px;">
                    <option value="Ball Games">Ball Games</option>
                    <option value="Drama">Drama</option>
                    <option value="Singing">Singing</option>
                    <option value="Play Musical Instruments">Play Musical Instruments</option>
                    <option value="Swimming">Swimming</option>
                    <option value="Other">Other</option>
                    </select></div>
                <div style="float:left;height: 20px;">
                <?php echo Resources::img("next.png",array("onclick"=>'moveitem("selectTalent","getTalent");'));?><br>
                <?php echo Resources::img("previous.png",array("onclick"=>'moveitem("getTalent","selectTalent");'));?><br>
                </div>
                <div style="float:left;height:100px;width: auto;">
                    <select class="mandatory" id="getTalent" name="talents[]" multiple style="height:125px;min-width:250px;"></select>
                </div>
                <input type="text" onchange='clearHighlight(this);' id="talentOther" name="talentsOther" title="Other Talents/ Gifts" placeholder="If other, Specify"/>
        </td></tr>    
             
        <tr><td colspan="4" align="center"><?php echo Resources::img("previous.png",array("title"=>"Previous","onclick"=>'gotoFrame("tbl_Talents","tbl_Academic");',"style"=>"float:left;cursor:pointer;")). " ".Resources::img("disksave.png",array("title"=>'Save',"onclick"=>'saveRecordNewStudent("frmBioData");',"style"=>"margin-left:auto;margin-right:auto;cursor:pointer;"))."" . Resources::img("next.png",array("title"=>"Next","onclick"=>'gotoFrame("tbl_Talents","tbl_Health");',"style"=>"float:right;cursor:pointer;"));?></td></tr>           
</table>



<!--Table Health -->


<table id="tbl_Health" class="sub_tbl studentdraft" style="border:1px solid orange;max-width:750px;">
    <caption><?php echo Resources::img("plus.png");?>New Student Profile</caption>
             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Talents Information (Page 6/6)</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
             
            <tr><td colspan="3">Has the student with any known medical condition?</td></tr>
            <tr><td>
                    <div style="float: left;"><select id="selectMed" multiple style="height:125px;min-width:250px;">
                    <option value="Asthma">Asthma</option>
                    <option value="Epileptic">Epileptic</option>
                    <option value="Heart Conditions">Heart Conditions</option>
                    <option value="Mental Instability">Mental Instability</option>
                    <option value="Other">Other</option>
                    </select></div>
                <div style="float:left;height: 20px;">
                <?php echo Resources::img("next.png",array("onclick"=>'moveitem("selectMed","getMed");'));?><br>
                <?php echo Resources::img("previous.png",array("onclick"=>'moveitem("getMed","selectMed");'));?><br>
                </div>
                <div style="float:left;height:100px;width: auto;">
                    <select class="mandatory" id="getMed" name="medical[]" multiple style="height:125px;min-width:250px;"></select>
                </div>
                    <input type="text" onchange='clearHighlight(this);' id="medicalOther" name="medicalOther" title="Other Medical Condition" placeholder="If other, Specify"/><input type="hidden" name="draft" value="1" id="draft"/>
            </td></tr>
             
            <tr><td colspan="4" align="center"><?php echo Resources::img("previous.png",array("title"=>"Previous","onclick"=>'gotoFrame("tbl_Health","tbl_Talents");',"style"=>"float:left;cursor:pointer;"))." ".Resources::img("unreject.png",array("title"=>'Submit',"onclick"=>'addStudentRecord("frmBioData");',"style"=>"margin-left:auto;margin-right:auto;cursor:pointer;"));?></td></tr>  
</table>
</form>
