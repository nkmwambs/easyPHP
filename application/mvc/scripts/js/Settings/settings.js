function uploadPlans(frmid){
	var fy = document.getElementById('fy').value;
   var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
            }
        };
    if(fy===""){
    	alert('FY cannot be empty!');
    	document.getElementById('fy').style.backgroundColor='red';
    }else{         
    	document.getElementById('fy').style.backgroundColor='white';                                  
         xmlhttp.open("POST",path+"/mvc/Settings/uploadplansheader/public/0",true);
         xmlhttp.send(frmData);
     }    
}
function planHeaderView(){
	//document.getElementById('planView').innerHTML="Hello World";
	var fy = document.getElementById('fy').value;
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('planView').innerHTML=xmlhttp.responseText;

          }
        };
	if(fy===""){
		alert("FY cannot be empty");
		document.getElementById('fy').style.backgroundColor='red';
	}else{
		document.getElementById('fy').style.backgroundColor='white';
      xmlhttp.open("GET",path+"mvc/Settings/viewPlansHeader/tym/"+fy,true);      
      xmlhttp.send();
     }
}

function uploadSchedules(frmid){
	var fy = document.getElementById('fy2').value;
	var icpNo = document.getElementById('icpNo').value;
   	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
            }
        };
    if(fy===""||icpNo===""){
    	alert('FY or KE Number cannot be empty!');
    	 	   	   	   	
    		document.getElementById('fy2').style.backgroundColor='red';
    		document.getElementById('icpNo').style.backgroundColor='red';
    	
    		
    
    }else{         
    	document.getElementById('fy2').style.backgroundColor='white';  
    	document.getElementById('icpNo').style.backgroundColor='white';                                
         xmlhttp.open("POST",path+"/mvc/Settings/uploadSchedules/public/0",true);
         xmlhttp.send(frmData);
     } 
}
function viewSchedulesUploads(elem){
	alert(elem.parentNode.parentNode.cells[1].innerHTML);
	var headerID = elem.parentNode.parentNode.cells[1].innerHTML;
}

function massFundsUpload(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
            }
        };                                
         xmlhttp.open("POST",path+"/mvc/Settings/massFundsUpload/public/0",true);
         xmlhttp.send(frmData);
}
function massCashBalUpload(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
            }
        };                                
         xmlhttp.open("POST",path+"/mvc/Settings/massCashBalUpload/public/0",true);
         xmlhttp.send(frmData);
}
function massOcBalUpload(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
            }
        };                                
         xmlhttp.open("POST",path+"/mvc/Settings/massOcBalUpload/public/0",true);
         xmlhttp.send(frmData);
}
function childrenDbUpdate(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
            }
        };                                
         xmlhttp.open("POST",path+"/mvc/Settings/childrenDbUpdate",true);
         xmlhttp.send(frmData);
}
function dateControl(elem){
	if(elem.checked===true){
		var flag=0;
	}else{
		var flag=1;
	}
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);

          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/dateControl/flag/"+flag,true);      
      xmlhttp.send();
     
}

function changeDollarRate(){
	var dollar_rate = document.getElementById('dollar_rate').value;
	var fy = document.getElementById('dollar_rate_fy').value;
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/changeDollarRate/dollar_rate/"+dollar_rate+"/fy/"+fy,true);      
      xmlhttp.send();
}
function changeExchangeRate(){
	var exchange_rate = document.getElementById('exchange_rate').value;
	var fy = document.getElementById('exchange_rate_fy').value;
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/changeExchangeRate/exchange_rate/"+exchange_rate+"/fy/"+fy,true);      
      xmlhttp.send();
}

function changeIcpPopulation(){
	//alert("Hello");
	var icpNoPop = document.getElementById('icpNoPop').value;
	var noOfMonths=document.getElementById('noOfMonths').value;
	var fy = document.getElementById('icpFy').value;
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/changeICPPopulation/icpNoPop/"+icpNoPop+"/fy/"+fy+"/noOfMonths/"+noOfMonths,true);      
      xmlhttp.send();
}

function siteOff(elem){
	var state=0;
	if(elem.checked){
		state=1;
	}
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/siteOff/state/"+state,true);      
      xmlhttp.send();
}

function getOfflineMsg(){
	
	var msg =document.getElementById('offlineMsg').value;
	//alert(msg);
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/getOfflineMsg/msg/"+msg,true);      
      xmlhttp.send();
}
function editUserProfile(){
    var uname = document.getElementById("fname").value;
    var oldPass = document.getElementById("oldPassword").value;
    var newPass = document.getElementById("newPassword").value;
    var newPassRpt = document.getElementById("newPasswordRepeat").value;
    //alert(uname);
   
    if(newPass===newPassRpt&&newPass!==""&&oldPass!==""){   
    	//alert("Password Matches");
    	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //alert(xmlhttp.responseText);
                var cnfm = xmlhttp.responseText;
                if(cnfm ==='1'){
                	//alert("User exists");
                			xmlhttp.onreadystatechange=function() {
					            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
					                alert(xmlhttp.responseText);
          						}
        					};

					      xmlhttp.open("GET",path+"mvc/Settings/editUserProfile/username/"+uname+"/password/"+newPass,true);      
					      xmlhttp.send();
                }else{
                	alert('User does not exist!');
                }
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/confirmUserExist/username/"+uname+"/password/"+oldPass,true);      
      xmlhttp.send();
    
    }else{
        alert("The new password repeat does not match or old password field is empty!");
    }
    
}

function showUsersList(pstID){
	//alert(dsgID);	
			xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('rst').innerHTML=xmlhttp.responseText;
            	
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/showUsersList/pstID/"+pstID,true);      
      xmlhttp.send();
	
}
function addUserToCategory(cat){
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('rst').innerHTML=xmlhttp.responseText;
            	
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/addUserToCategory/cat/"+cat,true);      
      xmlhttp.send();
}
function changeLimits(){
	//alert("Hello");
	var cspLimit = document.getElementById('cspLimit').value;
	var cdspLimit = document.getElementById('cdspLimit').value;
	xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				//document.write(xmlhttp.responseText);
				alert(xmlhttp.responseText);
				location.reload();
				
          }
        };
		
     xmlhttp.open("GET",path+"mvc/Settings/changeLimits/cspLimit/"+cspLimit+"/cdspLimit/"+cdspLimit,true);      
     xmlhttp.send();
}

function hvcClosureDate(){
   var frm = document.getElementById("frmcloseIndexing");  
   var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/hvcClosureDate/",true);
    xmlhttp.send(frmData);
}

function addNewHvcVul(){
	var frm = document.getElementById("frmVul");  
   	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                location.reload();
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/addNewHvcVul/",true);
    xmlhttp.send(frmData);
}
function addNewHvcIntvn(){
	var frm = document.getElementById("frmIntvn");  
   	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                location.reload();
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/addNewHvcIntvn/",true);
    xmlhttp.send(frmData);
}
function addNewOtherIntvn(){
	var frm = document.getElementById("frmOtherIntvn");  
   	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                location.reload();
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/addNewOtherIntvn/",true);
    xmlhttp.send(frmData);
}
function chkDel(){
	var chk = document.getElementsByClassName('chk');
	//alert(chk.length);
	var cnt=0;
	for(var i=0;i<chk.length;i++){
		if(chk.item(i).checked===true){
			cnt++;
		}
	}
	//alert(cnt);
	if(cnt>0){
		document.getElementById('delBtn').style.display='block';
	}else{
		document.getElementById('delBtn').style.display='none';
	}
}
function chkDelIntvn(){
	var chk = document.getElementsByClassName('chkIntv');
	//alert(chk.length);
	var cnt=0;
	for(var i=0;i<chk.length;i++){
		if(chk.item(i).checked===true){
			cnt++;
		}
	}
	//alert(cnt);
	if(cnt>0){
		document.getElementById('delIntvnBtn').style.display='block';
	}else{
		document.getElementById('delIntvnBtn').style.display='none';
	}
}
function chkDelOtherIntvn(){
	var chk = document.getElementsByClassName('chkOtherIntv');
	//alert(chk.length);
	var cnt=0;
	for(var i=0;i<chk.length;i++){
		if(chk.item(i).checked===true){
			cnt++;
		}
	}
	//alert(cnt);
	if(cnt>0){
		document.getElementById('delOtherIntvnBtn').style.display='block';
	}else{
		document.getElementById('delOtherIntvnBtn').style.display='none';
	}
}
function delVul(){ 
	//alert("Hey"); 
	var chk = document.getElementsByClassName('chk');
	var obj=[];
	var cnt=0;
	var vul_arr;
	for(var i=0;i<chk.length;i++){
		if(chk.item(i).checked===true){
			cnt++;
			vul_arr=chk.item(i).id.split('_');
			obj.push(vul_arr[1]);
			chk.item(i).parentNode.parentNode.style.display='none';
		}
	}
	//alert(JSON.stringify(obj));
	var str = obj;
	document.getElementById('delStr').value=str;
	
	var frm = document.getElementById("frmDelStr");  
   	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/delVul/",true);
    xmlhttp.send(frmData);
}
function delIntvn(){ 
	//alert("Hey"); 
	var chk = document.getElementsByClassName('chkIntv');
	var obj=[];
	var cnt=0;
	var vul_arr;
	for(var i=0;i<chk.length;i++){
		if(chk.item(i).checked===true){
			cnt++;
			vul_arr=chk.item(i).id.split('_');
			obj.push(vul_arr[1]);
			chk.item(i).parentNode.parentNode.style.display='none';
		}
	}
	//alert(JSON.stringify(obj));
	var str = obj;
	document.getElementById('delStrIntvn').value=str;
	
	var frm = document.getElementById("frmDelStrIntvn");  
   	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/delIntvn/",true);
    xmlhttp.send(frmData);
}
function delOtherIntvn(){ 
	//alert("Hey"); 
	var chk = document.getElementsByClassName('chkOtherIntv');
	var obj=[];
	var cnt=0;
	var vul_arr;
	for(var i=0;i<chk.length;i++){
		if(chk.item(i).checked===true){
			cnt++;
			vul_arr=chk.item(i).id.split('_');
			obj.push(vul_arr[1]);
			chk.item(i).parentNode.parentNode.style.display='none';
		}
	}
	//alert(JSON.stringify(obj));
	var str = obj;
	document.getElementById('delStrOtherIntvn').value=str;
	
	var frm = document.getElementById("frmDelStrOtherIntvn");  
   	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
            }
        };
                                               
    xmlhttp.open("POST",path+"/mvc/Settings/delOtherIntvn/",true);
    xmlhttp.send(frmData);
}
function blockUser(uid,auth){
	var userid=uid;
	var auth_code=auth;
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				//document.write(xmlhttp.responseText);
				alert(xmlhttp.responseText);
				location.reload();
          }
        };
		
     xmlhttp.open("GET",path+"mvc/Settings/blockUser/userid/"+userid+"/auth/"+auth_code,true);      
     xmlhttp.send();
}

