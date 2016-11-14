<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Reports/cdpr","[New Assessment]")." ".Resources::a_href("Reports/viewcdprgrid","[View Assessments]");
	echo "<hr><br>";
}
//print_r($data['rec']);

//Progress Measure Array
$progressmeasures = array(
	"3-5"=>array(
		"spiritual"=>array(
			"indicator1"=>array(
				"pm1"=>"Able to tell about at least three Bible stories of choice.",
				"pm2"=>"Names at least three examples of God's character mentioned in the Bible.",
				"pm3"=>"Recites from memory at least one brief Bible verse of choice"
			),
			"indicator2"=>array(
				"pm1"=>"States that God loves him/her",
				"pm2"=>"States that Jesus is the Son of God",
				"pm3"=>"Outlines at least three behaviors that are considered by the Bible to be sins."
			),
			"indicator3"=>array(
				"pm1"=>"Attends Sunday School at least twice in a month.",
				"pm2"=>"Draws/paints one  picture of service to God in his/her own community.",
				"pm3"=>"Able to make a simple prayer."
			)
		),
		"physical"=>array(
			"indicator1"=>array(
				"pm1"=>"Brushes his/her teeth correctly.",
				"pm2"=>"Identifies at least four external body parts",
				"pm3"=>"Participates in one sport of choice at least three times in three months at the Project."
			),
			"indicator2"=>array(
				"pm1"=>"Names at least two of his or her favorite foods.",
				"pm2"=>"Experiences reduced incidences of the following four diseases/conditions: Malaria, Diarrhea, Acute Respiratory Tract Infections, and Malnutrition. ",
				"pm3"=>"Is within acceptable range of normal weight-for-age."
			),
			"indicator3"=>array(
				"pm1"=>"Demonstrates at least four different types of inappropriate body touch.",
				"pm2"=>"States his/her gender; either boy or girl.",
				"pm3"=>"Mentions at least two substances/drugs commonly abused in his or her community."
			)
		),
		"cognitive"=>array(
			"indicator1"=>array(
				"pm1"=>"Regularly attends pre-school",
				"pm2"=>"Recognizes at least twenty letters of the alphabet",
				"pm3"=>"Counts at least from number 1 to 50"
			),
			"indicator2"=>array(
				"pm1"=>"Child names at least five items made in their locality.",
				"pm2"=>"Expresses interest in at least three vocational skills",
				"pm3"=>"Responds to simple instructions on use of time e.g. goes to class when he/she hears the school bell"
			),
			"indicator3"=>array(
				"pm1"=>"Expresses interest in at least three vocational skills",
				"pm2"=>"Child names at least five items made in their locality.",
				"pm3"=>"Identifies the local currency."
			)
		),
		"socio-emotion"=>array(
			"indicator1"=>array(
				"pm1"=>"Mentions at least two ways in which he or she expresses his or her own emotions.",
				"pm2"=>"Mentions at least three ways in which people should show respect for others.",
				"pm3"=>"Mentions at least two simple problems in his or her day-to-day life that need to be solved."
			),
			"indicator2"=>array(
				"pm1"=>"Child correctly states his/her age and gender.",
				"pm2"=>"Names at least three people in the family (immediate or distant) to which he or she belongs.",
				"pm3"=>"Recalls at least three decisions he or she has made in the last twenty-four hours."
			),
			"indicator3"=>array(
				"pm1"=>"Follows at least three simple instructions.",
				"pm2"=>"Reports to concerned Project staffs in case of a conflict.  ",
				"pm3"=>"Shares play-items easily with his or her peers at the Project."
			)
		)
	),
	"6-8"=>array(
		"spiritual"=>array(
			"indicator1"=>array(
				"pm1"=>"Able to tell about at least 4 Bible stories of choice.",
				"pm2"=>"Explains at least 3 lessons learnt about a Bible character of choice.",
				"pm3"=>"Recites at least three different Bible verses of choice. "
			),
			"indicator2"=>array(
				"pm1"=>"Expresses why God loves him/her",
				"pm2"=>"Makes a confession of Jesus Christ as  his/her Saviour",
				"pm3"=>"Mentions at least five of the ten Commandments of God."
			),
			"indicator3"=>array(
				"pm1"=>"Attends Sunday School at least twice in a month.",
				"pm2"=>"Describes at least three ways  in which he/she can serve God in the community.",
				"pm3"=>"Participates in organized prayer groups at the Project at least once every month"
			)
		),
		"physical"=>array(
			"indicator1"=>array(
				"pm1"=>"Keeps his or her hair, teeth, nails, and clothes clean.",
				"pm2"=>"Correctly points out the private parts of the human body. ",
				"pm3"=>"Plays a sport of choice at least two times in a month at the Project."
			),
			"indicator2"=>array(
				"pm1"=>"Identifies at least one example of a locally available food that is a source of nutrients for each of the following: body-building foods, energy-giving foods, and  vitamins. ",
				"pm2"=>"Experiences reduced incidences of the following four diseases/conditions: Malaria, Diarrhea, Acute Respiratory Tract Infections, and Malnutrition. ",
				"pm3"=>"Is within acceptable range of normal weight-for-age."
			),
			"indicator3"=>array(
				"pm1"=>"Mentions at least four signs of physical abuse.",
				"pm2"=>"States at least four risks associated with inappropriate sexual behavior.",
				"pm3"=>"Lists at least three types of dangerous substances/drugs within his or her community."
			)
		),
		"cognitive"=>array(
			"indicator1"=>array(
				"pm1"=>"Completes at least standard two level of formal education.",
				"pm2"=>"Reads at least five English sentences made up of three letter words ",
				"pm3"=>"In school, he/she scores  at least 50% in  all subjects in end of term examinations."
			),
			"indicator2"=>array(
				"pm1"=>"Matches at least eight types of resource materials to vocational skills.",
				"pm2"=>"Tries out at  least two vocational skills once a month",
				"pm3"=>"Follows a planned project/school weekly schedule"
			),
			"indicator3"=>array(
				"pm1"=>"Shows interest to learn at least three income-generating activities.",
				"pm2"=>"Attempts to design at least three different items in a year using the vocational skills he/she is learning.",
				"pm3"=>"Able to relate the value of a given amount of local currency with how much it is able to purchase."
			)
		),
		"socio-emotion"=>array(
			"indicator1"=>array(
				"pm1"=>"Outlines at least three benefits of expressing one's emotions.",
				"pm2"=>"Demonstrates at least seven ways of showing respect for other people.",
				"pm3"=>"Identifies at least three problems in his or her community that he or she would like to solve."
			),
			"indicator2"=>array(
				"pm1"=>"Demonstrates age and gender-appropriate family roles ",
				"pm2"=>"Identifies at least three people that have influenced his or her life.",
				"pm3"=>"Identifies at least three issues that he or she needs to make a decision about."
			),
			"indicator3"=>array(
				"pm1"=>"Provides relevant feedback to at least three questions about his or her time at the Project in the last one week.",
				"pm2"=>"Expresses anger in ways that are appropriate according to Biblical teachings.",
				"pm3"=>"Plays cooperatively with peers at the Project."
			)
		)
	),
	"9-11"=>array(
		"spiritual"=>array(
			"indicator1"=>array(
				"pm1"=>"Able to explain at least three lessons learnt from at least three different Bible stories of choice.",
				"pm2"=>"Identifies at  least five godly habits from a Biblical character of choice.",
				"pm3"=>"Mentions at least five lessons learnt from the Beatitudes (Matthew chapter 5, 6, & 7)."
			),
			"indicator2"=>array(
				"pm1"=>"Regularly testifies to other people that Jesus is his/her Lord & Savior.",
				"pm2"=>"Explains at least four ways in which he/she demonstrates the love of God to other people at the Project.",
				"pm3"=>"Mentions at least eight of the ten Commandments of God."
			),
			"indicator3"=>array(
				"pm1"=>"Regularly carries out at least two responsibilities in his/her local church every month.",
				"pm2"=>"Practices at least  three service activities per year  in the community.",
				"pm3"=>"Participates in organized prayer groups at the Project at least once every month"
			)
		),
		"physical"=>array(
			"indicator1"=>array(
				"pm1"=>"Demonstrates to peers how to carry out personal hygiene of the nails, clothes, hair, and teeth. ",
				"pm2"=>"Mentions at least four changes that occur in the body during puberty.",
				"pm3"=>"Plays a sport of choice at least two times in a month at the Project."
			),
			"indicator2"=>array(
				"pm1"=>"Explains at least three benefits of eating a balanced diet. ",
				"pm2"=>"Experiences reduced incidences of the following four diseases/conditions: Malaria, Diarrhea, Acute Respiratory Tract Infections, and Malnutrition. ",
				"pm3"=>"Is within acceptable range of normal weight-for-age."
			),
			"indicator3"=>array(
				"pm1"=>"Outlines the steps to take in reporting a case of Child abuse. ",
				"pm2"=>"Explains at least four risks associated with teenage pregnancy.",
				"pm3"=>"Mentions at least four consequences associated with substance/drug abuse."
			)
		),
		"cognitive"=>array(
			"indicator1"=>array(
				"pm1"=>"Completes at least standard five level of formal education.",
				"pm2"=>"Able to correctly re-tell a brief story after reading it",
				"pm3"=>"In school, he/she scores  at least 50% in  all subjects in end of term examinations."
			),
			"indicator2"=>array(
				"pm1"=>"Uses locally available resource materials in practicing two vocational skills.",
				"pm2"=>"Identifies at least two of his/her vocational strengths and/ talents.",
				"pm3"=>"Maintains a personal daily time schedule"
			),
			"indicator3"=>array(
				"pm1"=>"Participates once a month in learning at least two income generating activities.",
				"pm2"=>"Able to explain at least four different characteristics that make the items he/she has made unique from those made by other people.",
				"pm3"=>"Able to set at least three goals he/she would like to accomplish given a particular amount of money."
			)
		),
		"socio-emotion"=>array(
			"indicator1"=>array(
				"pm1"=>"Demonstrates awareness of at least three ways in which his or her own emotions affect people around him or her.",
				"pm2"=>"Identifies at least three ways in which he or she would like to improve regarding respecting other people.",
				"pm3"=>"Explains at least three reasons (objectives) why he or she would like to solve a particular problem."
			),
			"indicator2"=>array(
				"pm1"=>"Uses at least four words to describe why he/she is a person of value to God and other people.",
				"pm2"=>"Describes at least three ways he or she has influenced his or her family.",
				"pm3"=>"Describes at least three factors that influence the decisions he or she makes."
			),
			"indicator3"=>array(
				"pm1"=>"Correctly writes a letter of at least one hundred (100) words in a language of his or her choice.",
				"pm2"=>"Demonstrates empathy and compassion to others during a conflict.",
				"pm3"=>"Works cooperatively with peers to accomplish group-tasks."
			)
		)
	),
	"12-14"=>array(
		"spiritual"=>array(
			"indicator1"=>array(
				"pm1"=>"Able to share with peers at least ten lessons learnt from at least three Bible stories of choice.",
				"pm2"=>"Regularly demonstrates at least three habits learnt from a Bible character of choice.",
				"pm3"=>"Identifies at least three lessons learnt from one Chapter in the Bible he or she has been meditating about each month."
			),
			"indicator2"=>array(
				"pm1"=>"Leads others to accepting Jesus as Lord and Savior",
				"pm2"=>"Regularly practices at least three behaviors that demonstrate the love of God to the people around him/her at the Project.",
				"pm3"=>"Describes at least five consequences of ungodly behaviors."
			),
			"indicator3"=>array(
				"pm1"=>"Regularly carries out at least two responsibilities in his/her local fellowship every month.",
				"pm2"=>"Actively participates in  at least three Church-organized community service programs in a year.",
				"pm3"=>"Regularly leads prayer groups at the Project at least once every three months."
			)
		),
		"physical"=>array(
			"indicator1"=>array(
				"pm1"=>"Maintains personal hygiene of the nails, clothes, hair, and teeth. ",
				"pm2"=>"Explains at least four changes that occur in the body during puberty.",
				"pm3"=>"Participates in physical education exercises at least twice a month.  "
			),
			"indicator2"=>array(
				"pm1"=>"Explains to others how to prepare a balanced diet using locally available foods.",
				"pm2"=>"Explains symptoms of at least three illnesses that require immediate professional medical attention. ",
				"pm3"=>"Mentions at least three benefits of physical growth-monitoring."
			),
			"indicator3"=>array(
				"pm1"=>"Participates in at least four peer-group discussions in a year about child abuse.",
				"pm2"=>"Lists at least four signs of sexually-transmitted infections.",
				"pm3"=>"Explains at least two types of help available in his/her community for people engaged in substance/drug abuse."
			)
		),
		"cognitive"=>array(
			"indicator1"=>array(
				"pm1"=>"Completes at least primary school level of formal education.",
				"pm2"=>"Writes a composition of at least 200-250 words in English and without guidance. ",
				"pm3"=>"In school, he/she scores  at least 50% in  all subjects in end of term examinations."
			),
			"indicator2"=>array(
				"pm1"=>"Develops an apprenticeship relationship with at least one local resource person/organization for the vocational skills of his/her interest.",
				"pm2"=>"Participates in organized group vocational activities of his/her interest once a month",
				"pm3"=>"Develops life goals e.g. in his/her My Plan For Tomorrow"
			),
			"indicator3"=>array(
				"pm1"=>"Refines his/her competence in two or less income generating activities",
				"pm2"=>"Able to make at least two items/products in a year using the vocational skills he/she has learnt.",
				"pm3"=>"Keeps records of accountability (e.g. a personal budget) of how they spent any money they received in the last one year."
			)
		),
		"socio-emotion"=>array(
			"indicator1"=>array(
				"pm1"=>"Explains at least three ways in which his or her own emotions affect him or her.",
				"pm2"=>"Regularly exhibits at least four behaviors that demonstrate respect for other people. ",
				"pm3"=>"Describes at least three possible causes of a problem he or she would like to solve it."
			),
			"indicator2"=>array(
				"pm1"=>"Describes how he/she plans to achieve at least one of his/her life goals (let him/her choose from any of the four areas of holistic Child development.)",
				"pm2"=>"Explains at least three ways he or she has influenced his or her community.",
				"pm3"=>"Explains at least three reasons why he/she chose the goals he/she set in his/her 'My Plan for Tomorrow'."
			),
			"indicator3"=>array(
				"pm1"=>"Represents the views of his or her peers effectively.",
				"pm2"=>"Demonstrates empathy and compassion to others during a conflict.",
				"pm3"=>"Exhibits self-confidence when interacting with peers."
			)
		)
	),
	"15-18"=>array(
		"spiritual"=>array(
			"indicator1"=>array(
				"pm1"=>"Leads at least three Bible-study sessions per year at the Project.",
				"pm2"=>"Teaches peers about godly character at least three times a year at the Project.",
				"pm3"=>"Regularly demonstrates at least three new behaviors he/she has learnt from the Bible text meditated about in the last three months."
			),
			"indicator2"=>array(
				"pm1"=>"Participates in at least two evangelism out-reaches in a year",
				"pm2"=>"Regularly practices at least five behaviors that demonstrate the love of God to the people around him/her at the Project.",
				"pm3"=>"Teaches peers about Behavior Change at least three times a year."
			),
			"indicator3"=>array(
				"pm1"=>"Trains peers/children at the Project about spiritual acts of service at least three times a year. ",
				"pm2"=>"Actively participates in  at least three Church-organized community service programs in a year.",
				"pm3"=>"Regularly leads prayer groups at the Project at least once every three months."
			)
		),
		"physical"=>array(
			"indicator1"=>array(
				"pm1"=>"Teaches groups of children about personal hygiene at least two times a year ",
				"pm2"=>"Leads at least four discussions in a year with other adolescents about body-changes in puberty.",
				"pm3"=>"Leads others in a sport of choice at least three times a year."
			),
			"indicator2"=>array(
				"pm1"=>"Demonstrates to others how to prepare a balanced diet using locally available foods",
				"pm2"=>"Teaches organized groups of peers at the Project at least three times a year about prevention of poverty-related diseases.",
				"pm3"=>"Carries out formal physical growth-monitoring of younger Children at the Project at least once every six months."
			),
			"indicator3"=>array(
				"pm1"=>"Instructs peers and/or younger children on steps to take in case of experiencing child abuse.",
				"pm2"=>"Teaches peers at the Project at least twice a year about Sexual Purity.",
				"pm3"=>"Promotes A Substance/Drug Abuse-free life by signing a Commitment to keep away from such behavior."
			)
		),
		"cognitive"=>array(
			"indicator1"=>array(
				"pm1"=>"Completes secondary school level of formal education.",
				"pm2"=>"Writes at least two  articles in Kiswahili or English for the project/ church bulletin in a year",
				"pm3"=>"In school, he/she scores  at least 50% in  all subjects in end of term examinations."
			),
			"indicator2"=>array(
				"pm1"=>"Maintains an apprenticeship relationship with at least one local resource person/organization for the vocational skills of his/her interest",
				"pm2"=>"Initiates vocational activities of choice at least once a year ",
				"pm3"=>"Regularly updates his/her life goals e.g.  using My Plan For Tomorrow"
			),
			"indicator3"=>array(
				"pm1"=>"Refines his/her competence in three or less income generating activities",
				"pm2"=>"Able to explain his/her plan of how he/she intends to market the item(s) he/she has made.",
				"pm3"=>"Able to identify at least four possible local sources of business capital."
			)
		),
		"socio-emotion"=>array(
			"indicator1"=>array(
				"pm1"=>"Manages his/her own emotions effectively.",
				"pm2"=>"Teaches peers at the Project at least twice a year about how to respect others",
				"pm3"=>"Describes steps he/she will take in intervening and solving a problem that he/she would like to solve."
			),
			"indicator2"=>array(
				"pm1"=>"Identifies at least four things in his or her life (the private-self) that other people are not aware of about him or her.",
				"pm2"=>"Leads others in carrying out a community act of service at least once a year. ",
				"pm3"=>"Guides at least three peers/children in the Project in setting goals for their own lives in 'My Plan for Tomorrow'"
			),
			"indicator3"=>array(
				"pm1"=>"Ably describes at least three issues affecting his or her community.",
				"pm2"=>"Often mediates in conflicts involving other Project children",
				"pm3"=>"Disciples at least three adolescents."
			)
		)
	),
	"19+"=>array(
		"spiritual"=>array(
			"indicator1"=>array(
				"pm1"=>"Leads at least seven Bible-study sessions per year at the Project.",
				"pm2"=>"Disciples at least two children/youths in the Project.",
				"pm3"=>"Disciples at least three children/youths in the Project on how to use a Bible-Study Guide well."
			),
			"indicator2"=>array(
				"pm1"=>"Organizes at least one evangelism  outreach in  year ",
				"pm2"=>"Regularly practices at least seven behaviors that demonstrate the love of God to the people around him/her at the Project.",
				"pm3"=>"Regularly gives counsel to other children/youths in the Project about living a life that is pleasing to God."
			),
			"indicator3"=>array(
				"pm1"=>"Trains peers/children at the Project about spiritual acts of service at least three times a year. ",
				"pm2"=>"Involved in leading at least one local Church Ministry.",
				"pm3"=>"Regularly leads prayer groups at the Project at least once every three months."
			)
		),
		"physical"=>array(
			"indicator1"=>array(
				"pm1"=>"Teaches groups of children about personal hygiene at least two times a year ",
				"pm2"=>"Leads at least four discussions in a year with other adolescents about body-changes in puberty.",
				"pm3"=>"Leads others in a sport of choice at least three times a year."
			),
			"indicator2"=>array(
				"pm1"=>"Demonstrates to others how to prepare a balanced diet using locally available foods",
				"pm2"=>"Teaches organized groups of peers at the Project at least three times a year about prevention of poverty-related diseases.",
				"pm3"=>"Carries out formal physical growth-monitoring of younger Children at the Project at least once every six months."
			),
			"indicator3"=>array(
				"pm1"=>"Instructs peers and/or younger children on steps to take in case of experiencing child abuse. ",
				"pm2"=>"Teaches peers at the Project at least twice a year about Sexual Purity.",
				"pm3"=>"Promotes A Substance/Drug Abuse-free life by signing a Commitment to keep away from such behavior."
			)
		),
		"cognitive"=>array(
			"indicator1"=>array(
				"pm1"=>"Joins institution for post-Secondary education.",
				"pm2"=>"Composes an 800-word report about his/her progress in spiritual, cognitive, socio-emotional and physical areas ",
				"pm3"=>"In college, he/she scores  at least 50% in  all subjects in end of term examinations."
			),
			"indicator2"=>array(
				"pm1"=>"Coaches peers about the basics of at least one vocational skill of his/her interest",
				"pm2"=>"Leads at least one group vocational activity of choice once in a year",
				"pm3"=>"Achieves at least 30% of his/her goals set for economic self-sufficiency"
			),
			"indicator3"=>array(
				"pm1"=>"Develops at least one Business Proposal of an income-generating activity of his/her choice, once in two years",
				"pm2"=>"Generates some income from at least one vocational skill he/she has learnt.",
				"pm3"=>"Makes one Business Proposal Budget of a business of her/his choice in a year"
			)
		),
		"socio-emotion"=>array(
			"indicator1"=>array(
				"pm1"=>"Manages his/her own emotions effectively.",
				"pm2"=>"Teaches peers at the Project at least twice a year about how to respect others",
				"pm3"=>"Describes steps he/she will take in intervening and solving a problem that he/she would like to solve."
			),
			"indicator2"=>array(
				"pm1"=>"Identifies at least four things in his or her life (the private-self) that other people are not aware of about him or her.",
				"pm2"=>"Leads others in carrying out a community act of service at least once a year. ",
				"pm3"=>"Guides at least three peers/children in the Project in setting goals for their own lives in 'My Plan for Tomorrow'"
			),
			"indicator3"=>array(
				"pm1"=>"Ably describes at least three issues affecting his or her community.",
				"pm2"=>"Often mediates in conflicts involving other Project children",
				"pm3"=>"Disciples at least three adolescents."
			)
		)
	)
);

if(!is_array($data['rec'])){
	echo "<div id='error_div'>Beneficiary ".$data['ben']." not available in the database</div>";
	exit;
}

echo "<form id='frmcdpr'>";
echo "<table>";
echo "<caption>Individual Child Assessment: Assessment Form</caption>";

echo "<tr><th colspan='3' style='background-color:cyan;'>Bio Data</th></tr>";
echo "<tr><th style='text-align:left;'>ICP ID</th><td colspan='2'><INPUT TYPE='text' id='pNo' name='pNo' VALUE='".$data['icp']."' readonly/></td></tr>";
echo "<tr><th style='text-align:left;'>Beneficiary ID</th><td colspan='2'><INPUT TYPE='text' id='childNo' name='childNo' VALUE='".$data['rec'][0]->childNo."' readonly/></td></tr>";
echo "<tr><th style='text-align:left;'>Beneficiary Name</th><td colspan='2'><INPUT TYPE='text' id='childName' name='childName' VALUE='".$data['rec'][0]->childName."' readonly/></td></tr>";
echo "<tr><th style='text-align:left;'>Beneficiary Date Of Birth</th><td colspan='2'><INPUT TYPE='text' id='dob' name='dob' VALUE='".$data['rec'][0]->dob."' readonly/></td></tr>";
//cognitiveagegroup
echo "<tr><th style='text-align:left;'>Cognitive Age Group Assessed</th><td colspan='2'><INPUT TYPE='text' id='cognitiveagegroup' name='cognitiveagegroup' VALUE='".$data['cognitiveagegroup']."' readonly/></td></tr>";
echo "<tr><th style='text-align:left;'>Assessment Completion Date</th><td colspan='2'><INPUT readonly TYPE='text' id='assessDate' name='assessDate' VALUE='".$data['rec'][0]->assessDate."'/></td></tr>";

echo "<tr><th colspan='3' style='background-color:cyan;'>Cognitive Outcome</th></tr>";
echo "<tr><th colspan='3'>Global Indicator #1:  Completes at least primary education</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator1']['pm1']."<INPUT TYPE='hidden' name='CognitiveIndicator1Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator1']['pm1']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator1Pm1Score' name='CognitiveIndicator1Pm1Score' VALUE='".$data['rec'][0]->CognitiveIndicator1Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator1Pm1Comment' name='CognitiveIndicator1Pm1Comment' VALUE='".$data['rec'][0]->CognitiveIndicator1Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator1']['pm2']."<INPUT TYPE='hidden' name='CognitiveIndicator1Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator1']['pm2']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator1Pm2Score' name='CognitiveIndicator1Pm2Score' VALUE='".$data['rec'][0]->CognitiveIndicator1Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator1Pm2Comment' name='CognitiveIndicator1Pm2Comment' VALUE='".$data['rec'][0]->CognitiveIndicator1Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator1']['pm3']."<INPUT TYPE='hidden' name='CognitiveIndicator1Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator1']['pm3']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator1Pm3Score' name='CognitiveIndicator1Pm3Score' VALUE='".$data['rec'][0]->CognitiveIndicator1Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator1Pm3Comment' name='CognitiveIndicator1Pm3Comment' VALUE='".$data['rec'][0]->CognitiveIndicator1Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #2:  Cultivates unique vocational interests and intelligence</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator2']['pm1']."<INPUT TYPE='hidden' name='CognitiveIndicator2Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator2']['pm1']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator2Pm1Score' name='CognitiveIndicator2Pm1Score' VALUE='".$data['rec'][0]->CognitiveIndicator2Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator2Pm1Comment' name='CognitiveIndicator2Pm1Comment' VALUE='".$data['rec'][0]->CognitiveIndicator2Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator2']['pm2']."<INPUT TYPE='hidden' name='CognitiveIndicator2Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator2']['pm2']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator2Pm2Score' name='CognitiveIndicator2Pm2Score' VALUE='".$data['rec'][0]->CognitiveIndicator2Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator2Pm2Comment' name='CognitiveIndicator2Pm2Comment' VALUE='".$data['rec'][0]->CognitiveIndicator2Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator2']['pm3']."<INPUT TYPE='hidden' name='CognitiveIndicator2Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator2']['pm3']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator2Pm3Score' name='CognitiveIndicator2Pm3Score' VALUE='".$data['rec'][0]->CognitiveIndicator2Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator2Pm3Comment' name='CognitiveIndicator2Pm3Comment' VALUE='".$data['rec'][0]->CognitiveIndicator2Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #3:  Learns and utilizes at least one income-generating skill</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator3']['pm1']."<INPUT TYPE='hidden' name='CognitiveIndicator3Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator3']['pm1']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator3Pm1Score' name='CognitiveIndicator3Pm1Score' VALUE='".$data['rec'][0]->CognitiveIndicator3Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator3Pm1Comment' name='CognitiveIndicator3Pm1Comment' VALUE='".$data['rec'][0]->CognitiveIndicator3Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator3']['pm2']."<INPUT TYPE='hidden' name='CognitiveIndicator3Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator3']['pm2']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator3Pm2Score' name='CognitiveIndicator3Pm2Score' VALUE='".$data['rec'][0]->CognitiveIndicator3Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator3Pm2Comment' name='CognitiveIndicator3Pm2Comment' VALUE='".$data['rec'][0]->CognitiveIndicator3Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator3']['pm3']."<INPUT TYPE='hidden' name='CognitiveIndicator3Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['cognitive']['indicator3']['pm3']."'/></td><td><INPUT TYPE='text' id='CognitiveIndicator3Pm3Score' name='CognitiveIndicator3Pm3Score' VALUE='".$data['rec'][0]->CognitiveIndicator3Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='CognitiveIndicator3Pm3Comment' name='CognitiveIndicator3Pm3Comment' VALUE='".$data['rec'][0]->CognitiveIndicator3Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3' style='background-color:cyan;'>Physical Outcome</th></tr>";
echo "<tr><th colspan='3'>Global Indicator #1:  Demonstrates an appropriate understanding of his or her physical body</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator1']['pm1']."<INPUT TYPE='hidden' name='PhysicalIndicator1Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator1']['pm1']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator1Pm1Score' name='PhysicalIndicator1Pm1Score' VALUE='".$data['rec'][0]->PhysicalIndicator1Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator1Pm1Comment' name='PhysicalIndicator1Pm1Comment' VALUE='".$data['rec'][0]->PhysicalIndicator1Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator1']['pm2']."<INPUT TYPE='hidden' name='PhysicalIndicator1Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator1']['pm2']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator1Pm2Score' name='PhysicalIndicator1Pm2Score' VALUE='".$data['rec'][0]->PhysicalIndicator1Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator1Pm2Comment' name='PhysicalIndicator1Pm2Comment' VALUE='".$data['rec'][0]->PhysicalIndicator1Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator1']['pm3']."<INPUT TYPE='hidden' name='PhysicalIndicator1Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator1']['pm3']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator1Pm3Score' name='PhysicalIndicator1Pm3Score' VALUE='".$data['rec'][0]->PhysicalIndicator1Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator1Pm3Comment' name='PhysicalIndicator1Pm3Comment' VALUE='".$data['rec'][0]->PhysicalIndicator1Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #2:  Experiences reduced incidence of illness, nutritional deficiencies and physical impediments</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator2']['pm1']."<INPUT TYPE='hidden' name='PhysicalIndicator2Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator2']['pm1']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator2Pm1Score' name='PhysicalIndicator2Pm1Score' VALUE='".$data['rec'][0]->PhysicalIndicator2Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator2Pm1Comment' name='PhysicalIndicator2Pm1Comment' VALUE='".$data['rec'][0]->PhysicalIndicator2Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator2']['pm2']."<INPUT TYPE='hidden' name='PhysicalIndicator2Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator2']['pm2']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator2Pm2Score' name='PhysicalIndicator2Pm2Score' VALUE='".$data['rec'][0]->PhysicalIndicator2Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator2Pm2Comment' name='PhysicalIndicator2Pm2Comment' VALUE='".$data['rec'][0]->PhysicalIndicator2Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator2']['pm3']."<INPUT TYPE='hidden' name='PhysicalIndicator2Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator2']['pm3']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator2Pm3Score' name='PhysicalIndicator2Pm3Score' VALUE='".$data['rec'][0]->PhysicalIndicator2Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator2Pm3Comment' name='PhysicalIndicator2Pm3Comment' VALUE='".$data['rec'][0]->PhysicalIndicator2Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indiciator #3:  Takes responsibility for wise life choices about health and sexuality</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator3']['pm1']."<INPUT TYPE='hidden' name='PhysicalIndicator3Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator3']['pm1']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator3Pm1Score' name='PhysicalIndicator3Pm1Score' VALUE='".$data['rec'][0]->PhysicalIndicator3Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator3Pm1Comment' name='PhysicalIndicator3Pm1Comment' VALUE='".$data['rec'][0]->PhysicalIndicator3Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator3']['pm2']."<INPUT TYPE='hidden' name='PhysicalIndicator3Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator3']['pm2']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator3Pm2Score' name='PhysicalIndicator3Pm2Score' VALUE='".$data['rec'][0]->PhysicalIndicator3Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator3Pm2Comment' name='PhysicalIndicator3Pm2Comment' VALUE='".$data['rec'][0]->PhysicalIndicator3Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator3']['pm3']."<INPUT TYPE='hidden' name='PhysicalIndicator3Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['physical']['indicator3']['pm3']."'/></td><td><INPUT TYPE='text' id='PhysicalIndicator3Pm3Score' name='PhysicalIndicator3Pm3Score' VALUE='".$data['rec'][0]->PhysicalIndicator3Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='PhysicalIndicator3Pm3Comment' name='PhysicalIndicator3Pm3Comment' VALUE='".$data['rec'][0]->PhysicalIndicator3Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3' style='background-color:cyan;'>Socio-Emotional Outcome</th></tr>";
echo "<tr><th colspan='3'>Global Indicator #1:  Exercises self-management</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator1']['pm1']."<INPUT TYPE='hidden' name='SocioEmotionIndicator1Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator1']['pm1']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator1Pm1Score' name='SocioEmotionIndicator1Pm1Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator1Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator1Pm1Comment' name='SocioEmotionIndicator1Pm1Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator1Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator1']['pm2']."<INPUT TYPE='hidden' name='SocioEmotionIndicator1Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator1']['pm2']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator1Pm2Score' name='SocioEmotionIndicator1Pm2Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator1Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator1Pm2Comment' name='SocioEmotionIndicator1Pm2Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator1Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator1']['pm3']."<INPUT TYPE='hidden' name='SocioEmotionIndicator1Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator1']['pm3']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator1Pm3Score' name='SocioEmotionIndicator1Pm3Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator1Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator1Pm3Comment' name='SocioEmotionIndicator1Pm3Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator1Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #2:  Applies self and social awareness in making responsible life choices</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator2']['pm1']."<INPUT TYPE='hidden' name='SocioEmotionIndicator2Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator2']['pm1']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator2Pm1Score' name='SocioEmotionIndicator2Pm1Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator2Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator2Pm1Comment' name='SocioEmotionIndicator2Pm1Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator2Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator2']['pm2']."<INPUT TYPE='hidden' name='SocioEmotionIndicator2Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator2']['pm2']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator2Pm2Score' name='SocioEmotionIndicator2Pm2Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator2Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator2Pm2Comment' name='SocioEmotionIndicator2Pm2Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator2Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator2']['pm3']."<INPUT TYPE='hidden' name='SocioEmotionIndicator2Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator2']['pm3']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator2Pm3Score' name='SocioEmotionIndicator2Pm3Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator2Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator2Pm3Comment' name='SocioEmotionIndicator2Pm3Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator2Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #3:  Exhibits effective interpersonal relationship skills</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator3']['pm1']."<INPUT TYPE='hidden' name='SocioEmotionIndicator3Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator3']['pm1']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator3Pm1Score' name='SocioEmotionIndicator3Pm1Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator3Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator3Pm1Comment' name='SocioEmotionIndicator3Pm1Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator3Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator3']['pm2']."<INPUT TYPE='hidden' name='SocioEmotionIndicator3Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator3']['pm2']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator3Pm2Score' name='SocioEmotionIndicator3Pm2Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator3Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator3Pm2Comment' name='SocioEmotionIndicator3Pm2Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator3Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator3']['pm3']."<INPUT TYPE='hidden' name='SocioEmotionIndicator3Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['socio-emotion']['indicator3']['pm3']."'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator3Pm3Score' name='SocioEmotionIndicator3Pm3Score' VALUE='".$data['rec'][0]->SocioEmotionIndicator3Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SocioEmotionIndicator3Pm3Comment' name='SocioEmotionIndicator3Pm3Comment' VALUE='".$data['rec'][0]->SocioEmotionIndicator3Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3' style='background-color:cyan;'>Spiritual Outcome</th></tr>";
echo "<tr><th colspan='3'>Global Indicator #1:  Knows and understands the Bible</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator1']['pm1']."<INPUT TYPE='hidden' name='SpiritualIndicator1Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator1']['pm1']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator1Pm1Score' name='SpiritualIndicator1Pm1Score' VALUE='".$data['rec'][0]->SpiritualIndicator1Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator1Pm1Comment' name='SpiritualIndicator1Pm1Comment' VALUE='".$data['rec'][0]->SpiritualIndicator1Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator1']['pm2']."<INPUT TYPE='hidden' name='SpiritualIndicator1Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator1']['pm2']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator1Pm2Score' name='SpiritualIndicator1Pm2Score' VALUE='".$data['rec'][0]->SpiritualIndicator1Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator1Pm2Comment' name='SpiritualIndicator1Pm2Comment' VALUE='".$data['rec'][0]->SpiritualIndicator1Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator1']['pm3']."<INPUT TYPE='hidden' name='SpiritualIndicator1Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator1']['pm3']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator1Pm3Score' name='SpiritualIndicator1Pm2Score' VALUE='".$data['rec'][0]->SpiritualIndicator1Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator1Pm3Comment' name='SpiritualIndicator1Pm3Comment' VALUE='".$data['rec'][0]->SpiritualIndicator1Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #2:  Confesses Jesus as Savior</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator2']['pm1']."<INPUT TYPE='hidden' name='SpiritualIndicator2Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator2']['pm1']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator2Pm1Score' name='SpiritualIndicator2Pm1Score' VALUE='".$data['rec'][0]->SpiritualIndicator2Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator2Pm1Comment' name='SpiritualIndicator2Pm1Comment' VALUE='".$data['rec'][0]->SpiritualIndicator2Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator2']['pm2']."<INPUT TYPE='hidden' name='SpiritualIndicator2Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator2']['pm2']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator2Pm2Score' name='SpiritualIndicator2Pm2Score' VALUE='".$data['rec'][0]->SpiritualIndicator2Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator2Pm2Comment' name='SpiritualIndicator2Pm2Comment' VALUE='".$data['rec'][0]->SpiritualIndicator2Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator2']['pm3']."<INPUT TYPE='hidden' name='SpiritualIndicator2Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator2']['pm3']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator2Pm3Score' name='SpiritualIndicator2Pm3Score' VALUE='".$data['rec'][0]->SpiritualIndicator2Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator2Pm3Comment' name='SpiritualIndicator2Pm3Comment' VALUE='".$data['rec'][0]->SpiritualIndicator2Pm3Comment."'/></td></tr>";

echo "<tr><th colspan='3'>Global Indicator #3:  Practices spiritual disciplines of prayer, Bible study, worship and service</th></tr>";
echo "<tr><th style='text-align:left;'>Progress Measure</th><th style='text-align:left;'>Score</th><th style='text-align:left;'>Comment</th></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator3']['pm1']."<INPUT TYPE='hidden' name='SpiritualIndicator3Pm1' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator3']['pm1']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator3Pm1Score' name='SpiritualIndicator3Pm1Score' VALUE='".$data['rec'][0]->SpiritualIndicator3Pm1Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator3Pm1Comment' name='SpiritualIndicator3Pm1Comment' VALUE='".$data['rec'][0]->SpiritualIndicator3Pm1Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator3']['pm2']."<INPUT TYPE='hidden' name='SpiritualIndicator3Pm2' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator3']['pm2']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator3Pm2Score' name='SpiritualIndicator3Pm2Score' VALUE='".$data['rec'][0]->SpiritualIndicator3Pm2Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator3Pm2Comment' name='SpiritualIndicator3Pm2Comment' VALUE='".$data['rec'][0]->SpiritualIndicator3Pm2Comment."'/></td></tr>";
echo "<tr><td style='text-align:left;'>".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator3']['pm3']."<INPUT TYPE='hidden' name='SpiritualIndicator3Pm3' VALUE='".$progressmeasures[$data['cognitiveagegroup']]['spiritual']['indicator3']['pm3']."'/></td><td><INPUT TYPE='text' id='SpiritualIndicator3Pm3Score' name='SpiritualIndicator3Pm3Score' VALUE='".$data['rec'][0]->SpiritualIndicator3Pm3Score."' onchange='validatecdprscore(this);'/></td><td><INPUT TYPE='text' id='SpiritualIndicator3Pm3Comment' name='SpiritualIndicator3Pm3Comment' VALUE='".$data['rec'][0]->SpiritualIndicator3Pm3Comment."'/></td></tr>";

echo "</table>";
echo "</form>";
if($data['rec'][0]->status==='0'&&Resources::session()->userlevel==='1'){
	echo "<button onclick='savecdpr(\"frmcdpr\");'>Save</button><button onclick='submitcdpr(\"frmcdpr\");'>Submit</button>";	
}

?>