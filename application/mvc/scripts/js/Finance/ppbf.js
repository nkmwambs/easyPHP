function updatePlanFormFlds(){
    var planTypeFlds = document.getElementsByClassName("planType");
    var planType = document.getElementById("planTypeSel").value;
    var fy = document.getElementById("fySel").value;   
    var fyFlds = document.getElementsByClassName("fy");    
        for(var i=0;i<planTypeFlds.length;i++){
            planTypeFlds.item(i).value=planType;
            fyFlds.item(i).value=fy;
        }

}
function postNewPlan(frmid){
    var frm=document.getElementById(frmid);
    var frmData = new FormData(frm);

    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                            document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);                
            }
        };
        xmlhttp.open("POST",path+"/mvc/Finance/postNewPlan/public/0",true);
        xmlhttp.send(frmData);  
}

function searchPlan(){
    var plan = document.getElementById("planTypeSel").value;
    var FY = document.getElementById("fySel").value;
    //alert(planType);
	   xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
          var rst =xmlhttp.responseText;
          //alert(rst);
         
              var frm = document.getElementById("frmNewPlan");
              document.getElementById("tblNewPlan").style.display='block';
              document.getElementById("searchglass").style.display='block';
              document.getElementById("btnPostPlan").style.display='block';          
          if(rst==='0'){
              //alert(xmlhttp.responseText);
                frm.reset();
          }else{
              var tbl = document.getElementById("tblNewPlan");
              var obj = JSON.parse(xmlhttp.responseText);
              var tbl_ht = tbl.rows.length;
              var tbl_wt = tbl.rows[0].cells.length;
              var fld = ["JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt"];
              for(var m=2;m<tbl_wt;m++){
                    for(var n=2;n<tbl_ht;n++){
                        tbl.rows[n].cells[m].children(0).value=obj[n-2][fld[m-2]];
                        if(m===tbl_wt-1){
                            tbl.rows[n].cells[m].children(0).value=obj[n-2].AccTotals;
                        }
                    }
               }
               
          }

        }
       };
 
       xmlhttp.open("GET",path+"system/index.php?url=mvc/Finance/searchPlan/planType/"+plan+"/fy/"+FY+"/&rnd="+Math.random(),true);
       xmlhttp.send();
 
}
function calcPlanTotalPerAccount(el){
    //alert(el.value);
    var elid=el.id;
    var arr = elid.split("_");
    var totalFld = document.getElementById("AccTotals_"+arr[1]);
    var tbl = document.getElementById("tblNewPlan");
    var tbl_wt = tbl.rows[0].cells.length;
    var rw = el.parentNode.parentNode.rowIndex;
    //alert(rw);
    var sum=0;
    for(var k=2;k<tbl_wt-1;k++){
        if(!isNaN(parseInt(tbl.rows[rw].cells[k].children(0).value))){
            sum+=parseInt(tbl.rows[rw].cells[k].children(0).value);
        }
    }
    totalFld.value=sum;
}

function getPpbf(){
    
    var planType = document.getElementById("planTypeSel").value;
    var fy = document.getElementById("fySel").value;
   //alert(planType);
    xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState!==4) 
        {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';            
        }               
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
            document.getElementById('overlay').style.display='none';
            document.write(xmlhttp.responseText);
            //alert(xmlhttp.responseText);
            //document.getElementById("tblPlan").style.display='block';
        }
           };
       xmlhttp.open("GET",path+"system/index.php?url=mvc/Finance/getPpbf/planType/"+planType+"/fy/"+fy+"/&rnd="+Math.random(),true);
       xmlhttp.send();       
}
function ppbfCalc(lvl){
    //alert(lvl);
    if(document.getElementById("ppbfPfView")){
        var tbl = document.getElementById("ppbfPfView");
            for(var i=0;i<tbl.rows.length;i++){
                tbl.rows[i].cells[0].style.display='none';
                if(tbl.rows[i].cells[1].innerHTML==="1"){tbl.rows[i].cells[1].innerHTML="Annual";}
                if(tbl.rows[i].cells[1].innerHTML==="2"){tbl.rows[i].cells[1].innerHTML="Supplementary";}
                if(tbl.rows[i].cells[4].innerHTML==="0"&&lvl===2){tbl.rows[i].cells[4].innerHTML="<button  style='background-color:red;'  onclick='ppbfApproval("+tbl.rows[i].cells[0].innerHTML+",1,this);'>Approve</button>";}
                if(tbl.rows[i].cells[4].innerHTML==="1"&&lvl===2){tbl.rows[i].cells[4].innerHTML="<button onclick='ppbfApproval("+tbl.rows[i].cells[0].innerHTML+",0,this);'>UnApprove</button>";}
                if(tbl.rows[i].cells[4].innerHTML==="0"&&lvl===3){tbl.rows[i].cells[4].innerHTML="<button  style='background-color:red;'>Approve</button>";}
                if(tbl.rows[i].cells[4].innerHTML==="1"&&lvl===3){tbl.rows[i].cells[4].innerHTML="<button>UnApprove</button>";}
            }
            var btn = document.getElementsByTagName("button");
            for(var j=0;j<btn.length;j++){
                btn.item(j).style.width="50px";
                btn.item(j).style.fontSize="7pt";
            }
    }
}

function ppbfApproval(planID,approveStatus,el){
    var pid = planID;
    var state = approveStatus;
    //alert(el.innerHTML);
        xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState!==4) 
        {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';            
        }               
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
            document.getElementById('overlay').style.display='none';
            
            //alert(el.parentNode.parentNode.rowIndex);
            var rw = el.parentNode.parentNode.rowIndex;
            var tbl = document.getElementById("ppbfPfView");
            //tbl.rows[rw].cells[4].innerHTML="Cool";
            //document.write(xmlhttp.responseText);
            //alert(approveStatus);
            //var tbl = document.getElementById("ppbfPfView");
            if(xmlhttp.responseText==="0"){
                 alert("Plan Status Change Declined!");
            }else if(approveStatus===0){
                //alert("Plan unlocked Succefully!");
                tbl.rows[rw].cells[4].innerHTML="<button style='background-color:red;' onclick='ppbfApproval("+tbl.rows[rw].cells[0].innerHTML+",1,this);'>Approve</button>";
            }else if(approveStatus===1){
                //alert("Plan approved Successfully!");
                tbl.rows[rw].cells[4].innerHTML="<button  onclick='ppbfApproval("+tbl.rows[rw].cells[0].innerHTML+",0,this);'>Unapprove</button>";
            }
                var btn = document.getElementsByTagName("button");
                for(var j=0;j<btn.length;j++){
                    btn.item(j).style.width="50px";
                    btn.item(j).style.fontSize="7pt";
                }
        }
    };
       xmlhttp.open("GET",path+"system/index.php?url=mvc/Finance/approvePlan/planID/"+pid+"/approveState/"+state+"/&rnd="+Math.random(),true);
       xmlhttp.send();
}

function viewPpbfOther(el){
    //alert(el);
    var rw = el.parentNode.parentNode.rowIndex;
    //alert(rw);
    var tbl = document.getElementById("ppbfPfView");
    var planid = tbl.rows[rw].cells[0].innerHTML;
    //alert(planid);
        xmlhttp.onreadystatechange=function() 
	   {
        if (xmlhttp.readyState!==4) 
        {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';            
        }               
        if (xmlhttp.readyState===4 && xmlhttp.status===200) 
        {
            document.getElementById('overlay').style.display='none';
            document.write(xmlhttp.responseText);
            //alert(xmlhttp.responseText);
            //document.getElementById("tblPlan").style.display='block';
        }
           };
       xmlhttp.open("GET",path+"system/index.php?url=mvc/Finance/getPpbf/planid/"+planid+"/&rnd="+Math.random(),true);
       xmlhttp.send(); 
}
function approveSchedule(rid,elem){
	//alert(elem);
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    //alert(xmlhttp.responseText);
                    if(xmlhttp.responseText==='1'){
                    	alert("Approval Successfully!");
                    }
                    elem.parentNode.parentNode.style.backgroundColor='green';
                    elem.parentNode.innerHTML='<img id="" src= "'+path+'/system/images/unreject.png"/><img id="" onclick="reverseApproval('+rid+',this);" src= "'+path+'/system/images/reset.png"/>';
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/approveSchedule/rid/"+rid,true);      
      xmlhttp.send();
}
function reverseApproval(rid,elem){
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    //alert(xmlhttp.responseText);
                    if(xmlhttp.responseText==='1'){
                    	alert("Item Disapproved!");
                    }
                    elem.parentNode.parentNode.style.backgroundColor='red';
                    elem.parentNode.innerHTML='<img id="" onclick="approveSchedule('+rid+',this);" src= "'+path+'/system/images/approved.png"/><img id="" onclick="approveSchedule('+rid+',this);" src= "'+path+'/system/images/disapprove.png"/>';
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/reverseApproval/rid/"+rid,true);      
      xmlhttp.send();
	
}
