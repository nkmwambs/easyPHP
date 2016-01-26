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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
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
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('overlay').style.display='none';
				location.reload();
          }
        };
var cnf = confirm("Want to Inactivate this record? Note, Once you inactivate a record, only the HVC specialist can re-activate it!. Click Ok to activate or Cancel to Abort");		
if(!cnf){
	alert("Action aborted!");	
}else{
		frmData=new FormData();
		frmData.append("cid",cid);
     	xmlhttp.open("POST",path+"mvc/Reports/inactivateCase",true);      
        xmlhttp.send(frmData);
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
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		var frmData = new FormData();
		frmData.append("state",state);
		frmData.append("icp",keno);
      	xmlhttp.open("POST",path+"mvc/Reports/manageHvcIcp",true);      
        xmlhttp.send(frmData);
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
function toogleHvcViewSpecialist(cst){
	var frmData = new FormData();
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
	frmData.append("cst",cst);
      	xmlhttp.open("POST",path+"mvc/Reports/manageHvcPf",true);      
        xmlhttp.send(frmData);
}
function toogleHvcViewPf(icp){
	var frmData = new FormData();
		xmlhttp.onreadystatechange=function() {

            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            	document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
	frmData.append("icp",icp);
      	xmlhttp.open("POST",path+"mvc/Reports/manageHvcIcp",true);      
        xmlhttp.send(frmData);
}

function newMalCase(frmid){
	//alert(frmid);
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
function viewpdsreporters(elem){
	//alert(elem.innerHTML);
	var icp = elem.innerHTML;
		xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('pdsRptWelcome').innerHTML=xmlhttp.responseText;
				//location.reload();
          }
        };
		var frmData = new FormData();
		frmData.append("icp",icp);
      	xmlhttp.open("POST",path+"mvc/Reports/viewPdsReports/",true);      
        xmlhttp.send(frmData);
}
function selectpdsreport(tym){

	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		var frmData = new FormData();
		frmData.append("cdate",tym);
      	xmlhttp.open("POST",path+"mvc/Reports/pdsreportview/",true);      
        xmlhttp.send(frmData);
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
function savecdpr(frmid){
	//alert("Hello");
	var frm = document.getElementById(frmid);
	var frmData = new FormData(frm);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				//document.write(xmlhttp.responseText);
				//location.reload();
				alert(xmlhttp.responseText);
          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/savecdpr",true);      
        xmlhttp.send(frmData);
}
function getChildDetailsforCDPR(){
	var childNo = document.getElementById('childNo').value;
	var cognitiveagegroup = document.getElementById('cognitiveagegroup').value;
		if(childNo===""){
		alert("Child Number cannot be empty!");
		document.getElementById('childNo').style.border='2px red solid';
		exit;
	}
	if(cognitiveagegroup===""){
		alert("You must select a beneficiary cognitive age group!");
		document.getElementById('cognitiveagegroup').style.border='2px red solid';
		exit;
	}
	var frmData = new FormData();
	frmData.append("childNo",childNo);
	frmData.append("cognitiveagegroup",cognitiveagegroup);
	
		xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/getChildDetailsforCDPR",true);      
        xmlhttp.send(frmData);
}
function getChildDetailsforCDPRFromBoard(childNo,cognitiveagegroup){
	var childNo = document.getElementById('childNo').value;
	var cognitiveagegroup = document.getElementById('cognitiveagegroup').value;
	if(childNo===""){
		alert("Child Number cannot be empty!");
		document.getElementById('childNo').style.border='2px red solid';
		exit;
	}
	if(cognitiveagegroup===""){
		alert("You must select a beneficiary cognitive age group!");
		document.getElementById('cognitiveagegroup').style.border='2px red solid';
		exit;
	}
	var frmData = new FormData();
	frmData.append("childNo",childNo);
	frmData.append("cognitiveagegroup",cognitiveagegroup);
	//frmData.append("pNo",childNo.split("-")[0]);
	//alert(childNo);
		xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();
          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/getChildDetailsforCDPR",true);      
        xmlhttp.send(frmData);
}
function submitcdpr(frmid){
	var txt = document.getElementsByTagName("INPUT");
	var inputCnt=0;
	for(var w=0;w<txt.length;w++){
		txt.item(w).style.border='1px white solid';
		if(txt.item(w).value==='0'||txt.item(w).value===''||txt.item(w).value==='0000-00-00'){
			inputCnt++;
			txt.item(w).style.border='1px red solid';
		}
	}
	if(inputCnt>0){
		alert("You cannot submit an incompletely filled assessment form!");
		exit;
	}
	var frm = document.getElementById(frmid);
	var frmData = new FormData(frm);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				//document.write(xmlhttp.responseText);
				//location.reload();
				alert(xmlhttp.responseText);
          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/submitcdpr",true);      
        xmlhttp.send(frmData);
}
function checkcdprchildnumberformat(){
	var x = document.getElementById("KeNo").value;
    var y = document.getElementById("childNo").value;
    //alert(y);
    document.getElementById('childNo').style.backgroundColor='white';
    if(y.length===1){
    	document.getElementById('childNo').value = x+"-000"+y;
    }
    if(y.length===2){
       document.getElementById('childNo').value = x+"-00"+y;
    }
    if(y.length===3){
     document.getElementById('childNo').value = x+"-0"+y;
    }
    if(y.length===4){
     document.getElementById('childNo').value = x+"-"+y;
    }
    if(y.length>4){
    	alert("Please enter only the mumber part of the child number e.g. for KE980-0675, only enter 675");
		document.getElementById('childNo').value="";
        //exit;
    }
    
}
function  validatecdprscore(el){
	el.style.border='1px white solid';
	if(el.value>4){
		alert("The score cannot be greater 4");
		el.style.border='1px red solid';
		el.value="0";
	}
}
function getcdprlistbycst(cst){
	var frmData = new FormData();
	frmData.append("cst",cst);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				document.write(xmlhttp.responseText);
				location.reload();

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/pfcdprview",true);      
        xmlhttp.send(frmData);
}


function runquery(el){
	var cond = document.getElementById('conditions');

	while (cond.firstChild.nextSibling) {
    	cond.removeChild(cond.firstChild.nextSibling);
	}
	
	addcondition(cond);
	
}
function deletecondition(el){
	var pNode = el.parentNode.parentNode;
	pNode.removeChild(el.parentNode);
}
function getQueryResults(frmid){

var reqd = document.getElementsByClassName('flds');
var cnt=0;
for(var z=0;z<reqd.length;z++){
	if(reqd.item(z).value===''){
		++cnt;
		reqd.item(z).style.border='1px red solid';
	}
}	

if(cnt>0){
	alert(cnt+" required fields are empty!");
	exit;
}
	
var frm = document.getElementById('qryfld');
var frmData = new FormData(frm);
	
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				//document.getElementById('qryView').innerHTML=document.getElementById('query').innerHTML;
                document.getElementById('rsView').innerHTML=xmlhttp.responseText;
                //highlight('qryView');

          }
        };
		
      	xmlhttp.open("POST",path+"mvc/Reports/getQueryResults",true);      
        xmlhttp.send(frmData);
	
}
function addcondition(el){
	xmlhttp.onreadystatechange=function() {
       if (xmlhttp.readyState===4 && xmlhttp.status===200) {
          	
          	//alert(xmlhttp.responseText);
          	var oprt=["=",">","<","!=",">=","<=","LIKE %%","BETWEEN","IN","NOT IN"];
          	var obj = JSON.parse(xmlhttp.responseText);
          	
			var pr = document.getElementById('conditions');
			
			var br = document.createElement("BR");
			pr.appendChild(br);
			
			var div = document.createElement("DIV"); 
			
			var img_del = document.createElement("IMG"); 
			setAttributes(img_del,{"src":''+path+'/system/images/uncheck3.png',"onclick":"deletecondition(this)","class":"flds"});
			div.appendChild(img_del);
				
			var fld = document.createElement("SELECT");
			var fld_opt1 = document.createElement("OPTION");
			fld_opt1_text = document.createTextNode("Select Field");
			setAttributes(fld_opt1,{"value":""});
			fld_opt1.appendChild(fld_opt1_text);
			fld.appendChild(fld_opt1);
				for(var k in obj){
					var fld_opt2 = document.createElement("OPTION");
					fld_opt2_text = document.createTextNode(obj[k]);
					setAttributes(fld_opt2,{"value":k});
					fld_opt2.appendChild(fld_opt2_text);
					fld.appendChild(fld_opt2);				
				}
			
			setAttributes(fld,{"style":"width:160px;","class":"flds","name":"fld[]"});
			div.appendChild(fld);
			
			var op = document.createElement("SELECT");
			var op_opt1 = document.createElement("OPTION");
			op_opt1_text = document.createTextNode("Select Operator");
			setAttributes(op_opt1,{"value":""});
			op_opt1.appendChild(op_opt1_text);
			op.appendChild(op_opt1);
				for(l in oprt){
					var op_opt2 = document.createElement("OPTION");
					op_opt2_text = document.createTextNode(oprt[l]);
					setAttributes(op_opt2,{"value":oprt[l]});
					op_opt2.appendChild(op_opt2_text);
					op.appendChild(op_opt2);
				}
			setAttributes(op,{"style":"width:80px;","class":"flds","name":"op[]"});
			div.appendChild(op);
			
			var val = document.createElement("INPUT");
			setAttributes(val,{"style":"width:180px;","placeholder":"Field Value","type":"text","class":"flds","name":"val[]","value":""});
			div.appendChild(val);
			
			var img_plus = document.createElement("IMG"); 
			setAttributes(img_plus,{"src":''+path+'/system/images/plus.png',"onclick":"addcondition(this)","class":"flds"});
			div.appendChild(img_plus);
			
			pr.appendChild(div);
			
			}
        };
		var frm = document.getElementById('qryfld');
		var frmData = new FormData(frm);
		
      	xmlhttp.open("POST",path+"mvc/Reports/addcondition",true);      
        xmlhttp.send(frmData);			
}
