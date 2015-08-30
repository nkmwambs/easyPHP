<?php
	//print_r($data['all_hist']);
	echo "<table id='info_tbl' style='margin-top:25;min-width:100%;'>";
	echo "<caption>Action History</caption>";
	echo "<tr><th>User Name</th><th>Action</th><th>Time</th></tr>";
	foreach($data['all_hist'] as $value):
		echo "<tr><td>".$value->user_full_name."</td><td>".$value->action."</td><td>".$value->stmp."</td></tr>";
	endforeach;
	echo "</table>";
?>