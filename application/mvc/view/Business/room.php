<?php

echo Resources::img("office.png",array("style"=>'width:100%;height:100%;','usemap'=>'#office'));//usemap="#planetmap" href="roomsBooking/roomName/maasai_one"
?>

<map name="office">
   <area shape="rect" coords="114,16,292,110" onclick="roomsBooking(this);" id='1' alt="Maasai One" title="Maasai One" href="#">
   <area shape="rect" coords="324,16,501,110" onclick="roomsBooking(this);" id='2' alt="Maasai Two" title="Maasai Two" href="#">
   <area shape="rect" coords="683,16,761,110" onclick="roomsBooking(this);" id='3' alt="Rev Gatu" title="Rev Gatu" href="#">
   <area shape="rect" coords="554,171,631,211" onclick="roomsBooking(this);" id='4' alt="Abardare" title="Abardare" href="#">
   <area shape="rect" coords="436,269,506,305" onclick="roomsBooking(this);" id='5' alt="Tsavo" title="Tsavo" href="#">
   <area shape="rect" coords="436,405,506,440" onclick="roomsBooking(this);" id='6' alt="Samburu" title="Samburu" href="#">
   <area shape="rect" coords="373,405,434,440" onclick="roomsBooking(this);" id='7' alt="Shaba" title="Shaba" href="#">

<?php
$maasai_one = Resources::img("unlock.png",array("id"=>"booked_maasai_one"));
$maasai_two = Resources::img("unlock.png",array("id"=>"booked_maasai_two"));
$gatu = Resources::img("unlock.png",array("id"=>"booked_gatu"));
$abardare = Resources::img("unlock.png",array("id"=>"booked_abardare"));
$tsavo = Resources::img("unlock.png",array("id"=>"booked_tsavo"));
$samburu = Resources::img("unlock.png",array("id"=>"booked_samburu"));
$shaba = Resources::img("unlock.png",array("id"=>"booked_shaba"));
foreach($data['booked'] as $value):
if($value->roomID==='1'){
	 $maasai_one =Resources::img('lock.png',array("id"=>"booked_maasai_one"));
}
if($value->roomID==='2'){
	$maasai_two =Resources::img('lock.png',array("id"=>"booked_maasai_two"));
}
if($value->roomID==='3'){
	$gatu =Resources::img('lock.png',array("id"=>"booked_gatu"));
}	
if($value->roomID==='4'){
	$abardare =Resources::img('lock.png',array("id"=>"booked_abardare"));
}
if($value->roomID==='5'){
	$tsavo =Resources::img('lock.png',array("id"=>"booked_tsavo"));
}
if($value->roomID==='6'){
	$samburu =Resources::img('lock.png',array("id"=>"booked_samburu"));
}
if($value->roomID==='7'){
	$shaba =Resources::img('lock.png',array("id"=>"booked_shaba"));
}
endforeach;
echo $maasai_one;
echo $maasai_two;
echo $gatu;
echo $abardare;
echo $tsavo;
echo $samburu;
echo $shaba;
?>
<!--
<b>View Room Details:</b>
<div id="roomDetails"></div>
-->