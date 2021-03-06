function addRow(tableID) {
    var voucherType = document.getElementById("VTypeMain").value;
    if(voucherType!=="#"){
        var VType=document.cookie="VType="+voucherType;
    }
    
    var bodyTable = document.getElementById("bodyTable");
    var rws = bodyTable.rows.length;
    
    if(rws>1||VType!==""){
        document.getElementById("VTypeMain").parentNode.innerHTML="<input type='text' name='VTypeMain' id='VTypeMain' value='"+voucherType+"' readonly/>";
    }
     
    if(rws>1){
    	var val1 = bodyTable.rows[rws-1].cells[1].childNodes[0].value;
    	var val2 = bodyTable.rows[rws-1].cells[2].childNodes[0].value;
    	var val3 = bodyTable.rows[rws-1].cells[3].childNodes[0].value;
    	var val4 = bodyTable.rows[rws-1].cells[4].childNodes[0].value;
    	if(val1===""||val2===""||val3===""||val4===""){
    		alert("You must completely fill in the previous row before you proceed!");
    		exit;
    	}
    }
    
    xmlhttp.onreadystatechange=function() {
   	if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            } 	
    if (xmlhttp.readyState===4 && xmlhttp.status===200) {
    	document.getElementById('overlay').style.display='none';
        //alert(xmlhttp.responseText);
        var obj = JSON.parse(xmlhttp.responseText);
        
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var rw = rowCount+1;
            
                        var cell0 = row.insertCell(0);
                        var element0 = document.createElement("input");
                        element0.type = "checkbox";
                        //element0.name="chkbox[]";
                        element0.className="chkbx";
                        element0.onclick=function(){
                            var chks = document.getElementsByClassName("chkbx");
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
                        cell0.appendChild(element0);
                       
			var cell1 = row.insertCell(1);
			var element1 = document.createElement("input");
			element1.type = "text";
			element1.name = "qty[]";
			element1.setAttribute("class","qty accNos");
                        element1.id="qty"+rowCount;
                        element1.onkeyup=function(){
                                                        var x=this.value;
                                                        var y=document.getElementById('unit'+rowCount).value;
                                                        document.getElementById('cost'+rowCount).value=x*y;
                                                        
                                                        var sum = 0;
                                                        $('.cost').each(function(){
                                                                   sum += parseFloat(this.value);
                                                        });
                                                        document.getElementById('totals').value=accounting.formatMoney(sum, { symbol: "Kes.",  format: "%v %s" });   
                                                                                                              
                                                    };
                        element1.style.width = '80%';
                        //element1.className='qty accNos';
			cell1.appendChild(element1);
                        
			var cell2 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "desc[]";
            //element2.className="desc";
            element2.setAttribute("class","desc accNos");
            element2.style.width = '97%';
			cell2.appendChild(element2);  
                        
			var cell3 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.name = "unit[]";
            element3.id = "unit"+rowCount;
            element3.onkeyup=function(){
            		                    var x = this.value;
                                        var y = document.getElementById('qty'+rowCount).value;
                                        document.getElementById('cost'+rowCount).value= x*y;  
                                                       
                                        var sum = 0;
                                         $('.cost').each(function(){
                    	                      sum += parseFloat(this.value);
                                           });
                                        document.getElementById('totals').value=accounting.formatMoney(sum, { symbol: "Kes.",  format: "%v %s" });                                                             
                                                        
                                       };
                        //element4.value="unit"+rowCount;
           	element3.style.width = '80%';
          	//element3.className="unit";
          	element3.setAttribute("class","unit accNos");
            element3.onmousemove='add()';
			cell3.appendChild(element3);  
                        
			var cell4 = row.insertCell(4);
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.name = "cost[]";
            element4.id = "cost"+rowCount;
            //element4.className="cost";
            element4.setAttribute("class","cost accNos");
            element4.style.width = '80%';
            element4.readOnly = 'true';
			cell4.appendChild(element4);                         

			var cell5 = row.insertCell(5);
			var x = document.createElement("select");
			x.name ="acc[]";
            //x.className = 'accNos';
            x.setAttribute('class','accNos acSelect');
            x.style.width = '95%';         
            	var option1 = document.createElement("option");
				option1.text = "Select ...";
				option1.value = "";
            	x.add(option1,x[0]);
                        
                        for (i=0;i<obj.length;i++){
                        var option = document.createElement("option");
                        if(obj[i].AccTextCIVA!==null&&obj[i].open==="1"){
                            option.text = obj[i].AccNoCIVA;
                            option.value = obj[i].AccNo;
                            //document.getElementById("civaCode"+rowCount).value=obj[i].AccNoCIVA;
                        }else{
                            option.text = obj[i].AccText;
                            option.value = obj[i].AccNo;                        
                        }                                                 
			
                        x.add(option,x[i]);

                        } 
                        x.onchange=function(){
                          //alert("Hello!");  
                          document.getElementById("civaCode"+rowCount).value=obj[this.selectedIndex].civaID;
                          check_pc_other_ac_mix(this);
                        };
                        cell5.appendChild(x);
                        
           	var cell6 = row.insertCell(6);
			var element6 = document.createElement("input");
			element6.type = "text";
			element6.name = "civaCode[]";
                        element6.id = "civaCode"+rowCount;
                        element6.className="civaCode";
                        element6.style.width = '80%';
                        element6.readOnly = 'true';
			cell6.appendChild(element6);                         

                        //qty.desc,unit,cost
                        var qty = document.getElementsByClassName("qty");
                        var desc = document.getElementsByClassName("desc");
                        var unit = document.getElementsByClassName("unit");
                        var cost = document.getElementsByClassName("cost");
                        var accNos = document.getElementsByClassName("accNos");
                        var civaCode = document.getElementsByClassName("civaCode");
                        //accNos
                        for(var c=0;c<qty.length;c++){
                            qty.item(c).style.minWidth='30px';
                            desc.item(c).style.minWidth='80px';
                            unit.item(c).style.minWidth='80px';
                            cost.item(c).style.minWidth='80px';
                            accNos.item(c).style.minWidth='80px';
                            civaCode.item(c).style.minWidth='50';
                        }

              }

    };
        
        xmlhttp.open("GET",path+"system/index.php?url=mvc/Finance/accounts/voucherType/"+voucherType,true);
        xmlhttp.send();                       
}

function check_pc_other_ac_mix(elem){
	var val = elem.value;
	var acSelect = document.getElementsByClassName('acSelect');
	var cntAll=0;
	var cntPc=0;
	for(var i=0;i<acSelect.length;i++){
		cntAll++;
		if(acSelect.item(i).value==='2000'||acSelect.item(i).value==='2001'){
			cntPc++;
		}
		//if(acSelect.item(i).value!=='2000'||acSelect.item(i).value!=='2001'&&document.getElementById('VTypeMain').value==='CHQ'){
			//cntOther++;
		//}

		
	}
	var rst=cntAll-cntPc;
	if(rst!==0&&cntPc!==0){
		alert("Error Occurred! PC deposit can't be transacted with other Expense transactions");
		//alert(cntOther+"-"+cntPc);
		elem.lastChild.setAttribute("selected",'selected');
	}
}

function chqIntel(str){
  document.getElementById('CHQ').style.backgroundColor='white';
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                var txt = xmlhttp.responseText;
                var res = txt.match(/cheque/g);
                if(res.length>0){
                      document.getElementById('CHQ').style.backgroundColor='red';                    
                      alert(xmlhttp.responseText);
                      document.getElementById('CHQ').value="";
                    }
                    else{
                       // alert('Ok');
                      //document.getElementById('CHQ').style.backgroundColor='white'; 
                    }
          }
        };
        
    if(str!=="0"){
    var finStr = str.replace(/^0+/, '');
        xmlhttp.open("GET",path+"system/index.php?url=mvc/Finance/chqIntel/chq/"+finStr,true);
        xmlhttp.send();
     }
}
function delRow(tableID) {				
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
			//Totals
			var totals=0;
			for(var j=1;j<rowCount;j++){
				totals+=parseFloat(table.rows[j].cells[4].childNodes[0].value);
			}
			document.getElementById('totals').value=accounting.formatMoney(totals, { symbol: "Kes.",  format: "%v %s" }); 

}
function validateVType(){
            var x=document.getElementById('VTypeMain');
            if(x.value==='#'){
                x.style.backgroundColor='red';
                alert('Please select a valid voucher type!');
            }else{
                x.style.backgroundColor='white';
                document.getElementById('CHQ').style.backgroundColor='white';
            }
            
            if((x.value==='CHQ')&&(document.getElementById('CHQ').value==='')){
                document.getElementById('CHQ').style.backgroundColor='red';                
                alert('You must enter a cheque number!');
            }
        }
function postVoucher(){
		var validate = document.getElementsByClassName('validate');
		var cntFlds =0;
		
		var bodytbl = document.getElementById('bodyTable');
		var bodyrows = bodytbl.rows.length;
		
		if(bodyrows===1){
			alert("You can't post an empty voucher!");
			exit;
		}
		
		for(var z=0;z<validate.length;z++){
			if(validate.item(z).value===""){
				validate.item(z).style.backgroundColor='red';
				cntFlds++;
			}
		}
		if(cntFlds>0){
			alert("Date or Voucher Number Fields cannot be empty! Please reset the voucher if this problem persists!");
			exit();
		}
		
           var x = document.forms["myform"]["Payee"];
                    var y = document.forms["myform"]["TDescription"];
                    var accs = document.getElementsByClassName("accNos");
                    var cost = document.getElementsByClassName('cost');
                    for(var s=0;s<cost.length;s++){
                    	if(isNaN(cost.item(s).value)){
                    		alert("Enter only numeric values");
                    		cost.item(s).style.backgroundColor='red';
                    		return false;
                    	}
                    }
                    for(var i = 0; i < accs.length; i++)
                    {
                          if(accs.item(i).value===''){
                           accs.item(i).style.backgroundColor='red';
                           alert("Please select a valid account number!");
                           return false;
                       }else{
                           accs.item(i).style.backgroundColor='white';
                       }
                       
                    }  
                
                    
                    if (x.value===null || x.value==="") {
                    x.style.backgroundColor = 'red';
                    alert("Payee field name must be filled in");
                    x.style.backgroundColor = 'white';
                    return false;
                    }
                    
                    if(y.value===null ||y.value===""){
                        y.style.backgroundColor='red';
                        alert("Description field must be filled in");
                        y.style.backgroundColor = 'white';
                        return false;
                    }
                        
   var frm = document.getElementById('myform');  
   //frm.submit();
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
               //alert(xmlhttp.responseText);
               document.getElementById('info_div').id='error_div';
               document.getElementById('btnPostVch').style.display='none';
               document.getElementById('btnAddRow').style.display='none';//btnAddRow
               document.getElementById('error_div').innerHTML=xmlhttp.responseText+": Reset to Submit New Record";
               //document.getElementById("content").innerHTML=xmlhttp.responseText;
                
            }
        };
         if(document.getElementById('error_div')){
         	document.getElementById('error_div').innerHTML='Reset to add a New Voucher!';
         	document.getElementById('resetBtn').style.backgroundColor='red';
         }else{  
         	document.getElementById('btnPostVch').style.display='none';
            document.getElementById('btnAddRow').style.display='none';//btnAddRow                                   
	         xmlhttp.open("POST",path+"/mvc/Finance/postVoucher",true);
	         xmlhttp.send(frmData);
         }

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
    var opts = document.getElementsByClassName("tblList");
    for(var d=0;d<opts.length;d++){
        if(opts.item(d).checked===true){
            var tbl =opts.item(d).value; 
        }
    }
    //alert(tbl);
    //var tbl = document.getElementById("dbTbl").value;
    if(cnt>1){
            var itm = fieldset.lastChild;
            var cln = itm.cloneNode(true);
            fieldset.appendChild(cln);
}
    xmlhttp.open("GET",path+"/mvc/Finance/getFlds/tbl/"+tbl+"/public/0",true);
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
    //alert(legendid_arr);
    var opts = document.getElementsByClassName("tblList");
    for(var d=0;d<opts.length;d++){
        if(opts.item(d).checked===true){
            var tbl =opts.item(d).value; 
        }
    }
    //alert(tbl);
    if(cnt>0){
        var query="SELECT ";//+sel+" FROM students "+where+" "+sort
        for(var k=0;k<legendid_arr.length;k++){
            var parent = document.getElementById(legendid_arr[k]).parentNode;
            if(legendid_arr[k]==="select"){
                //var sel="";
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
        xmlhttp.open("POST",path+"/mvc/Finance/searchResults/public/0",true);
        xmlhttp.send(frmData);  
}
function btnVoucherView(){
    //btnAddRow,#btnPostVch{
    document.getElementById("btnAddRow").style.display='block';
    document.getElementById("btnPostVch").style.display='block';
    if(document.getElementById('VTypeMain').value==='CHQ'){
    	document.getElementById('CHQ').style.display='block';
    	document.getElementById('ChqNoText').style.display='block';
    }else{
    	document.getElementById('CHQ').style.display='none';
    	document.getElementById('ChqNoText').style.display='none';
    }
}

function calcVNumber(){
	//alert("Hello");
	var selectedDate = document.getElementById('TDate').value;
	var selectedDateEpoch=new Date(selectedDate);
	var selectedSTMP=selectedDateEpoch.getTime();
	
	var curMonth= selectedDate.substr(5,2);
	var curYear = selectedDate.substr(2,2);;
	
	var prevDate = document.getElementById('previousDate').value;
	var prevDateEpoch=new Date(prevDate);
	var prevSTMP=prevDateEpoch.getTime();
	
	var prevMonth= prevDate.substr(5,2);
	
	var prevVNumber= document.getElementById('prevVNumber').value;
	var fy=curYear;//prevVNumber.substr(0,2);
	var month=prevVNumber.substr(2,2);
	var VNumber = prevVNumber.substr(4);
	var rawNextVNumber=parseInt(VNumber)+1;
	var nextVNumber=rawNextVNumber;
	if(rawNextVNumber<10){
		nextVNumber='0'+rawNextVNumber;
	}
	
	var curVNumber=fy+month+nextVNumber; 
	
	if(parseInt(curMonth)!==parseInt(month)){
		var curVNumber=fy+curMonth+"01";
	}
	//alert(month);
	//if(parseInt(selectedSTMP)<parseInt(prevSTMP)||parseInt(curMonth)!==parseInt(prevMonth)){
	if(parseInt(selectedSTMP)<parseInt(prevSTMP)||parseInt(curMonth)>parseInt(prevMonth)+1){
		document.getElementById('info_div').setAttribute("id","error_div");
		document.getElementById('error_div').innerHTML='Error <img id="" src= "'+path+'/system/images/error.png"/><br> Date not allowed! The next allowable date should equal to and beyond '+prevDate+" and a date in Month "+month+". To Proceed to the next month dates, please consider submitting month "+month+" Report if not yet submitted";
		document.getElementById('TDate').value="";
		document.getElementById('VNumber').value="";
		document.getElementById('TDate').style.backgroundColor='red';
		document.getElementById('VNumber').style.backgroundColor='red';
	}else{
		document.getElementById('TDate').style.backgroundColor='white';
		document.getElementById('VNumber').style.backgroundColor='white';
		if(document.getElementById('error_div')){
			document.getElementById('error_div').innerHTML="";
			document.getElementById('error_div').setAttribute("id","info_div");	
		}
		
		document.getElementById('VNumber').value=curVNumber;
	}
	
}

function postFootNote(frmid){
   var frm = document.getElementById(frmid);  
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('fNotes').innerHTML=xmlhttp.responseText;
                //document.getElementById('msgArea').innerHTML="";
                document.getElementById('msgArea').value="";
                alert("Note Posted Successfully");
            }
        };
    if(document.getElementById('msgArea').value===""){
    	alert("Note cannot be empty!");
    	exit;
    }                                      
         xmlhttp.open("POST",path+"/mvc/Finance/postFootNote/public/0",true);
         xmlhttp.send(frmData);
}


//Start from Here

function previewvoucher(vNo){
     xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                document.getElementById('previewdiv').innerHTML=xmlhttp.responseText;
            }
        };
          
	var frmData = new FormData();
	frmData.append("VNumber",vNo);
	                                  
    xmlhttp.open("POST",path+"/mvc/Finance/previewvoucher",true);
    xmlhttp.send(frmData);	
}
function editVoucher(){
	var validate = document.getElementsByClassName('validate');
		var cntFlds =0;
		
		var bodytbl = document.getElementById('bodyTable');
		var bodyrows = bodytbl.rows.length;
		
		if(bodyrows===1){
			alert("You can't post an empty voucher!");
			exit;
		}
		
		for(var z=0;z<validate.length;z++){
			if(validate.item(z).value===""){
				validate.item(z).style.backgroundColor='red';
				cntFlds++;
			}
		}
		if(cntFlds>0){
			alert("Date or Voucher Number Fields cannot be empty! Please reset the voucher if this problem persists!");
			exit();
		}
		
           var x = document.forms["myform"]["Payee"];
                    var y = document.forms["myform"]["TDescription"];
                    var accs = document.getElementsByClassName("accNos");
                    var cost = document.getElementsByClassName('cost');
                    for(var s=0;s<cost.length;s++){
                    	if(isNaN(cost.item(s).value)){
                    		alert("Enter only numeric values");
                    		cost.item(s).style.backgroundColor='red';
                    		return false;
                    	}
                    }
                    for(var i = 0; i < accs.length; i++)
                    {
                          if(accs.item(i).value===''){
                           accs.item(i).style.backgroundColor='red';
                           alert("Please select a valid account number!");
                           return false;
                       }else{
                           accs.item(i).style.backgroundColor='white';
                       }
                       
                    }  
                
                    
                    if (x.value===null || x.value==="") {
                    x.style.backgroundColor = 'red';
                    alert("Payee field name must be filled in");
                    x.style.backgroundColor = 'white';
                    return false;
                    }
                    
                    if(y.value===null ||y.value===""){
                        y.style.backgroundColor='red';
                        alert("Description field must be filled in");
                        y.style.backgroundColor = 'white';
                        return false;
                    }
                        
   var frm = document.getElementById('myform');  
   //frm.submit();
    var frmData = new FormData(frm);
            xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
               //alert(xmlhttp.responseText);
               document.getElementById('info_div').id='error_div';
               document.getElementById('editvoucherdiv').innerHTML='';
               //document.getElementById('btnAddRow').style.display='none';//btnAddRow
               document.getElementById('error_div').innerHTML="Voucher edited successfully";
               //document.getElementById("content").innerHTML=xmlhttp.responseText;
                
            }
        };
         if(document.getElementById('error_div')){
         	document.getElementById('error_div').innerHTML='Reset to add a New Voucher!';
         	//document.getElementById('resetBtn').style.backgroundColor='red';
         }else{  
         	//document.getElementById('btnPostVch').style.display='none';
            //document.getElementById('btnAddRow').style.display='none';//btnAddRow                                   
	         xmlhttp.open("POST",path+"/mvc/Finance/editVoucher",true);
	         xmlhttp.send(frmData);
         }
}
function chqfld(){
	alert(document.getElementById('VTypeMain').value);
    if(document.getElementById('VTypeMain').value==='CHQ'){
    	document.getElementById('CHQ').style.display='block';
    	document.getElementById('ChqNoText').style.display='block';
    }else{
    	document.getElementById('CHQ').style.display='none';
    	document.getElementById('ChqNoText').style.display='none';
    }
}