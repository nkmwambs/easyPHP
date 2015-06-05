function sendName(frmid){
    //alert(frmid);
        var frm=document.getElementById(frmid);
        var frmData = new FormData(frm);

    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                            document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);  
                document.getElementById("rsts").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("POST",path+"/mvc/Resource/sendName/public/0",true);
        xmlhttp.send(frmData); 
}
function deleteUser(){
    var usr = document.getElementById("uname").value;
    var pass = "Me";
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState===4 && xmlhttp.status===200) {
           alert(xmlhttp.responseText);
                //var txt = xmlhttp.responseText;

          }
        };
        
        xmlhttp.open("GET",path+"system/index.php?url=mvc/Resource/delUser/user/"+usr,true);
        xmlhttp.send();    
}