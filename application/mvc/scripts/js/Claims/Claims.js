var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
function submitRec(frmid){
    //alert(frmid);
    var x = document.getElementsByClassName('rData');
    //alert(x);
    var cnt=0;
    for(i=0;i<x.length;i++){
       if(x.item(i).value===""){
          cnt++; 
              if(x.item(i).tagName === 'SELECT') {
                    x.item(i).options['0'].style.backgroundColor = 'red';
                    
              }
              if(x.item(i).tagName === 'INPUT' && x.item(i).type === 'text') {x.item(i).style.backgroundColor='red';}
              if(x.item(i).tagName === 'TEXTAREA') {x.item(i).style.backgroundColor='red';}
          //x.item(i).style.backgroundColor='red';
       }

    }
    //alert(cnt);
    if(cnt!==0){
        alert(cnt+" required fields are missing!");
        return false;
    }
    else if(cnt===0){
           document.getElementById(frmid).submit(); 
           
           //submitCsp();
    }
}

function delRow(tableID) {
                       //alert("Hello!");
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null !== chkbox && true === chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

function addClaim(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var csp=document.getElementById('cspNo').value;
            var cnt_csp = 0;
            if(csp!==""){
            	cnt_csp=1;
            }
           // alert(rowCount);
                        var cell0 = row.insertCell(0);
                        var element0 = document.createElement("input");
                        element0.type = "checkbox";
                        //element0.name="chkbox[]";
                        element0.className = 'slct';
                        element0.onclick = function(){
                                                    var inputElems = document.getElementsByTagName("input");
                                                    var count = 0;
                                                        for (var i=0; i<inputElems.length; i++) {
                                                            if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
                                                                count++;

                                                            }
                                                        }
                                                                    if(count>0){
                                                                        document.getElementById('rmRow').style.display='block';
                                                                        }
                                                                        if(count===0){
                                                                                document.getElementById('rmRow').style.display='none';
                                                                        }
                            
                                                        };
                        cell0.appendChild(element0);
            
            if(cnt_csp===1){
            	var cell = row.insertCell(0+parseInt(cnt_csp));
                var element = document.createElement("input");
                element.type = "checkbox";
                element.onclick=function(){
                	if(this.checked===true){
                		if(document.getElementById("childNo"+rowCount).value===""){
                			document.getElementById("childName"+rowCount).readOnly=false;
                		}else{
                			delCnf=confirm("Are you sure you want to change the program type? If Yes, this row will be deleted");
                			if(delCnf){
                				table.deleteRow(rowCount);
                			}else{
                				this.checked=false;
                			}
                		}	
                	
                	}else{
                		document.getElementById("childName"+rowCount).readOnly=true;
                	}
                };
                element.id="csp"+rowCount;
                cell.appendChild(element);
            }
			var cell1 = row.insertCell(1+parseInt(cnt_csp));
			var element1 = document.createElement("input");
			element1.type = "text";
			element1.name = "date[]";
                        element1.value = document.getElementById('curDate').value;
                        element1.style.width = '100px';
                        element1.readOnly = 'true';
                        element1.id="date"+rowCount;
			cell1.appendChild(element1);
                        
			var cell2 = row.insertCell(2+parseInt(cnt_csp));
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "proNo[]";
                        element2.style.width = '70px';
                        element2.id = "proNo"+rowCount;
                        element2.readOnly = 'true';
                        element2.value = document.getElementById('KENo').value;
			cell2.appendChild(element2); 
                        
			var cell3 = row.insertCell(3+parseInt(cnt_csp));
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.name = "cluster[]";
                        element3.id = "cluster"+rowCount;
                        element3.style.width = '110px';
                        element3.readOnly = 'true';
                        element3.value = document.getElementById('cst').value;
			cell3.appendChild(element3);  
                        
			var cell4 = row.insertCell(4+parseInt(cnt_csp));
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.name = "childNo[]";
                        element4.className="rData";
                        element4.id = "childNo"+rowCount;
                        element4.onchange=function(){ //"csp"+rowCount;
                        								//alert(csp);
                                                        //if(document.getElementById('csp'+rowCount).checked===false){
                                                        	//var x = document.getElementById('proNo'+rowCount).value;
                                                        	//alert('Not checked');
                                                        //}else if(document.getElementById('csp'+rowCount).checked===true){
                                                        	//var x = csp;
                                                        	//alert('Checked');
                                                        //}else{
                                                        	//var x = document.getElementById('proNo'+rowCount).value;
                                                        //}
                                                        
                                                        if(csp===""){
                                                        	var x = document.getElementById('proNo'+rowCount).value;
                                                        }else{
                                                        	
                                                        	if(document.getElementById('csp'+rowCount).checked===false){
                                                        		var x = document.getElementById('proNo'+rowCount).value;
                                                        	}else{
                                                        		var x = csp;
                                                        	}
                                                        	
                                                        }
                                                        
                                                        var y = this.value;
                                                        this.style.backgroundColor='white';
                                                        if(y.length===1){
                                                        document.getElementById('childNo'+rowCount).value = x+"-000"+y;
                                                        }
                                                        if(y.length===2){
                                                            document.getElementById('childNo'+rowCount).value = x+"-00"+y;
                                                        }
                                                        if(y.length===3){
                                                            document.getElementById('childNo'+rowCount).value = x+"-0"+y;
                                                        }
                                                        if(y.length===4){
                                                            document.getElementById('childNo'+rowCount).value = x+"-"+y;
                                                        }
                                                        if(y.length>4){
                                                        	alert("Please enter only the mumber part of the child number e.g. for KE980-0675, only enter 675");
                                                        	document.getElementById('childNo'+rowCount).value="";
                                                        	exit;
                                                        }
////////////////////////////////////////////////////////////////////
                                        var str = document.getElementById("childNo"+rowCount).value;
                                        frmData = new FormData();
                                        frmData.append("cNo",str);
                                        xmlhttp.onreadystatechange=function() { 
                                        if(xmlhttp.readyState!==4){
							                	document.getElementById('overlay').style.display='block';
							                	document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
							           		 }
							           	if(xmlhttp.readyState===4 && xmlhttp.status!==200){
	                                        xmlhttp.open("POST",path+"mvc/Claims/getCname/public/0",true);
	                                        xmlhttp.send(frmData);
							           	}
							            if (xmlhttp.readyState===4 && xmlhttp.status===200) { 
							                	document.getElementById('overlay').style.display='none';
                                            	var res = xmlhttp.responseText.split(',');
                                            	document.getElementById("childName"+rowCount).value = res['0'];
                                          }
                                        };
                                       
                                       if(csp===""){
                                       		xmlhttp.open("POST",path+"mvc/Claims/getCname/public/0",true);
                                       		xmlhttp.send(frmData);
                                       }else{
                                       		if(document.getElementById("csp"+rowCount).checked===false){
												xmlhttp.open("POST",path+"mvc/Claims/getCname/public/0",true);
												xmlhttp.send(frmData);
											}
                                       }
										
                                        
                                        
                            
                };
                        element4.onfocus = function(){  
                                                        //alert('Hello!');
                                                        document.getElementById('childNo'+rowCount).value = "";
                                                        };
                        
            element4.style.width = '100px';
			cell4.appendChild(element4);                          
                        
            var cell5 = row.insertCell(5+parseInt(cnt_csp));
			var element5 = document.createElement("input");
			element5.type = "text";
			element5.name = "childName[]";
            element5.id = "childName"+rowCount;                                                          
            element5.readOnly = "true";
			cell5.appendChild(element5);  

            var cell6 = row.insertCell(6+parseInt(cnt_csp));
			var element6 = document.createElement("input");
			element6.type = "text";
			element6.name = "treatDate[]";
                        element6.id = "treatDate"+rowCount;
                        element6.style.width = '100px';
                        element6.onchange=function(){
                                                          //alert('Hi!');
                                                          this.style.backgroundColor='white';
                                                          var date1 = new Date();
                                                          var date2 = new Date(this.value);
                                                          var one_day = 1000*60*60*24;
                                                          var date1_ms = date1.getTime();
                                                          var date2_ms = date2.getTime();
                                                          var difference_ms = Math.abs(date1_ms-date2_ms);
                                                          if(date2_ms>date1_ms){
                                                             this.style.backgroundColor='red';
                                                             alert('The date entered is greater than today date!');
                                                             this.value="";
                                                          }else if(Math.round(difference_ms/one_day)>60){
                                                              this.style.backgroundColor='red';
                                                              alert('The date entered in two months lesser, claim is invalid!');
                                                              this.value="";
                                                          }else{
                                                              this.style.backgroundColor='white';
                                                          }
                                                    };
                        element6.readOnly = 'true';
                        element6.className="rData";
			cell6.appendChild(element6);
                        
            var cell7 = row.insertCell(7+parseInt(cnt_csp));
			var element7 = document.createElement("input");
			element7.type = "text";
			element7.name = "type[]";
                        element7.id = "type"+rowCount;
                        element7.value='Normal';
                        element7.readOnly = 'true';
                        element7.style.width = '100px';
			cell7.appendChild(element7);       
                        
            
            var cell8 = row.insertCell(8+parseInt(cnt_csp));
			var element8 = document.createElement("input");
			element8.type = "text";
			element8.name = "diagnosis[]";
                        element8.id = "diagnosis"+rowCount;
                        element8.onchange = function(){
                                                this.style.backgroundColor='white';
                                             };
                        element8.className="rData";
			cell8.appendChild(element8);
                        
           	
           	var cell9 = row.insertCell(9+parseInt(cnt_csp));
			var element9 = document.createElement("input");
			element9.type = "text";
			element9.name = "vnum[]";
                        element9.id = "vnum"+rowCount;
                        element9.style.width = '100px';
                        element9.onchange = function(){
                                                this.style.backgroundColor='white';
                                             };
                        element9.className="rData";
			cell9.appendChild(element9);
                        
            
            var cell10 = row.insertCell(10+parseInt(cnt_csp));
			var element10 = document.createElement("input");
			element10.type = "text";
			element10.name = "nhif[]";
                        //element10.placeholder = 'Enter NHIF number or 0!';
                        element10.id = "nhif"+rowCount;
                        element10.value=0;
                        element10.className="rData";
                        element10.onkeyup = function(){
                                                            //alert('Here you are!');
                                                            var x = this.value;
                                                            var w = document.getElementById('amtReim'+rowCount).value;
                                                            var y = document.getElementById('totAmt'+rowCount).value;
                                                            var z = document.getElementById('contr'+rowCount).value;
                                                            if(x>0){
                                                                document.getElementById('careContr'+rowCount).value=0;
                                                                document.getElementById('amtReim'+rowCount).value=y;
                                                            }else if(x==='0'){
                                                                 document.getElementById('careContr'+rowCount).value = 0.1*y;
                                                                 document.getElementById('amtReim'+rowCount).value = 0.9*y;
                                                             }
                                                            
                                                        };
                        element10.onblur = function(){
                                                        var x = this.value;
                                                            var w = document.getElementById('amtReim'+rowCount).value;
                                                            var y = document.getElementById('totAmt'+rowCount).value;
                                                            var z = document.getElementById('careContr'+rowCount).value;
                                                            if(x>0){
                                                                document.getElementById('careContr'+rowCount).value=0;
                                                                document.getElementById('amtReim'+rowCount).value=y;
                                                            }else if(x==='0'){
                                                                 document.getElementById('careContr'+rowCount).value = 0.1*y;
                                                                 document.getElementById('amtReim'+rowCount).value = 0.9*y;
                                                             }
                                                     };
                        element10.style.width = '110px';
                        element10.onchange=function(){
                                                       var x=this.value;
                                                       this.style.backgroundColor='white';
                                                       if(x===""){
                                                           document.getElementById('nhif'+rowCount).value='0';
                                                       }
                                                    };
			cell10.appendChild(element10);  
                        
    
            var cell11 = row.insertCell(11+parseInt(cnt_csp));
			var element11 = document.createElement("input");
			element11.type = "text";
			element11.name = "totAmt[]";
                        element11.id = "totAmt "+rowCount;
                        element11.style.width = '100px';
                        element11.onchange = function(){
                                                this.style.backgroundColor='white';
                                             };
                        element11.className="rData";
                        element11.onkeyup = function(){
                                                            //alert('Here you are!');
                                                            var x = this.value;
                                                            var w = document.getElementById('amtReim'+rowCount).value;
                                                            var y = document.getElementById('nhif'+rowCount).value;
                                                            var z = document.getElementById('careContr'+rowCount).value;
                                                            if(x>0 && y>0){
                                                                document.getElementById('careContr'+rowCount).value=0;
                                                                document.getElementById('amtReim'+rowCount).value=x;
                                                            }else if(x>0 && y==='0'){
                                                                 document.getElementById('careContr'+rowCount).value = 0.1*x;
                                                                 document.getElementById('amtReim'+rowCount).value = 0.9*x;
                                                             }else if(x==='0'){
                                                                 document.getElementById('careContr'+rowCount).value = 0;
                                                                 document.getElementById('amtReim'+rowCount).value = 0;
                                                             }
                                                            
                                                        };  
                        element11.onblur = function(){
                                                           var x=this.value;
                                                           if(x<1000){
                                                               this.style.backgroundColor='red';
                                                               alert('Amount entered is less tha Kes. 1,000.');
                                                               this.value="";
                                                               document.getElementById('careContr'+rowCount).value ="";
                                                               document.getElementById('amtReim'+rowCount).value = "";
                                                               
                                                           }else{
                                                               this.style.backgroundColor='white';
                                                           }
                                                           if(document.getElementById('amtReim'+rowCount).value<1000){
                                                               document.getElementById('amtReim'+rowCount).style.backgroundColor='red';
                                                               document.getElementById('totAmt'+rowCount).style.backgroundColor='red';
                                                               document.getElementById('careContr'+rowCount).style.backgroundColor='red';
                                                               alert('Amount to be reimbursed cannot be less than Kes.1000!');
                                                               document.getElementById('amtReim'+rowCount).value="";
                                                               document.getElementById('totAmt'+rowCount).value="";
                                                               document.getElementById('careContr'+rowCount).value="";
                                                           }else{
                                                              document.getElementById('amtReim'+rowCount).style.backgroundColor='white';
                                                              document.getElementById('totAmt'+rowCount).style.backgroundColor='white'; 
                                                              document.getElementById('careContr'+rowCount).style.backgroundColor='white'; 
                                                           }
                                                    };
			cell11.appendChild(element11);  
                        

            var cell12 = row.insertCell(12+parseInt(cnt_csp));
			var element12 = document.createElement("input");
			element12.type = "text";
			element12.name = "careContr[]";
                        element12.id = "careContr"+rowCount;
                        element12.style.width = '100px';
                        element12.readOnly = 'true';
			cell12.appendChild(element12);                      


		    var cell13 = row.insertCell(13+parseInt(cnt_csp));
			var element13 = document.createElement("input");
			element13.type = "text";
			element13.name = "amtReim[]";
                        element13.id = "amtReim"+rowCount;
                        element13.style.width = '100px';
                        element13.readOnly = 'true';
			cell13.appendChild(element13);

            var cell14 = row.insertCell(14+parseInt(cnt_csp));
			var element14 = document.createElement("input");
			element14.type = "text";
			element14.name = "facName[]";
                        //element14.style.width = '100%';
                        element14.onchange = function(){
                                                this.style.backgroundColor='white';
                                             };
                        element14.className="rData";
			cell14.appendChild(element14); 

            
            var cell15 = row.insertCell(15+parseInt(cnt_csp));
			var element15 = document.createElement("select");
                                var tex = ['Select Type ...','Public','Private','Missionary'];
                                var val = ['','Public','Private','Missionary'];
                        for (i=0;i<tex.length;i++){
                                var option = document.createElement("option"); 
                                option.text = tex[i];
                                option.value = val[i];
                                element15.add(option,element15[i]);
                        } 
			element15.name = "facClass[]";
                        element15.onchange = function(){
                                                this.style.backgroundColor='white';
                                  //           };
                        //element15.onselect = function(){
                                        xmlhttp.onreadystatechange=function() {
                                          if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                                            document.getElementById("cnt"+rowCount).value = xmlhttp.responseText;
                                          }
                                        };
                                        var str = document.getElementById('childNo'+rowCount).value;
                                        //alert(str);
                                        xmlhttp.open("GET",path+"health/claimCnt.php?cid="+str,true);
                                        xmlhttp.send();
                                };                      
            element15.className="rData";
			cell15.appendChild(element15);  
       
       
            var cell16 = row.insertCell(16+parseInt(cnt_csp));
            var element16=document.createElement("input");
			element16.type = "text";
			element16.name = "refNo[]";
            element16.id = "refNo"+rowCount;
            element16.style.width = '90px';
            element16.value = '0';
            element16.className="rData";
			cell16.appendChild(element16);

            
            var cell17 = row.insertCell(17+parseInt(cnt_csp));
            var element17=document.createElement("input");
            element17.type = "file";
			element17.name = "rct[]";
            element17.id = "rct"+rowCount;
            element17.style.width = '130px';
            element17.className="rData";
            cell17.appendChild(element17);
    
            var cell18 = row.insertCell(18+parseInt(cnt_csp));
            var element18=document.createElement("input");
			element18.type = "text";
			element18.name = "claimCnt[]";
            element18.id = "claimCnt"+rowCount;
            element18.style.width = '50px';
            element18.readOnly = 'TRUE';
            element18.className="rData";
			cell18.appendChild(element18);
                       
                        
                        $("#treatDate"+rowCount).datepicker({dateFormat:"yy-mm-dd"});
                        
}
function submitClaim(frmid){
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
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Claims/medicalClaimEntry",true);
         xmlhttp.send(frmData);
}
function editRemarks(el,rmk,rnd){
    //alert(rnd);
    var sep = el.id.split("_");
    var id=sep[1];
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                el.parentNode.innerHTML=xmlhttp.responseText;
            }
        };
                                               
         xmlhttp.open("GET",path+"mvc/Claims/remarkMedicalClaim/rmks/"+rmk+"/rec/"+id+"/rnd/"+rnd,true);
         xmlhttp.send();
}

function showMore(el){
    var table_id = el.parentNode.parentNode.id;
    var table = document.getElementById(table_id);
    var rw = el.rowIndex;
    var recid_arr = el.id.split("_");
    var recid = recid_arr[1];
    var childNo = recid_arr[2]; 
    
    //alert(childNo);
    
    var keys_arr = ["ICP No: ","Cluster: ","Child Number: ","Child Name: ","Payment Date: ","Diagnosis: ","Total Amount: ","Contribution: ","N.H.I.F. No: ","Amount Reimbursable: "
        ,"Hospital Name: ","Facility Type: ","Claim Type: ","Claim Date: ","Voucher Number"];
    var flds = [];
    
    for(var i=0;i<15;i++){
    flds[i]=table.rows[rw].cells[i+1].innerHTML;
    }
    
    var showMore = document.getElementById("rt-bar");
    var str ="<div><img style='margin-right:10px;' title='View Notes' src= '"+path+"/system/images/notes.png' id='"+recid+"_"+childNo+"' onclick='chat(this);'><img title='Print' src='"+path+"/system/images/print.png'></div><br><br>";
    str +="<div id='sec_child'><table id='info_tbl'>";
    str +="<tr><td><b>Record ID: </b></td><td>"+recid+"</td></tr>";
    for(var k=0;k<flds.length;k++){
    str +="<tr><td><b>"+keys_arr[k]+"</b></td><td id='rw_"+recid+"_"+k+"'>"+flds[k]+"</td></tr>";   
    }
    str +="</table></div>";
    
    showMore.innerHTML=str;

}
function chat(rec){
    //alert(rec);
    var arr = rec.id.split("_");
    var recid = arr[0];
    var childNo=arr[1];
    xmlhttp.onreadystatechange=function() {
        var showMore = document.getElementById("sec_child");
        if (xmlhttp.readyState!==4) {
            showMore.innerHTML='<img id="loadimg_chat" src= "'+path+'/system/images/loadingmin.gif"/>';
        }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //el.parentNode.innerHTML=xmlhttp.responseText;
                var msgs = xmlhttp.responseText.split("|");
                
                showMore.innerHTML="<div><b>Beneficiary "+childNo+" Notes</b>:</div><br>\n\
                <b>Note To:</b> <input type='text name='toFname' id='toFname' placeholder='Recepient ID'/><br>\n\
                <br><textarea id='msg' name='msg' rows='5' cols='30'  placeholder='Type your notes here!'></textarea>\n\
                <br><img style='margin-right:15px;' title='Post' src='"+path+"/system/images/post.png' onclick='postNote("+recid+");'><img title='Reset' src='"+path+"/system/images/reset.png'><br>\n\
                <br><div id='hist_hdr'>Notes History</div><br>\n\
               <div id='history'></div>";
                for(var i=0;i<msgs.length;i++){
                    document.getElementById('history').innerHTML+=msgs[i];
                }
            }
        };
                                               
         xmlhttp.open("GET",path+"system/index.php?url=mvc/Claims/notesHistory/rec/"+recid+"/rnd/"+Math.random(),true);
         xmlhttp.send();
}

function postNote(rec){
    //alert(frmid);
    var toFname = document.getElementById('toFname').value;
    var msg = document.getElementById('msg').value;
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //alert(xmlhttp.responseText);
                document.getElementById('hist_hdr').innerHTML="Your Message:<br>"+xmlhttp.responseText;
                
            }
        };
    var to_str = document.getElementById('toFname').value;
    var msg_str = document.getElementById('msg').value;
    if(to_str===""){
        alert("Note receipient is missing!");
        document.getElementById('toFname').style.border='1px red solid';
    }else if(msg_str===""){
        alert("Message is empty!");
        document.getElementById('msg').style.border='1px red solid';        
    }else{
         xmlhttp.open("GET",path+"system/index.php?url=mvc/Claims/postNote/to/"+toFname+"/msg/"+msg+"/rec/"+rec,true);
         xmlhttp.send();    
     }
}


function print(){
    //alert("Print function under development!");
    var showMore = document.getElementById("sec_child");
    showMore.innerHTML='Print function under development!';
}

function approveClaims(rmk){
    var rmk = rmk;
    //alert(rmk);
    var chk = document.getElementsByClassName("chks");
    var remarks = [];
    for(var i=0;i<chk.length;i++){
        if(chk.item(i).checked===true){
            remarks[i]=chk.item(i).id.split("_")[1];
        }else{
            remarks[i]=0;
        }
    }
    //alert(remarks);
    var cnt_chks = remarks.length;
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
               if(xmlhttp.responseText==='1'){
                   alert("Update Successful");
                   //alert(cnt_chks);
                   for(var j=0;j<cnt_chks;j++){
                       if(remarks[j]!==0){
                           //alert(remarks[j]);
                           if(rmk==='2'){
                            document.getElementById("rmk_td_"+remarks[j]).innerHTML="<img onclick='editRemarks(this,0);' title='Approve' style='border:2px red solid;' src= '"+path+"/system/images/approved.png'/>";
                            }else if(rmk==='1'){
                            document.getElementById("rmk_td_"+remarks[j]).innerHTML="<img onclick='editRemarks(this,2);' title='Unreject' style='border:2px red solid;' src= '"+path+"/system/images/unreject.png'/>";
                            }else if(rmk==='0'){
                            document.getElementById("rmk_td_"+remarks[j]).innerHTML="<img onclick='editRemarks(this,2);' title='Approve' style='border:2px red solid;' src= '"+path+"/system/images/waiting.png'/><img onclick='editRemarks(this,1);' style='border:2px red solid;' src= '"+path+"/system/images/reject.png'/>";
                            }
                       }
                   }
               }else{
                   alert("No record selected!");
               }
            }
        };
        var status_arr = [];
        status_arr[0]="Unapprove";
        status_arr[1]="Reject";
        status_arr[2]="Approve";
        
        var cnfrm = confirm("Are you sure you want to change the status of the records selected to "+status_arr[rmk]+"?");
        if(cnfrm){
         xmlhttp.open("GET",path+"system/index.php?url=mvc/Claims/batchMedicalRemarks/rmks/"+rmk+"/rec/"+remarks,true);
         xmlhttp.send();
     }else{
         alert("You have cancelled your action! No record updated!");
     }
     
}

function editClaim(rec){
if(document.getElementById("info_tbl").rows[0].cells[1].innerHTML===rec) { 
    if(document.getElementById("info_tbl").rows[6].cells[1].innerHTML.substring(1,6)!=='input'){
    var paydate = document.getElementById("info_tbl").rows[5].cells[1].innerHTML;
    var diag = document.getElementById("info_tbl").rows[6].cells[1].innerHTML;
    var totAmt = document.getElementById("info_tbl").rows[7].cells[1].innerHTML;
    var nhif = document.getElementById("info_tbl").rows[9].cells[1].innerHTML;
    var facName = document.getElementById("info_tbl").rows[11].cells[1].innerHTML;
    var vNo = document.getElementById("info_tbl").rows[15].cells[1].innerHTML;
    document.getElementById("info_tbl").rows[5].cells[1].innerHTML="<input type='text' id='treatDate' value='"+paydate+"' onchange='calcReimburse(this,\""+rec+"\");' readonly='readonly'/>";
    $("#treatDate").datepicker({dateFormat:"yy-mm-dd",changeMonth:true,changeYear:true});
    document.getElementById("info_tbl").rows[6].cells[1].innerHTML="<input type='text' id='diagnosis' value='"+diag+"' onchange='calcReimburse(this,\""+rec+"\");'/>";
    document.getElementById("info_tbl").rows[7].cells[1].innerHTML="<input type='text' id='totAmt' value='"+totAmt+"' onchange='calcReimburse(this,\""+rec+"\");'/>";
    document.getElementById("info_tbl").rows[9].cells[1].innerHTML="<input type='text' id='nhif' value='"+nhif+"' onchange='calcReimburse(this,\""+rec+"\");'/>";
    document.getElementById("info_tbl").rows[11].cells[1].innerHTML="<input type='text' id='facName' value='"+facName+"' onchange='calcReimburse(this,\""+rec+"\");'/>";
    document.getElementById("info_tbl").rows[12].cells[1].innerHTML="<select id='facClass' onchange='calcReimburse(this,\""+rec+"\");'><option value=''>Select Option ...</option><option value='Public'>Public</option><option value='Missionary'>Missionary</option><option value='Private'>Private</option></select>";
    document.getElementById("info_tbl").rows[15].cells[1].innerHTML="<input type='text' id='vnum' value='"+vNo+"' onchange='calcReimburse(this,\""+rec+"\");'/>";
    }
    }else{
        alert("You cannot edit unselected record! Please double click the record to select it");
    }
}
function calcReimburse(el,rec){
    //alert("Hello");
    var amt = document.getElementById('totAmt').value;
    var nhif = document.getElementById('nhif').value;
    var contr=0;
        if(nhif==='0'){
            document.getElementById("info_tbl").rows[8].cells[1].innerHTML=parseInt(amt)*0.1;
            contr = document.getElementById("info_tbl").rows[8].cells[1].innerHTML;
        }else{
            document.getElementById("info_tbl").rows[8].cells[1].innerHTML=0;
            contr = document.getElementById("info_tbl").rows[8].cells[1].innerHTML;
        }
        
        document.getElementById("info_tbl").rows[10].cells[1].innerHTML=parseInt(amt)-parseInt(contr);
        
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                alert(innerHTML=xmlhttp.responseText);
            }
        };
                                               
         xmlhttp.open("GET",path+"system/index.php?url=mvc/Claims/editClaim/fld/"+el.id+"/val/"+el.value+"/contr/"+contr+"/rec/"+rec,true);
         xmlhttp.send();
}
function uploadRct(rec,frmid){
    var frm = document.getElementById(frmid);
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                //alert(innerHTML=xmlhttp.responseText);
                document.getElementById('overlay').style.display='none';
                    var rctTD = document.getElementById('rct-'+rec);
                     rctTD.innerHTML=xmlhttp.responseText;
                     rctTD.style.color='green';
                     document.getElementById("rmk_td_"+rec).innerHTML+='<img id="" style="border:2px red solid;margin:2px;" src= "'+path+'/system/images/diskdel.png"/>';
            }
        };
                                               
         xmlhttp.open("POST",path+"/mvc/Claims/attachReceipt",true);
         xmlhttp.send(frmData);
}

function delReceipt(rct,clst,rec,rnd){
    //alert(rct);
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                var str = xmlhttp.responseText.split("*");
                
                if(str[0]==='0'){
                    document.getElementById("rmk_td_"+rec).innerHTML='<img id="" onclick="editRemarks(this,2,"'+rnd+'");" style="border:2px red solid;margin:2px;" src= "'+path+'/system/images/waiting.png"/>\n\
                                                                    <img id="" onclick="editRemarks(this,1,"'+rnd+'");" style="border:2px red solid;margin:2px;" src= "'+path+'/system/images/reject.png"/>';
                    document.getElementById("rct-"+rec).innerHTML='<input type="file" name="rct"/>';
                }
                alert(str[1]);
            }
        };
                                               
         xmlhttp.open("GET",path+"system/index.php?url=mvc/Claims/delReceipt/rct/"+rct+"/clst/"+clst+"/rec/"+rec,true);
         xmlhttp.send();
}

function selectClaims(){
	var rmk = document.getElementById('rmkSelect').value;
	var frmDate = document.getElementById('frmDate').value;
	var toDate = document.getElementById('toDate').value;

	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
               document.write(xmlhttp.responseText);
               location.reload();
            }
        };
                                               
        var frmData = new FormData();
        frmData.append("rmk",rmk);
        frmData.append("frmDate",frmDate);
        frmData.append("toDate",toDate);
        xmlhttp.open("POST",path+"mvc/Claims/viewMedicalClaims",true);      
        xmlhttp.send(frmData);
}
