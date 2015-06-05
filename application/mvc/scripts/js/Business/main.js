var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
function showdd(id){
    document.querySelector("#"+id).style.display='block';
}
function hidedd(id){
    document.querySelector("#"+id).style.display='none';    
}

function changePriority(){
    alert("Hello");
}

function changeState(){
    alert("Hello");
}
function postHelpFeedback(fm){
       var frm = document.getElementById(fm);  
   //frm.submit();
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
                                               
         xmlhttp.open("POST",path+"/mvc/Business/postHelpFeedback",true);
         xmlhttp.send(frmData);
}