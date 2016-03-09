/*var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
*/

document.onclick = function(e){

    var target = (e && e.target) || (event && event.srcElement);

        if (target.id !== "mainDiv") {
                document.getElementById('mainDiv').style.display ="none";
        }



};
function pageload(){
	window.location.assign(path+app+"/"+controller+"/"+method);
}
function successload(){
	
	window.location.assign(path+app+"/Login/confirm/"+window.location.pathname);
}
function popup(){
    
	   xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
            
          var r = JSON.parse(xmlhttp.responseText); 
          var mainDiv=document.createElement("div");
          mainDiv.id="mainDiv";
                with(mainDiv.style){
                      position='absolute';
                      width='150px';
                      height='200px';
                      top='50px';
                      backgroundColor='wheat';
                      border='1px black solid';
                      borderRadius='5px';
                      padding='10px 5px 0px 5px';
                }
          for(var k=0;k<r.length;k++){ 
            var inner=document.createElement("div");
            var node=document.createTextNode(r[k].username);
            inner.appendChild(node);
            inner.id='innerdiv';
            inner.onclick=function(){
                fillInFld(this.innerHTML);
                
            };
            mainDiv.appendChild(inner);
            }

          document.getElementById("container").appendChild(mainDiv);
        }
       };
 
       xmlhttp.open("GET",path+"system/index.php?url=schoolmanager/Events/searchUsers/&rnd="+Math.random(),true);
       xmlhttp.send();
}
function searchstudentfrominput(){
	alert("Hello");
}
function fillInFld(el){
    //alert(el);
    document.getElementById("eventInivitees").value+=el+",";
}
function recentItems(title,url,userid,img){
        //alert(url);
        var mod_url=url.replace("/","_");
	   xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {

        }
       };
 
       xmlhttp.open("GET",path+"system/index.php?url=schoolmanager/Register/newRecent/title/"+title+"/url/"+mod_url+"/userid/"+userid+"/img/"+img,true);
       xmlhttp.send();
 
}

function moveitem(senderSelect,receiveSelect){
    var list = document.getElementById(senderSelect);
    var listItems = list.children.length;
    
    for(var i=0;i<listItems;i++){
        if(list.children(i).selected){
            var opt = document.createElement("option");
            opt.innerHTML=list.children(i).value;
            opt.value=list.children(i).value;
            document.getElementById(receiveSelect).appendChild(opt);
            list.remove(list.selectedIndex);
        }
    }


}



