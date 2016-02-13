var path = 'http://'+location.hostname+'/easyPHP/';
if (window.XMLHttpRequest) 
{
        // code for IE7+, Firefox, Chrome, Opera, Safari
      var xmlhttp=new XMLHttpRequest();
              
 } 
 else 
 { // code for IE6, IE5
   var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 }

function showEvent(td,mth,yr){
    var dt = td.innerHTML;
    	   xmlhttp.onreadystatechange=function() 
	   {
		if (xmlhttp.readyState!==4) 
		{
         document.getElementById("overlay").style.display="block";
         document.getElementById("overlay").innerHTML="<img id='loading' src='"+path+"system/images/loading.gif'/>";       
        }
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
         var eventstbl = document.getElementById("viewEvents");
         eventstbl.rows[0].cells[0].innerHTML="Event(s) for "+td.innerHTML+"-"+mth+"-" +yr;
         for(var r=1;r<eventstbl.rows.length;i++){
             eventstbl.deleteRow(r);
         }
         document.getElementById("overlay").style.display="none";
          var events = JSON.parse(xmlhttp.responseText);  
          var rw1 =eventstbl.insertRow(1);
          var cell1 = rw1.insertCell(0);
          cell1.innerHTML="<b>Event</b>";
          
          var cell2 = rw1.insertCell(1);
          cell2.innerHTML="<b>Location</b>";
          
          var cell3 = rw1.insertCell(2);
          cell3.innerHTML="<b>Event Urgency</b>";
          
          var cell4 = rw1.insertCell(3);
          cell4.innerHTML="<b>Event Owner</b>";          
          var urgency_arr = ["Low","Medium","High"];
          for(var i=0;i<events.length;i++){
              var rws=parseInt(i)+2;
              var row = eventstbl.insertRow(rws);
              var cell1 = row.insertCell(0);
              var cell2 = row.insertCell(1);
              var cell3 = row.insertCell(2);
              var cell4 = row.insertCell(3);
              cell1.innerHTML="<a href='"+path+"system/index.php?url=schoolmanager/Events/showEventDetails/public/1/mth/"+mth+"/yr/"+yr+"/eventID/"+events[i].eventID+"'>"+events[i].eventTitle+"</a>";
              cell2.innerHTML=events[i].eventLoc;
              cell3.innerHTML=urgency_arr[events[i].eventUrgency];
              cell4.innerHTML=events[i].eventOwnerName;
          }
          

        }
       };
       //alert(dt);
       xmlhttp.open("GET",path+"/schoolmanager/Events/showEvents/public/1/dt/"+dt+"/mth/"+mth+"/yr/"+yr,true);
       xmlhttp.send();
}
function newEvent(form){
    var id=form.id;
    var frm = document.getElementById(id);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                document.getElementById('overlay').style.display='none';
            

            }
        };
                                               
         xmlhttp.open("POST",path+"/schoolmanager/Events/postEvent",true);
         xmlhttp.send(frmData);
}
function editEvent(userid){
    
	   xmlhttp.onreadystatechange=function() 
	   {
		if (xmlhttp.readyState!==4) 
		{
         document.getElementById("overlay").style.display="block";
         document.getElementById("overlay").innerHTML="<img id='loading' src='"+path+"system/images/loading.gif'/>";       
        }
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
         document.getElementById("overlay").style.display="none";
          document.writeln(xmlhttp.responseText);                                     
        }
       };
 
       xmlhttp.open("GET",path+"system/index.php?url=schoolmanager/Events/editEvent/userid/"+userid,true);
       xmlhttp.send();
}
function postEditedEvent(){
    alert("Hello");
}
function searchUsers(){
    alert("Search Users");
}