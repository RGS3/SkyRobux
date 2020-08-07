<?php

    require "./php/classes/DataBase.php";

    $DataBase = new DataBase();

    $sql = "DELETE FROM `donate` WHERE UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`date`) > 1209600";
    $DataBase->query($sql,[]);