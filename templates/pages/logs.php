<?php
const login = "adminSkyRbx";
const password = "NCVjwdvrQWEHUIF";

if($_COOKIE['login'] !== login || $_COOKIE['token'] !== password) {
    header('Location: /');
}
?>
<?require_once "php/classes/Templates.php";?>
<html>
    <? Templates::setHead("Логи | Sky Robux");?>
    <body>
        <? Templates::setHeader(); ?>
        <main class="container logs-full-wrapper">
            <div class="logs-wrapper">

            </div>
        </main>
        <? Templates::setFooter("admin-footer"); ?>
    </body>
<script src="/js/pages/logs.js"></script>
    <script>
        let logsFullWrapper = document.querySelector(".logs-full-wrapper");
        let logsContainer = document.querySelector(".logs-wrapper");
        let logs = new Logs(logsFullWrapper,logsContainer);
    </script>
</html>
