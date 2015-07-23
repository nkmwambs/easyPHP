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
        xmlhttp.open("POST",path+"/mvc/Finance/submitMfr/public/0",true);                                     
        xmlhttp.send(frmData);
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

function clearDepInTransit(rid,elem){
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
                    	stateRestore(rid);
                    };
                    t.appendChild(a);                  
                    
          }
        };

      xmlhttp.open("GET",path+"mvc/Finance/changeState/rid/"+rid,true);      
      xmlhttp.send();
}
function stateRestore(rid){
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

      xmlhttp.open("GET",path+"mvc/Finance/undochangeState/rid/"+rid,true);      
      xmlhttp.send();
}
function updateBankBal(){
	var trans=parseFloat(document.getElementById('depTrans').innerHTML);
	var oc=parseFloat(document.getElementById('oc').innerHTML);
	var stmt = parseFloat(document.getElementById('statementAmount').value);
	//var cashBal = parseFloat(document.getElementById('cashBal').value); 
	if(document.getElementById('depTrans').innerHTML===""){
		document.getElementById('depTrans').innerHTML=0;
		trans=0;
	}
	if(document.getElementById('oc').innerHTML===""){
		document.getElementById('oc').innerHTML=0;
		oc=0;
	}	
	//if(document.getElementById('statementAmount').value){
		//document.getElementById('statementAmount').value=0;
		//stmt=0;
	//}
		document.getElementById('adjBank').value=stmt+trans-oc;

}
