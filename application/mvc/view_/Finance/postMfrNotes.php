<?php
	echo "<span style='font-weight:bold;'>View Notes Here</span>";
		foreach ($data['notes'] as $value) {
			echo "<div class='footnotes_header'>Note From: {$value->userfirstname} : {$value->stmp}</div>";
			echo "<div style='background-color: #FBD850;border-bottom-left-radius: 5px;	border-bottom-right-radius: 5px;padding-left:10px;'>{$value->notes}</div><br>";
		}
?>