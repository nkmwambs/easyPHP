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

function addStudentRecord(frmid){
    //alert(frmid);
    document.getElementById("draft").value='0';
    
    var talents = document.getElementById("getTalent");
    var medical = document.getElementById("getMed");
    
    
for(var i=0;i<talents.length;i++){
      talents.item(i).selected='true';
  }
      //alert(talents.length); 
for(var j=0;j<medical.length;j++){
      medical.item(j).selected='true';
    }
   
    
    var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loadingmin.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    var tblBioData=document.getElementById("tbl_BioData");
                    var otherTbls=document.getElementsByClassName("sub_tbl");
                    var input = document.getElementsByTagName("input");
                    var progress = document.getElementsByClassName("progress");
                    
                    tblBioData.style.display='block';
                    for(var k=0;k<otherTbls.length;k++){
                        otherTbls.item(k).style.display='none';
                    }
                    
                    for(var m=0;m<input.length;m++){
                        input.item(m).value="";
                    }
                    
                    for(var n=0;n<progress.length;n++){
                        progress.item(n).style.backgroundColor="skyblue";
                    }
                    
                    document.getElementById("lbl_BioData").style.backgroundColor="blue";
                    
                    
                    alert(xmlhttp.responseText);
                

            }
        };
        
         xmlhttp.open("POST",path+"/schoolmanager/Students/addStudentRecord/public/1",true);
         xmlhttp.send(frmData);  
}

function saveRecordNewStudent(frmid){
    var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loadingmin.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                
            }
        };
         xmlhttp.open("POST",path+"/schoolmanager/Students/addStudentRecord/public/1",true);
         xmlhttp.send(frmData);  
}

function gotoFrame(curid,nextid){
    var cnt=0;
    var inputs = document.querySelectorAll("#"+curid+" input[type=text]");
    var goto = document.getElementById(nextid);
    var cur = document.getElementById(curid);
    var curLbl=curid.split("_");
    var nxtLbl=nextid.split("_");
    for(var i=0;i<inputs.length;i++){
        if(inputs.item(i).value===""&&inputs.item(i).className==="mandatory"){
            cnt++;
            inputs.item(i).style.backgroundColor='red';
        }
    }
    
    if(cnt>0){
        alert(cnt+" mandatory field(s) is/are empty!");
    }else{
    cur.style.display="none";
    goto.style.display="block";
    document.getElementById("lbl_"+curLbl[1]).style.backgroundColor='green';
    document.getElementById("lbl_"+nxtLbl[1]).style.backgroundColor='blue';
    }
    
}

function clearHighlight(elem){
    document.getElementById(elem.id).style.backgroundColor==='white';
}
function editstudentfromprofile(el){
		    xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loadingmin.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('divResults').innerHTML = xmlhttp.responseText; 
                completeDraftStudent(el);
            }
        };
	xmlhttp.open("GET",path+"/schoolmanager/Students/editstudentfromprofile",true);
    xmlhttp.send();
	
}
function completeDraftStudent(el){
//alert(el.title);
var val="";
var rw;
if(el.tagName==='SELECT'){
    val=el.value;
}else if(isNaN(parseInt(el.title)/2)){
	//alert("Hello");
	rw = el.title.split("-");
	val = parseInt(rw[1]);
	//alert(val);
}else{
    val=el.title;
    document.getElementById("divResults").style.display='none';
    document.getElementById("lblManage").style.display='block';
    document.getElementById("tbl_BioData").style.display='block';
}

    if(val!==""){
                //alert(url);
	   xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
          //alert(xmlhttp.responseText);
          var obj = JSON.parse(xmlhttp.responseText);
          document.getElementById("admNo").value=obj[0].admNo;
          document.getElementById("fname").value=obj[0].fname;
          document.getElementById("lname").value=obj[0].lname;
          var sex_arr = ["Female","Male"];
          document.getElementById("sex").children(0).innerHTML=sex_arr[obj[0].sex-1];
          document.getElementById("sex").children(0).value=obj[0].sex;
          document.getElementById("dob").value=obj[0].dob;
          document.getElementById("nationality").value=obj[0].nationality;
          document.getElementById("active").value=obj[0].active;
          
          document.getElementById("county").value=obj[0].county;
          document.getElementById("ward").value=obj[0].ward;
          document.getElementById("area").value=obj[0].area;
          document.getElementById("street").value=obj[0].street;
          
          document.getElementById("parentOneFullname").value=obj[0].parentOneFullname;
          var parent_arr =["Father","Mother","Brother","Sister","Aunt","Uncle","Grand-Father","Grand-Mother","Other"];
          document.getElementById("parentOneRel").children(0).innerHTML=parent_arr[obj[0].parentOneRel-1];
          document.getElementById("parentOneRel").children(0).value=obj[0].parentOneRel;          
          document.getElementById("parentOneRelOther").value=obj[0].parentOneRelOther;
          document.getElementById("parentOnePhone").value=obj[0].parentOnePhone;
          document.getElementById("parentOneEmail").value=obj[0].parentOneEmail;
          document.getElementById("parentOneJob").value=obj[0].parentOneJob;
          document.getElementById("parentOneHome").value=obj[0].parentOneHome;

          document.getElementById("parentTwoFullname").value=obj[0].parentTwoFullname;
          //var parent_arr =["Father","Mother","Brother","Sister","Aunt","Uncle","Grand-Father","Grand-Mother","Other"];
          document.getElementById("parentTwoRel").children(0).innerHTML=parent_arr[obj[0].parentTwoRel-1];
          document.getElementById("parentTwoRel").children(0).value=obj[0].parentTwoRel;
          document.getElementById("parentTwoRelOther").value=obj[0].parentTwoRelOther;
          document.getElementById("parentTwoPhone").value=obj[0].parentTwoPhone;
          document.getElementById("parentTwoEmail").value=obj[0].parentTwoEmail;
          document.getElementById("parentTwoJob").value=obj[0].parentTwoJob;
          document.getElementById("parentTwoHome").value=obj[0].parentTwoHome; 
          
          var class_arr = ["Play Group","Nursery","Pre-School","STD One","STD Two","STD Three","STD Four","STD Five","STD Six","STD Seven","STD Eight"];
          document.getElementById("entryClass").children(0).innerHTML=class_arr[obj[0].entryClass-1];
          document.getElementById("entryClass").children(0).value=obj[0].entryClass;
          var firstSchool_arr = ["Yes","No"];
          document.getElementById("firstSchool").children(0).innerHTML=firstSchool_arr[obj[0].firstSchool-1];
          document.getElementById("firstSchool").children(0).value=obj[0].firstSchool; 
          document.getElementById("formerSchool").value=obj[0].formerSchool; 
          document.getElementById("lastScore").value=obj[0].lastScore;
          if(obj[0].interviewed==='1'){
              document.getElementById("interviewed").checked=true;
          }else{
              document.getElementById("interviewed").checked=false;
          }
          document.getElementById("interviewScore").value=obj[0].interviewScore;        
          
          
          var talents = document.getElementById("getTalent").children.length;
          for(var r=0;r<talents;r++){
              document.getElementById("getTalent").removeChild(document.getElementById("getTalent").childNodes[r]);
          }
          
          var talent_arr = obj[0].talents.split(",");
          for(var p=0;p<talent_arr.length;p++){
            var opt=document.createElement("option");
            opt.innerHTML=talent_arr[p];
            opt.value=talent_arr[p];
            document.getElementById("getTalent").appendChild(opt);
           }
          document.getElementById("talentsOther").value=obj[0].talentsOther;
          
          
          var medical_arr = obj[0].medical.split(",");
          for(var q=0;q<medical_arr.length;q++){
            var op=document.createElement("option");
            op.innerHTML=medical_arr[q];
            op.value=medical_arr[q];
            document.getElementById("getMed").appendChild(op);
           }
          document.getElementById("medicalOther").value=obj[0].medicalOther;
          
        }
       };
 
       xmlhttp.open("GET",path+"/schoolmanager/Students/completeDraftStudent/studentKey/"+val,true);
       xmlhttp.send();
    }
    
}

function searchResults(){   
    var fieldsets = document.getElementsByClassName("fieldsets");
    var cnt=0;
    var legendid_arr=[];
    for(var r=0;r<fieldsets.length;r++){
        if(fieldsets.item(r).children.length>1){
            cnt++;
            legendid_arr[r]=fieldsets.item(r).children(0).id;
        }
    }
    if(cnt>0){
        var query="SELECT ";
        for(var k=0;k<legendid_arr.length;k++){
            var parent = document.getElementById(legendid_arr[k]).parentNode;
            if(legendid_arr[k]==="select"){
                if(parent.children.length===2){
                    var cond = parent.children(1).children(0).value;
                    var val = parent.children(1).children(1).value;
                    if(cond==="All"||val==="*"){
                        query+="* FROM %MyTable%";                    
                    }else if(cond==="count distinct"){
                        query +="COUNT(DISTINCT "+val+") FROM %MyTable%";
                    }else{
                        query += cond+"("+val+") FROM %MyTable%";
                    }
                }else if(parent.children.length>2){
                    var cond = parent.children(1).children(0).value;
                    var val = parent.children(1).children(1).value;
                    var str="";
                    for(var f=2;f<parent.children.length;f++){
                        var select_one=parent.children(f).children(0).value;
                        var select_two=parent.children(f).children(1).value;
                        if(select_one!=="count distinct"){
                            str+=","+select_one+"("+select_two+")";
                        }else{
                            str+=",COUNT(DISTINCT "+select_two+")";
                        }
                    }
                        query += cond+"("+val+")"+str+" FROM %MyTable%";
                }
            }
            //var where="";
            if(legendid_arr[k]==="search"){
                if(parent.children.length===2){
                    var cn = parent.children(1).children(0).value;
                    var opr = parent.children(1).children(1).value;
                    var vl = parent.children(1).children(2).value;
                    if(parent.children(1).children(0).value!=="(Anywhere)"){
                        if(opr==="LIKE %%"){
                            query+=" WHERE "+cn+" LIKE '%"+vl+"%'";
                        }else{
                            query+=" WHERE "+cn+" "+opr+" '"+vl+"'";
                        }
                    }
                }else if(parent.children.length>2){
                    var cn = parent.children(1).children(0).value;
                    var opr = parent.children(1).children(1).value;
                    var vl = parent.children(1).children(2).value;
                    var other_str="";
                    for(var g=2;g<parent.children.length;g++){
                        var other_cn = parent.children(g).children(0).value;
                        var other_opr = parent.children(g).children(1).value;
                        var other_vl = parent.children(g).children(2).value;
                        if(other_opr==="LIKE %%"){
                            other_str+=" AND "+other_cn+" LIKE '%"+other_vl+"%'";
                        }else{
                            other_str+=" AND "+other_cn+" "+other_opr+" '"+other_vl+"'";
                        }
                    }
                    if(opr==="LIKE %%"){
                        query+=" WHERE "+cn+" LIKE '%"+vl+"%'"+other_str;
                    }else{
                        query+=" WHERE "+cn+opr+"'"+vl+"'"+other_str;
                    }
                }
            }
            //var sort="";
            if(legendid_arr[k]==="sort"){
                if(parent.children(1)){
                    var st = parent.children(1).children(0).value;
                    if(parent.children(1).children(1).checked){
                        var order="DESC";
                    }
                    query+=" ORDER BY "+st+" "+order;
                }
            }
            
            
            document.getElementById("results_sql").innerHTML=query;
        }
            if(document.getElementById("limit").parentNode.children(1).value!==""){
                    document.getElementById("results_sql").innerHTML+=" LIMIT "+document.getElementById("limit").parentNode.children(1).value;
            }
            
    }else if(document.getElementById("limit").parentNode.children(1).value!==""){
            document.getElementById("results_sql").innerHTML="SELECT * FROM %MyTable% LIMIT "+document.getElementById("limit").parentNode.children(1).value;
    }else{
            document.getElementById("results_sql").innerHTML="SELECT * FROM %MyTable%";
    }
    var frm=document.getElementById("qryFrm");
    var frmData = new FormData(frm);
    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.write(xmlhttp.responseText);
                
            }
        };
        xmlhttp.open("POST",path+"/schoolmanager/Students/searchResults/public/0",true);
        xmlhttp.send(frmData);  
}

function showContent(el){
    var fldid=el.id;
    var fieldset=document.getElementById(fldid).parentNode;
    var cnt = fieldset.children.length;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                var fld_obj = JSON.parse(xmlhttp.responseText);
                if(cnt===1){
                    var fieldset=document.getElementById(fldid).parentNode;
                    var div=document.createElement("div");
                    if(fldid==="search"){
                        fieldset.style.width='350px';
                        var search = document.createElement("select");
                        var firstOpt = document.createElement("option");
                        firstOpt.innerHTML="(Anywhere)";
                        search.appendChild(firstOpt);
                            for(var l=1;l<fld_obj.length;l++){
                                var option = document.createElement("option");
                                option.innerHTML=fld_obj[l];
                                search.appendChild(option);
                            }
                        search.style.maxWidth="160px";
                        div.appendChild(search);
                    
                        var operator = document.createElement("select");
                        var operator_arr=["","=","!=","<",">",">=","<=","LIKE","LIKE %%","NOT LIKE","BETWEEN","IN","NOT IN","IS NULL","IS NOT NULL"];
                            for(var r=0;r<operator_arr.length;r++){
                                var optn=document.createElement("option");
                                optn.innerHTML=operator_arr[r];
                                operator.appendChild(optn);
                            }
                        operator.style.maxWidth="80px";
                        div.appendChild(operator);
                        
                        var input=document.createElement("input");
                        input.type="text";
                        input.style.maxWidth="80px";
                        div.appendChild(input);

                    }else if(fldid==="sort"){
                       fieldset.style.width='280px';
                       var sort = document.createElement("select");
                        var firstOpt = document.createElement("option");
                        firstOpt.innerHTML="(Anywhere)";
                        sort.appendChild(firstOpt);
                       sort.style.maxWidth="160px";
                            for(var l=0;l<fld_obj.length;l++){
                                var option = document.createElement("option");
                                option.innerHTML=fld_obj[l];
                                sort.appendChild(option);
                            }
                       div.appendChild(sort);
                       
                       var checkOrder = document.createElement("input");
                       checkOrder.type='checkbox';
                       div.appendChild(checkOrder);
                       div.innerHTML+="Descending";
                    }else if(fldid==="select"){
                        fieldset.style.width='260px';
                        var select=document.createElement("select");
                        select.style.maxWidth="80px";
                        var select_arr=["All","Avg","count","max","min","sum","distinct","count distinct"];
                        for(var v=0;v<select_arr.length;v++){
                            var opt = document.createElement("option");
                            opt.innerHTML=select_arr[v];
                            select.appendChild(opt);
                        }
                        div.appendChild(select);
                        
                        var fld = document.createElement("select");
                        var firstOpt = document.createElement("option");
                        firstOpt.innerHTML="*";
                        fld.appendChild(firstOpt);
                        fld.style.maxWidth="160px";
                            for(var l=0;l<fld_obj.length;l++){
                                var option = document.createElement("option");
                                option.innerHTML=fld_obj[l];
                                fld.appendChild(option);
                            }
                        div.innerHTML+="(";
                        div.appendChild(fld); 
                        div.innerHTML+=")";
                        
                    }
                    fieldset.appendChild(div);
                }    
}   
};       

    if(cnt>1){
            var itm = fieldset.lastChild;
            var cln = itm.cloneNode(true);
            fieldset.appendChild(cln);
}
    xmlhttp.open("GET",path+"/schoolmanager/Students/getFlds/public/0",true);
    xmlhttp.send();  
}
function displayScroll(elem){
    elem.style.overflow='auto';
}
function hideScroll(elem){
    elem.style.overflow='hidden';
}
function updateManageRec(elem){
    document.getElementById("manageRec").value=elem.title;
}
function viewprintprofile(sid,el){
	//alert(el);
	    xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loadingmin.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('divResults').innerHTML = xmlhttp.responseText; 
                completeDraftStudent(el);
            }
        };
	xmlhttp.open("GET",path+"/schoolmanager/Students/viewprintprofile/studentKey/"+sid,true);
    xmlhttp.send();
    
}
