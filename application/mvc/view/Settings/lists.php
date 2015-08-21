<?php
//print_r($data);
?>
<div id='rst'>
	<!--<fieldset style="border:1px solid blue;">
	<legend>Actions</legend>
		<?php echo Resources::img("plus.png",array('title'=>'Add Group'));?>
	</fieldset>-->
        <table id='info_tbl' style="margin-top: 25px;">
            <thead><tr><th>Edit</th></th><th>Category ID</th><th>Category</th><th># Of Users</th></tr></thead>
            <tbody>
                <?php foreach($data['all'] as $value){ ?>
                <tr><td><?php echo Resources::img('diskedit.png',array('title'=>'Edit Group','style'=>'cursor:pointer;')).Resources::img('doc.png',array('title'=>'View Users','style'=>'cursor:pointer;','onclick'=>'showUsersList("'.$value->pstID.'");'));?></td></td><td><?php echo $value->pstID  ?></td><td><?php echo $value->dsgn;?></td><td>&nbsp;</td></tr>
                <?php } ?>
            </tbody>
        </table>
</div>