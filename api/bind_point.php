<?php
require_once 'connect_db.php';

$id_selected = $_POST['id_list'];
$sql = $connect->prepare("SELECT * FROM fire_point WHERE id=" . $id_selected . "");
$sql->execute();
$query_result = array();

while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    $proj_id = $row['id'];
	$loca_name = $row['loca_name'];
	$coordinate = $row['coordinate'];
	$radius = $row['radius'];
    $proj_status = $row['proj_status'];
	$created_date = $row['created_date'];
	$closed_date = $row['closed_date'];
}

$query_result = [$proj_id, $loca_name, $coordinate, $radius, $proj_status, $created_date, $closed_date];
echo json_encode($query_result);
?>