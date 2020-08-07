<?php
    require_once "./php/classes/Roblox.php";
    $Roblox = new Roblox();
    echo json_encode(['id'=>$Roblox->config['groupId']]);
