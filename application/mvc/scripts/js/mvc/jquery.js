      $(document).ready(function(){
				$("#frmDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
                $("#toDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});                
                $("#attenddate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#closeDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#cjCashOpBal").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#bsCashOpBalDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#osDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#closureDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
				$("#statementDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
				$("#bookedFromDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
				$("#bookedToDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
				$(".dateSelector").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//childDOB
				$("#childDOB").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//childDOB
				$("#closeIndexing").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//childDOB
				$("#closureDateCash").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//regDate
				$("#regDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//diagDate
				$("#diagDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//tfiDate
				$("#tfiDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//metricDate
				$("#metricDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//othertfienroldate
				$("#othertfienroldate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//requestDate
				$("#requestDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//exitDate
				$("#exitDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//assessDate
				$("#assessDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});//assessDate
		});
		
	  //  if (document.addEventListener) {
	    //    document.addEventListener('contextmenu', function(e) {
	      //      alert("Right Clicking not allowed"); //here you draw your own menu
	        //    e.preventDefault();
	        //}, false);
	    //} else {
	      //  document.attachEvent('oncontextmenu', function() {
	        //    alert("Right Clicking not allowed");
	        //    window.event.returnValue = false;
	        //});
	    //}
	    

 var mozilla=document.getElementById && !document.all;
 var ie=document.all;
 var contextisvisible=0;

 function iebody(){
 return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
 }

 function displaymenu(e){
	 el=document.getElementById("context_menu");
	 contextisvisible=1;
	 if (mozilla){
	 el.style.left=pageXOffset+e.clientX+"px";
	 el.style.top=pageYOffset+e.clientY+"px";
	 el.style.visibility="visible";
	 e.preventDefault();
	 return false;
	 }
	 else if (ie){
	 el.style.left=iebody().scrollLeft+event.clientX;
	 el.style.top=iebody().scrollTop+event.clientY;
	 el.style.visibility="visible";
	 return false;
	 }
 }

 function hidemenu(){
 if (typeof el!="undefined" && contextisvisible){
 el.style.visibility="hidden"
 contextisvisible=0
 }
 }

 if (mozilla){
 document.addEventListener("contextmenu", displaymenu, true)
 document.addEventListener("click", hidemenu, true)
 }
 else if (ie){
 document.attachEvent("oncontextmenu", displaymenu)
 document.attachEvent("onclick", hidemenu)
 }