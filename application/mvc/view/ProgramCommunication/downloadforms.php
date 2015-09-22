<?php
//echo $_POST['icpNo'];
	$form_arr=array(
		"EstimatedBirthdate"=>array("No","Yes"),
		"IsOrphan"=>array("No","Yes"),
		"HVC"=>array("No","Yes"),
		"Gender"=>array("","Male","Female"),
		"CognitiveAge"=>array("","0-2","3-5","6-8","9-11","12-14","15-18","19+"),
		"InfoType"=>array("","Initial Registration","Information Update"),
		"BeneficiaryProg"=>array("","CSP","CDSP"),
		"BeneficiaryProgtype"=>array("","Home-Based","Center-Based"),
		"Favoritesubject"=>array("","Social Studies","Science","Health","Physical Education","Music","Reading","Math","Language","History","Art"),
		"Formaleducation"=>array("","Primary","Secondary","Graduate","University","Preschool","Not enrolled"),
		"Currentyearofstudy"=>array("","5","6","7","4","3","2","1"),
		"Academicperformance"=>array("","Below Average","Average","Above Average"),
		"Typeofvocationaltraining"=>array("","Not Enrolled","Agriculture","Other","Automotive","Clothing Trades","Electrical/ Electronics","Transportation/ Driver","Cooking/ Food Service","Computer Technology","Business/ Administrative","Graphic Arts","Manufacturing/ Fabrication","Medical/ Health Services","Telecommunication","Cosmetology","Construction/ Tradesman","Income Generating Program at the Project"),
		"Childreligiousaffiliation"=>array("","Protestant","Jewish","None","Buddhist","Mormon","Hindu","Other","Ancestral","Tribal","Muslim","Catholic"),
		"ConfessJesus"=>array("","Unknown","No","Yes"),
		"Parentstogethernow"=>array("","Yes","Unknown","No"),
		"Maritalstatus"=>array("","Unknown","Were married, now divorced or permanently separated","Were married, now separated by death","Never married","Married"),
		"Naturalfatheralive"=>array("","Unknown","Yes","No"),
		"Naturalfatherlivingwithbenef"=>array("","No","Yes"),
		"NaturalmotherAlive"=>array("","Unknown","Yes","No"),
		"Naturalmotherlivingwithbenef"=>array("","No","Yes"),
		"fatheremploystatus"=>array("","Sometimes Employed","Not Employed","Regularly Employed"),
		"motheremploystatus"=>array("","Not Employed","Regularly Employed","Sometimes Employed"),
		"Primarycaregiver"=>array("","member3","member7","member8","member10","member11","member12","member9","member4","member5","member6","member1","member2"),
		"chkbx"=>array("No","Yes")
				
	);
	
	$flds=array(
				"majorcourses"=>array("Agriculture"=>"Agriculture","Economics"=>"Economics","Hospitality/ Hotel Management"=>"Hospitality","Science"=>"Science1","Biology/ Medicine"=>"Biology1","Education"=>"Education1","Law"=>"Law","Sociology / Social Science"=>"Sociology","Business/Management/Commerce"=>"Businessmanagement","Engineering"=>"Engineering","Mathematics"=>"Mathematics","Theology"=>"Theology","Community Development"=>"Communitydevelopment","English"=>"english1","Nursing"=>"nursing1","Tourism"=>"tourism","Computer Science / Information Technology"=>"informationtechnology","Graphic Arts / Fine Arts"=>"graphicarts","Psychology"=>"psychology","Criminology / Law Enforcement"=>"criminology","History"=>"history2","Sales and Marketing"=>"salesandmarketing","Other"=>"other2"),
				"familyduties"=>array("Caries Water"=>"Carrywater","Childcare"=>"childcare","Cleaning"=>"cleaning","Errands"=>"Errands","Sewing"=>"Sewing","Washing Clothes"=>"Washingclothes","Teaching Others"=>"Teachingothers","Kitchen Help"=>"Kitchenhelp","Making Beds"=>"Makingbeds","Gathers Firewood"=>"gathersfirweood","Gardening and Farming"=>"gardening","Buying and Selling in Market"=>"buyingandselling","Animal care"=>"animalcare","No family duties (Child under 3 years old)"=>"Nofamilyduties"),
				"christianactivities"=>array("Sunday School"=>"Sundayschool1","Bible Class"=>"bibleclass1","Camp"=>"camp1","Choir"=>"choir1","Youth Group"=>"Youthcamp1","Vocational Bible School"=>"vacationbibleschool"),
				"chronicillnesses"=>array("Asthma"=>"Asthma","Diabetes"=>"Diabetes","Polio"=>"Polio","Cerebral Palsy"=>"CerebralPalsy","Epilepsy"=>"Epilepsy","Cystic Fibrosis"=>"CysticFibrosis","Spina Bifida"=>"SpinaBifida","Cancer"=>"Cancer","Heart Defect"=>"HeartDefect","Scoliosis"=>"Scoliosis"),
				"mentaldevelopment"=>array("Autistic"=>"Autistic","Mental Delay"=>"MentalDelay","Depression"=>"Depression","Traumatic Brain Injury"=>"TraumaticBrainInjury","Learning Disability"=>"LearningDisability","Down Syndrome"=>"DownSyndrome","Bipolar Disorder"=>"BipolarDisorder","Fetal Alchohol Disorder"=>"FetalAlchoholDisorder","Emotional / Behaviour Disturbance"=>"BehaviourDisturbance","Attention Deficit / Hyperactivity (ADHD)"=>"AttentionDeficit","Learning Disorder"=>"LearningDisorder"),
				"physicaldisabilities"=>array("Disabled Left Arm"=>"DisabledLeftArm","Disabled Right Arm"=>"DisabledRightArm","Disabled Left Hand"=>"DisabledLeftHand","Disabled Right Hand"=>"DisabledRightHand","Disabled Left Leg"=>"DisabledLeftLeg","Disabled Right Leg"=>"DisabledRghtLeg","Disabled Left Foot"=>"DisabledLeftFoot","Disabled Right Foot"=>"DisabledRghttFoot","Disabled Spine"=>"Disabledspine","Impaired Speech"=>"ImpairedSpeech","Mute"=>"Mute","Impaired Hearing"=>"Impairedhearing","Deaf"=>"Deaf","Impaired Sight"=>"Impairedsight","Blind"=>"Blind")
	);
	
	
	$household = array(
				"member1"=>array("Member One Name"=>"member1","Member One Role"=>"role1","Member One Beneficiary No"=>"Ben1","Member One Caregiver"=>"Caregiver1","Primary Caregiver"=>"Primarycaregiver"),
				"member2"=>array("Member Two Name"=>"member2","Member Two Role"=>"role2","Member Two Beneficiary No"=>"Ben2","Member Two Caregiver"=>"Caregiver2","Primary Caregiver"=>"Primarycaregiver"),
				"member3"=>array("Member Three Name"=>"member3","Member Three Role"=>"role3","Member Three Beneficiary No"=>"Ben3","Member Three Caregiver"=>"Caregiver3","Primary Caregiver"=>"Primarycaregiver"),
				"member4"=>array("Member Four Name"=>"member4","Member Four Role"=>"role4","Member Four Beneficiary No"=>"Ben4","Member Four Caregiver"=>"Caregiver4","Primary Caregiver"=>"Primarycaregiver"),
				"member5"=>array("Member Five Name"=>"member5","Member Five Role"=>"role5","Member Five Beneficiary No"=>"Ben5","Member Five Caregiver"=>"Caregiver5","Primary Caregiver"=>"Primarycaregiver"),
				"member6"=>array("Member Six Name"=>"member6","Member Six Role"=>"role6","Member Six Beneficiary No"=>"Ben6","Member Six Caregiver"=>"Caregiver6","Primary Caregiver"=>"Primarycaregiver"),
				"member7"=>array("Member Seven Name"=>"member7","Member Seven Role"=>"role7","Member Seven Beneficiary No"=>"Ben7","Member Seven Caregiver"=>"Caregiver7","Primary Caregiver"=>"Primarycaregiver"),
				"member8"=>array("Member Eight Name"=>"member8","Member Eight Role"=>"role8","Member Eight Beneficiary No"=>"Ben8","Member Eight Caregiver"=>"Caregiver8","Primary Caregiver"=>"Primarycaregiver"),
				"member9"=>array("Member Nine Name"=>"member9","Member Nine Role"=>"role9","Member Nine Beneficiary No"=>"Ben9","Member Nine Caregiver"=>"Caregiver9","Primary Caregiver"=>"Primarycaregiver"),
				"member10"=>array("Member Ten Name"=>"member10","Member Ten Role"=>"role10","Member Ten Beneficiary No"=>"Ben10","Member Ten Caregiver"=>"Caregiver10","Primary Caregiver"=>"Primarycaregiver"),
				"member11"=>array("Member Eleven Name"=>"member11","Member Eleven Role"=>"role11","Member Eleven Beneficiary No"=>"Ben11","Member Eleven Caregiver"=>"Caregiver11","Primary Caregiver"=>"Primarycaregiver"),
				"member12"=>array("Member Twelve Name"=>"member12","Member Twelve Role"=>"role12","Member Twelve Beneficiary No"=>"Ben12","Member Twelve Caregiver"=>"Caregiver12","Primary Caregiver"=>"Primarycaregiver")
			
	);

	//print_r($data['total_rec']);
	
	$cnt=$data['offset'];
	
	//print($cnt);
	
	echo "<fieldset>";
	echo "<legend style='font-weight:bold;'>Search</legend>";
	//echo "<INPUT TYPE='text' id='rpt' value='1'/>";
	echo "<form id='frmSearch'>";
	echo "<INPUT TYPE='hidden' id='icpNo' name='icpNo' value='".$data['icpNo']."'>";
	echo "<INPUT TYPE='hidden' id='state' name='state' value='".$data['state']."'>";
	echo "<input type='hidden' id='infotype' name='infotype' value='".$data['infotype']."'/>";
	echo "Page Number: <SELECT id='offset' name='offset'>";
		foreach ($data['total_rec'] as $value) {
			$set = $value*25;
			$page = $value+1;
			if($data['offset']===$set){
				echo "<OPTION value='".$set."' SELECTED>".$page."</OPTION>";
			}else{
				echo "<OPTION value='".$set."'>".$page."</OPTION>";
			}
			
		}
	$maxPage = count($data['total_rec']);
	$statePage = (($cnt)/25)+1;
	echo "</SELECT> You are on Page $statePage of $maxPage";
	echo "</form>";
	echo "<button onclick='downloadblforms(\"frmSearch\");'>Search</button>";
	echo "</fieldset>";
	
	//print($data['test']);
	
	echo "<br><span style='font-weight:bold;'>State:</span> ".$data['state_tag']."<br>";
	echo "<span style='font-weight:bold;'>Information Type:</span> ".$data['info_tag']."<br>";
	if($data['icpNo']==='0'){
		echo "<span style='font-weight:bold;'>ICPs Filtered:</span> All ICPs<br>";
	}else{
		echo "<span style='font-weight:bold;'>ICPs Filtered:</span> ".$data['icpNo']."<br>";
	}
	
	echo "<table id='info_tbl' style='margin-top:25px;'>";
	
	if($data['icpNo']!=='0'){
	echo "<caption style='text-align:left;font-weight:bold;'>Download as: <a href='http://localhost/tcpt/excelDownload.php?icpNo=".$data['rec'][0]->ID2."&state=".$data['state']."&infotype=".$data['infotype']."'>".Resources::img("excel.png",array("title"=>"Excel Download"))."</a> | ".Resources::a_href("ProgramCommunication/main", "Back")."</caption>";
	}else{
		echo "<caption style='text-align:left;font-weight:bold;'>".Resources::a_href("ProgramCommunication/main", "Back")."</caption>";
	}
	
	//Header Row One
	echo "<tr><th colspan='34' style='text-align:left;'>001-028: About Beneficiary</th><th colspan='92' style='text-align:left;'> 0029-0042: Activities and Education</th><th colspan='8' style='text-align:left;'>043 - 045: Spiritual</th><th colspan='39' style='text-align:left;'>046-052: Medical/ Health</th><th colspan='10' style='text-align:left;'>053-063: Family</th><th colspan='61' style='text-align:left;'>064-069: Household Members</th><th colspan='2' style='text-align:left;'>Submit Details</th></tr>";
	
	//Header Row Two
	echo "<tr><th colspan='6' style='text-align:left;'>001-002: Action and ID</th>";
	echo "<th>003: Information Type</th>"; 
	echo "<th colspan='2' style='text-align:left;'>004: Beneficiary Program</th>"; 
	echo "<th colspan='3' style='text-align:left;'>005-007: Beneficiary Name</th>";
	echo "<th colspan='4' style='text-align:left;'>008-0011: Gender and Age</th>";
	echo "<th colspan='2' style='text-align:left;'>012-013: Vulnerabilities</th>";
	echo "<th>014: Is Orphan</th>";
	echo "<th>015: Correspondence Language</th>";
	echo "<th colspan='6' style='text-align:left;'>016-020: Primary Address</th>";
	echo "<th colspan='6' style='text-align:left;'>022-026: Alternate Address</th>";
	echo "<th colspan='2' style='text-align:left;'>027-028: Contact Details</th>";
	echo "<th colspan='11' style='text-align:left;'>029: Things I like: Use for 1-2 Years Old (Select all that Apply)</th>";
	echo "<th colspan='25' style='text-align:left;'>030: Things I like: Use for 3+ Years Old (Select all that Apply)</th>";
	echo "<th colspan='12' style='text-align:left;'>032: Favorite Project Activities</th>";
	echo "<th colspan='14' style='text-align:left;'>033: Beneficiary Family Duties: Use for 3+ year old children (Select all that apply)</th>";
	echo "<th colspan='30' style='text-align:left;'>034 - 042: Beneficiary Education</th>";
	echo "<th style='text-align:left;'>043: Child's Religious Affiliation</th>";
	echo "<th colspan='6' style='text-align:left;'>044: Christian Activities</th>";
	echo "<th style='text-align:left;'>045: Beneficiary Confession to Jesus Christ</th>";
	echo "<th style='text-align:left;'>046: Weight in Kg</th>";
	echo "<th style='text-align:left;'>047: Height in cms</th>";
	echo "<th style='text-align:left;'>048: Regular Medical Treatment</th>";
	echo "<th colspan='15' style='text-align:left;'>050: Physical Disabilities</th>";
	echo "<th colspan='10' style='text-align:left;'>051: Chronic Illnesses</th>";
	echo "<th colspan='11' style='text-align:left;'>051: Mental Development Conditions (Select all that Apply)</th>";
	echo "<th colspan='2' style='text-align:left;'>053-054: Natural Parents</th>";
	echo "<th colspan='2' style='text-align:left;'>055-056: Natural Father</th>";
	echo "<th colspan='2' style='text-align:left;'>058-059: Natural Mother</th>";
	echo "<th colspan='4' style='text-align:left;'>060-063: Household Employment</th>";
	echo "<th colspan='1' style='text-align:left;'>064: Household Name</th>";
	foreach ($household as $key => $value) {
		echo "<th colspan='5' style='text-align:left;'>Member ".substr($key,6)."</th>";
	}
	echo "<th colspan='2' style='text-align:left;'>Submit Details</th>";
	echo "</tr>";
	
	//Header Row Three
	echo "<tr><th>Action</th>";
	echo "<th>Record ID</th>";
	echo "<th>S/No</th>";
	echo "<th>KE No</th>";
	echo "<th>001: Child No</th>";
	echo "<th>002: ICP Name</th>";
	
	echo "<th>003: Information Type</th>";
	
	echo "<th>004: Program Type</th>";
	echo "<th>004: Beneficiary Program Type</th>";
	
	echo "<th>005: First Name</th>"; 
	echo "<th>006: Last Name</th>"; 
	echo "<th>007: Preferred Name</th>";
	
	echo "<th>008: Gender</th>";
	echo "<th>009: Birth Date</th>"; 
	echo "<th>010: Estimated Birth Date</th>";
	echo "<th>011: Cognitive Age</th>";
	
	echo "<th>012: Is Orphan</th>"; 
	echo "<th>013: HVC</th>";
	
	echo "<th>014: Citizenship</th>";
	
	echo "<th>015: Correspondence</th>";	
	
	echo "<th>016: Street</th>";
	echo "<th>017: City</th>";
	echo "<th>018: Province</th>";
	echo "<th>019: Latitude</th>";
	echo "<th>019: Longittude</th>";
	echo "<th>020: Postal Code</th>";
	
	echo "<th>022: Alternate Street</th>";
	echo "<th>023: Alternate City</th>";
	echo "<th>024: Alternate Province</th>";
	echo "<th>025: Alternate Latitude</th>";
	echo "<th>025: Alternate Longitude</th>";
	echo "<th>026: Alternate Postal Code</th>";
	
	echo "<th>027: Phone</th>";
	echo "<th>028: Email</th>";
	
	echo "<th>029: Clapping hands to rhythm</th>";
	echo "<th>029: Rolling a Ball</th>";
	echo "<th>029: Dance</th>";
	echo "<th>029: Putting Words Together in Phrases</th>";
	echo "<th>029: Throwing a Ball</th>";
	echo "<th>029: Dancing</th>";
	echo "<th>029: Running</th>";
	echo "<th>029: Saying Words</th>";
	echo "<th>029: Walking Independently</th>";
	echo "<th>029: Listening to stories</th>";
	echo "<th>029: Singing</th>";
	
	echo "<th>030: Art/Drawing</th>";
	echo "<th>030: Hide and Seek</th>";
	echo "<th>030: Ping Pong</th>";
	echo "<th>030: Running</th>";
	echo "<th>030: Volleyball and Handball</th>";
	echo "<th>030: Baseball</th>";
	echo "<th>030: Jacks</th>";
	echo "<th>030: Play House</th>";
	echo "<th>030: Singing</th>";
	echo "<th>030: Walking</th>";
	echo "<th>030: Basketball</th>";
	echo "<th>030: Jump Rope</th>";
	echo "<th>030: Reading</th>";
	echo "<th>030: Sports</th>";
	echo "<th>030: Bicycling</th>";
	echo "<th>030: Music</th>";
	echo "<th>030: Rolling a hoop</th>";
	echo "<th>030: Story Telling</th>";
	echo "<th>030: Dolls</th>";
	echo "<th>030: Musical Instruments</th>";
	echo "<th>030: Swimming</th>";
	echo "<th>030: Group Games</th>";
	echo "<th>030: Marbles</th>";
	echo "<th>030: Soccer</th>";
	echo "<th>030: Toy Cars</th>";
	//Favorite Project Activities
	
	echo "<th>032: Dancing and or Drama</th>";
	echo "<th>032: Learning about God</th>";
	echo "<th>032: Participating in Service Activities</th>";
	echo "<th>032: Singing Songs</th>";
	echo "<th>032: Doing Arts and Crafts</th>";
	echo "<th>032: Learning new vocational skills</th>";
	echo "<th>032: Playing Games</th>";
	echo "<th>032: Snacks/ Mealtime</th>";
	echo "<th>032: Going on Field trip/excursions</th>";
	echo "<th>032: Listening to Bible Stories</th>";
	echo "<th>032: Planning Sports</th>";
	echo "<th>032: Spending time with Friends</th>";
	
	//Beneficiary Family Duties
	foreach ($flds['familyduties'] as $key => $value) {
		echo "<th>033: {$key}</th>";
	}
	
	
	//Favorite subject in school
	echo "<th>034: Favorite subject in school (Select only one)</th>";
	
	//Formal Education
	echo "<th>035: Formal Education (Select only one)</th>";
	
	//Current University Year of Study
	echo "<th>036: Formal Education (Select only one)</th>";
	
	//Local Grade
	echo "<th>037: Local Grade Level (Select only one)</th>";
	
	//Academic Performance
	echo "<th>038: Academic Performance (Select only one)</th>";
	
	//Type of Vocational/ Tech Training
	echo "<th>039: Type of Vocational/ Tech Training (Select only one)</th>";
	
	//Major Course Of Study
	foreach ($flds['majorcourses'] as $key => $value) {
		echo "<th>041: {$key}</th>";
	}
	
	//Not Enrolled in Education Reason
	echo "<th>042: Not Enrolled in Education Reason</th>";
	
	//Child's Religious Affliation
	echo "<th>043: Child's Religious Affliation (Select only one)</th>";
	
	//Christian Activities
	foreach ($flds['christianactivities'] as $key => $value) {
		echo "<th>044: {$key}</th>";
	}
	
	//Does the Beneficiary Currently Confess Jesus Christ as Savior
	echo "<th>045: Does the Beneficiary Currently Confess Jesus Christ as Savior</th>";
	
	//Weight in Kg
	echo "<th>046: Weight in Kg</th>";
	
	//Height in cms
	echo "<th>047: Height in cms</th>";
	
	//Regular Medical Treatment
	echo "<th>048: Regular Medical Treatment</th>";
	
	//Physical Disabilities
	foreach ($flds['physicaldisabilities'] as $key => $value) {
		echo "<th>050: {$key}</th>";
	}
	
	//Chronic Illnesses
	foreach ($flds['chronicillnesses'] as $key => $value) {
		echo "<th>051: {$key}</th>";
	}
	
	//Mental Development Condtions
	foreach ($flds['mentaldevelopment'] as $key => $value) {
		echo "<th>052: {$key}</th>";
	}
	
	//Together Now
	echo "<th>053: Together Now?</th>";
	
	//Marital Status
	echo "<th>054: Marital Status (Select only One)</th>";
	
	//Natural Father Alive
	echo "<th>055: Alive?</th>";
	
	//Natural Father Living with the Beneficiary
	echo "<th>056: Living with Beneficiary?</th>";
	
	//Natural Mother Alive
	echo "<th>058: Alive?</th>";
	
	//Natural Mother Living with the Beneficiary
	echo "<th>059: Living with Beneficiary?</th>";
	
	//Father or Male Guardian
	echo "<th>060: Father or Male Guardian (Select only One)</th>";
	
	//Father or Male Guardian Occupation
	echo "<th>061: Father or Male Guardian Occupation</th>";
	
	//Mother or Female Guardian
	echo "<th>062: Mother or Female Guardian (Select only One)</th>";
	
	//Mother or Female Guardian Occupation
	echo "<th>063: Mother or Female Guardian Occupation</th>";
	
	//Household Name
	echo "<th>064: Household Name</th>";
	
	//Household Members
	for ($i=1; $i <sizeof($household)+1; $i++) { 
		foreach ($household['member'.$i] as $key => $value) {
			echo "<th>{$key}</th>";
		}
	}
	
	//Completed On
	echo "<th>064: Household Name</th>";
	
	//Completed By
	echo "<th>064: Household Name</th>";
	
	
	echo "</tr>";
	
	foreach($data['rec'] as $value){
		$sno = $cnt+1;
		
		
		echo "<tr title='".@number_format($value->ID3)."'>";
		if($value->status==='0'){
			echo "<td>".Resources::img("plus.png",array("title"=>"Accept","onclick"=>"statusupdate(\"2\",\"".$value->rID."\",\"".$value->ID2."\",this);"))." | ".Resources::img("uncheck3.png",array("title"=>"Decline","onclick"=>"statusupdate(\"1\",\"".$value->rID."\",\"".$value->ID2."\",this);"))." | ".Resources::img("blackflag.png",array("title"=>"Flag","onclick"=>"statusupdate(\"4\",\"".$value->rID."\",\"".$value->ID2."\",this);"))."</td>";
		}elseif($value->status==='2'){
			echo "<td>".Resources::img("archive.png",array("title"=>"Archive","onclick"=>"statusupdate(\"3\",\"".$value->rID."\",\"".$value->ID2."\",this);"))." | ".Resources::img("blackflag.png",array("title"=>"Flag","onclick"=>"statusupdate(\"4\",\"".$value->rID."\",\"".$value->ID2."\",this);"))."</td>";
		}elseif($value->status==='3'){
			echo "<td style='color:green;'>Archived</td>";
		}elseif($value->status==='4'){
			echo "<td>".Resources::img('redflag.png',array("title"=>"Flagged","onclick"=>"statusupdate(\"6\",\"".$value->rID."\",\"".$value->ID2."\",this);"))."</td>";
		}elseif($value->status==='6'){
			echo "<td>".Resources::img("archive.png",array("title"=>"Archive","onclick"=>"statusupdate(\"3\",\"".$value->rID."\",\"".$value->ID2."\",this);"))." | ".Resources::img("greenflag.png",array("title"=>"Resolved Flag"))."</td>";
		}elseif($value->status==='1'){
			echo "<td style='color:red;'>Declined</td>";
		}
		
		echo "<td onclick='selectRow(this);'>".$value->rID."</td>";
		echo "<td>".$sno."</td>";
		echo "<td>".number_format($value->ID2)."</td>";
		
		$childNo = "";
		if(@number_format($value->ID3)<10){
			$childNo="000".@number_format($value->ID3);
		}elseif(@number_format($value->ID3)<100){
			$childNo="00".@number_format($value->ID3);
		}elseif(@number_format($value->ID3)<1000){
			$childNo="0".@number_format($value->ID3);
		}else{
			$childNo=@number_format($value->ID3);
		}
		
		
		echo "<td>KE".number_format($value->ID2).$childNo."</td>"; 
		
		echo "<td>".$value->ICPName."</td>"; 
		echo "<td>".$form_arr['InfoType'][$value->InfoType]."</td>";
		echo "<td>".$form_arr['BeneficiaryProg'][$value->BeneficiaryProg]."</td>";
		echo "<td>".$form_arr['BeneficiaryProgtype'][$value->BeneficiaryProgtype]."</td>";
		echo "<td>".$value->FirstName."</td>"; 
		echo "<td>".$value->LastName."</td>"; 
		echo "<td>".$value->PrefName."</td>"; 
		echo "<td>".$form_arr['Gender'][$value->Gender]."</td>";
		echo "<td>".$value->BirthDate."</td>"; 
		echo "<td>".$form_arr['EstimatedBirthdate'][$value->EstimatedBirthdate]."</td>"; 
		echo "<td>".$form_arr['CognitiveAge'][$value->CognitiveAge]."</td>";
		echo "<td>".$form_arr['IsOrphan'][$value->IsOrphan]."</td>"; 
		echo "<td>".$form_arr['HVC'][$value->HVC]."</td>";
		echo "<td>".$value->Citizenship."</td>";
		echo "<td>".$value->Correspondence."</td>";
		echo "<td>".$value->Street."</td>";
		echo "<td>".$value->City."</td>";
		echo "<td>".$value->Province."</td>";
		echo "<td>".$value->Latitude."</td>";
		echo "<td>".$value->Longittude."</td>";
		echo "<td>".$value->PostalCode."</td>";
		echo "<td>".$value->Street1."</td>";
		echo "<td>".$value->City1."</td>";
		echo "<td>".$value->Province1."</td>";
		echo "<td>".$value->Latitude1."</td>";
		echo "<td>".$value->Longitude1."</td>";
		echo "<td>".$value->PostalCode1."</td>";
		echo "<td>".$value->Phone."</td>";
		echo "<td>".$value->Email."</td>";
		
		echo "<td>".$form_arr['chkbx'][$value->CLaphands]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Rollball]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->WordsTogether]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->ThrowBall]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Dance]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Run]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->SayWords]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->WalkIndependently]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Listentostories]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Jump]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->SingSongs]."</td>";
		
		echo "<td>".$form_arr['chkbx'][$value->Art]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Hideandseek]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Pingpong]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Run1]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->VolleyBall]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Baseball]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Jacks]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Playhouse]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Singing1]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Walking1]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Basketball]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Jumprope]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Reading]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Sports]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Cycling]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Music]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Rollinghoop]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Storytelling]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Dolls]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Musicalinstrument]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Swimming]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Groupgames]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->marbles]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Soccer]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Toycars]."</td>";
		
		//Favourite Project Activities
		
		echo "<td>".$form_arr['chkbx'][$value->Dancinganddrama]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->LearningaboutGod]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Serviceactivities]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Singing1]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Artandcraft]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Newvocationalskills]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Playinggames]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->Snacks]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->fieldtrip]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->biblestories]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->planningsports]."</td>";
		echo "<td>".$form_arr['chkbx'][$value->spendingtimewithfriends]."</td>";
		
		//Beneficiary Family Duties
		foreach ($flds['familyduties'] as $key => $val) {
			echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";	
		}
		
		//Favourite subject in school
		
		if(!empty($value->Favoritesubject)){
			echo "<td>".$form_arr['Favoritesubject'][$value->Favoritesubject]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Formal Education 
		
		if(!empty($value->Formaleducation)){
			echo "<td>".$form_arr['Formaleducation'][$value->Formaleducation]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Current University Year of Study
		
		if(!empty($value->Currentyearofstudy)){
			echo "<td>".$form_arr['Currentyearofstudy'][$value->Currentyearofstudy]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Local Grade
		echo "<td>".$value->Localgradelevel."</td>";
		
		//Academic Performance
		if(!empty($value->Academicperformance)){
			echo "<td>".$form_arr['Academicperformance'][$value->Academicperformance]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		
		//Type of vocation/ tech training
		if(!empty($value->Typeofvocationaltraining)){
			echo "<td>".$form_arr['Typeofvocationaltraining'][$value->Typeofvocationaltraining]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		
		//Major Course of Study
		foreach ($flds['majorcourses'] as $key => $val) {
			echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";
		}
		
		//Not enrolled in Education reason
		echo "<td>".$value->notenrolledreason."</td>";
		
		//Child's Religious Affiliation		
		if(!empty($value->Childreligiousaffiliation)){
			echo "<td>".$form_arr['Childreligiousaffiliation'][$value->Childreligiousaffiliation]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Christian Activities 
		foreach ($flds['christianactivities'] as $key => $val) {
			echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";	
		}
		
		//Child's Confession to Jesus Christ		
		if(!empty($value->ConfessJesus)){
			echo "<td>".$form_arr['ConfessJesus'][$value->ConfessJesus]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Weight in Kg
		$decimal=0;
		if(!empty($value->Weight2)&&!empty($value->Weight1)){
			$decimal=number_format($value->Weight2);
			echo "<td>".number_format($value->Weight1).".".number_format($decimal)."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		
		
		//Height in Kg
		$height=0;
		if(!empty($value->Height)){
			$height=number_format($value->Height);
		}
		echo "<td>".$height."</td>";
		
		//Regular Medical Treatment
		echo "<td>".$value->RegMedTreat1."</td>";
		
		//Physical Disabilities
		if(!empty($value->$val)){
		foreach ($flds['physicaldisabilities'] as $key => $val) {
			echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";	
		}
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Chronic Illnesses
		foreach ($flds['chronicillnesses'] as $key => $val) {
			echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";	
		}
		
		//Mental Development Conditions
		foreach ($flds['mentaldevelopment'] as $key => $val) {
			echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";	
		}
		
		//Natural Parents Together Now?		
		if(!empty($value->Parentstogethernow)){
			echo "<td>".$form_arr['Parentstogethernow'][$value->Parentstogethernow]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Marital Status		
		if(!empty($value->Maritalstatus)){
			echo "<td>".$form_arr['Maritalstatus'][$value->Maritalstatus]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Natural Father Alive?		
		if(!empty($value->Naturalfatheralive)){
			echo "<td>".$form_arr['Naturalfatheralive'][$value->Naturalfatheralive]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Natural Father Living with Beneficiary?	
		if(!empty($value->Naturalfatherlivingwithbenef)){
			echo "<td>".$form_arr['Naturalfatherlivingwithbenef'][$value->Naturalfatherlivingwithbenef]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Natural Mother Alive?		
		if(!empty($value->NaturalmotherAlive)){
			echo "<td>".$form_arr['NaturalmotherAlive'][$value->NaturalmotherAlive]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Natural Mother Living with Beneficiary?	
		if(!empty($value->Naturalmotherlivingwithbenef)){
			echo "<td>".$form_arr['Naturalmotherlivingwithbenef'][$value->Naturalmotherlivingwithbenef]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Father or Male Guardian Occupation	
		if(!empty($value->fatheremploystatus)){
			echo "<td>".$form_arr['fatheremploystatus'][$value->fatheremploystatus]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Father or Male Guardian Occupation
		echo "<td>".$value->fatheroccupation."</td>";
		
		//Mother or Female Guardian Occupation	
		if(!empty($value->motheremploystatus)){
			echo "<td>".$form_arr['motheremploystatus'][$value->motheremploystatus]."</td>";
		}else{
			echo "<td>&nbsp;</td>";
		}
		
		//Mother or Female Guardian Occupation
		echo "<td>".$value->motheroccupation."</td>";
		
		//MHousehold Name
		echo "<td>".$value->householdname."</td>";
		
		//Household Members
		for ($i=1; $i <sizeof($household)+1; $i++) { 
		
		foreach ($household['member'.$i] as $key => $val) {
			if($val==='Ben'.$i&&!empty($value->$val)){
				echo "<td>".number_format($value->$val)."</td>";
			}elseif($val==='Caregiver'.$i){
				echo "<td>".$form_arr['chkbx'][$value->$val]."</td>";
			}elseif($val==='Primarycaregiver'){
					if(!empty($value->$val)&&$form_arr['Primarycaregiver'][$value->$val]==='member'.$i){
						echo "<td>Yes</td>";
					}else{
						echo "<td>&nbsp;</td>";
					}
			}else{
				echo "<td>".$value->$val."</td>";
			}
			
		}
		
		}	
		
		//Completed On
		echo "<td>".$value->Completed0n."</td>";
		
		//Completed By
		echo "<td>".$value->Completedby."</td>";
		
		echo "</tr>";
		$cnt++;

	}

	echo "</table>";
?>