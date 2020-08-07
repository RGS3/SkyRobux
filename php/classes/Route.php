<?php

    class Route{

        static function get(int $index){
            $route = preg_split("/\//",$_GET["route"]);
            return $route[$index];
        }

        static function includePage(string $name){
            return @include ("./templates/pages/".$name);
        }

        static function includeApi(string $name){
            return @include ("./php/api/".$name);
        }

        static function includePrivateApi(string $name){
            return @include ("./php/private_api/".$name);
        }
    }