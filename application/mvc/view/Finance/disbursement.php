<?php
if($_SESSION['userlevel']==="1"){
    echo Resources::a_href("Finance/viewSlip","<button>View Advice</button>");
}elseif($_SESSION['userlevel']==="2"){
    echo Resources::a_href("Finance/advicePerICP","<button>Advice Per ICP</button>")." ".a_tag("","<button>Advice Per Cluster</button>");
}elseif($_SESSION['userlevel']==="3") {
    echo Resources::a_href("Finance/fundsUpload","<button>Upload Funds</button>");
    echo "<button onclick='viewFunds();'>View Uploads</button>";
} else {
    
}
?>