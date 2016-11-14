<?php
//print_r($data);
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
if(Resources::session()->userlevel==='1'){												
	echo Resources::a_href("Reports/csp","<button>Create Report</button>");	
}else{
	echo Resources::a_href("Reports/viewCsp","<button>Report Grid</button>");	
}											
?>
<div id='caption' style='font-weight:bold;font-size:15pt;margin-left:auto;margin-right:auto;margin-bottom:20px;width:320px;height:auto;'>CSP Monthly Report (Preview)</div>
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
                                            <span>Fiscal Year Quarter</span> <span class='info'  title="This the period which you are reporting for" style="color:red;">*</span>
                                            <select name="period" id="period">
                                                <option value="<?php echo $data[0]->period;?>"><?php echo $data[0]->period;?></option>
                                            </select><br>

                                            Month <select name="month" id="month">
                                             <option value='<?php echo $data[0]->month;?>'><?php echo $month_array_names[$data[0]->month-1];?></option>
                                            </select><br>
                                            KE Number <span style="color:red;">*</span> <input type="text" readonly  value="<?php echo $data[0]->keno;?>" id="keno" name="keno" readonly="readonly"/><br>
                                            CSP Number <span style="color:red;">*</span>
                                            
                                            <select name="cspNo" id="cspNo" class="rData">
                                                <option value="<?php echo $data[0]->cspNo;?>"><?php echo "CS".$data[0]->cspNo;?></option>

                                            </select><br>
                                             
                                        </td>
                                    </tr>

                                    <tr><td colspan="2"><div id='beneficiaries' class='heading' style="">Beneficiaries</div></td></tr>
                                    <tr><td class="inner" align='right'  style="padding:30px;">
                                        
                                            Caregivers at the month end, how many caregivers were:<br>
                                            Pregnant <input type="text" readonly  name="pregNo" onblur="calcCsp();" class="nums" id="pregNo" value="<?php echo $data[0]->pregNo;?>"/> <br>
                                            Not Pregnant <input type="text" readonly  name="noPregNo" onblur="calcCsp();" class="nums"  id="noPregNo" value="<?php echo $data[0]->noPregNo;?>"/>
                                            <p></p>
                                            <i>Total Caregiver Beneficiaries</i> <input type="text" readonly  class="nums" id="totCaregivers" name="totCaregivers" value="<?php echo $data[0]->totCaregivers;?>" readonly="readonly"/>
                                            
                                        </td>
                                        <td align='right'  style="padding:30px;">
                                            Children at the month end, how many children were:<br>
                                            Ages Birth - 12 months <input type="text" readonly  name="cat1Births" onblur="calcCsp();" class="nums" id="cat1Births" value="<?php echo $data[0]->cat1Births;?>"/><br>
                                            Ages 13 - 24 months <input type="text" readonly  name="cat2Births" onblur="calcCsp();" class="nums" id="cat2Births" value="<?php echo $data[0]->cat2Births;?>"/><br>
                                            Ages 25 - 36 months <input type="text" readonly  name="cat3Births" onblur="calcCsp();" class="nums" id="cat3Births" value="<?php echo $data[0]->cat3Births;?>"/><br>
                                            Ages over 36 months (still home-based) * <input type="text" readonly  name="cat4Births" onblur="calcCsp();" class="nums" id="cat4Births" value="<?php echo $data[0]->cat4Births;?>"/><br>
                                            <i>Total Child Beneficiaries</i> <input type="text" readonly  class="nums" id="totChildren" name="totChildren" value="<?php echo $data[0]->totChildren;?>" readonly="readonly"/>
                                            
                                        </td></tr>
                                    <tr><td colspan="2" align="center"><i>Total Mother-Child-Units <span style="color:red;">*</span> </i><input type="text" readonly  class="nums" id="totmcu" name="totmcu" readonly="readonly" value="<?php echo $data[0]->totmcu;?>"/></td></tr>

                                    <tr><td colspan="2"><div id='caregivers_births' class='heading' style="">Caregivers & Births</div></td></tr>
                                    <tr><td class="inner" align='right'  style="padding:30px;">
                                            Caregivers at the month end:<br>
                                            Of the Pregnant Caregivers reported above:<br> 
                                            How many are <b>currently receiving prenatal care?</b> <input type="text" readonly  name="noPreCare" class="nums" id="noPreCare" value="<?php echo $data[0]->noPreCare;?>"/><br>
                                            Of the Total Caregiver Beneficiaries calculated above:<br>
                                            How many are <b>currently breastfeeding?</b><input type="text" readonly  name="noBreast" class="nums" id="noBreast" value="<?php echo $data[0]->noBreast;?>"/>
                                        </td>
                                        <td align='right'  style="padding:30px;">
                                            Live Births<br>During the <u>full month</u>, how many babies were:<br>
                                    <b>Born Prematurely</b> (less than 37 weeks) <input type="text" readonly  id="noPremature"  onblur="calcCsp();" name="noPremature" class="nums" value="<?php echo $data[0]->noPremature;?>"/><br>
                                    <b>Born at full-term</b> (37 weeks or more) <input type="text" readonly  id="noFull" name="noFull"  onblur="calcCsp();" class="nums" value="<?php echo $data[0]->noFull;?>"/><br>
                                    <i>Total Live Births  </i><input type="text" readonly  id="totLive" name="totLive" value="<?php echo $data[0]->totLive;?>" class="nums" readonly="readonly"/><br>
                                    Of the <i>Total Live Births</i> reported above, how many were:<br>
                                    <b>Attended by a skilled birth attendant</b> <input type="text" readonly  id="noSkilled" name="noSkilled" class="nums" value="<?php echo $data[0]->noSkilled;?>"/><br>
                                    <b>Normal birth weight</b> (2.5 kg or more)<input type="text" readonly  id="noNormWt" name="noNormWt" class="nums" value="<?php echo $data[0]->noNormWt;?>"/><br>
                                </td></tr>
                                    <tr><td colspan="2"><div id='deaths' class='heading' style="">Deaths</div></td></tr>
                                    <tr><td colspan="2" style="padding:20px;">
                                                <b>Please submit a Beneficiary Death Form via the PDCS site for all beneficiary deaths (caregiver and child) within 30 days of the death. For help filling out the form, please see the Beneficiary                                                        Death Instructions.</b></td></tr>
                                    <tr><td colspan="2"><div id='diseases_injuries' class='heading' style="">Child Diseases & Injuries</div></td></tr>
                                    <tr><td class="inner" align='right'  style="padding:30px;">
                                    <u>Diagnosed Child Diseases</u><br>
                                    During the <u>full month</u>, how many incidences of the following diseases were diagnosed by a health Professional:<br>
                                    <b>Diarrhea</b> <input type="text" readonly  name="diagDia" id="diagDia"  onblur="calcCsp();"  class="nums vec" value="<?php echo $data[0]->diagDia;?>"/> <br>
                                    <b>Acute Respiratory Infections *</b> <input type="text" readonly  name="diagRes" id="diagRes" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->diagRes;?>"/> <br>
                                    <b>Moderate malnutrition</b>  <input type="text" readonly  name="diagMoMal" id="diagMoMal" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->diagMoMal;?>"/> <br>
                                    <b>Severe malnutrition</b>  <input type="text" readonly  name="diagSeMal" id="diagSeMal" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->diagSeMal;?>"/> <br>
                                        
                                    <b>Vector-borne</b> <br>
                                    <b>Malaria</b> <input type="text" readonly  name="vecMal" id="vecMal" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->vecMal;?>"/> <br>
                                    <b>Dengue</b> <input type="text" readonly  name="vecDen" id="vecDen" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->vecDen;?>"/> <br>
                                    <b>Yellow Fever</b> <input type="text" readonly  name="vecYel" id="vecYel" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->vecYel;?>"/> <br>
                                    <b>Japanese Encephalitis</b> <input type="text" readonly  name="vecEnc" onblur="calcCsp();" id="vecEnc" class="nums vec" value="<?php echo $data[0]->vecEnc;?>"/> <br>
                                    <b>Other vector-borne</b> <input type="text" readonly  name="vecOth" id="vecOth" onblur="calcCsp();" class="nums vec" value="<?php echo $data[0]->vecOth;?>"/> <br>
                                    <i>Total Diagnosed Child Diseases</i> <input type="text" readonly  name="totSick" id="totSick" class="nums" value="<?php echo $data[0]->totSick;?>" readonly="readonly"/>
                                        </td>
                                        <td align='right'  style="padding:30px;">
                                        <u>Child Injuries Requiring Medical Attention</u>
                                        During the <u>full month</u>, how many of the following injuries were sustained that required medical attention:<br>
                                        <b>Falls</b> <input type="text" readonly  name="injFall"  onblur="calcCsp();" id="injFall" class="nums inj" value="<?php echo $data[0]->injFall;?>"/> <br>
                                        <b>Burns</b><input type="text" readonly  name="injBurn" id="injBurn" onblur="calcCsp();"  class="nums inj" value="<?php echo $data[0]->injBurn;?>"/> <br>
                                        <b>Poisoning</b><input type="text" readonly  name="injPoison"  onblur="calcCsp();" id="injPoison" class="nums inj" value="<?php echo $data[0]->injPoison;?>"/> <br>
                                        <b>Vehicular Accidents</b><input type="text" readonly  name="injAcc"  onblur="calcCsp();" id="injAcc" class="nums inj" value="<?php echo $data[0]->injAcc;?>"/> <br>
                                        <b>Near Drowning</b><input type="text" readonly  name="injDrown"  onblur="calcCsp();" id="injDrown" class="nums inj" value="<?php echo $data[0]->injDrown;?>"/> <br>
                                        <i>Total Child Injuries</i> <input type="text" readonly  name="totInj" id="totInj" class="nums" value="<?php echo $data[0]->totInj;?>" readonly="readonly"/>
                                        </td></tr>
                                    <tr><td colspan="2"><div id='departures_transitions' class='heading' style="">Departure & Transitions</div></td></tr>
                                    <tr><td colspan="2" align='right' style="padding:20px;">
                                            During the <u>full</u> month, how many beneficiaries were departed for the following reasons:<br>
                                    The <b>CSP Caregiver</b> is no longer interested in participating in the CSP and <b>requests to be departed</b> <input type="text" readonly  name="depNoInt" id="depNoInt" onblur="calcCsp();"  class="nums dep" value="<?php echo $data[0]->depNoInt;?>"/><br>
                                    <b>Not attending program activities </b>(group activities or home visits)<b> for 2 consecutive months </b>(unjustified absence) <input type="text" readonly  name="depNotAtt" id="depNotAtt" onblur="calcCsp();"  class="nums dep" value="<?php echo $data[0]->depNotAtt;?>"/><br>
                                    <b>The CSP Caregiver passes away</b> and no other suitable caregiver commits to participate within 3 months <input type="text" readonly  name="depCgPassed" id="depCgPassed" onblur="calcCsp();"  class="nums dep" value="<?php echo $data[0]->depCgPassed;?>"/><br>
                                    <b> The CSP pregnant mother has a miscarriage or the CSP child dies</b> <input type="text" readonly  name="depMisDead" id="depMisDead" onblur="calcCsp();"  class="nums dep" value="<?php echo $data[0]->depMisDead;?>"/><br>
                                    <b>The beneficiary moves</b> to an area that does not allow for reasonable access to another home-based project <input type="text" readonly  name="depMove" id="depMove" class="nums dep"  onblur="calcCsp();"  value="<?php echo $data[0]->depMove;?>"/><br>
                                    <b>The CSP project terminates</b> and the Field Office is not able to transfer the CSP beneficiary to another CSP project <input type="text" readonly  name="depEnd" id="depEnd" class="nums dep"  onblur="calcCsp();"  value="<?php echo $data[0]->depEnd;?>"/><br>
                                    <b>The Caregiver or child places the welfare of other beneficiaries at risk</b> due to aggressive or offensive behaviors <input type="text" readonly  name="depRisk" id="depRisk" class="nums dep"  onblur="calcCsp();"  value="<?php echo $data[0]->depRisk;?>"/><br>
                                    <b> The child reaches his/her fourth birthday</b> and is not transitioned to CDSP <input type="text" readonly  name="depTrans" id="depTrans" class="nums dep"  onblur="calcCsp();"  value="<?php echo $data[0]->depTrans;?>"/><br>
                                    <b>Family circumstances have changed positively</b> so that the beneficiaries no longer need Compassion's assistance <input type="text" readonly  name="depOk" id="depOk" class="nums dep"  onblur="calcCsp();"  value="<?php echo $data[0]->depOk;?>"/><br>
                                    <i>Total Departures</i> <input type="text" readonly  name="totDep" id="totDep" class="nums" value="0" readonly="readonly"/><br>
                                    <b>Transition:  The child is officially registered in CDSP/center-based programming <span style="color:red;">*</span></b> <input type="text" readonly  name="totTrans" id="totTrans" class="nums" value="<?php echo $data[0]->totTrans;?>"/><br>
                                        </td></tr>
                                    <tr><td colspan="2"><div id='spiritual_development' class='heading' style="">Spiritual Development</div></td></tr>
                                    <tr><td colspan="2" align='right' style="padding:20px;">
                                            During the <u>full month</u>, how many:<br>
                                    <b>Primary Caregivers made a first-time profession of faith in Christ</b> <input type="text" readonly  name="saved" id="saved" class="nums" value="<?php echo $data[0]->saved;?>"/><br>
                                     
                                        </td></tr>
                        <tr><td colspan="2"><div id='newbeneficiaries' class='heading' style="">New Enrolments</div></td></tr>
                                    <tr><td  colspan="2" align='right'  style="padding:30px;">Children and Caregivers Enrolments for the month:<br>
                                            Number of new pregnant mothers' enrolled in the CSP this month: <input type='text' name="newCaregivers" id="newCaregivers"  value="<?php echo $data[0]->newCaregivers;?>"/><br>
                                            Number of new children enrolled in the CSP this month: <input type="text" readonly  id="newChildren" name="newChildren"  value="<?php echo $data[0]->newChildren;?>"/>
                                    
                                        </td></tr>
                                            <tr><td colspan="2"><div id='att_dev' class='heading' style="">Attendance and Development</div></td></tr>
                                            <tr><td  colspan="2" align='right'  style="padding:30px;">
                                                    Number of MCU's that attended programming this month: <input type="text" readonly  id="noAttend" name="noAttend"  style="width:50px;"  value="<?php echo $data[0]->noAttend;?>"/><br>
                                                    Number of fathers that participated in CSP activities this Month: <input type="text" readonly  id="noFathers" name="noFathers"  style="width:50px;"  value="<?php echo $data[0]->noFathers;?>"/><br>

                                                    Number of CSP caregivers that acquired functional literacy skills (as a result of CSP intervention this month: <input type="text" readonly  id="skills" name="skills" style="width:50px;"  value="<?php echo $data[0]->skills;?>"/><br>
                                                    Number of CSP beneficiaries that are within normal progression in socio-emotional outcome indicators this Month: <input type="text" readonly  id="seDev" name="seDev"  style="width:50px;"  value="<?php echo $data[0]->seDev;?>"/><br>
                                                    Number of CSP beneficiaries that are within normal progression in cognitive development indicators this Month: <input type="text" readonly  id="coDev" name="coDev"  style="width:50px;"  value="<?php echo $data[0]->coDev;?>"/><br>


                                    
                                    <!--<input type="hidden" name="stmp" id="stmp" value=""-->
                                                    
                                        </td></tr>
                                        <tr><td colspan="2" align='center' style="padding:20px;">
                                                <!--<button>Close</button>--><!--<button>Save</button>-->
                                                
                                            </td></tr>
                                </table>
                                </form>   
                               <button onclick='deleteCsp("<?php echo $data[0]->rid;?>")'>Delete</button>
