<?php
//$data['csp']=1;
$style='display:block;';
$colspan='20';
$csp='';
if(!isset($data['csp'])){
	$style='display:none;';
	$colspan='19';
}else{
	$csp=$data['csp'][0]->cspNo;
}
	echo "<button onclick='addClaim(\"tblreqClaim\");'>Add New Row</button>"
    ."<button class='btn' onclick='submitClaim(\"frmClaim\");'>Submit</button>"
    . "<button onclick='delRow(\"tblreqClaim\");'>Delete Row</button>".Resources::a_href("Claims/viewMedicalClaims",""
    . "<button>View</button>")."";
			
    echo "<form id='frmClaim' enctype='multipart/form-data'>";
	echo "<INPUT TYPE='hidden' VALUE='".$csp."' id='cspNo'/>";
    echo "<table style='position: relative;left: 0px; font-size: 8pt; width:1060px;font-size:small;' id='tblreqClaim'  class='designerTable'>";
    echo "<tr><th colspan='".$colspan."' align='left'>Medical Claim System: Medical Claim Form</th></tr>";
    echo "<tr><th>Select</th><th style='".$style."'>Is CSP Beneficiary?</th></th><th>Claim Date</th><th>Project No</th><th>Cluster Name</th><th>Child Number</th><th>Child Name</th><th>Treatment Date</th><th>Claim Type</th><th>Diagnosis</th><th>Voucher Number</th><th>NHIF Number</th><th>Amount Spent</th><th>Caregiver's Contribution</th><th>Amount Reimbursed</th><th>Facility Name</th><th>Facility Type</th><th>Receipts</th><th>Request Approval Document (If Any)</th><th>Child's Claim Count</th></tr>";
                   
    echo "</table>";
    echo "</form>";
    echo "<input type='hidden' id='curDate' value='".date("Y-m-d")."'/>";
    echo "<input type='hidden' id='KENo' value='".$_SESSION['fname']."'/>";
    echo "<input type='hidden' id='cst' value='".$_SESSION['cname']."'/>";
