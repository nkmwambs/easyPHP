
<?php
if(empty($data['rooms'])){
	echo "<div id='error_div'>Data for the Selected Room not Available</div>";
	exit;
}
//print_r($data['booked']);
//$show=0;
//$bookedBy='';
//$from ='';
//$to='';
//foreach($data['booked'] as $value):	
	//if($value->roomID===$data['rooms'][0]->roomID){
		//	$show=1;
			//$bookedBy=$value->bookedByID;
			//$from=$value->bookedFrom;
			//$to=$value->bookedTo;
	//}
//endforeach;

$arr_hrs = range(06, 19);
$arr_mins = range(0,59);

$hrs_opt='<option>Select Hours</option>';
foreach($arr_hrs as $hrs):
	if($hrs<10){
		$hrs_opt .= "<option>0{$hrs}</option>";
	}else{
		$hrs_opt .= "<option>{$hrs}</option>";
	}	

endforeach;

$mins_opt='<option>Select Minutes</option>';
foreach($arr_mins as $mins):
	if($mins<10){
		$mins_opt .= "<option>0{$mins}</option>";	
	}else{
		$mins_opt .= "<option>{$mins}</option>";
	}
	
endforeach;



echo "<table id='info_tbl' style='margin-top:30px;margin-left:auto;margin-right:auto;'>";
echo "<caption><b>Room Details</b></caption>";
	echo "<tr><td>Room Name</td><td>".$data['rooms'][0]->roomName."</td></tr>";
	echo "<tr><td>Capacity</td><td>".$data['rooms'][0]->capacity."</td></tr>";
	echo "<tr><td>Available Facilities</td><td>".$data['rooms'][0]->facilities."</td></tr>";
	
	
	if(!empty($data['booked'])){
		echo "<tr><td>Booking Status</td><td>Booked</td></tr>";
		echo "<tr><td>Booked From</td><td>".$data['booked'][0]->bookedFrom."</td></tr>";
		echo "<tr><td>Booked To</td><td>".$data['booked'][0]->bookedTo."</td></tr>";
		echo "<tr><td>Booked By</td><td>".Users::userCredentials($data['booked'][0]->bookedByID)->RealName." ".Users::userCredentials($data['booked'][0]->bookedByID)->OtherName."</td></tr>";
		//echo "<tr><td>";
	}else{
		echo "<tr><td>Booking Status</td><td>Not Booked</td></tr>";			
	}
		echo "<form id='frmBooking'>";
		echo "<tr><td>Book From</td><td><input type='text' id='bookedFromDate' name='bookedFromDate' readonly='readonly'/> Time:<SELECT id='bookedFromHrs'  name='bookedFromHrs'>".$hrs_opt."</SELECT>:<SELECT  id='bookedFromMins'   name='bookedFromMins'>".$mins_opt."</SELECT></td></tr>";
		echo "<tr><td>Book To</td><td><input type='text' id='bookedToDate' name='bookedToDate' readonly='readonly'/> Time:<SELECT  id='bookedToHrs' name='bookedToHrs'>".$hrs_opt."</SELECT>:<SELECT  id='bookedToMins' name='bookedToMins'>".$mins_opt."</SELECT></td></tr>";
		echo "<input type='hidden' name='roomID' id='roomID' value='".$data['rooms'][0]->roomID."'/>";
		echo "</form>";
		
		echo "<tr><td colspan='2'><button onclick='submitRoomBooking(\"frmBooking\");'>Book</button>";
		if(!empty($data['booked'][0])&&$data['booked'][0]->bookedByID===Resources::session()->ID){
			echo "<button onclick='expireRoomBooking(".$data['booked'][0]->bookingID.");'>Cancel Booking?</button>";
			
		}	
		echo Resources::a_href("Business/room","<button>Back</button>");	
		echo "</td></tr>";
	
	echo "<tr><th colspan='2'>Upcoming Bookings</th></tr>";
	echo "<tr><th>Date</th><th>Booking By</th></tr>";
	foreach($data['upcoming'] as $value):
		echo "<tr><td>".$value->bookedFrom." - ".$value->bookedTo."</td><td>".Users::userCredentials($value->bookedByID)->RealName."</td></tr>";
	endforeach;
echo "</table>";
?>