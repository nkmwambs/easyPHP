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

function roomsBooking(rm){
	var rmid = rm.id;
	
			xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	//document.getElementById('roomDetails').innerHTML=xmlhttp.responseText;
            	
            	document.write(xmlhttp.responseText);
            	location.reload();
            	
    
          }
        };

      xmlhttp.open("GET",path+"mvc/Business/roomsBooking/rmID/"+rmid,true);      
      xmlhttp.send();
}

function submitRoomBooking(frmid){
	var from = Date.parse(document.getElementById('bookedFromDate').value);	
	var to = Date.parse(document.getElementById('bookedToDate').value);
	if (to < from) {
    	alert ("Error! Booking From date cannot be greater that the booking to date!");
    	exit;
	}else if(document.getElementById('bookedFromDate').value===""||document.getElementById('bookedToDate').value===""){
		alert("Date(s) cannot be empty!");
		exit;
	}
	
	
   var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(xmlhttp.responseText);
                
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	//document.getElementById('roomDetails').innerHTML=xmlhttp.responseText;
            	
            	document.write(xmlhttp.responseText);
            	location.reload();
            	
    
          }
        };

      xmlhttp.open("GET",path+"mvc/Business/room/",true);      
      xmlhttp.send();
                
            }
        };                                     
         xmlhttp.open("POST",path+"/mvc/Business/submitRoomBooking/public/0",true);
         xmlhttp.send(frmData);
}


function expireRoomBooking(bookid){
	  xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	alert(xmlhttp.responseText);
            	
            	
            	   xmlhttp.onreadystatechange=function() {
			            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
			            	//document.getElementById('roomDetails').innerHTML=xmlhttp.responseText;
			            	
			            	document.write(xmlhttp.responseText);
			            	location.reload();
			            	
			    
			          }
			        };
			
			      xmlhttp.open("GET",path+"mvc/Business/room/",true);      
			      xmlhttp.send();
            	
    
          }
        };

      xmlhttp.open("GET",path+"mvc/Business/expireRoomBooking/bookingID/"+bookid,true);      
      xmlhttp.send();
}
