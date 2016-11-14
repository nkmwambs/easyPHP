<?php
echo Resources::a_href('Settings/lists',"<button>Back</button>")."<br><br>";
?>

<?php
echo "<table id='info_tbl'  style='margin-top: 25px;'>";
echo "<caption style='font-weight:bold;'>Category ".$data['cat']." Users</caption>";
echo "<tr><th>Action</th><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Group</th><th>Cluster</th><th>Email</th><th>Administrator</th><th>Delegated</th><th>Department</th><th>Log Count</th><th>Active</th><th>Reffered By</th></tr>";
foreach($data['users'] as $value):
	echo "<tr>";
	if($value->auth==='1'){
		echo "<td>".Resources::img('lock.png',array("title"=>'Suspend',"style"=>"cursor:pointer;",'onclick'=>"blockUser(".$value->ID.",0);"))."</td>";
	}else{
		echo "<td>".Resources::img('unlock.png',array('title'=>'Activate',"style"=>"cursor:pointer;",'onclick'=>"blockUser(".$value->ID.",1);"))."</td>";
	}
		
		foreach($value as $val):
			echo "<td>".$val."</td>";			
		endforeach;
	echo "</tr>";
endforeach;
echo "</table>";
?>