<?php
	foreach($data['footnotes'] as $value):
		echo "<div class='footnotes_header'>{$value->msg_from} post for Voucher Number {$value->VNumber}: <i>Posted on {$value->stmp}</i></div><br>";
		echo "<div class='footnotes_body'>{$value->msg}</div>";
	endforeach;