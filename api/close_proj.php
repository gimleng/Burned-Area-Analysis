<?php
require_once 'connect_db.php';
if (isset($_POST['id_selected'])) {
    $id_selected = $_POST['id_selected'];
    $proj_status = 'closed';

    $sql = $connect->prepare("UPDATE fire_point SET proj_status=:proj_status, closed_date=now() WHERE id='" . $id_selected . "'");
    $sql->bindParam(':proj_status', $proj_status, PDO::PARAM_STR);
    $result = $sql->execute();

    if ($result) {
        echo 'completed';
    } else {
        echo 'failed';
    }
} else {
    echo 'NoID';
}
?>