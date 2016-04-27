var pathArray = window.location.pathname.split("/");

var method = pathArray[4];

var controller = pathArray[3];

var app = pathArray[2];

var root = pathArray[1];

var path = 'http://'+location.hostname+'/'+root+'/';

 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 }

function xmlhttprequest(url,cnfrm1,confrm2){
//alert(url);
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

    xmlhttp.onreadystatechange=function() {    
        if (xmlhttp.readyState===4 && xmlhttp.status===200) {
            if(confrm2==="1"){
                document.write(xmlhttp.responseText);
            }else{
                location.reload();
                alert(xmlhttp.responseText);
            }
        }
    };
    if(cnfrm1==="1"){
    var response = confirm("Are you sure you want to perform this action?");
        if(response){
            xmlhttp.open("GET",path+"system/index.php?url="+url+"/rnd/"+Math.random(),true);
            xmlhttp.send();
        }
        else{
            alert("Your action has been cancelled!");
        }
    }else{
        xmlhttp.open("GET",path+"system/index.php?url="+url+"/rnd/"+Math.random(),true);
        xmlhttp.send();        
    }
}

function editMenu(el){
    var elemid=el.id;
    var tdid_arr = elemid.split("_");
    var tdid = tdid_arr[0];
    var tdFld = tdid_arr[2];
    var elem = document.getElementById(elemid);
    if(elem.childNodes[0].tagName!=='INPUT'){
        var value = elem.innerHTML;
        document.getElementById(elemid).innerHTML = "<input id='"+tdFld+"' type='text' value='"+value+"' onchange='effectEdit(this,\""+tdid+"\");'/>";
    }
}

function effectEdit(el,mnid){
    var url = app+"/Settings/editMenu/"+el.id+"/"+el.value+"/mnID/"+mnid+"";
    xmlhttprequest(url,"1","0");
}

function removeInput(el){
    var id=el.id;
    var elem = document.getElementById(id);
    if(elem.childNodes[0].tagName==='INPUT'){
        var value = elem.firstChild.value;
        elem.removeChild(elem.firstChild);
        elem.innerHTML=value;
        
    }
}
function getOptionText(selection,eq){
	var text="";
	
	for(var x=0;x<selection.children.length;x++){
		if(selection.item(x).value===eq){
			text = selection.item(x).innerHTML;
		}
	}
	
	return text;
}

/**
 * Table Filter Functions ---- Start Here
 */

function addfilters(val,text){
	var inputs = document.getElementsByTagName("INPUT");
	var cnt = inputs.length;

	var vals = val.split(",");
	var txt = text.split(",");
	var op = ["=",">","<",">=","<=","!=","Contains"];
	
	var pr = document.getElementById("fldset");
	
	//Delete Image
	var img_one =document.createElement('IMG');
	img_one.src = path+'/system/images/uncheck3.png';
	setAttributes(img_one,{"style":"cursor:pointer;","Title":"Delete Filter","class":"row"+cnt});
	img_one.onclick = function (){
		deletefilter("row"+cnt);
	};
		
	//Select One
	var select_one = document.createElement("SELECT");
	select_one.name = 'fields[]';
	select_one.className = "row"+cnt;
	var ext_opt_one = document.createElement("OPTION");
	ext_opt_one.innerHTML = "Select Filter Field";
	ext_opt_one.value='';
	select_one.appendChild(ext_opt_one);
	
	for (var i=0; i < vals.length; i++) {
	  var opt = document.createElement('OPTION');
	  opt.innerHTML = txt[i];
	  opt.setAttribute("value",vals[i]);
	  select_one.appendChild(opt);
	};
	
	
	//Select Two
	var select_two = document.createElement("SELECT");
	select_two.name = 'operators[]';
	select_two.className = "row"+cnt;
	var ext_opt_two = document.createElement("OPTION");
	ext_opt_two.innerHTML = "Select Operator";
	ext_opt_two.value='';
	select_two.appendChild(ext_opt_two);
	
	for (var j=0; j < op.length; j++) {
	  var opt = document.createElement('OPTION');
	  opt.innerHTML = op[j];
	  opt.setAttribute("value",op[i]);
	  select_two.appendChild(opt);
	};
	
	//Criteria Value
	
	var criteria  = document.createElement("INPUT");
	setAttributes(criteria,{"placeholder":"Criteria Value","class":"row"+cnt,"name":"criteriaval[]","type":"text"});
	
	//Add filter
	var img_two =document.createElement('IMG');
	img_two.src = path+'/system/images/plus.png';	
	setAttributes(img_two,{"style":"cursor:pointer;","Title":"Add Filter","class":"row"+cnt});
	img_two.onclick = function (){
		addfilters(val,text);
	};
	
	//Break
	var br = document.createElement('br');
	setAttributes(br,{"class":"row"+cnt});
	
	//Append to fldset
	pr.appendChild(img_one);
	pr.appendChild(select_one);
	pr.appendChild(select_two);
	pr.appendChild(criteria);
	pr.appendChild(img_two);
	pr.appendChild(br);
	
}

function getfiltercontroller(callback,div){
	//alert(callback);
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                	//alert(Object.keys(xmlhttp.responseText).length);
                	if(Object.keys(xmlhttp.responseText).length === 2){
                		alert("Results not found or Controller Method Missing!");
                	}
                	create_grid(div,xmlhttp.responseText,callback);
                }
            
        };
        
        var rst = document.getElementById('rst');
        
        if(!rst){
        	alert("DIV rst not present. Create a DIV with id rst or supply another DIV id in the resource as a forth argument");
        	exit;
        }
        //alert(callback);
        var frm = document.getElementById('filterform');  
    	var frmData = new FormData(frm);                                     
         xmlhttp.open("POST",path+"schoolmanager/"+callback,true);
         xmlhttp.send(frmData);
}
function deletefilter(cname){

	var flds = document.getElementsByClassName(cname);
	
	var inp = document.getElementsByTagName('INPUT');
	//alert(inp.length);
	if(inp.length===1||inp.length===2){
		alert("You should have atleast one filter");
		exit;
	}
	
	while(flds.length>0){
		flds[0].parentNode.removeChild(flds[0]);
	}
}

function create_grid(div,objRaw,callback){
	//alert(callback);
	var arr = callback.split("/");
	var func = arr[1];
	
	var pg = document.getElementById(div);
	var obj = JSON.parse(objRaw);
	var keys = Object.keys(obj[0]);
	
	pg.innerHTML = "";
	
	var tbl = document.createElement('TABLE');
	setAttributes(tbl,{"id":"info_tbl","style":"margin-top:25px;max-width:100%;min-width:90%;"});
	var tr_one = document.createElement('TR');
	for(l in keys){
		var th = document.createElement('TH');
		th.innerHTML = keys[l];
		tr_one.appendChild(th);
	}	
	tbl.appendChild(tr_one);
	
	for(i in obj){
		var tr = document.createElement('TR');
		for(j in obj[i]){
			var td = document.createElement('TD');	
			td.innerHTML = obj[i][j];
			td.onclick = function(){
				//editgrid(this);
				window[func](this);
			};
			tr.appendChild(td);
		}
		tbl.appendChild(tr);
	}
	pg.appendChild(tbl);
	
}
function editgrid(elem){
	var tbl = elem.parentNode.parentNode;
	var cell_index = elem.cellIndex; 
	var editcallback = document.getElementById('editcallback').value;
	if(event.ctrlKey&&elem.children.length===0&&cell_index!==0&&editcallback!==''){
		var d = elem.innerHTML;
		
		elem.innerHTML = '<INPUT TYPE="text" VALUE="'+d+'"/>';
		var img = document.createElement('IMG');
		img.src = path+'/system/images/diskedit.png';
		img.onclick = function (){
			var fld_val = tbl.rows[0].cells[cell_index].innerHTML;
			
			var rw = elem.parentNode;
			var db_key = rw.cells[0].innerHTML;
			var newVal = elem.children[0].value;
			//alert(newVal);
			editfield(fld_val,db_key,newVal,elem);
		};
		elem.appendChild(img);
	}
	
}
function editfield(fld_val,db_key,newVal,elem){
	//alert(newVal);
	var editcallback = document.getElementById('editcallback').value; 
	   xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
					//document.getElementById(div).innerHTML=xmlhttp.responseText;
					alert(xmlhttp.responseText);
					elem.innerHTML='';
					elem.innerHTML=newVal;
                }
            
        };
          
    	var frmData = new FormData();
    	     
    	frmData.append("id",db_key);
    	frmData.append('field',fld_val);
    	frmData.append('newVal',newVal);
    	                                
        xmlhttp.open("POST",path+"/"+app+"/"+editcallback,true);
        xmlhttp.send(frmData);
}


/**
 * Table Filter Functions ---- Ends Here
 */

function excelexport(){
				//getting values of current time for generating the file name
				var img = document.getElementById('tblAllSchedules').getElementsByTagName('img');
				var l = img.length;
				for (var i = 0; i < l; i++) {
				    img[0].parentNode.removeChild(img[0]);
				}
				
		        var dt = new Date();
		        var day = dt.getDate();
		        var month = dt.getMonth() + 1;
		        var year = dt.getFullYear();
		        var hour = dt.getHours();
		        var mins = dt.getMinutes();
		        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
		        //creating a temporary HTML link element (they support setting file names)
		        var a = document.createElement('a');
		        //getting data from our div that contains the HTML table
		        var data_type = 'data:application/vnd.ms-excel';
		        var table_div = document.getElementById('rst');
		        var table_html = table_div.outerHTML.replace(/ /g, '%20');
		        a.href = data_type + ', ' + table_html;
		        //setting the file name
		        a.download = 'exported_table_' + postfix + '.xls';
		        //triggering the function
		        a.click();
		        //just in case, prevent default behaviour
		        //e.preventDefault();
	
}
function setAttributes(el, attrs) {
  for(var key in attrs) {
    el.setAttribute(key, attrs[key]);
  }
}//setAttributes(elem, {"src": "http://example.com/something.jpeg", "height": "100%", ...}); 
function validaterequired(){
	var req = document.getElementsByClassName('req');
	var local_cnt = 0;
	
	for (var i=0; i < req.length; i++) {
		req.item(i).style.backgroundColor='white';
	  	if(req.item(i).value===''){
	  		req.item(i).style.backgroundColor='red';
	  		local_cnt++;
	  	}
	};
	
	if(local_cnt>0){
		alert(local_cnt+" mandatory fields are empty!");
		exit;
	}
}
/*
 * Smart Table starts here
 */

function smartexpand(smartid,elem){
	
	document.getElementById('smart_rst').style.display='none';
	
	var sid = document.getElementById(smartid);
	var sc = document.getElementsByClassName('smart_body');
	var smart_expand = document.getElementsByClassName('smart_expand');
	
	for (var k=0; k < smart_expand.length; k++) {
		smart_expand.item(k).innerHTML='&nabla;';
		smart_expand.item(k).parentNode.style.color='white'; 	
	}
		
	for (var j=0; j < sc.length; j++) {
		if(sc.item(j).style.display==='block'){
			sc.item(j).style.display='none';
		}
	 	
	}
	
	sid.style.display='block';
	elem.innerHTML='&Delta;';		
	elem.parentNode.style.color='blue';
	
	document.getElementById('smart_main_expand').innerHTML="&Delta;";

}
function smartmainexpand(){
	document.getElementById('smart_rst').style.display='none';
	
	var sc = document.getElementsByClassName('smart_body');
	var smart_expand = document.getElementsByClassName('smart_expand');
	
	for (var k=0; k < smart_expand.length; k++) {
		smart_expand.item(k).innerHTML='&nabla;';
		smart_expand.item(k).parentNode.style.color='white'; 	
	}

	for (var j=0; j < sc.length; j++) {
		if(sc.item(j).style.display==='block'){
			sc.item(j).style.display='none';
		}
	 	
	}
	
	document.getElementById('smart_main_expand').innerHTML="&nabla;";
}
function func(elem){
	alert("No Function Available");
}
function create_table(obj){
	if(document.getElementById('smart_rst').children.length>0){
		document.getElementById('smart_rst').removeChild(document.getElementById('smart_rst').children[0]);
	}
	
	var TABLE = document.createElement('TABLE');
	setAttributes(TABLE,{"id":"info_tbl","style":"margin-top:20px;color:green;min-width:50%;max-width:95%;"});
	
	var keys = Object.keys(obj[0]);
	var HR = document.createElement("TR");
	for(var i in keys){
		var TH = document.createElement("TH");
		TH.innerHTML = keys[i];
		HR.appendChild(TH);
	}
	
	TABLE.appendChild(HR);
	
	
	for (var j=0; j < obj.length; j++) {
	  var TR = document.createElement("TR");
	  	for(var k in obj[j]){
	  		var TD = document.createElement("TD");
	  		TD.innerHTML = obj[j][k];
	  		setAttributes(TD,{"style":"color:white;"});
	  		TD.onclick=function (){
	  			
	  		};
	  		TR.appendChild(TD);
	  	}
	  	TABLE.appendChild(TR);
	}
	

	
	return TABLE;
	
}
function viewallfields(){
	var bd = document.getElementsByClassName('smart_body');//smart_viewall_chk
	var chk = document.getElementById('smart_viewall_chk');//smart_viewall_chk
	var arrows = document.getElementsByClassName('smart_expand');
	var hd = document.getElementsByClassName('smart_hr_heading');
	
	for (var i=0; i < bd.length; i++) {
	  if(chk.checked===true){
	  		arrows.item(i).innerHTML="&Delta;";
	  		bd.item(i).style.display='block';//smart_hr_heading
	  		hd.item(i).style.color='#0000FF';
	  }else{
	  		arrows.item(i).innerHTML="&nabla;";
	  		bd.item(i).style.display='none';
	  		hd.item(i).style.color='white';	  		
	  }
	};
}
/*
 * Smart Table ends here
 */




/*
 * Popup - Start
 */

function popup(rst,header){
	//alert("Hello");
	var container = document.getElementById('container');
	var pop = document.createElement("DIV");
	setAttributes(pop,{"id":"popup","class":"popup"});
	var content = document.createElement("DIV");
	content.innerHTML='<a href="#close" title="Close"  onclick="closepop()" class="close">X</a><b>'+header+"</b><br>";
	content.appendChild(rst);
	pop.appendChild(content);
	container.appendChild(pop);
	
}
function closepop(){
	document.getElementById('popup').style.display='none';
}
/*
 * Popup -End
 */

/*
 * Module desc - start
 */

function moduledesc(msg){
		
		var div = document.createElement("DIV");
		div.innerHTML = msg;
		
		var hdr = "Module Description";
		
		popup(div,hdr);
	
}

/*
 * Module desc - end
 */