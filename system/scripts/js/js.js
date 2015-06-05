var path = 'http://'+location.hostname+'/easyPHP/';

function xmlhttprequest(url,cnfrm1,confrm2){
//alert(url);
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

    xmlhttp.onreadystatechange=function() {    
        if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            if(confrm2==="1"){
                document.write(xmlhttp.responseText);
            }else{
                location.reload();
                alert(xmlhttp.responseText);
            }
        }
    };
    if(cnfrm1==="1"){
    var response = confirm("Are you sure you want to perform this action?");
        if(response){
            xmlhttp.open("GET",path+"system/index.php?url="+url+"/rnd/"+Math.random(),true);
            xmlhttp.send();
        }
        else{
            alert("Your action has been cancelled!");
        }
    }else{
        xmlhttp.open("GET",path+"system/index.php?url="+url+"/rnd/"+Math.random(),true);
        xmlhttp.send();        
    }
}

function editMenu(el){
    var elemid=el.id;
    var tdid_arr = elemid.split("_");
    var tdid = tdid_arr[0];
    var tdFld = tdid_arr[2];
    var elem = document.getElementById(elemid);
    if(elem.childNodes[0].tagName!=='INPUT'){
        var value = elem.innerHTML;
        document.getElementById(elemid).innerHTML = "<input id='"+tdFld+"' type='text' value='"+value+"' onchange='effectEdit(this,\""+tdid+"\");'/>";
    }
}

function effectEdit(el,mnid){
    var url = "mvc/Settings/editMenu/"+el.id+"/"+el.value+"/mnID/"+mnid+"";
    xmlhttprequest(url,"1","0");
}

function removeInput(el){
    var id=el.id;
    var elem = document.getElementById(id);
    if(elem.childNodes[0].tagName==='INPUT'){
        var value = elem.firstChild.value;
        elem.removeChild(elem.firstChild);
        elem.innerHTML=value;
        
    }
}