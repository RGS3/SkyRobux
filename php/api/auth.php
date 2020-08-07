<?php
const login = "adminSkyRbx";
const password = "NCVjwdvrQWEHUIF";

if($_POST['login'] === login && $_POST['token'] === password){
    echo json_encode(['code'=>1]);
    return true;
}

echo json_encode(['code'=>0,'message'=>'Wrong login or password']);
return true;
