<?php
    const login = "adminSkyRbx";
    const password = "NCVjwdvrQWEHUIF";

    if($_COOKIE['login'] === login && $_COOKIE['token'] === password){
        $routes =
            [
                'set'=>"set.php",
                'logs'=>"logs.php"
            ];

        if(!Route::includePrivateApi($routes[Route::get(2)])){
            echo json_encode(['code'=>0,'message'=>'bad request']);
        }
    }else{
        echo json_encode(['code'=>0,'message'=>'Wrong login/password']);
    }