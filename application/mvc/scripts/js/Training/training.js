function savelemone(frmid){
	var frm =document.getElementById(frmid);
	var frmData = new FormData(frm);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				alert(xmlhttp.responseText);
				//location.reload();

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Training/savelemone",true);      
        xmlhttp.send(frmData);
}
function loadlemoneform(){
	var userdepartment = document.getElementById('userdepartment').value;
	var usertoken = document.getElementById('usertoken').value;
	var trainingID = document.getElementById('tID').value;
	
	//Check if No Training is selected
	if(trainingID===""){
		alert('Please choose a valid training');
		exit;
	}
	
	//Check if User is an ICP account and if Yes exit
	if(parseInt(userdepartment)===0){
		alert('Please consider using a personal non CKE staff toolkit user account');
		exit;
	}
	
	
	var frmData = new FormData();
	frmData.append("tID",trainingID);
	frmData.append("usertoken",usertoken);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Training/loadlem",true);      
        xmlhttp.send(frmData);
}
function addtrainingsession(){
	var tbl = document.getElementById('tbltrainingsessions');
    var rowCount = tbl.rows.length;
    var row = tbl.insertRow(rowCount);
            
    var cell0 = row.insertCell(0);
    var element0 = document.createElement("input");
    element0.type = "checkbox";
    element0.className="chkbx";
    element0.onclick=function(){
    		var chks = document.getElementsByClassName("chkbx");
            var cnt = 0;
                for(var i=0;i<chks.length;i++){
                    if(chks.item(i).checked===true){
                       cnt++;
                    }
                }
                if(cnt>0){
                    document.getElementById("btnDelRow").style.display="block";
                }else{
                    document.getElementById("btnDelRow").style.display="none";
                }
            };
     cell0.appendChild(element0);
	
	var cell1 = row.insertCell(1);
	var element1 = document.createElement("input");
    element1.type = "text";
    element1.style.width = '90%';
    element1.setAttribute("class","sessdesc tbox");
    element1.name = "sessdesc[]";
    cell1.appendChild(element1);

	var cell2 = row.insertCell(2);
	var element2 = document.createElement("input");
    element2.type = "text";
    element2.style.width = '90%';
    element2.setAttribute("class","facilitator tbox");
    element2.name = "facilitator[]";
    cell2.appendChild(element2);	
}
function delRow(tableID){
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null !== chkbox && true === chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}

			}
}

function posttraining(frmid){
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
				//location.reload();

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Training/posttraining",true);      
        xmlhttp.send(frmData);
}
function addlemqstnrow(tblid){
	var tbl = document.getElementById(tblid);
    var rowCount = tbl.rows.length;
    var row = tbl.insertRow(rowCount);
            
    var cell0 = row.insertCell(0);
    var element0 = document.createElement("input");
    element0.type = "checkbox";
    element0.className="chkbx";
    element0.onclick=function(){
    		var chks = document.getElementsByClassName("chkbx");
            var cnt = 0;
                for(var i=0;i<chks.length;i++){
                    if(chks.item(i).checked===true){
                       cnt++;
                    }
                }
                if(cnt>0){
                    document.getElementById("btnDelRow").style.display="block";
                }else{
                    document.getElementById("btnDelRow").style.display="none";
                }
            };
     cell0.appendChild(element0);
	
	var cell1 = row.insertCell(1);
	var element1 = document.createElement("input");
    element1.type = "text";
    element1.style.width = '90%';
    element1.setAttribute("class","qdesc");
    element1.name = "qdesc[]";
    cell1.appendChild(element1);
}
function postlemquestion(frmid){
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
				location.reload();

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Training/postlemquestion",true);      
        xmlhttp.send(frmData);	
}
function updatelemqstnstate(state,qid,el){
	var frmData = new FormData();
	frmData.append("status",state);
	frmData.append("qID",qid);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				alert(xmlhttp.responseText);
				var row = el.parentNode.parentNode;
				var tbl = row.parentNode;
				var index=row.rowIndex;
				tbl.deleteRow(index);

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Training/updatelemqstnstate",true);      
        xmlhttp.send(frmData);
}
function filterlemqstns(){
	var state = document.getElementById('filterqstnstate').value;
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();

          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Training/training/state/"+state,true);      
        xmlhttp.send();	
}

function retrievestaff(){
	var keno = document.getElementById('keno').value;
	//alert(keno);
	var frmData = new FormData();
	frmData.append('keno',keno);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                var obj = JSON.parse(xmlhttp.responseText);
				//alert(obj);
				//location.reload();
				//alert(xmlhttp.responseText);
				var slct = document.getElementById('participantsname');
				for(var x=1;x<slct.children.length;x++){
					slct.removeChild(x);
				}
				for(var i=0;i<obj.length;i++){
					var user = obj[i].userfirstname+" "+obj[i].userlastname;
					var opt = document.createElement("option");
					opt.value=obj[i].ID;
					opt.innerHTML=user;
					slct.appendChild(opt);
				}

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Training/retrievestaff",true);      
        xmlhttp.send(frmData);
}
function checkregister(){
	var userID = document.getElementById('participantsname').value;
	var trainingID = document.getElementById('training').value;
	var frmData = new FormData();
	frmData.append('userID',userID);
	frmData.append('trainingID',trainingID);
	
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
		
      	xmlhttp.open("POST",path+"mvc/Training/checkregister",true);      
        xmlhttp.send(frmData);	
}
