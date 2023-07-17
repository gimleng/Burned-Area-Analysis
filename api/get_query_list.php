<?php
require_once 'connect_db.php';

if (isset($_POST['point_show'])) {
    $point_show = $_POST['point_show'];
    $show_list_array = array();
    if ($point_show == 'active') {
        $sql = $connect->prepare("SELECT * FROM fire_point WHERE proj_display='show' AND proj_status='open'");
        $sql->execute();
        while ($sql_show = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($show_list_array, $sql_show['id']);
        }
    } else if ($point_show == 'deactive') {
        $sql = $connect->prepare("SELECT * FROM fire_point WHERE proj_display='show' AND proj_status='closed'");
        $sql->execute();
        while ($sql_show = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($show_list_array, $sql_show['id']);
        }
    } else {
        $sql = $connect->prepare("SELECT * FROM fire_point WHERE proj_display='show' AND id=" . $point_show . "");
        $sql->execute();
        while ($sql_show = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($show_list_array, $sql_show['id']);
        }
    }
    echo json_encode($show_list_array);
} else {
    $show_list_array = array();
    echo json_encode($show_list_array);
}
?>