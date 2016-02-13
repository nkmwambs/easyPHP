  function getCivAllocatedIcps(elem){ 
     xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //alert(xmlhttp.responseText);
                document.getElementById('allocate').value=xmlhttp.responseText;
            }
        };
        
      var civText = elem.value;      
      var frmData = new FormData();
      frmData.append("civCode",civText);
                                         
      xmlhttp.open("POST",path+"/mvc/Finance/getCivAllocatedIcps",true);
      xmlhttp.send(frmData);
}

function createCivAccount(frmid){
	var mandatory  = document.getElementsByClassName('starred');
	var fldCnt=0;
	for(var i=0;i<mandatory.length;i++){
		if(mandatory.item(i).value===""){
			mandatory.item(i).style.borderColor='red';
			$fldCnt++;
		}
	}
	if(fldCnt>0){
		alert(fldCnt+ "fields are empty!");
		exit;
	}
	  var frm = document.getElementById(frmid);
      var frmData = new FormData(frm);
	     xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                location.reload();
            }
        };
                                         
      xmlhttp.open("POST",path+"/mvc/Finance/createCivAccount",true);
      xmlhttp.send(frmData);
}
function manageCivDate(flag,AccNoCIVA){
	     xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                location.reload();
            }
        };
          
      var cnfm = confirm("Are you sure you want to change the status of this Account?");
      if(!cnfm){
      	alert("Account Status changes aborted!");
      	exit;
      }   
      
      frmData = new FormData();     
      
      frmData.append("flag",flag);
      frmData.append("AccNoCIVA",AccNoCIVA);
            
      xmlhttp.open("POST",path+"/mvc/Finance/manageCivDate",true);
      xmlhttp.send(frmData);
}
function civstatusfilter(elem){
	//alert(elem.value);
	var status=elem.value;
	if(status===""){
		alert("Please choose a valid account state");
		exit;
	}
	     
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
            	document.write(xmlhttp.responseText);
            }
     };   
            
      xmlhttp.open("GET",path+"/mvc/Finance/civ/status/"+status,true);
      xmlhttp.send();	
}

function viewicpcivacounts(civaID,civText){
	//alert(civText);
	     xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
               document.getElementById('content').innerHTML=xmlhttp.responseText;
            }
        }; 
      
      frmData = new FormData();     
      
      frmData.append("civaID",civaID);
      frmData.append("AccTextCIVA",civText);
            
      xmlhttp.open("POST",path+"/mvc/Finance/viewicpcivacounts",true);
      xmlhttp.send(frmData);
}

function showcivimpbreakdown(elem,civaID,civText){
	var icp = elem.innerHTML;
	//alert(civText);
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
               document.getElementById('content').innerHTML=xmlhttp.responseText;
            }
        }; 
      
      frmData = new FormData();     
      frmData.append("icpNo",icp);
      frmData.append("civaID",civaID);
      frmData.append("AccTextCIVA",civText);
            
      xmlhttp.open("POST",path+"/mvc/Finance/showcivimpbreakdown",true);
      xmlhttp.send(frmData);
}

function addfundtocivschedule(){
	var desc = document.getElementById('fund').value;
	var month = document.getElementById('month').value;
	var civCode = document.getElementById('civCode').value;
	//alert(civText);
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
               //document.getElementById('content').innerHTML=xmlhttp.responseText;
               alert("CIV Code Added Successfully in the Fund Schedule");
               location.reload();
            }
        }; 
      
      frmData = new FormData();     
      frmData.append("AccountDescription",desc);
      frmData.append("Month",month);
      frmData.append("civCode",civCode);
            
      xmlhttp.open("POST",path+"/mvc/Finance/addfundtocivschedule",true);
      xmlhttp.send(frmData);	
}

function updatecivcode(){
	document.getElementById('civCode').value=document.getElementById('fund').value;
}
function changeMonthforciv(){
	var month = document.getElementById('newMonth').value;
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
               document.write(xmlhttp.responseText);
               location.reload();
            }
        }; 
      
      frmData = new FormData();     
      frmData.append("Month",month);
            
      xmlhttp.open("POST",path+"/mvc/Finance/civfundsschedule",true);
      xmlhttp.send(frmData);		
}
function addicptociv(elem){	
	var civCode = elem.parentNode.parentNode.children['4'].innerHTML;
	var icp = prompt("Please type in the ICPs you would like to add","");
	if(icp){
			xmlhttp.onreadystatechange=function() {
	            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
	               //document.write(xmlhttp.responseText);
	               //location.reload();
	               //alert(icp+" have been added successfully to "+civCode+" account");ICPs without the CIV Fund
	              // if(xmlhttp.responseText!==""){
	               	//	alert("ICPs without the CIV Fund ("+civCode+"): "+xmlhttp.responseText);
	               //}else{
	               //		alert("All ICPs Added Successfully");
	               //}
	               alert(xmlhttp.responseText);
	            }
	        }; 
	      
	      frmData = new FormData();     
	      frmData.append("icpNos",icp);
	      frmData.append("civCode",civCode);
	            
	      xmlhttp.open("POST",path+"/mvc/Finance/addicptociv",true);
	      xmlhttp.send(frmData);
			
	}else{
		alert("Aborted!");
	}
	
}
