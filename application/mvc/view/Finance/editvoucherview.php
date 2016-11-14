<?php
if(is_array($data)){
	print_r($data['test']);
}else{
	print($data['test']);
}

if(isset($data['error'])){
	echo $data['error'];
	exit;
}
?>


<div id='editvoucherdiv'>

<button id="" onclick="addRow('bodyTable');">Add Row</button><button onclick="editVoucher();"  id=''>Post</button><button id="" style="display:block;" onclick="delRow('bodyTable');">Delete Row</button><button onclick="previewvoucher(<?php echo $data['maxRec'];?>)">Preview</button>

<br><br><div id='info_div'></div>

<form id="myform" method='POST'>
            <input type="hidden" value="<?php echo $_SESSION['fname']; ?>" id="KENo" name="KENo"/>
            
            <table id='tblVch' style="width: 100%;">
                <colgroup><col width="10%"/><col width="15%"/><col width="10%"/><col width="15%"/></colgroup>
                <tr>
                    <th colspan="4"><?php echo $_SESSION['fname']; ?><br>COMPASSION ASSISTED PROJECT VOUCHER</th>
                </tr>

                <tr>		              
		            <td><b>Date:</b></td><td><input type="text" id="TDate" class='dateSelector validate' name="TDate" style="width:95%;"  value="<?php echo $data['cDate'];?>"  readonly="readOnly"/><input type='hidden' id="previousDate" value="<?php echo $data['cDate'];?>"/></td><td><b>Voucher Number</b></td><td><input type="text" id="VNumber" name="VNumber" style="width:95%;" value="<?php echo $data['maxRec'];?>" readonly="readOnly"/><input type="hidden" id="prevVNumber" value="<?php echo $data['maxRec']['VNumber'];?>"/></td>
                </tr>
                <tr>
                    <td id="vendor"><b>Vendor/ Payee:</b></td><td colspan="3"><input type="text" id="Payee" name="Payee" style="width:98%;" value="<?php echo $data['Payee'];?>"/></td>
                </tr>
                <tr>
                    <td id="address" style="width:10%;"><b>Address:</b></td><td colspan="3"style="width:10%;"><input type="text" id="Address" name="Address" style="width:98%;" value="<?php echo $data['Address'];?>"/></td>
                </tr>    
                <tr>
                    <td><b>Voucher Type:</b></td>
                    <td>
                    	<?php
                    		$vtype = array("PC"=>"Payment By Cash","CHQ"=>"Payment By Cheque","CR"=>"Cash Received");
                    	?>
                       <select name="VTypeMain" id="VTypeMain" style="width:95%;"  onchange="chqfld();" title="<?php echo $data['VType'];?>">
                            <option value="">Select Voucher Type</option>
                            <?php 
                            
                            	foreach ($vtype as $key=>$value) {
                            		$chkd = "";	                    		
                    				if($data['VType']===$key){
                    					$chkd="SELECTED";
                    				}
									echo '<option value="'.$key.'" '.$chkd.'>'.$value.'</option>';
								}
                            ?>
                        </select>
                    </td>
                    <?php
                    	$chqno = explode('-',$data['ChqNo']);
						$dis = 'none';
						if($data['VType']==='CHQ'){
							$dis='block';
						}
                    ?>
                    <td id='ChqNoText' style="display:<?php echo $dis;?>;"><b>Cheque Number:</b></td><td><input type="text" id="CHQ" name="ChqNo" style="width:95%;display:<?php echo $dis;?>;" value="<?php echo $chqno[0]; ?>"/></td>
                </tr>
                <tr><td colspan="4"><div id="errMsg" style="color:red;"></div></td></tr>
                <tr>
                    <td id="Desc" style="width:10%;"><b>Description of transaction:</b></td><td colspan="3" style="width:90%;"><input type="text" id="TDescription" style="width:98%;" name="TDescription" value="<?php echo $data['TDesc'];?>"/></td>
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
</div>        
    
<div id='previewdiv'></div>