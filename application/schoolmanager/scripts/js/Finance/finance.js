function addstructureitem(){
	xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loading" src= "'+path+'/system/images/loading.gif"/>';

            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                
                var parse = JSON.parse(xmlhttp.responseText);
                //alert(parse['cat'][0].categoryname);
                //exit;
                	
				var tbl = document.getElementById('tbl_dividers');
				var row = tbl.rows.length;	
				var rw = document.createElement("TR");
				
				var cell0 = document.createElement("TD");
				var element0 = document.createElement("INPUT");
				setAttributes(element0,{"id":"desc"+row,"type":"text","name":"dsc[]"});
				cell0.appendChild(element0);
				rw.appendChild(cell0);
				
				var cell1 = document.createElement("TD");
				var element1 = document.createElement("INPUT");
				setAttributes(element1,{"id":"amount"+row,"type":"text","name":"amount[]","style":"max-width:60px;"});
				cell1.appendChild(element1);
				rw.appendChild(cell1);  
				
				var cell2 = document.createElement("TD");
				var element2 = document.createElement("SELECT");
				setAttributes(element2,{"id":"period"+row,"name":"period[]","style":"max-width:160px;"});
				var  optmain= document.createElement("OPTION");
				optmain.innerHTML="Select Period";
				element2.appendChild(optmain);
				for (var i=0; i < parse['period'].length; i++) {
				  opt = document.createElement("OPTION");
				  setAttributes(opt,{"VALUE":parse['period'][i].pID});
				  opt.innerHTML=parse['period'][i].periodname;
				  element2.appendChild(opt);
				};
				cell2.appendChild(element2);
				rw.appendChild(cell2);
				
				var cell3 = document.createElement("TD");
				var element3= document.createElement("SELECT");
				setAttributes(element3,{"id":"category"+row,"name":"category[]"});
				var  optmain1= document.createElement("OPTION");
				optmain1.innerHTML="Select Category";
				element3.appendChild(optmain1);
				for (var j=0; j < parse['cat'].length; j++) {
				  opt1 = document.createElement("OPTION");
				  setAttributes(opt1,{"VALUE":parse['cat'][j].catID});
				  opt1.innerHTML=parse['cat'][j].categoryname;
				  element3.appendChild(opt1);
				};
				
				cell3.appendChild(element3);
				rw.appendChild(cell3); 
				
				tbl.appendChild(rw);
                
            }
        };	
    
    
    var frmData = new FormData();


	xmlhttp.open("POST",path+"/"+app+"/Finance/getfeestructurefields",true);
    xmlhttp.send(frmData);     
	
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
     
	xmlhttp.open("POST",path+"/"+app+"/Finance/createnewstructure",true);
    xmlhttp.send(frmData);
}
function newfeestructure(){
	var newfeestructureyear = document.getElementById("newfeestructureyear").value;//feestructurename
	var feestructurename = document.getElementById("feestructurename").value;//
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

    
    var frmData = new FormData();
    frmData.append("academicyear",newfeestructureyear);
    frmData.append("feestructurename",feestructurename);
    
     
	xmlhttp.open("POST",path+"/"+app+"/Finance/newfeestructure",true);
    xmlhttp.send(frmData);	
}
function deletefeestructure(){
	//alert("Hello");
	var sel = document.getElementById('selFees').value;
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

    
    var frmData = new FormData();
    frmData.append("fID",sel);
    
     
	xmlhttp.open("POST",path+"/"+app+"/Finance/deletefeestructure",true);
    xmlhttp.send(frmData);		
}

function movefeestructure(){
	//alert("Hello");
	var sel = document.getElementById('moveSel').value;
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

    
    var frmData = new FormData();
    frmData.append("fID",sel);
    
     
	xmlhttp.open("POST",path+"/"+app+"/Finance/movefeestructure",true);
    xmlhttp.send(frmData);		
}