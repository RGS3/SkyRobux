<?php
    class Templates{
        public static function setHead(string $title="Welcome to Sky Robux")
        {?>
            <head>
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?echo $title?></title>
                <link rel="icon" href="/media/imgs/logo.ico ">
                <script src="/js/async.js"></script>
                <script src="/js/main.js"></script>
                <link rel="stylesheet" href="/styles/css/default.css">
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,800&family=Oswald:wght@700&display=swap" rel="stylesheet">
            </head>
        <?}
        public static function setHeader(string $name="header")
        {
            include "./templates/headers/".$name.".php";
        }
        public static function setFooter(string $name="footer")
        {
            include "./templates/footers/".$name.".php";
        }
    }
?>