<?php //echo Resources::url("Settings/upload_beneficiaries");?>
<form id="frm_beneficiaries" enctype="multipart/form-data">
	<label for='beneficiaries'>Upload CSV Here </label> <INPUT type="file" name="beneficiaries" id="beneficiaries"/>
</form>
<button id="upload_btn" onclick="upload();">Upload</button>

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#upload_btn").click(function(){
			   var frm = document.getElementById('frm_beneficiaries');  
			   //frm.submit();
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
			                                               
			         xmlhttp.open("POST",path+"/mvc/Settings/upload_beneficiaries",true);
			         xmlhttp.send(frmData);
		});
	
	});
</script>
