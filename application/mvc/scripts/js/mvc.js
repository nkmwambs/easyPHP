var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

function setAttributes(el, attrs) {
  for(var key in attrs) {
    el.setAttribute(key, attrs[key]);
  }
}//setAttributes(elem, {"src": "http://example.com/something.jpeg", "height": "100%", ...});    
function xmlrequest(url){
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //el.parentNode.innerHTML=xmlhttp.responseText;
                document.getElementById('overlay').style.display='none';
                document.writeln(xmlhttp.responseText);
             }
        };
          //alert(url);                                     
         xmlhttp.open("GET",path+"system/index.php?url=mvc/"+url+"&rnd="+Math.random(),true);
         xmlhttp.send();
}
function chkAll(el){
    var chkbxs = document.getElementsByClassName('chks');
   if(el.checked===true){
       for(var i=0;i<chkbxs.length;i++){
           chkbxs.item(i).checked=true;
       }
   }else{
        for(var i=0;i<chkbxs.length;i++){
           chkbxs.item(i).checked=false;
       }
   }
}

function editUserProfile(url){
    var uname = document.getElementById("uname").value;
    var oldPass = document.getElementById("oldPassword").value;
    var newPass = document.getElementById("newPassword").value;
    var newPassRpt = document.getElementById("newPasswordRepeat").value;
    
    if(newPass===newPassRpt){   
    
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //el.parentNode.innerHTML=xmlhttp.responseText;
                document.getElementById('overlay').style.display='none';
                //document.writeln(xmlhttp.responseText);
                
                if(xmlhttp.responseText==='1'){
                    xmlrequest(url);
                    alert("Password Changed successfully!");
                }else if(xmlhttp.responseText==='0'){
                    xmlrequest(url);
                    alert("Old paswword not found. In case this problem persist contact the administrator!");
                }
             }
        };
          //alert(url);                                     
         xmlhttp.open("GET",path+"system/index.php?url=mvc/Settings/confirmUserExist&rnd="+Math.random(),true);
         xmlhttp.send();
    
    }else{
        xmlrequest(url);
        alert("The new password repeat does not match!");
    }
}
function recentItems(title,url,userid,img){
       //alert(title);
        var mod_url=url.replace("/","_");
	   xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
            
          //alert(xmlhttp.responseText); 

        }
       };
 
       xmlhttp.open("GET",path+"system/index.php?url=mvc/Welcome/newRecent/title/"+title+"/url/"+mod_url+"/userid/"+userid+"/img/"+img+"/&rnd="+Math.random(),true);
       xmlhttp.send();
 
}
function printData(tblid)
{
  //document.getElementById("printecj").addEventListener("click",function(){
      var cnf = confirm("Are you sure you want to print this view?");
      if(cnf){
            var divToPrint=document.getElementById(tblid);
            with (divToPrint.style){
                 borderCollapse='collapse';
                 minWidth='50%';
                 marginLeft='auto';
                 marginRight='auto';
             }
            var newWin= window.open("", "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=0,width=900, height=600");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.close();
            newWin.focus();
            newWin.print();
      }else{
          alert("Printing aborted!");
      }
  //});
}

function switchUser(el){
    //alert(el.id);


    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                            document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);       
                location.reload();
            }
        };
        if(el.tagName==="BUTTON"){
            var frm=document.getElementById("frmSwitch");
            var frmData = new FormData(frm);    
            xmlhttp.open("POST",path+"/mvc/Welcome/switchUser/public/0",true);
            xmlhttp.send(frmData); 
        }else{
            xmlhttp.open("GET",path+"/mvc/Welcome/switchUser/username/"+el.id,true);
            xmlhttp.send();             
        }
    
}

function searchUser(elid){
    //alert(elid);
    var val = document.getElementById(elid).value;
    //alert(val);
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                            document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                newWin= window.open("http://localhost/easyPHP/mvc/Welcome/searchUser/", "_blank","toolbar=no, scrollbars=yes, resizable=no, \n\
                top=50, left=600,width=500, height=500,menubar=no,titlebar=no,statusbar=no");
                //var obj = JSON.parse(xmlhttp.responseText);
                //newWin.document.write(xmlhttp.responseText);
                document.getElementById("btnUserSearch").style.display='block';
          }
        };
        //alert(val);
    xmlhttp.open("GET",path+"mvc/Welcome/searchUser/username/"+val,true);
    xmlhttp.send();
}
function delRec(){
    var dels = document.getElementsByClassName("dels");
    if(document.getElementById("del").checked===true){
        for(var i=0;i<dels.length;i++){
            dels.item(i).checked=true;
        }
        document.getElementById("btnFundsDel").style.display='block';
    }else{
        for(var i=0;i<dels.length;i++){
            dels.item(i).checked=false;
        }
        document.getElementById("btnFundsDel").style.display='block';
        location.reload();
    }
}

function login(){
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
              document.getElementById('overlay').style.display='block';
              document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('content').innerHTML=xmlhttp.responseText;
          }
        };
        //alert(val);
    xmlhttp.open("GET",path+"mvc/Welcome/login",true);
    xmlhttp.send();
}

