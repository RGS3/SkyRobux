<?php

    include_once "./php/classes/Roblox.php";
    $Roblox = new Roblox();
    $set = Route::get(3);

    if($set === "groupId"){
        if(empty($_POST['groupId']))
            return printf(json_encode(['code'=>0,'message'=>'cannot set groupId to NULL']));
        $Roblox->config['groupId'] = $_POST['groupId'];
    }

    if($set === "price"){
        if(empty($_POST['price']))
            return printf(json_encode(['code'=>0,'message'=>'cannot set price to NULL']));
        $Roblox->config['price'] = $_POST['price'];
    }

    if($set === "qiwiToken"){
        if(empty($_POST['qiwiToken']))
            return printf(json_encode(['code'=>0,'message'=>'cannot set qiwiToken to NULL']));
        $Roblox->config['qiwiToken'] = $_POST['qiwiToken'];
    }

    if($set === "qiwiNumber"){
        if(empty($_POST['qiwiNumber']))
            return printf(json_encode(['code'=>0,'message'=>'cannot set qiwiNumber to NULL']));
        $Roblox->config['qiwiNumber'] = $_POST['qiwiNumber'];
        return printf(json_encode(['code'=>1]));

    }

    if($set === "robloxAccount"){
        if(empty($_POST['login']) || empty($_POST['password']))
            return printf(json_encode(['code'=>0,'message'=>'given NULL login or password']));
        $res = $Roblox->setAccount($_POST['login'],$_POST['password']);
        if($res['code'] !== 1)
            return printf(json_encode(['code'=>$res['code'],'message'=>"ROBLOX ERROR: ".$res['message']]));

        return printf(json_encode(['code'=>1]));
    }

    $Roblox->saveConfig();

    echo json_encode(['code'=>1]);
    return true;