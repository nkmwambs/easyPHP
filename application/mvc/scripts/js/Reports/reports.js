var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }


//body.addEventListener("load",highlight('qryView'), false);
//document.addEventListener("DOMContentLoaded",highlight('qryView'), false )
  function highlight(inputid)
	{
			var textArr=["SELECT ","UPDATE "," FROM "," LEFT JOIN "," WHERE ","GROUP BY"," ON "," ORDER BY "," ASC "," DESC"," INNER JOIN "," RIGHT JOIN "," SUM"," sum"," AVG"," avg"," AS "," as "];
			for(var i=0;i<textArr.length;i++){
	    		inputText = document.getElementById(inputid);
	    		var innerHTML = inputText.innerHTML;
	    		//var index = innerHTML.indexOf(textArr[i]);
	    		var index= innerHTML.search(textArr[i]);
	    		
	    		if ( index >= 0)
	    		{ 
	        		innerHTML = innerHTML.substring(0,index) + "<span class='highlight'>" + innerHTML.substring(index,index+textArr[i].length) + "</span>" + innerHTML.substring(index + textArr[i].length);
	        		inputText.innerHTML = innerHTML; 
	    		}
	    }

	}

function queryView(frmid){
   	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('qryView').innerHTML=document.getElementById('query').innerHTML;
                document.getElementById('rsView').innerHTML=xmlhttp.responseText;
                highlight('qryView');
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Reports/queryView",true);
         xmlhttp.send(frmData);
   }
   
   function rstQry(){
   	//alert("Hello");
   	   document.getElementById('qryView').innerHTML='';
       document.getElementById('rsView').innerHTML='';
       document.getElementById('query').innerHTML='';
   }
   
   function setQuery(frmid){
   	//alert("Hello");
   	document.getElementById('query').innerHTML=document.getElementById('qrySelect').value;
   	   	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('qryView').innerHTML=document.getElementById('query').innerHTML;
                document.getElementById('rsView').innerHTML=xmlhttp.responseText;
                highlight('qryView');
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Reports/queryView",true);
         xmlhttp.send(frmData);
   }
   
   function newQuery(frmid){
   	//if(document.getElementById('qryName').value=" "){
   		//alert('Query Name cannot be empty!');
   		//document.getElementById('qryName').style.backgroundColor='red';
   		//exit;
   	//}

   	   	var frm = document.getElementById(frmid);  
    	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                location.reload();

            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Reports/newQuery",true);
         xmlhttp.send(frmData);
   }
   
 function calcCsp(){
    //alert('Hi!');
    var pregNo = document.getElementById('pregNo').value;
    var noPregNo = document.getElementById('noPregNo').value;
    var totCaregivers = parseInt(pregNo)+parseInt(noPregNo);
    document.getElementById('totCaregivers').value = totCaregivers;
    
    var cat1Births = document.getElementById('cat1Births').value;
    var cat2Births = document.getElementById('cat2Births').value;
    var cat3Births = document.getElementById('cat3Births').value;
    var cat4Births = document.getElementById('cat4Births').value;
    var totChildren = parseInt(cat1Births)+parseInt(cat2Births)+parseInt(cat3Births)+parseInt(cat4Births);
    var totMcu = parseInt(cat1Births)+parseInt(cat2Births)+parseInt(cat3Births)+parseInt(cat4Births)+parseInt(pregNo);
    document.getElementById('totChildren').value = totChildren; 
    
    document.getElementById('totmcu').value = totMcu; 
    
    var noPremature = document.getElementById('noPremature').value;
    var noFull = document.getElementById('noFull').value;
    var totLive = parseInt(noPremature)+parseInt(noFull);
    document.getElementById('totLive').value = totLive;
    
    var vec = document.getElementsByClassName('vec');
    var sumVec = 0;
    for (var i=0;i<vec.length;i++){
        sumVec += parseInt(vec.item(i).value);
    }
    document.getElementById('totSick').value = sumVec;
    
    var inj = document.getElementsByClassName('inj');
    var sumInj = 0;
    for (var i=0;i<inj.length;i++){
        sumInj += parseInt(inj.item(i).value);
    }
    document.getElementById('totInj').value = sumInj;
    
    var dep = document.getElementsByClassName('dep');
    var sumDep = 0;
    for (var i=0;i<dep.length;i++){
        sumDep += parseInt(dep.item(i).value);
    }
    document.getElementById('totDep').value = sumDep;
    
    
}

function submitCsp(frmid){
	   	   	var frm = document.getElementById(frmid);  
    	var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                //location.reload();

            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Reports/submitCsp",true);
         xmlhttp.send(frmData);
}
function deleteCsp(rid){
	//alert(rid);
		      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                //document.write(xmlhttp.responseText);
                //location.reload();
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/deleteCsp/rid/"+rid,true);      
        xmlhttp.send();
}

function showCspRpt(){
	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                //document.write(xmlhttp.responseText);
                //location.reload();
                document.getElementById("topDiv").innerHTML=xmlhttp.responseText;
          }
        };
		var qtr = document.getElementById('showQtr').value;
		var mth = document.getElementById('showMnth').value;
		if(qtr===""){
			alert("Choose a valid period");
			document.getElementById('showQtr').style.border='2px red solid';
			exit;
		}
		if(mth==="0"){
			alert("Select a month");
			document.getElementById('showMnth').style.border='2px red solid';
			exit;
		}
		document.getElementById('showQtr').style.border='1px black solid';
		document.getElementById('showMnth').style.border='1px black solid';
		
      	xmlhttp.open("GET",path+"mvc/Reports/showCspRpt/qtr/"+qtr+"/mth/"+mth,true);      
        xmlhttp.send();
}
function editCspFromGrid(el){
		var rid=el.parentNode.nextSibling.innerHTML;
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.getElementById("rptsDiv").innerHTML=xmlhttp.responseText;
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/showCspRpt/rid/"+rid,true);      
        xmlhttp.send();
}
function selectCspRpts(){
	//viewCsp
	//var rid=el.parentNode.nextSibling.innerHTML;
	var period = document.getElementById('showQtr').value;
	var mth = document.getElementById('showMnth').value;
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.getElementById("rptsDiv").innerHTML=xmlhttp.responseText;
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/nonIcpCspView/period/"+period+"/mth/"+mth,true);      
        xmlhttp.send();
}
function getMthsforQtr(){
	var str = document.getElementById('showQtr').value;
	var qtr = str.substr(6,2);
	var list=document.getElementById('showMnth');
	var nodes = list.childNodes.length;

		//alert("Hello");
	switch(qtr) {
	     case "Q1":
	        months={"July":"7","August":"8","September":"9"};
	        break;
	     case "Q2":
	        months={"October":"10","November":"11","December":"12"};
	        break;
	     case "Q3":
	        months={"January":"1","February":"2","March":"3"};
	        break;        
	     default:
	         months={"April":"4","May":"5","June":"6"};
 	}
 	//alert(months);
 	list.innerHTML="";
 	var opt = document.createElement("option");
 	var txt = document.createTextNode("Select Month ...");
 	opt.value='0';
 	opt.appendChild(txt);
 	//opt.createTextNodeL="Select Month ...";
 	list.appendChild(opt);
 	for(var key in months ){
 		var opt = document.createElement("option");
 		opt.innerHTML=key;
 		opt.value=months[key];
 		list.appendChild(opt); 		
 	}

}
function submitHvcIndex(){
	//alert("Hello");
	var frm = document.getElementById('indexing');  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
				//document.write(xmlhttp.responseText);
				location.reload();
                }
            
        };
var validate = document.getElementsByClassName('validate');

var cnt=0;
for(var k=0;k<validate.length;k++){
	if(validate.item(k).value===""){
		cnt++;
		validate.item(k).style.backgroundColor='red';
	}
}        

if(cnt!==0){
	alert(cnt +" mandatory fields are empty!");
	exit;
}
        
var cnf = confirm("Are you sure you want to submit this record!");

if(!cnf){
	alert("Record not submitted!");
}else{                                 
         xmlhttp.open("POST",path+"/mvc/Reports/submitHvcIndex/public/0",true);
         xmlhttp.send(frmData);
}
}

function changeClr(id){
                  document.getElementById(id).style.backgroundColor='white';
                  document.getElementById("childName").style.backgroundColor='white';
                  document.getElementById("childDOB").style.backgroundColor='white';
                  document.getElementById("childAge").style.backgroundColor='white';
                  document.getElementById("childSex").style.backgroundColor='white';
              }
function monthDiff(firstDate, secondDate) {
        var fm = firstDate.getMonth();
        var fy = firstDate.getFullYear();
        var sm = secondDate.getMonth();
        var sy = secondDate.getFullYear();
        var months = Math.abs(((fy - sy) * 12) + fm - sm);
        var firstBefore = firstDate > secondDate;
        firstDate.setFullYear(sy);
        firstDate.setMonth(sm);
        firstBefore ? firstDate < secondDate ? months-- : "" : secondDate < firstDate ? months-- : "";
        return months;
}            
function calcAge(elem){
	var date2=new Date(elem.value);
	var date1=new Date();
	var noOfmonths	= monthDiff(date1,date2);
	
	var years=parseInt(noOfmonths)/12;
	
	document.getElementById('childAge').value=years.toFixed(2);
}
function inactivateCase(cid){
	//alert(cid);	
		//var period = document.getElementById('showQtr').value;
	//var mth = document.getElementById('showMnth').value;
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				//document.getElementById("rptsDiv").innerHTML=xmlhttp.responseText;
				location.reload();
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/inactivateCase/cid/"+cid,true);      
        xmlhttp.send();
}
function isInt(value) {
  return !isNaN(value) && 
         parseInt(Number(value)) == value && 
         !isNaN(parseInt(value, 10));
}
function completeChildNo(elem){
	//alert(elem.value);
	var icp = document.getElementById('pNo').value;
	var cnum = elem.value;
	if(isNaN(parseInt(cnum))){
		alert("Enter numeric values only!");
		document.getElementById('childNo').value="";
		document.getElementById('childNo').style.backgroundColor='red';
		exit;
	}
	if(cnum.length>4){
		alert("Enter only the child number without the ICP Number prefix");
		document.getElementById('childNo').value="";
		document.getElementById('childNo').style.backgroundColor='red';
		exit;
	}
	
	if(cnum.length===1){
		document.getElementById('childNo').value=icp+"000"+cnum;
	}else if(cnum.length===2){
		document.getElementById('childNo').value=icp+"00"+cnum;
	}else if(cnum.length===3){
		document.getElementById('childNo').value=icp+"0"+cnum;
	}else{
		document.getElementById('childNo').value=icp+cnum;
	}
}
