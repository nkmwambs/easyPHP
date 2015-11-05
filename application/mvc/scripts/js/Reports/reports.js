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
var cnf = confirm("Want to Inactivate this record? Note, Once you inactivate a record, only the HVC specialist can re-activate it!. Click Ok to activate or Cancel to Abort");		
if(!cnf){
	alert("Action aborted!");	
}else{
     	xmlhttp.open("GET",path+"mvc/Reports/inactivateCase/cid/"+cid,true);      
        xmlhttp.send();
}
}
function stateSort(){
	var state = document.getElementById('stateSort').value;
	var keno =document.getElementById('keno').value;
	//alert(state);
			xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				//document.getElementById("rptsDiv").innerHTML=xmlhttp.responseText;
				//location.reload();
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/manageHvc/state/"+state+"/icpNo/"+keno,true);      
        xmlhttp.send();
}
function isInt(value) {
  return !isNaN(value) && 
         parseInt(Number(value)) == value && 
         !isNaN(parseInt(value, 10));
}
function completeChildNo(elem){
	//alert(elem.value);
	if(document.getElementById('prg').value==='2'){
		var icp = document.getElementById('pNo').value;
		document.getElementById('prg').style.borderColor='';
	}else if(document.getElementById('prg').value==='1'){
		var icp = document.getElementById('csNo').value;
		document.getElementById('prg').style.borderColor='';
	}else{
		document.getElementById('prg').style.borderColor='red';
		document.getElementById('childNo').value="";
		alert('Program type Cannot be empty!');
		exit;
	}
	
	
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
	
	
	var childNum="";
	if(cnum.length===1){
		document.getElementById('childNo').value=icp+"-"+"000"+cnum;
		childNum=icp+"-"+"000"+cnum;
	}else if(cnum.length===2){
		document.getElementById('childNo').value=icp+"-"+"00"+cnum;
		childNum=icp+"-"+"00"+cnum;
	}else if(cnum.length===3){
		document.getElementById('childNo').value=icp+"-"+"0"+cnum;
		childNum=icp+"-"+"0"+cnum;
	}else{
		document.getElementById('childNo').value=icp+"-"+cnum;
		childNum=icp+"-"+cnum;
	}

		xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				//alert(xmlhttp.responseText);
				var obj = JSON.parse(xmlhttp.responseText);
				//alert(obj.pNo);
				document.getElementById('childName').value=obj.childName;
				document.getElementById('newchildDOB').value=obj.dob;
				
				var date2=new Date(document.getElementById('newchildDOB').value);
				var date1=new Date();
				var noOfmonths	= monthDiff(date1,date2);				
				var years=parseInt(noOfmonths)/12;
				
				document.getElementById('childAge').value=years.toFixed(2);
				document.getElementById('childSex').value=obj.sex;
				
          }
        };
		
    if(document.getElementById('prg').value==='2'){
		var newNum = childNum.replace("-","_");
      	xmlhttp.open("GET",path+"mvc/Reports/getChildrenDetails/cnum/"+newNum,true);      
        xmlhttp.send();	
     }
	
}
function changeToText(elemid) {
  var obj = document.getElementById(elemid);
  document.getElementById('sexDiv').removeChild(obj);
  var element = document.createElement('input');
  element.setAttribute('type', 'text');
  element.setAttribute('readonly', 'readonly');
  element.setAttribute('id', elemid);
  document.getElementById('sexDiv').appendChild(element); 
}
function changeToSelect(elemid) {
  var obj = document.getElementById(elemid);
  document.getElementById('sexDiv').removeChild(obj);
  var element = document.createElement('select');
  element.setAttribute('name', 'sex');
  element.setAttribute('id', 'childSex');
  var sel=document.createElement('OPTION');
  sel.value='';
  sel.innerHTML='Select Gender...';
  element.appendChild(sel);
  var male = document.createElement('OPTION');
  male.value='Male';
  male.innerHTML='Male';
  element.appendChild(male);
  var female = document.createElement('OPTION');
  female.value='Female';
  female.innerHTML='Female';
  element.appendChild(female);  
  document.getElementById('sexDiv').appendChild(element);
}
function showHvcBody(){
	
	document.getElementById("body_div").style.display='block';
	var prg=document.getElementById('prg').value;
	document.getElementById('childName').value = "";
	document.getElementById("childAge").value = "";
	document.getElementById('childNo').value='';
	if(prg==='1'){
		document.getElementById('childName').readOnly = false;	
		if(document.getElementById('childDOB')){
			document.getElementById('childDOB').value = "";
		}else{
			document.getElementById('newchildDOB').id = "childDOB";
			document.getElementById('childDOB').value = "";
		}
		if(document.getElementById('childSex').tagName==='INPUT'){
			document.getElementById('childSex').removeAttribute("type");
			document.getElementById('childSex').removeAttribute("readonly");
			changeToSelect('childSex');
		}
		//if(document.getElementById('childNo').hasAttribute('onblur')===true){
			//document.getElementById('childNo').removeAttribute('onblur');
		//}
		
	}else if(prg==='2'){
		document.getElementById('childName').readOnly = true;
		if(document.getElementById('childDOB')){
			document.getElementById('childDOB').id='newchildDOB';
			document.getElementById('newchildDOB').value = "";
		}else{
			document.getElementById('newchildDOB').value = "";
		}
		
		if(document.getElementById('childSex').tagName==='SELECT'){
			changeToText('childSex');
		}
		
		//if(document.getElementById('childNo').hasAttribute('onblur')===false){
			//document.getElementById('childNo').setAttribute('onblur','completeChildNo(this)');
		//}
		//alert(document.getElementById('childNo').hasAttribute('onblur'));
	}
}
function toogleHvcView(cst){
	var rwCst = cst.replace("-","_");
	//alert(rwCst);
	var frmData = new FormData();
		xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
	frmData.append("cst",cst);
      	xmlhttp.open("POST",path+"mvc/Reports/manageHvc",true);      
        xmlhttp.send(frmData);
}

function newMalCase(frmid){
	//alert(frmid);
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
                clrForm();
            }
        };
        
var validate = document.getElementsByClassName('validate');

var cnt=0;
for(var k=0;k<validate.length;k++){
	if(validate.item(k).value===""){
		cnt++;
		validate.item(k).style.borderColor='red';
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
                                               
         xmlhttp.open("POST",path+"/mvc/Reports/newMalCase",true);
         xmlhttp.send(frmData);
}
}
function chkifNum(elem){
	var cnum = elem.value;
	
	if(isNaN(parseInt(cnum))){
		alert("Enter numeric values only!");
		elem.value="";
		elem.style.backgroundColor='red';
		exit;
	}
		
}
function clrForm(){
	var inputs = document.getElementsByClassName('validate');
	for(var i=0;i<inputs.length;i++){
		if(inputs.item(i).hasAttribute('readonly')===false){
			inputs.item(i).value="";
		}
	}	
}
function tfiUpdate(childID,malID){
	//var childID=document.getElementById('cNo').value;
	//svar malID=document.getElementById('malID').value;
	xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
		var childNo = childID.replace("-","");
		//alert(childNo);
      	xmlhttp.open("GET",path+"mvc/Reports/tfiUpdate/cNo/"+childNo+"/malID/"+malID,true);      
        xmlhttp.send();
}
function newtfiUpdate(frmid){
		var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                frm.reset();
            }
        };
        
        xmlhttp.open("POST",path+"/mvc/Reports/newtfiUpdate",true);
        xmlhttp.send(frmData);
}
function malmetricsUpdate(childID,malID){
	//var childID=document.getElementById('cNo').value;
	//svar malID=document.getElementById('malID').value;
	xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
		var childNo = childID.replace("-","");
		//alert(childNo);
      	xmlhttp.open("GET",path+"mvc/Reports/malmetricsUpdate/cNo/"+childNo+"/malID/"+malID,true);      
        xmlhttp.send();	
}
function newmalmetricsupdate(frmid){
		var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                frm.reset();
            }
        };
        
        xmlhttp.open("POST",path+"/mvc/Reports/newmalmetricsupdate",true);
        xmlhttp.send(frmData);	
}
function malcaseview(malID){
	xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.write(xmlhttp.responseText);
				//location.reload();
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/malcaseview/malID/"+malID,true);      
        xmlhttp.send();		
}
function tfiEnrol(childID,malID){
	xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
		var childNo = childID.replace("-","");
      	xmlhttp.open("GET",path+"mvc/Reports/tfienrol/cNo/"+childNo+"/malID/"+malID,true);      
        xmlhttp.send();	
}
function newothertfienrol(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                frm.reset();
            }
        };
        
        xmlhttp.open("POST",path+"/mvc/Reports/newothertfienrol",true);
        xmlhttp.send(frmData);		
}
function exitMalCase(childID,malID){
		xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
		var childNo = childID.replace("-","");
      	xmlhttp.open("GET",path+"mvc/Reports/exitMalCase/cNo/"+childNo+"/malID/"+malID,true);      
        xmlhttp.send();	
}
function exitRequest(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                frm.reset();
            }
        };
        
        xmlhttp.open("POST",path+"/mvc/Reports/exitRequest",true);
        xmlhttp.send(frmData);
}
function declineRequest(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                frm.reset();
            }
        };
        
        xmlhttp.open("POST",path+"/mvc/Reports/declineRequest",true);
        xmlhttp.send(frmData);	
}
function addAttendance(input,mth,yr){
	//alert(input);
	
}
function viewPdsReports(){
		xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.getElementById('pdsRptWelcome').innerHTML=xmlhttp.responseText;
				//location.reload();
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/viewPdsReports/",true);      
        xmlhttp.send();	
}
function savePdsReport(frmid){
	var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                location.reload();
                //frm.reset();
            }
        };
        
        xmlhttp.open("POST",path+"/mvc/Reports/savePdsReport",true);
        xmlhttp.send(frmData);	
}
function showReport(dt){
			xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				//document.getElementById('pdsRptWelcome').innerHTML=xmlhttp.responseText;
				//location.reload();
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/pds/dt/"+dt,true);      
        xmlhttp.send();	
}
function createpdsreport(tym){
	xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				alert(xmlhttp.responseText);
          }
        };
		
      	xmlhttp.open("GET",path+"mvc/Reports/createpdsreport/tym/"+tym,true);      
        xmlhttp.send();	
}

function submitpdsreport(startdate,curdate,enddate,frmid){
	//if(parseInt(curdate)>=parseInt(startdate)&&parseInt(curdate)<=parseInt(enddate)){
		//alert("Ok");
	//}else{
		//alert("Nope");
	//}

	if(parseInt(curdate)>=parseInt(startdate)&&parseInt(curdate)<=parseInt(enddate)){
				//alert("Report submitted successfully");
				var frm = document.getElementById(frmid);  
		   		 var frmData = new FormData(frm);
		            xmlhttp.onreadystatechange=function() {
		            if(xmlhttp.readyState!==4){
		                document.getElementById('overlay').style.display='block';
		                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
		            }
		            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
		                document.getElementById('overlay').style.display='none';
		                alert(xmlhttp.responseText);
		                location.reload();
		                //frm.reset();
		            }
		        };
		        frmData.append("submitting", "1");
		        var cnf = confirm("Are you sure you want to submit this report? Once a report is submitted, changes will not be allowed. Please Cancel and  save the changes if not sure");
		        if(!cnf){
		        	alert("Operation aborted. Report not submitted");
		        	exit;
		        }else{
			        xmlhttp.open("POST",path+"/mvc/Reports/savePdsReport",true);
			        xmlhttp.send(frmData);	
		        }
	}else{
		alert("You cannot submit this report before "+timeConverter(startdate)+" of the month or after "+timeConverter(enddate)+" of the next reporting month");
	}

}

function validatepdsreport(rid,state){
		//alert(state);
	var rsn = "";
	if(state==='2'){
		rsn = document.getElementById('declineReason').value;
	}	
	//alert(rsn);
	var frmData = new FormData();
	frmData.append("rptID",rid);
	frmData.append("status",state);
	frmData.append("declineReason",rsn);
	
		xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				alert(xmlhttp.responseText);
				location.reload();
          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/validatepdsreport",true);      
        xmlhttp.send(frmData);	
	
}
