<?php
?>

<button id="btnAddRow" onclick="addRow('bodyTable')">Add Row</button><button onclick="postVoucher();"  id='btnPostVch'>Post</button><button id="btnDelRow" style="display:none;" onclick="delRow('bodyTable');">Delete Row</button><?php echo a_tag("Finance/viewAll","<button>Search</button>")." ".a_tag("Finance/voucher","<button>Reset</button>");?>
<form id="myform" method='POST' action=''>
            <input type="hidden" value="<?php echo $_SESSION['username']; ?>" id="KENo" name="KENo"/>
            
            <table id='tblVch' style="width: 100%;">
                <colgroup><col width="10%"/><col width="15%"/><col width="10%"/><col width="15%"/></colgroup>
                <tr>
                    <th colspan="4"><?php echo $_SESSION['username']; ?><br>COMPASSION ASSISTED PROJECT VOUCHER</th>
                </tr>

                <tr>
                    <?php 
                        if ($data<=9){
                    ?>
               
                    <td><b>Date:</b></td><td><input type="text" id="TDate" name="TDate" style="width:95%;" value="<?php echo date('Y-m-d'); ?>" readonly="readOnly"/></td><td><b>Voucher Number</b></td><td><input type="text" id="VNumber" name="VNumber" style="width:95%;" value='<?php echo date('y')."".date('m')."0".($data)+1; ?>' readonly="readOnly"/></td>
                    <?php
                   }else{
                        ?>
                    <td><b>Date:</b></td><td><input type="text" id="TDate" name="TDate" style="width:95%;" value="<?php echo date('Y-m-d'); ?>" readonly="readOnly"/></td><td><b>Voucher Number</b></td><td><input type="text" id="VNumber" name="VNumber" style="width:95%;" value='<?php echo date('y')."".date('m')."".($data)+1; ?>' readonly="readOnly"/></td>
 
                    <?php
                   }
                    ?>
                </tr>
                <tr>
                    <td id="vendor"><b>Vendor/ Payee:</b></td><td colspan="3"><input type="text" id="Payee" name="Payee" style="width:98%;"/></td>
                </tr>
                <tr>
                    <td id="address" style="width:10%;"><b>Address:</b></td><td colspan="3"style="width:10%;"><input type="text" id="Address" name="Address" style="width:98%;"/></td>
                </tr>    
                <tr>
                    <td><b>Voucher Type:</b></td>
                    <td>
                        <select name="VTypeMain" id="VTypeMain" style="width:95%;" onchange="btnVoucherView();">
                            <option value="">Select Voucher Type</option>
                            <option value="PC">Payment By Cash</option>
                            <option value="CHQ">Payment By Cheque</option>
                            <option value="CR">Cash Received</option>
                        </select>
                    </td>
                    <td><b>Cheque Number:</b></td><td><input type="text" id="CHQ" name="ChqNo" onblur="chqIntel(this.value);" style="width:95%;"/></td>
                </tr>
                <tr><td colspan="4"><div id="errMsg" style="color:red;"></div></td></tr>
                <tr>
                    <td id="Desc" style="width:10%;"><b>Description of transaction:</b></td><td colspan="3" style="width:90%;"><input type="text" id="TDescription" style="width:98%;" name="TDescription" onkeydown="validateVType();"/></td>
                </tr>
            </table>
            
        <table id="bodyTable" style="width:100%;">
            <tr>
                <th>Check</th><th style="width:10%;">Quantity</th><th style="width:50%;">Items Purchased/ Services Received</th><th style="width:10%;">Unit Cost</th><th style="width:10%;">Cost</th><th style="width:20%;">Account</th><th style="width:20%;">CIV Code</th>
            </tr>
        </table>
        <table id="" style="width:100%;position:relative;bottom: 0;">
            <tr><td colspan="5" style="width:80%"><b>Totals:</b></td><td style="width:20%" colspan="2"><input type="text" id="totals" name="totals" style='height:2em;' readonly="readonly"/></td></tr>
        </table>
        </form>
    