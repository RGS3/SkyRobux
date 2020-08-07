<?php
    require "./php/classes/Roblox.php";
    $Roblox = new Roblox();

    echo json_encode(['code'=>1,'price'=>$Roblox->config['price']]);