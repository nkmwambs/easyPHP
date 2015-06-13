function testChoice(){
	        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
              document.getElementById('overlay').style.display='block';
              document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                //document.getElementById('content').innerHTML=xmlhttp.responseText;
          }
        };
       var testChoice=document.getElementById('user').value;
    xmlhttp.open("GET",path+"mvc/Resource/testChoice/testChoice/"+testChoice+"/public/0",true);
    xmlhttp.send();
}