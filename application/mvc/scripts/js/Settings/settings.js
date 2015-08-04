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
    //if(fy===""){
    	//alert('FY cannot be empty!');
    	//document.getElementById('fy').style.backgroundColor='red';
    //}else{         
    	//document.getElementById('fy').style.backgroundColor='white';                                  
         xmlhttp.open("POST",path+"/mvc/Settings/massFundsUpload/public/0",true);
         xmlhttp.send(frmData);
     //}
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
	//alert("Hello");	
	var dollar_rate = document.getElementById('dollar_rate').value;
	var fy = document.getElementById('dollar_rate_fy').value;
	//alert(dollar_rate);
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
	//alert(exchange_rate);
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Settings/changeExchangeRate/exchange_rate/"+exchange_rate+"/fy/"+fy,true);      
      xmlhttp.send();
}
