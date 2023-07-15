<?php
require_once 'connect_db.php';

if (isset($_POST['fire_coor']) && isset($_POST['coor_name']) && isset($_POST['radius_km'])) {
    $fire_coor = $_POST['fire_coor'];
    $coor_name = $_POST['coor_name'];
    $radius = $_POST['radius_km'];
    $status = 'open';
    $display = 'show';

    $stmt = $connect->prepare("INSERT INTO fire_point (loca_name, coordinate, radius, proj_status, proj_display, created_date) VALUES (:loca_name, :coordinate, :radius, :proj_status, :proj_display, now())");
    $stmt->bindParam(':loca_name', $coor_name, PDO::PARAM_STR);
    $stmt->bindParam(':coordinate', $fire_coor, PDO::PARAM_STR);
    $stmt->bindParam(':radius', $radius, PDO::PARAM_INT);
    $stmt->bindParam(':proj_status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':proj_display', $display, PDO::PARAM_STR);
    $result = $stmt->execute();
    echo 'pass';
} else {
    echo 'failed';
    die();
}
?>