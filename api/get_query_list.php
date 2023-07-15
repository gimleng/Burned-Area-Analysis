<?php
require_once 'connect_db.php';

$show_list_array = array();
$sql = $connect->prepare("SELECT * FROM fire_point WHERE proj_display='show'");
$sql->execute();
while ($sql_show = $sql->fetch(PDO::FETCH_ASSOC)) {
    array_push($show_list_array, $sql_show['id']);
}

echo json_encode($show_list_array);
?>