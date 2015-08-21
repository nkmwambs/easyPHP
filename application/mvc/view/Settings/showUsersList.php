<?php
//print_r($data['users']);
echo Resources::a_href('Settings/lists',"<button>Back</button>")."<br><br>";
?>

<!--<fieldset style="border:1px solid blue;">
	<legend>Actions</legend>
	<?php
		echo Resources::img("plus.png",array('title'=>'Add User to Category','onclick'=>'addUserToCategory("'.$data['cat'].'");'))." ".Resources::img('transfer.png',array('title'=>'Transfer User from Category'));
	?>
</fieldset>-->

<?php
echo "<table id='info_tbl'  style='margin-top: 25px;'>";
echo "<caption style='font-weight:bold;'>Category ".$data['cat']." Users</caption>";
echo "<tr><th>Action</th><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Group</th><th>Cluster</th><th>Email</th><th>Administrator</th><th>Delegated</th><th>Department</th><th>Log Count</th><th>Active</th><th>Reffered By</th></tr>";
foreach($data['users'] as $value):
	echo "<tr><td>".Resources::img('uncheck3.png')."</td>";
		foreach($value as $val):
			echo "<td>".$val."</td>";			
		endforeach;
	echo "</tr>";
endforeach;
echo "</table>";
?>