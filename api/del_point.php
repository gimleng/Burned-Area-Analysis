<?php
require_once 'connect_db.php';

if (isset($_POST['point_id'])) {
	$id_selected = $_POST['point_id'];
	$sql = $connect->prepare("SELECT * FROM fire_point WHERE id=" . $id_selected . "");
	$sql->execute();
	$query_result = array();

	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
		$proj_id = $row['id'];
		$loca_name = $row['loca_name'];
		$coordinate = $row['coordinate'];
		$radius = $row['radius'];
		$proj_status = $row['proj_status'];
		$proj_display = $row['proj_display'];
		$created_date = $row['created_date'];
		$closed_date = $row['closed_date'];
	}

	$stmt = $connect->prepare("INSERT INTO fire_point_del (id, loca_name, coordinate, radius, proj_status, proj_display, created_date, closed_date) VALUES (:id, :loca_name, :coordinate, :radius, :proj_status, :proj_display, :created_date, :closed_date)");
	$stmt->bindParam(':id', $proj_id, PDO::PARAM_INT);
	$stmt->bindParam(':loca_name', $loca_name, PDO::PARAM_STR);
	$stmt->bindParam(':coordinate', $coordinate, PDO::PARAM_STR);
	$stmt->bindParam(':radius', $radius, PDO::PARAM_INT);
	$stmt->bindParam(':proj_status', $proj_status, PDO::PARAM_STR);
	$stmt->bindParam(':proj_display', $proj_display, PDO::PARAM_STR);
	$stmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
	$stmt->bindParam(':closed_date', $closed_date, PDO::PARAM_STR);
	$result = $stmt->execute();

	$sql_del = $connect->prepare("DELETE FROM fire_point WHERE id = '" . $proj_id . "'");
	$sql_del->execute();

	echo 'pass';
} else {
	echo 'failed';
}
?>