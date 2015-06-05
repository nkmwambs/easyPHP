<table style='border:2px orange solid;'>
    <caption><?php echo img_tag("userprofile.png");?> User Profile</caption>
    <tr><th align='left'>Field</th><th align='left'>Value</th></tr>
<?php

$th_array = array("username"=>array("User Name","No"),"fname"=>array("First Name","Yes"),"lname"=>array("Last Name","Yes"),"email"=>array("Email","Yes"),"admin"=>array("Administrator","No"),"auth"=>array("Aunthenticated","No"),"usrlvl"=>array("User Level","No"));
$data_array = (array)$data[0];
array_shift($data_array);
array_splice($data_array,5,1);

foreach($th_array as $key=>$value):
if($value[1]==="Yes"){    
    echo "<tr><td>".$value[0]."</td><td><input type='text' value='".$data_array[$key]."'/></td></tr>";
}  else {
    echo "<tr><td>".$value[0]."</td><td>".$data_array[$key]."</td></tr>";
}
endforeach;
?>
    <tr><td>Password</td><td><input type="password" id=''/></td></tr>
    <tr><td>Repeat Password</td><td><input type="password" id=''/></td></tr>
</table>