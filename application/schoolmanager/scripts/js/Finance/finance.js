function addstructureitem(){
	//alert("Hello");
	var tbl = document.getElementById('tbl_dividers');
	var row = tbl.rows.length;	
	var rw = document.createElement("TR");
	
	var cell0 = document.createElement("TD");
	var element0 = document.createElement("INPUT");
	setAttributes(element0,{"id":"desc"+row,"type":"text","name":"desc[]"});
	cell0.appendChild(element0);
	rw.appendChild(cell0);
	
	var cell1 = document.createElement("TD");
	var element1 = document.createElement("INPUT");
	setAttributes(element1,{"id":"amount"+row,"type":"text","name":"amount[]"});
	cell1.appendChild(element1);
	rw.appendChild(cell1);  
	
	tbl.appendChild(rw);
}

function chkallcreatestructure(elem){
	var chkgrade = document.getElementsByClassName("chkgrade");
	
	if(elem.checked===false){
		for(var i=0;i<chkgrade;i++){
			chkgrade.item(i).checked=false;
		}
	}else{
		for(var i=0;i<chkgrade;i++){
			chkgrade.item(i).checked=true;
		}
	}
		
}

function createnewstructure(){
	//alert("Hello");
	var frm = document.getElementById("frmStructure");
	xmlhttp.onreadystatechange=function() {
 	if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
  		 if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                //alert(xmlhttp.responseText);
                document.getElementById('smart_rst').style.display='block';
                document.getElementById('smart_rst').innerHTML=xmlhttp.responseText;
            }
        };

    
    var frmData = new FormData(frm);
     
	xmlhttp.open("POST",path+"/schoolmanager/Finance/createnewstructure",true);
    xmlhttp.send(frmData);
}
