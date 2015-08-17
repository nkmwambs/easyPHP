var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
       
       
function showContents(el,tym){
	//alert(tym);
    var icp = el.innerHTML; 
    var rds = document.getElementsByClassName("rds");
    for(var i=0;i<rds.length;i++){
        if(rds.item(i).checked===true){
            var rpt =rds.item(i).value;
        }
    }
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('content').innerHTML=xmlhttp.responseText;
                //document.write(xmlhttp.responseText);
                //location.reload();
          }
        };
        //alert(icp);
    if(rpt==="1"){
      xmlhttp.open("GET",path+"mvc/Finance/ecj/tym/"+tym+"/icp/"+icp,true);  
    }else if(rpt==="2"){
        xmlhttp.open("GET",path+"mvc/Finance/ppbfOther/icp/"+icp,true);
    }
    
    xmlhttp.send();
}
    


function submitFunds(frmid){
    //alert(frmid);
   var frm = document.getElementById(frmid);  
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
                                               
         xmlhttp.open("POST",path+"/mvc/Finance/uploadFundsList/public/0",true);
         xmlhttp.send(frmData);
}

function viewFunds(){
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.write(xmlhttp.responseText);
                location.reload();
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewFunds/",true);      
        xmlhttp.send();
}
function fundsCategories(){
               xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.write(xmlhttp.responseText);
                //location.reload();
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/fundsCategories/",true);      
        xmlhttp.send();
}
function addFundBalRow(tblid){
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                
                //alert(xmlhttp.responseText);    
                var obj=JSON.parse(xmlhttp.responseText);
                
                var tbl=document.getElementById(tblid);
                var rws = tbl.rows.length;
                var newRw = tbl.insertRow(rws);

                var cell0=newRw.insertCell(0);
                var chk = document.createElement("input");
                chk.type='checkbox';
                chk.className='chks';
                chk.onclick=function(){
                  showDel();  
                };
                cell0.appendChild(chk);

                var cell1=newRw.insertCell(1);
                var sel = document.createElement("select");
                var opt1 = document.createElement('option');
                opt1.innerHTML='Select Account ... ';
                sel.appendChild(opt1);
                for(var j=0;j<obj.length;j++){
                    var opt = document.createElement('option');
                    opt.innerHTML=obj[j].AccText+"-"+obj[j].AccName;
                    opt.value=obj[j].AccNo;
                    sel.appendChild(opt);
                }
                sel.name='funds[]';
                cell1.appendChild(sel);

                var cell2=newRw.insertCell(2);
                var inp = document.createElement("input");
                inp.type='text';
                inp.name='amount[]';
                inp.className='inputs';
                inp.value=0;
                inp.onclick=function(){
                  this.value='';  
                };
                inp.onkeyup=function(){
                  var inputs = document.getElementsByClassName("inputs");
                  var sum=0;
                  for(var l=0;l<inputs.length;l++){
                      sum+=parseFloat(inputs.item(l).value);
                  }
                  document.getElementById("totalFunds").value=sum;
                };
                cell2.appendChild(inp);
                
    }
 };

    xmlhttp.open("GET",path+"mvc/Finance/getExpAccounts/",true);      
    xmlhttp.send();
}
function showDel(){
    var chks = document.getElementsByClassName("chks");
    var cnt=0;
    for(var i=0;i<chks.length;i++){
        if(chks.item(i).checked===true){
            cnt++;
        }
    }
    //alert(cnt);
    if(cnt>0){
        document.getElementById("btnFundRowDel").style.display='block';
    }else{
        document.getElementById("btnFundRowDel").style.display='none';
    }
    
}

function addFundBal(frmid){
    //alert(document.getElementById("closeDate").value);
       var frm = document.getElementById(frmid);  
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
                frm.reset();
                var tbl = document.getElementById("tblFundsBalBf");
                var rws = tbl.rows.length;
                for(var k=2;k<rws;k++){
                   tbl.deleteRow(k);
                }
            }
        };
    if(document.getElementById("closeDate").value===""){
            alert("Period Close date cannot be empty!");
            document.getElementById("closeDate").style.border='2px red solid';
        }else{
                                               
         xmlhttp.open("POST",path+"/mvc/Finance/addFundBal/public/0",true);
         xmlhttp.send(frmData);
     }
}
function changeBalState(icp,state,el){
   alert(icp);
   /**
    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                alert(xmlhttp.responseText);
                //location.reload();
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/balStateChange/newState/"+state+"/icp/"+icp,true);      
        xmlhttp.send();
       **/
}

function addChqOSRow(){
    var tbl = document.getElementById("tblOSBf");
    var rws = tbl.rows.length;
    
    var newRec = tbl.insertRow(rws);
    
    var cell0=newRec.insertCell(0);
    var chk = document.createElement("input");
    chk.type='checkbox';
    chk.className='chks';
    chk.onclick=function(){
            showDel();  
        };
    cell0.appendChild(chk);
    
    var cell1=newRec.insertCell(1);
    var chq = document.createElement("input");
    setAttributes(chq,{"type":"text","className":"inputs","name":"chqNo[]"});
    cell1.appendChild(chq);
    
    var cell2=newRec.insertCell(2);
    var dt=document.createElement("input");
    setAttributes(dt,{"type":"text","className":"inputs","name":"chqDate[]","readonly":"readonly","id":"chqDate"+rws});
    cell2.appendChild(dt);
    
     $("#chqDate"+rws).datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
    
    var cell3=newRec.insertCell(3);
    var amt = document.createElement("input");
    setAttributes(amt,{"type":"text","className":"inputs","name":"amount[]"});
    cell3.appendChild(amt);
}
function addOS(frmid){
    var frm = document.getElementById(frmid);  
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
                frm.reset();
                var tbl = document.getElementById("tblOSBf");
                var rws = tbl.rows.length;
                for(var k=1;k<rws;k++){
                    tbl.deleteRow(k);
                }
            }
        };                                
         xmlhttp.open("POST",path+"/mvc/Finance/addOustChqBf/public/0",true);
         xmlhttp.send(frmData);
       
}
function adjust_financial_year(step){
    var fy=document.getElementById("curFy").value;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                //document.getElementById('overlay').style.display='block';
                //document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //document.getElementById('overlay').style.display='none';
                document.getElementById("curFy").value=xmlhttp.responseText;
                document.getElementById("fy").value=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/adjust_financial_year/curFy/"+fy+"/step/"+step,true);      
        xmlhttp.send();
}
function showScheduleForCurrentMonth(month,el){
    //alert(month);
    fy = document.getElementById("curFy").value;
        var fy=document.getElementById("curFy").value;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                var divMonths = document.getElementsByClassName("divMonths");
                for(var j=0;j<divMonths.length;j++){
                    divMonths.item(j).style.backgroundColor='wheat';
                    divMonths.item(j).style.color='black';
                }
                el.style.backgroundColor='green';
                el.style.color='white';
                document.getElementById("schedule").innerHTML=xmlhttp.responseText;
                
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/showSchedule/month/"+month+"/fy/"+fy,true);      
        xmlhttp.send();
}
function addScheduleRow(){
    var tbl = document.getElementById("tblSchedule");
    var rws = parseInt(tbl.rows.length)-1;
    var months_arr=["Jul","Aug","Sep","Oct","Nov","Dec","Jan","Feb","Mar","Apr","May","Jun"]; 
    document.getElementById("btnPostSchedule").style.display='block';
    var newRw = tbl.insertRow(rws);
    
    var cell0 = newRw.insertCell(0);
    var chk = document.createElement("input");
    setAttributes(chk,{"type":"checkbox","class":"chk"});
    chk.onclick=function(){
                            var chks = document.getElementsByClassName("chk");
                            var cnt = 0;
                            for(var i=0;i<chks.length;i++){
                                if(chks.item(i).checked===true){
                                    cnt++;
                                }
                            }
                            if(cnt>0){
                                document.getElementById("btnDelRow").style.display="block";
                            }else{
                                document.getElementById("btnDelRow").style.display="none";
                            }
                        };
    cell0.appendChild(chk);
    
    //Check Box
    var cell1 =newRw.insertCell(1);
    var desc = document.createElement("input");
    setAttributes(desc,{"type":"text","name":"details[]","class":"plansDetails","id":"desc"+rws});
    desc.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
        document.getElementById("lbl"+rws).innerHTML=this.value;
    };
    cell1.appendChild(desc);
    
    //Quantity Column
    var cell2 = newRw.insertCell(2);
    var qty = document.createElement("input");
    setAttributes(qty,{"type":"text","name":"qty[]","value":"0","style":"width:60px;text-align:right;","id":"qty"+rws});
    qty.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
      document.getElementById("totalCost"+rws).value=(parseFloat(this.value)*parseFloat(document.getElementById("unitCost"+rws).value)*parseFloat(document.getElementById("often"+rws).value)).toFixed(2); 
      var totalCost = document.getElementsByClassName("totalCost");
      //alert(totalCost.length);
      var sumCost = 0;
        for(var x=0;x<totalCost.length;x++){
          sumCost+=parseFloat(totalCost.item(x).value);
      }
      
      document.getElementById("acTotal").value=sumCost.toFixed(2);
        for(var i=0;months_arr.length;i++){
          document.getElementById(months_arr[i]+rws).value=((parseFloat(document.getElementById("totalCost"+rws).value))/12).toFixed(2);
         document.getElementById(months_arr[i]+"Amt").value=((parseFloat(document.getElementById("acTotal").value))/12).toFixed(2);
      }
    };
    qty.onclick=function(){
      this.value='';  
    };
    cell2.appendChild(qty);
    
    //Unit Cost Column
    var cell3 = newRw.insertCell(3);
    var unitCost = document.createElement("input");
    setAttributes(unitCost,{"type":"text","name":"unitCost[]","style":"width:60px;text-align:right;","value":"0","id":"unitCost"+rws});
    unitCost.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
      document.getElementById("totalCost"+rws).value=(parseFloat(this.value)*parseFloat(document.getElementById("qty"+rws).value)*parseFloat(document.getElementById("often"+rws).value)).toFixed(2);
      var totalCost = document.getElementsByClassName("totalCost");
      
      var sumCost = 0;
        for(var x=0;x<totalCost.length;x++){
          sumCost+=parseFloat(totalCost.item(x).value);
      }
      
      document.getElementById("acTotal").value=sumCost.toFixed(2);
      
        for(var i=0;months_arr.length;i++){
          document.getElementById(months_arr[i]+rws).value=((parseFloat(document.getElementById("totalCost"+rws).value))/12).toFixed(2);
          document.getElementById(months_arr[i]+"Amt").value=((parseFloat(document.getElementById("acTotal").value))/12).toFixed(2);
        }

    };    
    unitCost.onclick=function(){
      this.value='';  
    };    
    cell3.appendChild(unitCost);   
    
    //Frequency Column
    var cell4 = newRw.insertCell(4);
    var often = document.createElement("input");
    setAttributes(often,{"type":"text","name":"often[]","style":"width:60px;text-align:right;","value":"0","id":"often"+rws});
    often.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";        
        document.getElementById("approved"+rws).value=0;
      document.getElementById("totalCost"+rws).value=(parseFloat(this.value)*parseFloat(document.getElementById("qty"+rws).value)*parseFloat(document.getElementById("unitCost"+rws).value)).toFixed(2);
      var totalCost = document.getElementsByClassName("totalCost");
      
      var sumCost = 0;
        for(var x=0;x<totalCost.length;x++){
          sumCost+=parseFloat(totalCost.item(x).value);
      }
      
      document.getElementById("acTotal").value=sumCost.toFixed(2);
      
        for(var i=0;months_arr.length;i++){
          document.getElementById(months_arr[i]+rws).value=((parseFloat(document.getElementById("totalCost"+rws).value))/12).toFixed(2);
          document.getElementById(months_arr[i]+"Amt").value=((parseFloat(document.getElementById("acTotal").value))/12).toFixed(2);
        }

    };    
    often.onclick=function(){
      this.value='';  
    };    
    cell4.appendChild(often);
    
    
    
    //Total Cost Column
    var cell5 = newRw.insertCell(5);
    var totalCost = document.createElement("input");
    setAttributes(totalCost,{"type":"text","name":"totalCost[]","class":"itemTotals","class":"totalCost","value":"0","style":"width:80px;text-align:right;","readonly":"readonly","id":"totalCost"+rws});
    cell5.appendChild(totalCost); 
    
    //Validation
    var cell6=newRw.insertCell(6);
    var validate = document.createElement("input");
    setAttributes(validate,{"type":"text","name":"validate[]","class":"validate","value":"0","style":"width:80px;text-align:right;","readonly":"readonly","id":"validate"+rws});
    cell6.appendChild(validate);
    
    //Clear buttons columns
    var cell7 =newRw.insertCell(7);
    var clr=document.createElement("div");
    clr.innerHTML='Clear';
    setAttributes(clr,{"style":"background-color:green;border-radius:5px;padding:2px;"});
    clr.onclick=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";        
        document.getElementById("approved"+rws).value=0;
        for(var q=0;q<months_arr.length;q++){
          document.getElementById(months_arr[q]+rws).value=0;
                    var mth = document.getElementsByClassName(months_arr[q]);
                    var sumMonth=0;
                      for(var s=0;s<mth.length;s++){
                        sumMonth+=parseFloat(mth.item(s).value);
                    }
                    document.getElementById(months_arr[q]+"Amt").value=sumMonth.toFixed(2);
      } 
      document.getElementById("totalCost"+rws).style.border='2px red solid';
      document.getElementById("validate"+rws).value=document.getElementById("totalCost"+rws).value;
    };
    cell7.appendChild(clr);
    
    //Monthly Costing Columns
    for(var k=0;k<months_arr.length;k++){
        var indx = k+8;
        var cell = newRw.insertCell(indx);
        var month = document.createElement("input");
        setAttributes(month,{"type":"text","name":months_arr[k]+"Amt[]","class":""+months_arr[k]+" row"+rws,"value":"0","style":"width:80px","id":months_arr[k]+rws});
        month.onkeyup=function(){
            document.getElementById("notes"+rws).innerHTML="Not Approved";            
            document.getElementById("approved"+rws).value=0;
            var sum_months=0;
            for(var p=0;p<months_arr.length;p++){
                sum_months+=parseFloat(document.getElementById(months_arr[p]+rws).value);
                            var mth = document.getElementsByClassName(months_arr[p]);
                            //alert(mth.item(1).value);
                            var sumMonth=0;
                              for(var s=0;s<mth.length;s++){
                                sumMonth+=parseFloat(mth.item(s).value);
                            }
                            document.getElementById(months_arr[p]+"Amt").value=sumMonth.toFixed(2);
            }
            if(sum_months!==parseFloat(document.getElementById("totalCost"+rws).value)){
                document.getElementById("totalCost"+rws).style.border='2px red solid';
            }else{
                document.getElementById("totalCost"+rws).style.border='0px white solid';
            }
            
            var rows = document.getElementsByClassName("row"+rws);
            //alert(rows.length);
            var sumRow=0;
            for(var z=0;z<rows.length;z++){
                sumRow+=parseFloat(rows.item(z).value);
            }
            document.getElementById("validate"+rws).value=parseFloat(document.getElementById("totalCost"+rws).value)-sumRow;
        };
        cell.appendChild(month);   
    }
    
    //Create notes Buttons Column
    
    var cell20=newRw.insertCell(20);
    var notes=document.createElement("div");
    notes.innerHTML='Not Approved';
    setAttributes(notes,{"style":"background-color:green;padding:3px;border-radius:3px;","id":"notes"+rws});
    var approved=document.createElement("input");
    approved.value=0;
    setAttributes(approved,{"type":"hidden","name":"approved[]","class":"approved","value":"0","style":"width:80px","id":"approved"+rws});
    cell20.appendChild(notes); 
    cell20.appendChild(approved); 
   
    document.getElementById('notesDiv').innerHTML+='<br><label id="lbl'+rws+'"></label><br><textarea id="notes'+rws+'" name="notes[]" rows="10" cols="150"></textarea>';
}

function postSchedule(frmid){
	var detailRows = document.getElementsByClassName('plansDetails');
	for(var i=0;i<detailRows.length;i++){
		if(detailRows.item(i).value===""){
			alert("One or More Details fields are empty!");
			detailRows.item(i).style.backgroundColor='red';
			exit;
		}else{
			detailRows.item(i).style.backgroundColor='white';
		}
	}
	var TotalRows = document.getElementsByClassName('itemTotals');
	for(var k=0;k<TotalRows.length;k++){
		if(TotalRows.item(j).value===0){
			alert("One or More Total Cost fields are empty!");
			TotalRows.item(k).style.backgroundColor='red';
			exit;
		}else{
			TotalRows.item(k).style.backgroundColor='white';
		}
	}
	
    if(document.getElementById("acTotal").value==="0.00"||document.getElementById("acTotal").value===""){
        alert("The Schedule is empty!");
    }else{
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
                //frm.reset();
            }
        }; 
       if(document.getElementById('AccNo').value===""){
       	alert('Choose an Account to Proceed!');
       	document.getElementById('AccNo').style.backgroundColor='red';
       }else{                             
         xmlhttp.open("POST",path+"/mvc/Finance/postSchedule/public/0",true);
        
         xmlhttp.send(frmData);
         }  
    }
    
}
function scheduleRow(obj,indx){
    var tbl = document.getElementById("tblSchedule");
    var rws = parseInt(tbl.rows.length)-1;
    var months_arr=["Jul","Aug","Sep","Oct","Nov","Dec","Jan","Feb","Mar","Apr","May","Jun"]; 
    //var months_arr_flds=["JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt"]; 
    document.getElementById("btnPostSchedule").style.display='block';
    var newRw = tbl.insertRow(rws);
    
    
    //Check box column
    var cell0 = newRw.insertCell(0);
    var chk = document.createElement("input");
    chk.disabled=true;
    setAttributes(chk,{"type":"checkbox","class":"chk"});
    cell0.appendChild(chk);

    
    //Details Column
    var cell1 =newRw.insertCell(1);
    var desc = document.createElement("input");
    desc.value=obj[indx].details;
    if(obj[indx].approved==='2'){
        setAttributes(desc,{"type":"text","name":"details[]","id":"desc"+rws,"readonly":"readonly"});
    }else{
        setAttributes(desc,{"type":"text","name":"details[]","id":"desc"+rws});
    }
    cell1.appendChild(desc);
    
    //Quantity Column
    var cell2 = newRw.insertCell(2);
    var qty = document.createElement("input");
    if(obj[indx].approved==='2'){
        setAttributes(qty,{"type":"text","name":"qty[]","value":"0","style":"width:60px;text-align:right;","id":"qty"+rws,"readonly":"readonly"});
    }else{
        setAttributes(qty,{"type":"text","name":"qty[]","value":"0","style":"width:60px;text-align:right;","id":"qty"+rws});
    }
        qty.value=obj[indx].qty;
    qty.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
      document.getElementById("totalCost"+rws).value=(parseFloat(this.value)*parseFloat(document.getElementById("unitCost"+rws).value)*parseFloat(document.getElementById("often"+rws).value)).toFixed(2); 
      var totalCost = document.getElementsByClassName("totalCost");
      //alert(totalCost.length);
      var sumCost = 0;
        for(var x=0;x<totalCost.length;x++){
          sumCost+=parseFloat(totalCost.item(x).value);
      }
      
      document.getElementById("acTotal").value=sumCost.toFixed(2);
        for(var i=0;months_arr.length;i++){
          document.getElementById(months_arr[i]+rws).value=((parseFloat(document.getElementById("totalCost"+rws).value))/12).toFixed(2);
         document.getElementById(months_arr[i]+"Amt").value=((parseFloat(document.getElementById("acTotal").value))/12).toFixed(2);
      }
    };
    qty.onclick=function(){
        if(obj[indx].approved==='0'){
            this.value='';  
        }   
    };
    cell2.appendChild(qty);
    
    //Unit Cost Column
    var cell3 = newRw.insertCell(3);
    var unitCost = document.createElement("input");
    if(obj[indx].approved==='2'){
        setAttributes(unitCost,{"type":"text","name":"unitCost[]","style":"width:60px;text-align:right;","value":"0","id":"unitCost"+rws,"readonly":"readonly"});
    }else{
        setAttributes(unitCost,{"type":"text","name":"unitCost[]","style":"width:60px;text-align:right;","value":"0","id":"unitCost"+rws});
    }
    unitCost.value=obj[indx].unitCost;
    unitCost.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
      document.getElementById("totalCost"+rws).value=(parseFloat(this.value)*parseFloat(document.getElementById("qty"+rws).value)*parseFloat(document.getElementById("often"+rws).value)).toFixed(2);
      var totalCost = document.getElementsByClassName("totalCost");
      
      var sumCost = 0;
        for(var x=0;x<totalCost.length;x++){
          sumCost+=parseFloat(totalCost.item(x).value);
      }
      
      document.getElementById("acTotal").value=sumCost.toFixed(2);
      
        for(var i=0;months_arr.length;i++){
          document.getElementById(months_arr[i]+rws).value=((parseFloat(document.getElementById("totalCost"+rws).value))/12).toFixed(2);
          document.getElementById(months_arr[i]+"Amt").value=((parseFloat(document.getElementById("acTotal").value))/12).toFixed(2);
        }

    };    
    unitCost.onclick=function(){
        if(obj[indx].approved==='0'){
            this.value='';  
        }    
    };
    cell3.appendChild(unitCost);   
    
    //Frequency Column
    var cell4 = newRw.insertCell(4);
    var often = document.createElement("input");
    often.value=obj[indx].often;
    if(obj[indx].approved==='2'){    
        setAttributes(often,{"type":"text","name":"often[]","style":"width:60px;text-align:right;","value":"0","id":"often"+rws,"readonly":"readonly"});
    }else{
        setAttributes(often,{"type":"text","name":"often[]","style":"width:60px;text-align:right;","value":"0","id":"often"+rws});
    }
    often.onkeyup=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
      document.getElementById("totalCost"+rws).value=(parseFloat(this.value)*parseFloat(document.getElementById("qty"+rws).value)*parseFloat(document.getElementById("unitCost"+rws).value)).toFixed(2);
      var totalCost = document.getElementsByClassName("totalCost");
      
      var sumCost = 0;
        for(var x=0;x<totalCost.length;x++){
          sumCost+=parseFloat(totalCost.item(x).value);
      }
      
      document.getElementById("acTotal").value=sumCost.toFixed(2);
      
        for(var i=0;months_arr.length;i++){
          document.getElementById(months_arr[i]+rws).value=((parseFloat(document.getElementById("totalCost"+rws).value))/12).toFixed(2);
          document.getElementById(months_arr[i]+"Amt").value=((parseFloat(document.getElementById("acTotal").value))/12).toFixed(2);
        }

    };    
    often.onclick=function(){
        if(obj[indx].approved==='0'){
            this.value='';  
        }  
    };
    cell4.appendChild(often);
      
    
    //Total Cost Column
    var cell5 = newRw.insertCell(5);
    var totalCost = document.createElement("input");
    totalCost.value=obj[indx].totalCost;
    setAttributes(totalCost,{"type":"text","name":"totalCost[]","class":"totalCost","value":"0","style":"width:80px;text-align:right;","readonly":"readonly","id":"totalCost"+rws});
    cell5.appendChild(totalCost); 
    
    //Validation
    var cell6=newRw.insertCell(6);
    var validate = document.createElement("input");
    validate.value=obj[indx].validate;
    setAttributes(validate,{"type":"text","name":"validate[]","class":"validate","value":"0","style":"width:80px;text-align:right;","readonly":"readonly","id":"validate"+rws});
    cell6.appendChild(validate);
    
    var cell7 =newRw.insertCell(7);
    if(obj[indx].approved==='2'){
        
    }else{
    var clr=document.createElement("div");
    clr.innerHTML='Clear';
    setAttributes(clr,{"style":"background-color:green;border-radius:5px;padding:2px;"});
    clr.onclick=function(){
        document.getElementById("notes"+rws).innerHTML="Not Approved";
        document.getElementById("approved"+rws).value=0;
        for(var q=0;q<months_arr.length;q++){
          document.getElementById(months_arr[q]+rws).value=0;
                    var mth = document.getElementsByClassName(months_arr[q]);
                    var sumMonth=0;
                      for(var s=0;s<mth.length;s++){
                        sumMonth+=parseFloat(mth.item(s).value);
                    }
                    document.getElementById(months_arr[q]+"Amt").value=sumMonth.toFixed(2);
      } 
      document.getElementById("totalCost"+rws).style.border='2px red solid';
      document.getElementById("validate"+rws).value=document.getElementById("totalCost"+rws).value;
    };
    cell7.appendChild(clr);
    }
    
    //Monthly Costing Columns
    for(var k=0;k<months_arr.length;k++){
        var ind = k+8;
        var cell = newRw.insertCell(ind);
        var month = document.createElement("input");
        if(k===0){month.value=obj[indx].JulAmt;}
        if(k===1){month.value=obj[indx].AugAmt;}
        if(k===2){month.value=obj[indx].SepAmt;}
        if(k===3){month.value=obj[indx].OctAmt;}
        if(k===4){month.value=obj[indx].NovAmt;}
        if(k===5){month.value=obj[indx].DecAmt;}
        if(k===6){month.value=obj[indx].JanAmt;}
        if(k===7){month.value=obj[indx].FebAmt;}
        if(k===8){month.value=obj[indx].MarAmt;}
        if(k===9){month.value=obj[indx].AprAmt;}
        if(k===10){month.value=obj[indx].MayAmt;}
        if(k===11){month.value=obj[indx].JunAmt;}
        if(obj[indx].approved==='2'){
            setAttributes(month,{"type":"text","name":months_arr[k]+"Amt[]","class":""+months_arr[k]+" row"+rws,"value":"0","style":"width:80px","id":months_arr[k]+rws,"readonly":"readonly"});
        }else{
            setAttributes(month,{"type":"text","name":months_arr[k]+"Amt[]","class":""+months_arr[k]+" row"+rws,"value":"0","style":"width:80px","id":months_arr[k]+rws});
        }
        month.onkeyup=function(){
            document.getElementById("notes"+rws).innerHTML="Not Approved";            
            document.getElementById("approved"+rws).value=0;
            var sum_months=0;
            for(var p=0;p<months_arr.length;p++){
                sum_months+=parseFloat(document.getElementById(months_arr[p]+rws).value);
                            var mth = document.getElementsByClassName(months_arr[p]);
                            //alert(mth.item(1).value);
                            var sumMonth=0;
                              for(var s=0;s<mth.length;s++){
                                sumMonth+=parseFloat(mth.item(s).value);
                            }
                            document.getElementById(months_arr[p]+"Amt").value=sumMonth.toFixed(2);
            }
            if(sum_months!==parseFloat(document.getElementById("totalCost"+rws).value)){
                document.getElementById("totalCost"+rws).style.border='2px red solid';
            }else{
                document.getElementById("totalCost"+rws).style.border='0px white solid';
            }
            
            var rows = document.getElementsByClassName("row"+rws);
            //alert(rows.length);
            var sumRow=0;
            for(var z=0;z<rows.length;z++){
                sumRow+=parseFloat(rows.item(z).value);
            }
            document.getElementById("validate"+rws).value=parseFloat(document.getElementById("totalCost"+rws).value)-sumRow;
        };
        month.onclick=function(){
         if(obj[indx].approved==='0'){
            this.value='';  
        }  
        };
        cell.appendChild(month);   
    }
    
    //Approval Status Column
    
    var cell20=newRw.insertCell(20);
    var notes=document.createElement("div");
    var approved=document.createElement("input");
    approved.value=obj[indx].approved;
    setAttributes(approved,{"type":"hidden","name":"approved[]","class":"approved","value":"0","style":"width:80px","id":"approved"+rws});
    if(obj[indx].approved==='0'){
        notes.innerHTML='Not Approved';
        setAttributes(notes,{"style":"background-color:blue;padding:3px;border-radius:3px;color:white;","id":"notes"+rws});
    }else if(obj[indx].approved==='1'){
        notes.innerHTML='Submitted';
        setAttributes(notes,{"style":"background-color:brown;padding:3px;border-radius:3px;color:white;","id":"notes"+rws});
    }else if(obj[indx].approved==='2'){
        notes.innerHTML='Approved';
        setAttributes(notes,{"style":"background-color:green;padding:3px;border-radius:3px;color:white;","id":"notes"+rws});
    }else if(obj[indx].approved==='3'){
    	notes.innerHTML='Rejected';
    	setAttributes(notes,{"style":"background-color:red;padding:3px;border-radius:3px;color:white;","id":"notes"+rws});
    }
    //setAttributes(notes,{"style":"background-color:green;padding:3px;border-radius:3px;color:white;","id":"notes"+rws});
    cell20.appendChild(notes); 
    cell20.appendChild(approved); 
    if(obj[indx].approved==='2'){
        var readonly="readonly";
    }else{
        var readonly="";
    }
    document.getElementById('notesDiv').innerHTML+='<br><label>'+document.getElementById("desc"+rws).value+'</label><br><textarea id="notes'+rws+'" name="notes[]" rows="10" cols="150" '+readonly+'>'+obj[indx].notes+'</textarea>';
}
function checkSchedule(){
    //location.reload();
    //var tbl= document.getElementById("tblSchedule");
    var tbl_len= document.getElementById("tblSchedule").rows.length;
    //document.getElementById("notesDiv").innerHTML='View Notes Here';
    
    if(tbl_len>3){
       alert("Reset before changing the schudule!");
    }else{
    
    var acc_elem = document.getElementById("AccNo");
    var fy_elem = document.getElementById("fy");
    if(document.getElementById("AccNo").value===""){
        alert("No account selected!");
       acc_elem.style.border='2px red solid';
       fy_elem.style.border='2px red solid';
    }else{
        acc_elem.style.border='2px white solid';
        fy_elem.style.border='2px white solid';
        fy_elem.value=document.getElementById("curFy").value;
        document.getElementById("btnAddRow").style.display='block';
       // alert("Hello");
       
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                var obj=JSON.parse(xmlhttp.responseText);
                //alert(obj.length);
                var totals=0;
                for(var i=0;i<obj.length;i++){
                    scheduleRow(obj,i);
                    totals+=parseFloat(obj[i].totalCost);
                }
                document.getElementById("acTotal").value=totals.toFixed(2);
          }
        };
      var fy = fy_elem.value;
      var acc = acc_elem.value;
      xmlhttp.open("GET",path+"mvc/Finance/checkSchedule/fy/"+fy+"/acc/"+acc,true);      
      xmlhttp.send();
    }
}
    
}
function viewAllSchedules(){
	document.getElementById('btnPostSchedule').style.display='none';
		document.getElementById('btnAddRow').style.display='none';
      var fy=document.getElementById("curFy").value;
      
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                    document.getElementById("scheduleview").innerHTML=xmlhttp.responseText;
                    document.getElementById("btnNewSchedule").style.display="block";
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewAllSchedules/fy/"+fy+"/public/0",true);      
      xmlhttp.send();

}
function deleteSchedule(scheduleID){
    //alert(scheduleID);
          var fy=document.getElementById("curFy").value;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                  document.getElementById("scheduleview").innerHTML=xmlhttp.responseText;
                //    document.getElementById("btnNewSchedule").style.display="block";
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewAllSchedules/fy/"+fy+"/scheduleID/"+scheduleID,true);      
      xmlhttp.send();
    
}
function editSchedule(scheduleID){
    var ID=scheduleID;
    alert("Function not operational!");
}
function viewPlanSummary(){
		document.getElementById('btnPostSchedule').style.display='none';
		document.getElementById('btnAddRow').style.display='none';
        var fy=document.getElementById("curFy").value;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                  document.getElementById("scheduleview").innerHTML=xmlhttp.responseText;
                //    document.getElementById("btnNewSchedule").style.display="block";
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewPlanSummary/fy/"+fy,true);      
      xmlhttp.send();   
}
function viewPlanSummaryByPf(icp){
	//alert(icp);
           var fy=document.getElementById("curFy").value;
           //alert(fy);
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                  document.getElementById("resultsDiv").innerHTML=xmlhttp.responseText;
                //    document.getElementById("btnNewSchedule").style.display="block";
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewPlanSummaryByPf/fy/"+fy+"/icpNo/"+icp,true);      
      xmlhttp.send();   
}
function sendRequest(elem){
    var scheduleID_arr=elem.id.split("_");
    var scheduleID = scheduleID_arr[1];
    var rqType=scheduleID_arr[0];
    if(!document.getElementById("txtArea")){
        //var fy=document.getElementById("curFy").value;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                var msgDiv = document.getElementById("rqMsgDiv");
                //alert(xmlhttp.responseText);
                var obj = JSON.parse(xmlhttp.responseText);
                if(obj.length>0){
                        var lbl = document.createElement('div');
                        lbl.innerHTML=obj[0].details+" Conversation";
                        setAttributes(lbl,{"style":"margin-bottom:15px;font-weight:bold;"});
                        msgDiv.appendChild(lbl);

                        for(var j=0;j<obj.length;j++){
                            var inner_msg_div = document.createElement("div");
                            setAttributes(inner_msg_div,{"style":"margin-bottom:15px;"});
                            inner_msg_div.innerHTML=obj[j].lname+" ("+obj[j].fname+"): "+obj[j].rqMessage;
                            msgDiv.appendChild(inner_msg_div);
                        }
                }
                var txtArea = document.createElement("textarea");
                setAttributes(txtArea,{"id":"txtArea","name":"rqMessage","rows":"5","cols":"93","style":"overflow:auto"});
                msgDiv.appendChild(txtArea);
                setAttributes(msgDiv,{"style":"z-index:10;display:block;min-height:100px;min-width:100px;padding:15px 15px 40px 15px;background-color:wheat;"});
                var rqBtn = document.createElement('div');
                setAttributes(rqBtn,{"id":"rqBtn","onclick":"postRequest();","style":"background-color:green;border-radius:5px;padding:2px;width:60px;color:white;cursor:pointer;"});
                rqBtn.innerHTML="Post";
                msgDiv.appendChild(rqBtn);

                var scheduleID_input = document.createElement("input");
                scheduleID_input.value=scheduleID;
                setAttributes(scheduleID_input,{"type":"hidden","id":"scheduleID_input","name":"scheduleID"});
                document.getElementById("frmRq").appendChild(scheduleID_input);
                
                
         }
        };

      xmlhttp.open("GET",path+"mvc/Finance/getRequests/scheduleID/"+scheduleID+"/rqType/"+rqType,true);      
      xmlhttp.send();    
    }else{
        var cnfrm = confirm("You can only send one request per time!, Are you sure you want to continue erasing the current request?");
        if(cnfrm){
            document.getElementById("rqMsgDiv").innerHTML="";
            document.getElementById("rqMsgDiv").style.display='none';
        }else{
            alert("Your new request has been aborted!");
        }
            
    }
}

function postRequest(){
     var frm = document.getElementById("frmRq");  
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
                document.getElementById("rqMsgDiv").innerHTML="";
                document.getElementById("rqMsgDiv").style.display='none';
                document.getElementById("scheduleID_input").style.display='none';
                //if(xmlhttp.responseText===1){
                    location.reload();
                //}
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Finance/planRequest/public/0",true);
         xmlhttp.send(frmData);
}
function postRequestByPf(){
     var frm = document.getElementById("frmRq");  
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
                document.getElementById("rqMsgDiv").innerHTML="";
                document.getElementById("rqMsgDiv").style.display='none';
                document.getElementById("scheduleID_input").style.display='none';
                
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Finance/planPfFeedback/public/0",true);
         xmlhttp.send(frmData);
}
function submitNewPlanItem(elem){
    var scheduleID_arr=elem.id.split("_");
    var scheduleID = scheduleID_arr[1];
    //alert(scheduleID);
        var fy=document.getElementById("curFy").value;
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                if(xmlhttp.responseText==="0"){
                   alert("Submission Failed");
                }else{
                    document.getElementById("scheduleview").innerHTML=xmlhttp.responseText;
                }
                //alert(xmlhttp.responseText);
                  //document.getElementById("scheduleview").innerHTML=xmlhttp.responseText;
                //    document.getElementById("btnNewSchedule").style.display="block";
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/submitNewPlanItem/scheduleID/"+scheduleID+"/fy/"+fy,true);      
      xmlhttp.send();
}
function massSubmitPlanItems(){
           var fy=document.getElementById("curFy").value;
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("scheduleview").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/massSubmitPlanItems/fy/"+fy,true);      
      xmlhttp.send();
}
function showNewPlansItems(){
    //alert("Hello");
     var fy=document.getElementById("curFy").value;
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("resultsDiv").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/showNewPlansItems/fy/"+fy,true);      
      xmlhttp.send();
}
function viewPlans(){
     var fy=document.getElementById("curFy").value;
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                //document.getElementById('overlay').style.display='block';
                //document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //document.getElementById('overlay').style.display='none';
                    document.getElementById("resultsDiv").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/pfPlansView/fy/"+fy,true);      
      xmlhttp.send();
}
function viewBal(){
	//alert("Hello");
	     //var fy=document.getElementById("curFy").value;
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("balView").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewBal",true);      
      xmlhttp.send();
}

function hideViewBal(){
	document.getElementById('balView').innerHTML='';
}

function addCash(frmid){
	 var frm = document.getElementById(frmid);  
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
        if(frmid==="frmCashBf"){
        	xmlhttp.open("POST",path+"/mvc/Finance/addCash/public/0",true);
        }else{
        	xmlhttp.open("POST",path+"/mvc/Finance/addStmtCash/public/0",true);
        }                                       
         
         
         xmlhttp.send(frmData);
}
function viewCashBal(){
//document.getElementById('viewCashBal').innerHTML="Hello";	
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("viewCashBal").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewCashBal",true);      
      xmlhttp.send();
}
function viewCashStmtBal(){
//document.getElementById('viewCashBal').innerHTML="Hello";	
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("viewCashStmtBal").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewCashStmtBal",true);      
      xmlhttp.send();
}
function ocView(){
	//document.getElementById('balView').innerHTML="Hello!";
	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("balView").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/ocView",true);      
      xmlhttp.send();
}
function selectCJ(tym){
		var icpNo=document.getElementById('icpNo').value;
	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('content').innerHTML=xmlhttp.responseText;
                sumEcj();
                //document.write(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/ecj/tym/"+tym+"/icpNo/"+icpNo,true);      
      xmlhttp.send();
}
function selectSlip(tym){
	//alert(tym);
		    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('content').innerHTML=xmlhttp.responseText;
                //sumEcj();
                //document.write(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewSlip/tym/"+tym+"/public/0",true);      
      xmlhttp.send();
}

function selectDisburse(tym){
		    xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('content').innerHTML=xmlhttp.responseText;
                //sumEcj();
                //document.write(xmlhttp.responseText);
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/viewFunds/tym/"+tym+"/public/0",true);      
      xmlhttp.send();
}

function delRowPlan(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var totalCost = document.getElementsByClassName('totalCost');
	var delTotals=0;		
		for(var i=0; i<rowCount; i++) {
					var row = table.rows[i];
					var chkbox = row.cells[0].childNodes[0];
					if(null !== chkbox && true === chkbox.checked) {
						
						table.deleteRow(i);
						rowCount--;
						i--;
					}

				}
				
		for(var j=0;j<totalCost.length;j++){
				delTotals+=parseFloat(totalCost.item(j).value);
		}
		
		document.getElementById('acTotal').value=delTotals;	
		document.getElementById('btnDelRow').style.display='none';
}