var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }


function downloadblforms(frmid){
document.getElementById('icpNo').style.borderColor='white';
if(document.getElementById('icpNo').value==='')
{
	document.getElementById('icpNo').style.borderColor='red';
	alert('No ICP Number Selected');
	exit;
}
   	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //if(document.getElementById('rpt')){
                	document.getElementById('rplc').innerHTML=xmlhttp.responseText;
                //}else{
                	//document.write(xmlhttp.responseText);
                //}
                
 
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/ProgramCommunication/downloadforms",true);
         xmlhttp.send(frmData);
}
function pullipcs(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
	var status = document.getElementById('pullicps').value;
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //document.getElementById('state').value=status;
                document.getElementById('icpsdrop').innerHTML=xmlhttp.responseText;
 
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/ProgramCommunication/selecticps",true);
         xmlhttp.send(frmData);
}
function statusupdate(newState,rid,icpNo,elem){
	       xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	//alert(xmlhttp.responseText);
                document.getElementById('overlay').style.display='none';
                if(xmlhttp.responseText==='3'){
                	elem.parentNode.innerHTML='<span style="color:green;">Archived</span>';
                }else if(xmlhttp.responseText==='2'){
                	elem.parentNode.innerHTML='<img title="Archive" onclick="statusupdate("'+newState+'","'+rid+'","'+icpNo+'","'+elem+'");" src= "'+path+'/system/images/archive.png"/> | <img title="Flag" onclick="statusupdate("4","'+rid+'","'+icpNo+'","'+elem+'");" src= "'+path+'/system/images/blackflag.png"/>';
                }else if(xmlhttp.responseText==='1'){
                	elem.parentNode.innerHTML='<span style="color:red;">Declined</span>';
                }else if(xmlhttp.responseText==='4'){
                	elem.parentNode.innerHTML='<img title="Flagged" onclick="statusupdate("2","'+rid+'","'+icpNo+'","'+elem+'");" src= "'+path+'/system/images/redflag.png"/>';
                }else if(xmlhttp.responseText==='6'){
                	elem.parentNode.innerHTML='<img title="Archive" onclick="statusupdate("2","'+rid+'","'+icpNo+'","'+elem+'");" src= "'+path+'/system/images/archive.png"/> | <img title="Resolved Flag" src= "'+path+'/system/images/greenflag.png"/>';
                }
            }
        };
            //alert(newState);                      
         xmlhttp.open("GET",path+"/mvc/ProgramCommunication/statusupdate/status/"+newState+"/rid/"+rid+"/icpNo/"+icpNo,true);
         xmlhttp.send();
}

function selectRow(elem){
	var tbl = elem.parentNode.parentNode.children;
	for(var j=0;j<tbl.length;j++){
		var cell = tbl.item(j).children;
		for(var k=0;k<cell.length;k++){
			cell.item(k).style.borderColor='grey';
			cell.item(k).style.borderWidth='2px';
		}
	}
	
	var cls = elem.parentNode.children;
	for(var i=0;i<cls.length;i++){
		cls.item(i).style.borderColor='red';
		cls.item(i).style.borderWidth='3px';
	}
}
