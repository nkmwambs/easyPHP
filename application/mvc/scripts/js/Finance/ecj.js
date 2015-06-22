var path = 'http://'+location.hostname+'/easyPHP/';
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                 var xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }


function sumEcj(){
    if(document.getElementById("ecj")){
        //Expense and Income Totals
        var tbl = document.getElementById("ecj");
        var tbl_width = tbl.rows[4].cells.length;
        var tbl_heigth = tbl.rows.length;
        for(var i=12;i<tbl_width;i++){ 
            var sum=0;
            for(var j=6;j<tbl_heigth;j++){
                if(!isNaN(parseInt(tbl.rows[j].cells[i].innerHTML))){
                    sum+=parseInt(tbl.rows[j].cells[i].innerHTML);
                }
            }
           tbl.rows[4].cells[i].innerHTML=sum;
        }
        //Bank Moving Balances
        var moving_bank_bal=0;
        var bank_opening_balance = tbl.rows[5].cells[7].innerHTML;
        for(var k=6;k<tbl_heigth;k++){
            if(!isNaN(parseInt(tbl.rows[k-1].cells[8].innerHTML))){var prev=parseInt(tbl.rows[k-1].cells[8].innerHTML);}else{prev=parseInt(bank_opening_balance);}
            if(!isNaN(parseInt(tbl.rows[k].cells[6].innerHTML))){var dep=parseInt(tbl.rows[k].cells[6].innerHTML);}else{dep=0;}
            if(!isNaN(parseInt(tbl.rows[k].cells[7].innerHTML))){var wtd=parseInt(tbl.rows[k].cells[7].innerHTML);}else{wtd=0;}
                moving_bank_bal= prev+dep-wtd;
                tbl.rows[k].cells[8].innerHTML=moving_bank_bal;
            
        }
        //PC Moving Balances
        var moving_pc_bal=0;
        var pc_opening_balance = tbl.rows[5].cells[10].innerHTML;
        for(var l=6;l<tbl_heigth;l++){
            if(!isNaN(parseInt(tbl.rows[l-1].cells[11].innerHTML))){var pc_prev=parseInt(tbl.rows[l-1].cells[11].innerHTML);}else{pc_prev=parseInt(pc_opening_balance);}
            if(!isNaN(parseInt(tbl.rows[l].cells[9].innerHTML))){var pc_dep=parseInt(tbl.rows[l].cells[9].innerHTML);}else{pc_dep=0;}
            if(!isNaN(parseInt(tbl.rows[l].cells[10].innerHTML))){var pc_wtd=parseInt(tbl.rows[l].cells[10].innerHTML);}else{pc_wtd=0;}
                moving_pc_bal= pc_prev+pc_dep-pc_wtd;
                tbl.rows[l].cells[11].innerHTML=moving_pc_bal;
        } 
        //Bank Deposit Totals
        
        var bank_dep_total =0;
        for(var m=6;m<tbl_heigth;m++){
            if(!isNaN(parseInt(tbl.rows[m].cells[6].innerHTML))){
                bank_dep_total += parseInt(tbl.rows[m].cells[6].innerHTML);
            }
        }
        tbl.rows[4].cells[6].innerHTML=bank_dep_total;
        
        //PC Deposit Total
        
        var pc_dep_total =0;
        for(var q=6;q<tbl_heigth;q++){
            if(!isNaN(parseInt(tbl.rows[q].cells[9].innerHTML))){
                pc_dep_total += parseInt(tbl.rows[q].cells[9].innerHTML);
            }
        }
        tbl.rows[4].cells[9].innerHTML=pc_dep_total;        
        
        //Bank payments Totals
        
        var bank_wtd_total =0;
        for(var p=6;p<tbl_heigth;p++){
            if(!isNaN(parseInt(tbl.rows[p].cells[7].innerHTML))){
                bank_wtd_total += parseInt(tbl.rows[p].cells[7].innerHTML);
            }
        }
        tbl.rows[4].cells[7].innerHTML=bank_wtd_total;
        
        //PC Payments Totals
        var pc_wtd_total =0;
        for(var r=6;r<tbl_heigth;r++){
            if(!isNaN(parseInt(tbl.rows[r].cells[10].innerHTML))){
                pc_wtd_total += parseInt(tbl.rows[r].cells[10].innerHTML);
            }
        }
        tbl.rows[4].cells[10].innerHTML=pc_wtd_total;        
        
        
        //Current Bank Balance
        tbl.rows[4].cells[8].innerHTML = parseInt(bank_opening_balance)+bank_dep_total-bank_wtd_total;
        
        //Current PC Balance
        tbl.rows[4].cells[11].innerHTML = parseInt(pc_opening_balance)+pc_dep_total-pc_wtd_total;        
        
    }
    if(document.getElementById("tblVoucher")){
        var tbl=document.getElementById("tblVoucher");
        var tbl_ht = tbl.rows.length;   
        //var max_tbl_width = tbl.rows[6].cells.length;
        //alert(max_tbl_width);
        //alert(tbl.rows[tbl_ht-6].cells[1].innerHTML);
        //alert(tbl.rows[6].cells[3].innerHTML);
        var vch_sum=0;
        for(var t=6;t<tbl_ht-6;t++){
            vch_sum+=parseInt(tbl.rows[t].cells[3].innerHTML);
        }
        tbl.rows[tbl_ht-6].cells[1].innerHTML=vch_sum;
        tbl.rows[tbl_ht-6].cells[1].style.fontWeight='bold';
    }
    if(document.getElementById("tblCiva")){
        //alert("Hello");
        var tbl = document.getElementById("tblCiva");
        var rw = tbl.rows.length;
        //alert(rw);
        for(var i=0;i<rw;i++){
            tbl.rows[i].cells[0].style.display='none';
            tbl.rows[i].cells[3].style.display='none';
            tbl.rows[i].cells[4].style.display='none';
            tbl.rows[i].cells[5].style.display='none';
            tbl.rows[i].cells[6].style.display='none';
            if(tbl.rows[i+1].cells[11].innerHTML===1){
                tbl.rows[i+1].cells[11].innerHTML='<button>Open</button>';
            }else{
                tbl.rows[i+1].cells[11].innerHTML='<button>Close</button>';
            }
            
        }
        
    }
    if(document.getElementById("tblShowBal")){
        //alert("Hello");
        var tbl = document.getElementById("tblShowBal");
        var rw = tbl.rows.length;
        for(var n=1;n<rw;n++){
            //var icp= tbl.rows[n].cells[1].innerHTML;
            //alert(icp);
            if(tbl.rows[n].cells[4].innerHTML==="1"){
               tbl.rows[n].cells[4].innerHTML="<button onclick='changeBalState('"+tbl.rows[n].cells[1].innerHTML+"',0,this);'>Lock</button>"; 
            }else{
               tbl.rows[n].cells[4].innerHTML="<button onclick='changeBalState('"+tbl.rows[n].cells[1].innerHTML+"',1,this);'>Unlock</button>"; 
            }
        }
    }    
}

