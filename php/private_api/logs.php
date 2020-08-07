<?php
    require_once "./php/classes/DataBase.php";

    $DataBase = new DataBase();

    $page = $_GET['page'];
    $sql = "SELECT * FROM `donate` LIMIT 50 OFFSET ?";
    echo json_encode( $DataBase->query($sql,[$page*50])->fetchAll(PDO::FETCH_ASSOC) );