function mfrCalc(){
    var civa = document.getElementById("tblCiva");
    var rw = civa.rows.length;
    
    for(var i=0;i<rw;i++){
        civa.rows[i].cells[0].style.display="none";
        for(var j=3;j<7;j++){
            civa.rows[i].cells[j].style.display="none";
        }
    }
}

function mfrTotals(){
	

}
function submitMfr(frmid){
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
            }
        };
        var recon = document.getElementById("reconTxt").value;
        var varExplain=document.getElementsByClassName('varExplain');
        var statementFlds=document.getElementsByClassName('statementFlds');
        var cntEmpty=0;
        
        for(var i=0;i<varExplain.length;i++){
        	if(varExplain.item(i).innerHTML===""){
        		cntEmpty++;
        		varExplain.item(i).style.backgroundColor='red';
        	}else{
        		varExplain.item(i).style.backgroundColor='white';
        	}
        }
        for(var i=0;i<statementFlds.length;i++){
        	if(statementFlds.item(i).value===""||statementFlds.item(i).value===0){
        		cntEmpty++;
        		statementFlds.item(i).style.backgroundColor='red';
        	}else{
        		statementFlds.item(i).style.backgroundColor='white';
        	}
        }
        
        if(recon==='0'){
        	alert("Error in Report Reconciliation. Report not submitted!");
        }else if(cntEmpty>0){
        	alert(cntEmpty+ " mandatory fields empty!");
        }else{
        	xmlhttp.open("POST",path+"/mvc/Finance/submitMfr/public/0",true);                                     
        	xmlhttp.send(frmData);
        }
}
function selectMFR(val){
	//alert(val);
      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    document.getElementById("content").innerHTML=xmlhttp.responseText;
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/mfrNav/time/"+val,true);      
      xmlhttp.send();
}

function clearDepInTransit(rid,source,type,elem){
	//alert(rid);
	var tbl = elem.parentNode.parentNode.parentNode;
	var rwIndex = elem.parentNode.parentNode.rowIndex;
	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
				//tbl.rows[rwIndex].cells[0].innerHTML="<a href='#' onclick='stateRestore(this);'>Restore</a>";
                //tbl.deleteRow(rwIndex);
                    //alert(xmlhttp.responseText); 
                    var t = tbl.rows[rwIndex].cells[0];
                    var a = document.createElement("a");
                    a.setAttribute("href", "#");
                    t.removeChild(t.childNodes[0]); 
                    a.innerHTML='Undo';
                    a.onclick=function(){
                    	stateRestore(rid,source,type);
                    };
                    t.appendChild(a);                  
                    
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/changeState/rid/"+rid+"/source/"+source+"/type/"+type,true);      
      xmlhttp.send();
}
function stateRestore(rid,source,type){
	//alert(rid);
	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    //alert(xmlhttp.responseText);                 
                    
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/undochangeState/rid/"+rid+"/source/"+source+"/type/"+type,true);      
      xmlhttp.send();
}
function updateBankBal(){
	var trans=parseFloat(document.getElementById('depTrans').innerHTML);
	var oc=parseFloat(document.getElementById('oc').innerHTML);
	var stmt = parseFloat(document.getElementById('statementAmount').value);
	var bankBal = parseFloat(document.getElementById('bankTxt').value);
	var validate = document.getElementById('bankReconValidation');
	if(document.getElementById('depTrans').innerHTML===""){
		document.getElementById('depTrans').innerHTML=0;
		trans=0;
	}
	if(document.getElementById('oc').innerHTML===""){
		document.getElementById('oc').innerHTML=0;
		oc=0;
	}	
	var adj=stmt+trans-oc;
	if(adj){
		document.getElementById('adjBank').innerHTML=adj.toFixed(2);
	}else{
		document.getElementById('adjBank').innerHTML=0;
	}
			
	var adjBank=parseFloat(document.getElementById('adjBank').innerHTML);
	var val_rst = bankBal-adjBank.toFixed(2);
	if(val_rst){
		validate.innerHTML=val_rst;
	}else{
		validate.innerHTML=0;	
	}
	
	if(validate.innerHTML!=="0"||validate.innerHTML===""){
		validate.style.backgroundColor='red';
	}else{
		validate.style.backgroundColor='green';
	}
	
	var recon = document.getElementById('recon');
	var cashValidate=document.getElementById('cashValidate');
	var reconTxt=document.getElementById('reconTxt');
	
	if(parseFloat(validate.innerHTML)!==0||parseFloat(cashValidate.innerHTML)!==0){
		recon.innerHTML=0;
		reconTxt.value=0;
	}else{
		recon.innerHTML=1;
		reconTxt.value=1;
	}
	
}

function validateMFR (rid) {
  //alert(rid);
  	      xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState!==4) {
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                    alert(xmlhttp.responseText);                 
                    
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/validateMFR/rid/"+rid,true);      
      xmlhttp.send();
}