<?php

require_once "./php/classes/Route.php";

if(Route::get(0)==="api"){
    Route::includeApi(Route::get(1).".php");
    return;
}

if(!Route::includePage(Route::get(0).".php")){
    Route::includePage("welcome.php");
}