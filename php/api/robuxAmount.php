<?php
    require_once "./php/classes/Roblox.php";

    $Roblox = new Roblox();
    $amount = $Roblox->getRobuxAmount();

    echo json_encode(['code'=>1,'amount'=>$amount['amount']->robux]);