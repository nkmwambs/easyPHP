<table id="tbl_BioData" style="border: <br>1px solid orange;width: <br>100%;position: <br> relative;">
    <caption><?php echo Resources::img("editplain.png",array("title"=>'Edit Profile - '.$data['student']->studentKey.'',"onclick"=>'editstudentfromprofile(this);'));?>New Student Profile</caption>
    
    <tr><th colspan="3">Student's Bio-Data</th></tr>
    <tr>
        <td colspan="2">Student Image: <br><div style="min-height: <br> 100px;max-width: <br> 90px;background-color: <br> white;">&nbsp;</div></td>
        <td>Admission Number: <br> <input readonly="readonly" class="mandatory" type="text" onchange='clearHighlight(this);' id="admNo" name="admNo" title="Admission Number" placeholder="Admission Number"/></td>
    </tr>
    
    <tr><th colspan="3">&nbsp;</th></tr>
    
    <tr>
        <td>First Name: <br> <input readonly="readonly" class="mandatory" type="text"  onchange='clearHighlight(this);' id="fname" name="fname" placeholder="First Name" title="First Name"/></td>
        <td>Last Name: <br> <input readonly="readonly"  class="mandatory" type="text" onchange='clearHighlight(this);' id="lname" name="lname" placeholder="Last Name" title="Last Name"/></td>
        <td>Gender: <br> <select disabled   class="mandatory"  id="sex" name="sex"><option>Gender ...</option><option value="1">Female</option><option value="2">Male</option></select disabled  ></td>
    </tr>
    
    <tr><th colspan="3">&nbsp;</th></tr>
    
        <tr>
            <td>Date Of Birth: <br> <input readonly="readonly" class="mandatory" type="text" onchange='clearHighlight(this);' id="dob" name="dob" placeholder="Date Of Birth" title="Date Of Birth" readonly="readonly"/></td>
            <td> Nationality: <br> <input readonly="readonly"  class="mandatory" type="text" onchange='clearHighlight(this);' value="Kenya" id="nationality" name="nationality" title="Nationality" placeholder="Nationality"/></td><td>Active? <select disabled   class="mandatory" id="active" name="active"><option value="">Active?</option><option value="Yes">Yes</option><option value="No">No</option></select disabled  ></td>
            
        </tr>


<!-- Table Location-->

             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Residence/ Location</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
         <td colspan="2">County Of Residence: <br><input readonly="readonly" class="mandatory"  type="text" onchange='clearHighlight(this);' id="county" name="county" title="County" placeholder="County"/></td>
         <td colspan="2">Ward: <br> <input readonly="readonly" class="mandatory"  type="text" onchange='clearHighlight(this);' id="ward" name="ward" title="Ward" placeholder="Ward"/></td>
     </tr>
     
         <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr>
        <td colspan="2"> Estate/ Area of Residence: <br> <input readonly="readonly" class="mandatory"  type="text" onchange='clearHighlight(this);' id="area" name="area" title="Area/ Estate" placeholder="Area/ Estate"/></td>
         <td colspan="2">Street: <br> <input readonly="readonly" type="text" onchange='clearHighlight(this);' id="street" name="street" title="Street" placeholder="Street"/></td>
     </tr>
     
         <tr><td colspan="4">&nbsp;</td></tr>


<!----- Table Parents-->

             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Parent/ Guardian Information</th></tr>
    
    <tr><td colspan="4">Parent/Guardian 1</td></tr>

    <tr><td><input readonly="readonly" class="mandatory"  type="text" onchange='clearHighlight(this);' id="parentOneFullname" name="parentOneFullname" title="Full Name" placeholder="Full Name"/></td><td><select disabled   class="mandatory"  id="parentOneRel" name="parentOneRel" title="Relationship"><option value="">Relationship ... </option><option value="1">Father</option><option value="2">Mother</option><option value="3">Brother</option><option value="4">Sister</option><option value="5">Aunt</option><option value="6">Uncle</option><option value="7">Grand-Father</option><option value="8">Grand-Mother</option><option value="9">Other</option></select disabled  ></td><td><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentOneRelOther" name="parentOneRelOther" title="Other Relationship" placeholder="If Other, Specify"/></td><td></td></tr>
    
    <tr><td><input readonly="readonly" class="mandatory"  type="text" onchange='clearHighlight(this);' id="parentOnePhone" name="parentOnePhone" title="Phone Number" placeholder="Phone Number"/></td></td><td><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentOneEmail" name="parentOneEmail" title="Email" placeholder="Email"/></td><td><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentOneJob" name="parentOneJob" title="Occupation" placeholder="Occupation"/></td><td></td></tr>
    
    <tr><td colspan="3"><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentOneHome" name="parentOneHome" title="Residence" placeholder="Residence"/></td><td colspan="1">&nbsp;</td></tr>
    
    <tr><td colspan="4">&nbsp;</td></tr>

	<tr><td colspan="4">Parent/Guardian 2</td></tr>
	
    <tr><td><input readonly="readonly"  type="text" onchange='clearHighlight(this);' id="parentTwoFullname" name="parentTwoFullname" title="Full Name" placeholder="Full Name"/></td><td><select disabled    id="parentTwoRel" name="parentTwoRel" title="Relationship"><option value="">Relationship ... </option><option value="1">Father</option><option value="2">Mother</option><option value="3">Brother</option><option value="4">Sister</option><option value="5">Aunt</option><option value="6">Uncle</option><option value="7">Grand-Father</option><option value="8">Grand-Mother</option><option value="9">Other</option></select disabled  ></td><td><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentTwoRelOther" name="parentTwoRelOther" title="Other Relationship" placeholder="If Other, Specify"/><td></td></td></tr>
    
    <tr><td><input readonly="readonly"  type="text" onchange='clearHighlight(this);' id="parentTwoPhone" name="parentTwoPhone" title="Phone Number" placeholder="Phone Number"/></td></td><td><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentTwoEmail" name="parentTwoEmail" title="Email" placeholder="Email"/></td><td><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentTwoJob" name="parentTwoJob" title="Occupation" placeholder="Occupation"/></td><td></td></tr>
    
    <tr><td colspan="3"><input readonly="readonly" type="text" onchange='clearHighlight(this);' id="parentTwoHome" name="parentTwoHome" title="Residence" placeholder="Residence"/></td><td colspan="1">&nbsp;</td></tr>       
    
<!-- Class Details-->

             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Academic Information</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
             
    <tr>
        <td colspan="2">Class Admitted into: <br> <select disabled   class="mandatory" id="entryClass" name="entryClass"><option value="">Entry Class</option><option value="1">Play Group</option><option value="2">Nursery</option><option value="3">Pre-School</option><option value="4">STD One</option><option value="5">STD Two</option><option value="6">STD Three</option><option value="7">STD Four</option><option value="8">STD Five</option><option value="9">STD Six</option><option value="10">STD Seven</option><option value="11">STD Eight</option></select disabled  ></td>
        <td colspan="2">First School?: <br> <select disabled   id="firstSchool" name="firstSchool"><option value="">First School? ... </option><option value="1">Yes</option><option value="0">No</option></select disabled  ></td>
    </tr>
    <tr>
        <td colspan="2">If Yes, Name previous School: <br> <input readonly="readonly" type="text" onchange='clearHighlight(this);' id="formerSchool" name="formerSchool" title="Former School" placeholder="If No, Former School"/></td>
        <td colspan="2">Last Exam score from last school: <br> <input readonly="readonly" type="text" onchange='clearHighlight(this);' id="lastScore" name="lastScore" title="Last Score" placeholder="If No, Last Score"/></td>
    </tr>
    <tr><td colspan="2"> Interviewed?<input readonly="readonly" type="checkbox" name="interviewed" id="interviewed" value="1"/></td>
        <td colspan="2">If Yes, Interview Score<input readonly="readonly" type="text" onchange='clearHighlight(this);' id="interviewScore" name="interviewScore" title="Interview Score" placeholder="Interview Score"/></td>
    </tr>
    
            

<!--Table Talents-->

             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Talents Information</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
             
             <tr><td colspan="4">
              
                <select disabled   class="mandatory" id="getTalent" name="talents[]" multiple style="height: <br>125px;min-width: <br>250px;"></select disabled  >
            
                <input readonly="readonly" type="text" onchange='clearHighlight(this);' id="talentOther" name="talentsOther" title="Other Talents/ Gifts" placeholder="If other, Specify"/>
        </td></tr>    
             

<!--Table Health -->

             <tr><td colspan="4">&nbsp;</td></tr>
    <tr><th colspan="4">Student's Talents Information</th></tr>
             <tr><td colspan="4">&nbsp;</td></tr>
             
            <tr><td colspan="3">Has the student with any known medical condition?</td></tr>
            <tr><td>

                    <select disabled   class="mandatory" id="getMed" name="medical[]" multiple style="height: <br>125px;min-width: <br>250px;"></select disabled  >
              
                    <input readonly="readonly" type="text" onchange='clearHighlight(this);' id="medicalOther" name="medicalOther" title="Other Medical Condition" placeholder="If other, Specify"/><input readonly="readonly" type="hidden" name="draft" value="1" id="draft"/>
            </td></tr>
             
</table>
