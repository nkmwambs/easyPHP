<?php
                                            $month_array_names = array(
                                                'January',
                                                'February',
                                                'March',
                                                'April',
                                                'May',
                                                'June',
                                                'July',
                                                'August',
                                                'September',
                                                'October',
                                                'November',
                                                'December'
                                                );
                                            $month_array_nums = range(1,12);
                                            $month_array = array_combine($month_array_nums,$month_array_names);

if(empty($data)){
	echo "<div id='error_div'>You are not permitted to access this area! Please contact the administrator!</div>";
}else{
	echo "<span style='float:left;'>Show:</span>";
	echo "<SELECT id='showQtr' name='showQtr' style='float:left;' onchange='getMthsforQtr();'><OPTION value=''>Select Quarter ...</OPTION>";
	foreach ($data[1] as $value) {
		echo "<OPTION>".$value->period."</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT id='showMnth' name='showMnth' style='float:left;'><OPTION value='0'>Select Month ...</OPTION>";
		//foreach($month_array as $num => $name):
          //     $option = (number_format($num,0)===number_format(date('m'),0))?                                 
            //   "<option value='".number_format($num,0)."' selected>".$name."</option>":
              // "<option value='".$num."'>".$name."</option>";  
              // echo $option;
        //endforeach;
	echo "</SELECT>";
	echo Resources::img("go.png",array("title"=>"Show","onclick"=>'showCspRpt();',"style"=>'cursor:pointer'));
//print_r($data[1]);
?>
	 	<div id='topDiv'>
                    
	 			<div id='caption' style='font-weight:bold;font-size:15pt;margin-left:auto;margin-right:auto;margin-bottom:20px;width:270px;height:auto;'>CSP Monthly Report (New)</div>
                                <form id="cspRpt" style="width:100%">
                                <table id='csp_report_form' class='nothing' style="font-size:9pt;">
                                    <colgroup><col width='50%'/><col width='50%'/></colgroup>
                                    <tr><td colspan="2"><div id='information' class='heading'>Reporting Information</div></td></tr>
                                    <tr><td class="inner" style="">
 
                                                Instructions: Please fill in the values for all white boxes in the form. Gray boxes 
                                                will auto-calculate based on the values you provided. Warning messages may occur asking you to 
                                                double check or  correct your work. An asterisk * means you can place your mouse over the 
                                                field for more information. For clarity on all terms and definitions, please click below
                                                for the CSP Terms and Definitions document.

                                        </td>
                                        <td align='right' style="padding:30px;">
                                            <span title="This the period which you are reporting for">Fiscal Year Quarter</span> <span style="color:red;">*</span>
                                            <select name="period" id="period">
                                                <!--<option value="#">Select Period</option>-->
                                                
                                                <?php
                                                $months = range(1,12);
                                                $qtrs = array_chunk($months,3);
                                                $chk = array(3,4,1,2);
                                                $cb = array_combine($chk,$qtrs);
                                                foreach ($cb as $q => $m){
                                                    $month = date('m');
                                                    $year = date('Y');
                                                    if(in_array($month,$m)){
                                                        $qtr = $q;
                                                        $fy = ($qtr===1 || $qtr===2)?$year+1:$year;
                                                          
                                                        }
                                                    } 
                                                    /**
                                                     * 1,2,3    = Index,0 = Qt 3
                                                     * 4,5,6    = Index,1 = Qt 4
                                                     * 7,8,9    = Index,2 = Qt 1
                                                     * 10,11,12 = Index,3 = Qt 2
                                                     */
                                                    ?>
                                                <option value="<?php echo 'FY'.$fy.'Q'.$qtr;?>"><?php echo 'FY'.$fy.'Q'.$qtr;?></option>
                                                <!--<option value="FY2015Q4">FY2015Q4</option>-->
                                            </select><br>

                                            Month <select name="month" id="month">
                                                <?php
                                                    foreach($month_array as $num => $name):
                                                        $option = (number_format($num,0)===number_format(date('m'),0))?                                 
                                                        "<option value='".number_format($num,0)."' selected>".$name."</option>":
                                                        "<option value='".$num."'>".$name."</option>";  
                                                        echo $option;
                                                    endforeach;
                                                ?>
                                            </select><br>
                                            KE Number <span style="color:red;">*</span> <input type="text" value="<?php echo Resources::session()->fname;?>" id="keno" name="keno" readonly="readonly"/><br>
                                            CSP Number <span style="color:red;">*</span>
                                            
                                            <select name="cspNo" id="cspNo" class="rData">
                                                <option value="<?php echo $data[0][0]->csp_num;?>"><?php echo $data[0][0]->cspNo;?></option>

                                            </select><br>
                                             
                                        </td>
                                    </tr>

                                    <tr><td colspan="2"><div id='beneficiaries' class='heading' style="">Beneficiaries</div></td></tr>
                                    <tr><td class="inner" align='right'  style="padding:30px;">
                                        
                                            Caregivers at the month end, how many caregivers were:<br>
                                            Pregnant <input type="text" name="pregNo" onblur="calcCsp();" class="nums" id="pregNo" value="0"/> <br>
                                            Not Pregnant <input type="text" name="noPregNo" onblur="calcCsp();" class="nums"  id="noPregNo" value="0"/>
                                            <p></p>
                                            <i>Total Caregiver Beneficiaries</i> <input type="text" class="nums" id="totCaregivers" name="totCaregivers" value="0" readonly="readonly"/>
                                            
                                        </td>
                                        <td align='right'  style="padding:30px;">
                                            Children at the month end, how many children were:<br>
                                            Ages Birth - 12 months <input type="text" name="cat1Births" onblur="calcCsp();" class="nums" id="cat1Births" value="0"/><br>
                                            Ages 13 - 24 months <input type="text" name="cat2Births" onblur="calcCsp();" class="nums" id="cat2Births" value="0"/><br>
                                            Ages 25 - 36 months <input type="text" name="cat3Births" onblur="calcCsp();" class="nums" id="cat3Births" value="0"/><br>
                                            Ages over 36 months (still home-based) * <input type="text" name="cat4Births" onblur="calcCsp();" class="nums" id="cat4Births" value="0"/><br>
                                            <i>Total Child Beneficiaries</i> <input type="text" class="nums" id="totChildren" name="totChildren" value="0" readonly="readonly"/>
                                            
                                        </td></tr>
                                    <tr><td colspan="2" align="center"><i>Total Mother-Child-Units <span style="color:red;">*</span> </i><input type="text" class="nums" id="totmcu" name="totmcu" readonly="readonly" value="0"/></td></tr>

                                    <tr><td colspan="2"><div id='caregivers_births' class='heading' style="">Caregivers & Births</div></td></tr>
                                    <tr><td class="inner" align='right'  style="padding:30px;">
                                            Caregivers at the month end:<br>
                                            Of the Pregnant Caregivers reported above:<br> 
                                            How many are <b>currently receiving prenatal care?</b> <input type="text" name="noPreCare" class="nums" id="noPreCare" value="0"/><br>
                                            Of the Total Caregiver Beneficiaries calculated above:<br>
                                            How many are <b>currently breastfeeding?</b><input type="text" name="noBreast" class="nums" id="noBreast" value="0"/>
                                        </td>
                                        <td align='right'  style="padding:30px;">
                                            Live Births<br>During the <u>full month</u>, how many babies were:<br>
                                    <b>Born Prematurely</b> (less than 37 weeks) <input type="text" id="noPremature"  onblur="calcCsp();" name="noPremature" class="nums" value="0"/><br>
                                    <b>Born at full-term</b> (37 weeks or more) <input type="text" id="noFull" name="noFull"  onblur="calcCsp();" class="nums" value="0"/><br>
                                    <i>Total Live Births  </i><input type="text" id="totLive" name="totLive" value="0" class="nums" readonly="readonly"/><br>
                                    Of the <i>Total Live Births</i> reported above, how many were:<br>
                                    <b>Attended by a skilled birth attendant</b> <input type="text" id="noSkilled" name="noSkilled" class="nums" value="0"/><br>
                                    <b>Normal birth weight</b> (2.5 kg or more)<input type="text" id="noNormWt" name="noNormWt" class="nums" value="0"/><br>
                                </td></tr>
                                    <tr><td colspan="2"><div id='deaths' class='heading' style="">Deaths</div></td></tr>
                                    <tr><td colspan="2" style="padding:20px;">
                                                <b>Please submit a Beneficiary Death Form via the PDCS site for all beneficiary deaths (caregiver                                                           and child) within 30 days of the death. For help filling out the form, please see the Beneficiary                                                        Death Instructions.</b></td></tr>
                                    <tr><td colspan="2"><div id='diseases_injuries' class='heading' style="">Child Diseases & Injuries</div></td></tr>
                                    <tr><td class="inner" align='right'  style="padding:30px;">
                                    <u>Diagnosed Child Diseases</u><br>
                                    During the <u>full month</u>, how many incidences of the following diseases were diagnosed by a health Professional:<br>
                                    <b>Diarrhea</b> <input type="text" name="diagDia" id="diagDia"  onblur="calcCsp();"  class="nums vec" value="0"/> <br>
                                    <b>Acute Respiratory Infections *</b> <input type="text" name="diagRes" id="diagRes" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                    <b>Moderate malnutrition</b>  <input type="text" name="diagMoMal" id="diagMoMal" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                    <b>Severe malnutrition</b>  <input type="text" name="diagSeMal" id="diagSeMal" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                        
                                    <b>Vector-borne</b> <br>
                                    <b>Malaria</b> <input type="text" name="vecMal" id="vecMal" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                    <b>Dengue</b> <input type="text" name="vecDen" id="vecDen" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                    <b>Yellow Fever</b> <input type="text" name="vecYel" id="vecYel" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                    <b>Japanese Encephalitis</b> <input type="text" name="vecEnc" onblur="calcCsp();" id="vecEnc" class="nums vec" value="0"/> <br>
                                    <b>Other vector-borne</b> <input type="text" name="vecOth" id="vecOth" onblur="calcCsp();" class="nums vec" value="0"/> <br>
                                    <i>Total Diagnosed Child Diseases</i> <input type="text" name="totSick" id="totSick" class="nums" value="0" readonly="readonly"/>
                                        </td>
                                        <td align='right'  style="padding:30px;">
                                        <u>Child Injuries Requiring Medical Attention</u>
                                        During the <u>full month</u>, how many of the following injuries were sustained that required medical attention:<br>
                                        <b>Falls</b> <input type="text" name="injFall"  onblur="calcCsp();" id="injFall" class="nums inj" value="0"/> <br>
                                        <b>Burns</b><input type="text" name="injBurn" id="injBurn" onblur="calcCsp();"  class="nums inj" value="0"/> <br>
                                        <b>Poisoning</b><input type="text" name="injPoison"  onblur="calcCsp();" id="injPoison" class="nums inj" value="0"/> <br>
                                        <b>Vehicular Accidents</b><input type="text" name="injAcc"  onblur="calcCsp();" id="injAcc" class="nums inj" value="0"/> <br>
                                        <b>Near Drowning</b><input type="text" name="injDrown"  onblur="calcCsp();" id="injDrown" class="nums inj" value="0"/> <br>
                                        <i>Total Child Injuries</i> <input type="text" name="totInj" id="totInj" class="nums" value="0" readonly="readonly"/>
                                        </td></tr>
                                    <tr><td colspan="2"><div id='departures_transitions' class='heading' style="">Departure & Transitions</div></td></tr>
                                    <tr><td colspan="2" align='right' style="padding:20px;">
                                            During the <u>full</u> month, how many beneficiaries were departed for the following reasons:<br>
                                    The <b>CSP Caregiver</b> is no longer interested in participating in the CSP and <b>requests to be departed</b> <input type="text" name="depNoInt" id="depNoInt" onblur="calcCsp();"  class="nums dep" value="0"/><br>
                                    <b>Not attending program activities </b>(group activities or home visits)<b> for 2 consecutive months </b>(unjustified absence) <input type="text" name="depNotAtt" id="depNotAtt" onblur="calcCsp();"  class="nums dep" value="0"/><br>
                                    <b>The CSP Caregiver passes away</b> and no other suitable caregiver commits to participate within 3 months <input type="text" name="depCgPassed" id="depCgPassed" onblur="calcCsp();"  class="nums dep" value="0"/><br>
                                    <b> The CSP pregnant mother has a miscarriage or the CSP child dies</b> <input type="text" name="depMisDead" id="depMisDead" onblur="calcCsp();"  class="nums dep" value="0"/><br>
                                    <b>The beneficiary moves</b> to an area that does not allow for reasonable access to another home-based project <input type="text" name="depMove" id="depMove" class="nums dep"  onblur="calcCsp();"  value="0"/><br>
                                    <b>The CSP project terminates</b> and the Field Office is not able to transfer the CSP beneficiary to another CSP project <input type="text" name="depEnd" id="depEnd" class="nums dep"  onblur="calcCsp();"  value="0"/><br>
                                    <b>The Caregiver or child places the welfare of other beneficiaries at risk</b> due to aggressive or offensive behaviors <input type="text" name="depRisk" id="depRisk" class="nums dep"  onblur="calcCsp();"  value="0"/><br>
                                    <b> The child reaches his/her fourth birthday</b> and is not transitioned to CDSP <input type="text" name="depTrans" id="depTrans" class="nums dep"  onblur="calcCsp();"  value="0"/><br>
                                    <b>Family circumstances have changed positively</b> so that the beneficiaries no longer need Compassion's assistance <input type="text" name="depOk" id="depOk" class="nums dep"  onblur="calcCsp();"  value="0"/><br>
                                    <i>Total Departures</i> <input type="text" name="totDep" id="totDep" class="nums" value="0" readonly="readonly"/><br>
                                    <b>Transition:  The child is officially registered in CDSP/center-based programming <span style="color:red;">*</span></b> <input type="text" name="totTrans" id="totTrans" class="nums" value="0"/><br>
                                        </td></tr>
                                    <tr><td colspan="2"><div id='spiritual_development' class='heading' style="">Spiritual Development</div></td></tr>
                                    <tr><td colspan="2" align='right' style="padding:20px;">
                                            During the <u>full month</u>, how many:<br>
                                    <b>Primary Caregivers made a first-time profession of faith in Christ</b> <input type="text" name="saved" id="saved" class="nums" value="0"/><br>
                                     
                                        </td></tr>
                        <tr><td colspan="2"><div id='newbeneficiaries' class='heading' style="">New Enrolments</div></td></tr>
                                    <tr><td  colspan="2" align='right'  style="padding:30px;">Children and Caregivers Enrolments for the month:<br>
                                            Number of new pregnant mothers' enrolled in the CSP this month: <input type='text' name="newCaregivers" id="newCaregivers"  value="0"/><br>
                                            Number of new children enrolled in the CSP this month: <input type="text" id="newChildren" name="newChildren"  value="0"/>
                                    
                                        </td></tr>
                                            <tr><td colspan="2"><div id='att_dev' class='heading' style="">Attendance and Development</div></td></tr>                                        <tr><td  colspan="2" align='right'  style="padding:30px;">
                                                    Number of MCU's that attended programming this month: <input type="text" id="noAttend" name="noAttend"  style="width:50px;"  value="0"/><br>
                                                    Number of fathers that participated in CSP activities this Month: <input type="text" id="noFathers" name="noFathers"  style="width:50px;"  value="0"/><br>

                                                    Number of CSP caregivers that acquired functional literacy skills (as a result of CSP intervention this month: <input type="text" id="skills" name="skills" style="width:50px;"  value="0"/><br>
                                                    Number of CSP beneficiaries that are within normal progression in socio-emotional outcome indicators this Month: <input type="text" id="seDev" name="seDev"  style="width:50px;"  value="0"/><br>
                                                    Number of CSP beneficiaries that are within normal progression in cognitive development indicators this Month: <input type="text" id="coDev" name="coDev"  style="width:50px;"  value="0"/><br>


                                    
                                    <!--<input type="hidden" name="stmp" id="stmp" value=""-->
                                                    
                                        </td></tr>
                                        <tr><td colspan="2" align='center' style="padding:20px;">
                                                <!--<button>Close</button>--><!--<button>Save</button>-->
                                                
                                            </td></tr>
                                </table>
                                </form>   
                                <button onclick='submitCsp("cspRpt");'>Submit</button>
	 	</div>
	 	<?php
	 		}
	 	?>