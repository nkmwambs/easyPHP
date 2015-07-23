var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
function submitUser(frmid){
    var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
    xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                document.getElementById('register_error').innerHTML="";
                var inputs = document.getElementsByTagName("input");
                for(var i=0;i<inputs.length;i++){
                    inputs.item(i).value="";
                }
            }
        };
        var cnt=0;
        var passmatch = check_pswd_rpt();
        var rst = check_empty_fields(cnt);
         if(rst>0){
            document.getElementById('register_error').innerHTML= rst+" field(s) are empty!";
        }else if(passmatch===0){
            document.getElementById('register_error').innerHTML= "Cannot submit, Passwords are not matching";
        }else{
         xmlhttp.open("POST",path+"/mvc/Register/submitUser/public/1",true);
         xmlhttp.send(frmData);
     }
}
function check_pswd_len(el){
    
    var msg =document.getElementById('register_error');
    msg.style.color='red';
    if(el.value.length<3){
        el.style.borderColor='red';
        msg.innerHTML = "Very Short Password";
    }else if(el.value.length<5){
        el.style.style.borderColor='yellow';
        msg.innerHTML = "Short Password";
    }else if(el.value.length<7){
        el.style.borderColor='blue';
        msg.innerHTML = "Medium Sized Password";
    }else if(el.value.length>=7){ 
        var exp = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        if(el.value.match(exp)){
            el.style.borderColor='green';
            msg.style.color='green';
            msg.innerHTML = "Excellent Password";            
            return true;
        }else{
            msg.innerHTML = "Password should be 8 characters long with atleast 1 alphanumeric, numeric, uppercase and lowercase characters";
        }
    }
}
function check_pswd_rpt(){
    document.getElementById('register_error').style.color='red';
    var pswd = document.getElementById("password").value;
    var rpt = document.getElementById("rptPassword").value;
    //alert(rpt);
    if(pswd!==rpt){
        document.getElementById('register_error').innerHTML="Passwords are not matching!";
        return 0;
    }else{
        document.getElementById('register_error').style.color='green';
        document.getElementById('register_error').innerHTML="Passwords are now matching!";
        return 1;
    }
}

function check_empty_fields(cnt){
    var inputs = document.getElementsByTagName("input");
    for(var i=0;i<inputs.length;i++){
        if(inputs.item(i).value.length===0||inputs.item(i).value.charAt(0)===" "){
            cnt++;
        }
    }
 return cnt;
}

function validate(elem){
    //alert(elem.id);
    var errorHolder = document.getElementById('register_error');
    errorHolder.innerHTML="";
    elem.style.backgroundColor='white';
    if(elem.id==='username'&&(elem.value.length<6||elem.value.length>10)){
        errorHolder.innerHTML="Username should be between 6 to 10 characters long!";
        elem.style.backgroundColor='red';
        elem.value="";
    }
    if(elem.id==='email'){
        
         var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
            if(elem.value.match(mailformat))  
            {  
                return true; 
               // alert("Ok");
            }  
            else  
            {  
                errorHolder.innerHTML="You have entered an invalid email address!";  
                elem.style.backgroundColor='red';
                elem.value="";
                return false;  
            } 

    }
}
function changePwd(frmid){
    //alert(frmid);
    document.getElementById('register_error').style.color='red';
          var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('register_error').innerHTML=xmlhttp.responseText;

            }
        };
        var cnt=0;
        var passmatch = check_pswd_rpt();
        var rst = check_empty_fields(cnt);
         if(rst>0){
            document.getElementById('register_error').innerHTML= rst+" field(s) are empty!";
        }else if(passmatch===0){
            document.getElementById('register_error').innerHTML= "Cannot submit, Passwords are not matching";
        }else{
        xmlhttp.open("POST",path+"/mvc/Register/changePwd",true);
        xmlhttp.send(frmData);
    }
}
 

