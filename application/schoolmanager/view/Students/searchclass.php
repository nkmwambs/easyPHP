<?php


$arr = array();

$arr['Results Grid']['records'] = $data['rec'];
$arr['Results Grid']['functions'] = array(
										"3"=>"showStudents"
										);

echo Resources::db_table($arr);

?>