<?php // session_start();
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}
?>

        <style>
			span{font-weight:bolder;}
            input[type='text']{width:200px}
            .otherFld{width: 600px;}
        </style>
        


        <?php 
        echo Resources::a_href("Reports/manageHvc","<button>View/Manage</button>")."<br><br>";
        $limit = 3;//DLookup1("limit","hvc_limit","prg='2'"); $msg = $limit+1;?>
        <!--<input type="text" value="<?php echo $limit ?>"/>-->
       <!-- <div style="display:<? if($cnt<=$limit){echo 'none';}else{echo 'block';} ?>;">You have reached the maximum number (<?php //echo $msg; ?> cases) allowable to index!</div>
        <div style="display:<? if($cnt<=$limit){echo 'block';}else{echo 'none';} ?>;">-->

                <span style="font-weight: bolder; font-size: 25px; position: relative; left: 200px;">HIGHLY VULNERABLE CHILD IDENTIFICATION TOOL</span>            
                <ol start="1">
                    <li>Read through the Items before filling them</li>
                    <li>First identify children that you would regard as vulnerable among Compassion registered children before filling this form</li>
                    <li>Fill this form for every identified vulnerable child from the registered children</li>
                    <li>Submit this form before 15th September</li>
                    <li>This is a new recruitment for the next financial year and only those children that have not benefited from the HVC support 
                        should be included in this recruitment. Incase you want to include a child who has already benefited from HVC kindly 
                        confirm with the PF before hand</li>
                </ol>
                <div>
               <form id='indexing'>
                
                <span style="color: red;">* Required</span>
                <p>
                    <span>Cluster Name <span style="color:red;">*</span><br><input type="text" name="cst" id="cstName" class='validate' value="<?php echo $data['clst']; ?>" readonly="readOnly"/></span>
                </p>
                <p>
                    <span>Project's Number <span style="color:red;">*</span><br><input type="text" name="pNo" id="pNo" value="<?php echo $data['icp'];?>"   class='validate' readonly="readOnly"/></span>
                </p>
                <p>
                	<span>Program<span style="color:red;">*</span></span><br>
                	<select name="prg"  class='validate' >
                		<option value="">Select Program</option>
                		<option value="1">CSP</option>
                		<option value="2">CDSP</option>
                	</select>
                </p>
                <p>
                    <span>Child's KE Number <span style="color:red;">*</span>Enter the number without <?php echo Resources::session()->fname; ?> prefix and the leading Zeroes!<br><input type="text" name="childNo"  class='validate'  id="childNo" onchange="changeClr(this.id);"  onblur="completeChildNo(this);" placeholder="Child Number" style=""/></span>
                </p>
                <p>
                    <span>Child's Name <span style="color:red;">*</span><br><input placeholder="Child Name as Per the S and G" type="text" name="childName" id="childName"  class='validate' /></span>
                </p>
                <p>
                    <span>Child's Date of Birth <span style="color:red;">*</span><br><input placeholder="Child date of birth" type="text" name="dob" id="childDOB" readonly="readOnly"  class='validate'  onchange="calcAge(this);"/></span>
                </p>                
                <p>
                    <span>Child's Age (Years)<span style="color:red;">*</span><br><input placeholder="Child Current Age" type="text" name="age" id="childAge" readonly="readOnly"  class='validate' /></span>
                </p>
                <p>
                    <span>Child's Sex <span style="color:red;">*</span></span><br>
                    <select name="sex" id="childSex"  class='validate' >
                    	<option value="M">Male</option>
                    	<option value="F">Female</option>
                    	<option value="" selected="">Select Gender</option>
                    </select>
                    
                    <!--<input placeholder="Child Gender" type="text" name="sex" id="childSex" readonly="readOnly"/>-->
                </p>
                <p>
                            <span>Type of Vulnerability<span style="color:red;">*</span></span><br>

                                    <?php 
                                   // $sql = "SELECT * FROM vulnerability";
                                   // $qry = mysql_query($sql);
                                    foreach ($data['vul'] as $rows) {    
                                  	
                                    echo "<input type='checkbox' name='vul[]' value='".$rows->vul."'/><span style='font-weight:normal;'>".$rows->vul."</span><br>";
                                    }
                                    echo "Other (Specify): <input type='text' id='' class='otherFld' name='vul[]'/>";
                                    ?>
  
                            
                </p>
                <p>
                    <span>Number of months of required for HVC intervention <span style="color:red;">*</span><br><input type="text" name="mths" id="mths"   class='validate'  onchange="changeClr(this.id);" placeholder="Number of Months"/></span>
                </p>
                <p>
                    <span>Type of Intervention required through HVC support <span style="color:red;">*</span><br>These are interventions that can be accessed Only through HVC funds</span><br>
                            <!--<select name="supt" id="supt">
                                    <option value="#">Select proposed Intervention......</option>-->
                                    <?php 
                                   // $sqlInt = "SELECT * FROM intervention";
                                   // $qryInt = mysql_query($sqlInt);
                                    foreach($data['int'] as $rowsInt){
                                    echo "<input type='checkbox' name='intervene[]' value='".$rowsInt->intervene."'>".$rowsInt->intervene."<br>";
                                    }
                                    echo "Other (Specify): <input type='text' id='' class='otherFld' name='intervene[]' />";
                                    ?>
                           <!-- </select>-->
                    
                </p>
                <p>
                    <span>Other Non-HVC Interventions Required  <span style="color:red;">*</span><br>These interventions contribute to reducing child vulnerability but cannot be accessed through HVC funds. Other Compassion funds can be mobilized to compliment. </span><br>
                            <!--<select name="supt" id="supt">
                                    <option value="#">Select proposed Intervention......</option>-->
                                    <?php 
                                    //$sqlNon = "SELECT * FROM non_hvc_int";
                                    //$qryNon = mysql_query($sqlNon);
                                    foreach($data['otherInt'] as $rowsNon){
                                    echo "<input type='checkbox' name='othSup[]' value='".$rowsNon->nonHvc."'>".$rowsNon->nonHvc."<br>";
                                    }
                                    echo "Other (Specify): <input type='text' id='' class='otherFld' name='othSup[]' />";
                                    ?>
                           <!-- </select>-->
                    
                </p>
                <p>
                    <span>
                        Any other Intervention suitable for the child? <span style="color:red;">*</span> Include interventions that can be done under the HVC Strategy (Care reinforcement or replacement) 
                        <br>
                        <textarea cols="120" rows="3" name="othSup2" id="othInt" placeholder="Please enter your alternative intervention deem vital for this case!"/></textarea>
                    </span>
                </p>
                <p>
                    <span>
                        Future sustainability strategy to reduce child dependence on HVC Support <span style="color:red;">*</span><br> 
                        <textarea cols="120" rows="3" name="ftPlan" id="intSust"  class='validate' placeholder="Please enter your sustainability plan on this case!"/></textarea>                        
                    </span>
                </p>


                               </form> 
                                                    <p align="center">
                                                        <button id="cdspSubmit" onclick="submitHvcIndex();">Submit</button>
                                                            <!--<input type="submit" value="Submit" name="submit"/>-->
                                                    </p>
                </div>
        </div>
        
<?php


?>