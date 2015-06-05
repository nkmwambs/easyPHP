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