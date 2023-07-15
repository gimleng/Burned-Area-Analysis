<?php
$dbname = "fire_emergency";
$table_name = "fire_point";
$hostname = "localhost";
$username = "gimleng";
$password = "configtion";
try {
    $connect = new PDO("pgsql:dbname=$dbname;host=$hostname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS fire_point (
        ID SERIAL NOT NULL,
        loca_name TEXT NOT NULL,
        coordinate TEXT NOT NULL,
        radius INTEGER NOT NULL,
        proj_status TEXT NOT NULL,
        proj_display TEXT NOT NULL,
        created_date DATE NOT NULL,
        closed_date DATE,
        PRIMARY KEY (ID)
      )";
    $connect->exec($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>