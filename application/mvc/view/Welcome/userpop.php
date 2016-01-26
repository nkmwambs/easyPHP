<?php

foreach ($data as $value) {
	echo "<span class='items' onclick='getUser(\"".$value->username."\")'>".$value->userfirstname." ".$value->userlastname."</span><br>";
}
?>