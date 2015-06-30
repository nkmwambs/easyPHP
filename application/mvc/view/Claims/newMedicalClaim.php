<?php
    echo "<form id='frmClaim' method='POST' action='".Resources::url("Claims/medicalClaimEntry")."' enctype='multipart/form-data'>";

echo "<div onclick='addClaim(\"tblreqClaim\");' class='btn'>Add Record</div>"
    . "<button formaction='".Resources::url("Claims/medicalClaimEntry")."' formmethod='POST' class='btn'>Submit</button>"
        . "<div class='btn' onclick='delRow(\"tblreqClaim\");'>Delete Row</div>".Resources::a_href("Claims/viewMedicalClaims",""
                . "<div class='btn' >View</div>")."";


    echo "<table style='position: relative;left: 0px; font-size: 8pt; width:1060px;font-size:small;' id='tblreqClaim'  class='designerTable'>";
    echo "<tr><th colspan='19' align='left'>Medical Claim System: Medical Claim Form</th></tr>";
    echo "<tr><th>Select</th></th><th>Claim Date</th><th>Project No</th><th>Cluster Name</th><th>Child Number</th><th>Child Name</th><th>Treatment Date</th><th>Claim Type</th><th>Diagnosis</th><th>Voucher Number</th><th>NHIF Number</th><th>Amount Spent</th><th>Caregiver's Contribution</th><th>Amount Reimbursed</th><th>Facility Name</th><th>Facility Type</th><th>Request Ref (If Any)</th><th>Receipts</th><th>Child's Claim Count</th></tr>";
                   
    echo "</table>";
    echo "</form>";
    echo "<input type='hidden' id='curDate' value='".date("Y-m-d")."'/>";
    echo "<input type='hidden' id='KENo' value='".$_SESSION['username']."'/>";
    echo "<input type='hidden' id='cst' value='".$_SESSION['cname']."'/>";
