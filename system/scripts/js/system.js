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
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loadingmin.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {
                document.getElementById('overlay').style.display='none';
                	if(xmlhttp.responseText===''){
                		alert("Results not found or Controller Method Missing!");
                	}
                	create_grid(div,xmlhttp.responseText);
                }
            
        };
        
        var rst = document.getElementById('rst');
        
        if(!rst){
        	alert("DIV rst not present. Create a DIV with id rst or supply another DIV id in the resource as a forth argument");
        	exit;
        }
        
        var frm = document.getElementById('filterform');  
    	var frmData = new FormData(frm);                                     
         xmlhttp.open("POST",path+"/mvc/"+callback,true);
         xmlhttp.send(frmData);
}
function deletefilter(cname){
	
	var flds = document.getElementsByClassName(cname);
	
	var inp = document.getElementsByTagName('INPUT');
	
	if(inp.length===1){
		alert("You should have atleast one filter");
		exit;
	}
	
	while(flds.length>0){
		flds[0].parentNode.removeChild(flds[0]);
	}
}

function create_grid(div,objRaw){
	var pg = document.getElementById(div);
	var obj = JSON.parse(objRaw);
	var keys = Object.keys(obj[0]);
	
	pg.innerHTML = "";
	
	var tbl = document.createElement('TABLE');
	setAttributes(tbl,{"id":"info_tbl","style":"margin-top:25px;"});
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
				editgrid(this);
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
    	                                
        xmlhttp.open("POST",path+"/mvc/"+editcallback,true);
        xmlhttp.send(frmData);
}


/**
 * Table Filter Functions ---- Ends Here
 */

function excelexport(){
				//getting values of current time for generating the file name
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
