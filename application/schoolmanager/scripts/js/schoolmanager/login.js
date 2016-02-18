//var path = 'http://'+location.hostname+'/easyPHP/';


function login()
{
	 try
	 {
	   xmlhttp.onreadystatechange=function() 
	   {
		if (xmlhttp.readyState!==4) 
		{
         document.getElementById("overlay").style.display="block";
         document.getElementById("overlay").innerHTML="<img id='loading' src='"+path+"system/images/loading.gif'/>";       
         //document.getElementById("loading").style.marginTop='200px';
         //document.getElementById("loading").style.marginLeft='570px';
        }
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
         document.getElementById("overlay").style.display="none";
          document.writeln(xmlhttp.responseText);                                     
        }
       };
       document.getElementById("login").style.display="none";
       xmlhttp.open("GET",path+"system/index.php?url="+app+"/Login/show_login",true);
       xmlhttp.send();
   }
   catch(e)
   {
   	//alert(e.Message);
   }
}
function log(frmid){
    //alert("Hello");
    var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert("Hello");
                if(xmlhttp.responseText==='1'){
                    document.getElementById("error_log").innerHTML='<img id="loadimg" src= "'+path+'/system/images/error.png"/> Access denied, Please contact an administrator if error persists!';
                }else{
                	
                document.write(xmlhttp.responseText);
                
                }
            

            }
        };
                                               
         xmlhttp.open("POST",path+"/"+app+"/Login/logged/public/1",true);
         xmlhttp.send(frmData);
}
function checkSecurity(frmid){
        var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                if(xmlhttp.responseText==='0'){
                    document.getElementById("error_log").innerHTML='<img id="loadimg" src= "'+path+'/system/images/error.png"/> Credential provided is wrong, Please contact the Administrator!';
                }else{
                document.write(xmlhttp.responseText);
                
                }
            

            }
        };
                                               
         xmlhttp.open("POST",path+"/"+app+"/Login/passReset",true);
         xmlhttp.send(frmData);    
}

function newPassReset(frmid){
        var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //alert(xmlhttp.responseText);
                document.getElementById('overlay').style.display='none';
                if(xmlhttp.responseText!=='1'){
                    document.getElementById("register_error").innerHTML='<img id="loadimg" src= "'+path+'/system/images/error.png"/> Error Occured';
                }else{
                document.getElementById("register_error").innerHTML='<img id="loadimg" src= "'+path+'/system/images/inform.png"/> Password Reset Successfully!';
                                
                }
            

            }
        };
                                               
         xmlhttp.open("POST",path+"/"+app+"/Login/newPassReset",true);
         xmlhttp.send(frmData);     
}