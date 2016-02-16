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
    var msg = document.getElementById("msg").value;
    
    
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
