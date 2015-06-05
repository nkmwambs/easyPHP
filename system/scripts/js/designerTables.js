onload = function(){
var tables = document.getElementsByClassName('designerTable');
for(var i=0;i<tables.length;i++){
   with(tables.item(i).style){
               width="100%";
               border="1px solid black";
               borderCollapse="collapse";
               
   } 
}
    
    var th = document.querySelectorAll(".designerTable th");
    for(var i=0;i<th.length;i++){
      th[i].style.backgroundColor = "lightblue";  
      th[i].style.padding= "2px 10px 2px 10px";
    }
    
    var tr_odd = document.querySelectorAll(".designerTable tr:nth-child(odd)");
    for(var i=0;i<tr_odd.length;i++){
      tr_odd[i].style.backgroundColor = "wheat";
    }

    var tr_even = document.querySelectorAll(".designerTable tr:nth-child(even)");
    for(var i=0;i<tr_even.length;i++){
      tr_even[i].style.backgroundColor = "white";
    }
    
    var td = document.querySelectorAll(".designerTable td");
    for(var i=0;i<td.length;i++){
      td[i].style.whiteSpace = "nowrap";
      td[i].style.padding="2px 10px 2px 10px";
    }   
    
    
};

onmouseover=function(){

};

