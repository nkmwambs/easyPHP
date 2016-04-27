function postmsg(){
		validaterequired();
		 xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('smart_rst').style.display='block';
                document.getElementById('smart_rst').innerHTML=xmlhttp.responseText;
            }
        };
      
    var boardname = document.getElementById('boardname').value;
    var pointer = document.getElementById("pointer").value;
    var msg_type = document.getElementById("msg_type").value;
    //var msg = document.getElementById("msg").value;
    var msg = tinyMCE.get('msg').getContent();
    
    
    var frmData = new FormData();
    frmData.append("boardname",boardname);
    frmData.append("pointer",pointer);
    frmData.append("msg_type",msg_type);
    frmData.append("msg",msg);
     
	xmlhttp.open("POST",path+"/schoolmanager/Administration/postmsg",true);
    xmlhttp.send(frmData);
}
function pullexistingmessage(){
	alert("Hello");
}
function postlogo(){
	//alert("Hello");
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('smart_rst').style.display='block';
                document.getElementById('smart_rst').innerHTML=xmlhttp.responseText;
            }
        };
    var frm = document.getElementById('frmlogo');   
    var frmData = new FormData(frm);
   	var sitetitle = tinyMCE.get('sitetitle').getContent();
   	sitetitle.replace(/<p>|<\/p>/gi,"<br>");
   	
   	frmData.append("sitetitle",sitetitle); 
     
	xmlhttp.open("POST",path+"/schoolmanager/Administration/postlogo",true);
    xmlhttp.send(frmData);
}
function changedefaultlogo(){
	//alert("Hello");	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('smart_rst').style.display='block';
                document.getElementById('smart_rst').innerHTML=xmlhttp.responseText;
            }
        };
    var frm = document.getElementById('frmsetlogo');   
    var frmData = new FormData(frm);
    
	xmlhttp.open("POST",path+"/schoolmanager/Administration/changedefaultlogo",true);
    xmlhttp.send(frmData);
}
function deleteLogo(elem){
	//alert(elem.id);
	var row = elem.parentNode.parentNode;
	var tbl = row.parentNode;
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('overlay').style.display='none';
                if(xmlhttp.responseText==='1'){
                	alert("Cannot delete a default logo. Consider changing the logo before you delete it");
                }else{
                	tbl.removeChild(row);
                }
            }
        };
  	var cnf = confirm("Are you sure you want to delete this logo and its associated title?");
  	if(!cnf){
  		alert("Action aborted!");
  		exit;
  	}
  	var logoID = elem.id;
    var frmData = new FormData();
    frmData.append("logoID",logoID);
    
	xmlhttp.open("POST",path+"/schoolmanager/Administration/deleteLogo",true);
    xmlhttp.send(frmData);
		
}

function createmenu(){
	//alert("Got it");
		xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('overlay').style.display='none';
				alert(xmlhttp.responseText);
            }
        };
	var frm = document.getElementById("frmcreatemenu");
    var frmData = new FormData(frm);
    
	xmlhttp.open("POST",path+"/schoolmanager/Administration/createmenu",true);
    xmlhttp.send(frmData);	
}
function editmenu(elem){
	//alert(elem.id.split("_")[1]);
	var val = elem.id.split("_")[1];	
	var fld = elem.id.split("_")[2];
	
	var tds = document.getElementsByClassName("tds");
	
	for (var i=0; i < tds.length; i++) {
	  if(tds.item(i).childNodes[0].type==='text'){
	  		tds.item(i).innerHTML = tds.item(i).childNodes[0].value;
	  }else{
	  		tds.item(i).innerHTML = tds.item(i).childNodes[0].value;
	  }
	};
	
	if(fld==='selfTitle'){
		elem.innerHTML="<INPUT class='vals' TYPE='text' VALUE='"+val+"' onkeyup='changemenufield(\""+fld+"\")'/>";
	}else if(fld==='img'){
		elem.innerHTML="<SELECT><OPTION VALUE='"+val+"'>"+val+"</OPTION></SELECT>";
	}else if(fld==='admin'){
		elem.innerHTML="<SELECT><OPTION VALUE='"+val+"'>"+val+"</OPTION></SELECT>";
	}
	
	
	
}
function changemenufield(fld){
	alert(fld);
}
