 

var tArea = document.getElementsByTagName("textarea");
for (var f=0; f < tArealength; f++) {
  //setAttributes(tArea, {"spellcheck": "true"});  
}; 
 
function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp * 1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = date + ' ' + month + ' ' + year;
  return time;
} 
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
        var username = document.getElementById('username').value;
        if(!username){
 			alert('Click the watch glass to search for a username!');
 			exit;
 		}
        xmlhttp.open("GET",path+"/mvc/Welcome/switchUser/username/"+username,true);
        xmlhttp.send(); 
    
}
function closepop(){
	document.getElementById('popup').style.display='none';
}
function popup(rst,header){
	var container = document.getElementById('container');
	var pop = document.createElement("DIV");
	setAttributes(pop,{"id":"popup","class":"popup"});
	var content = document.createElement("DIV");
	//content.innerHTML='<a href="#close" title="Close"  onclick="closepop()" class="close">X</a><b>'+header+"</b><br>"+rst;
	content.innerHTML='<a href="#close" title="Close"  onclick="closepop()" class="close">X</a><b>'+header+"</b><br>";
	content.appendChild(rst);
	pop.appendChild(content);
	container.appendChild(pop);
	
}
function searchUser(){
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                var rst = xmlhttp.responseText;
                var header = "Toolkit Users";
                popup(rst,header);
          }
        };
    xmlhttp.open("GET",path+"mvc/Welcome/userpop",true);
    xmlhttp.send();
}
function getUser(username){
	//alert(username);
	document.getElementById('username').value = username;
	closepop();
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
function showLogin(){
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('content').innerHTML=xmlhttp.responseText;

            }
        };                                          
         xmlhttp.open("GET",path+"/mvc/Welcome/login",true);
         xmlhttp.send(); 
}

function login(){
	//alert("Hello");
    var frm = document.getElementById('frmLogin');  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
				document.write(xmlhttp.responseText);
                }
            
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Welcome/show/public/1",true);
         xmlhttp.send(frmData);
}

 function newPassReset(frmid){
 	var pass1 =  document.getElementById('password').value;
 	var pass2 =  document.getElementById('rptPassword').value;
 	
 	
 	
    var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loadingmin.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                //document.write(xmlhttp.responseText);
                document.getElementById('coverUp').style.display='none';
                           

            }
        };
    if(pass1!==pass2||pass1===""||pass2===""){
 		alert("Password and Password Repeat Must be the same and not empty");
 		//exit();
 	}else{                                           
         xmlhttp.open("POST",path+"/mvc/Welcome/newPassReset",true);
         xmlhttp.send(frmData);   
     }  
}

function forgotPassReset(frmid){
	//alert(frmid);
	document.getElementById('msg').innerHTML="";
	var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
           
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('msg').innerHTML=xmlhttp.responseText;

            }
        };                                          
         xmlhttp.open("POST",path+"/mvc/Welcome/forgotPassReset",true);
         xmlhttp.send(frmData);   
}
function changeLang(elem){
	//alert(elem.value);   
	xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				location.reload();

            }
        };                                       
         xmlhttp.open("GET",path+"/mvc/Settings/changeLang/lang/"+elem.value,true);
         xmlhttp.send(); 
}

