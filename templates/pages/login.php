<?php
const login = "adminSkyRbx";
const password = "NCVjwdvrQWEHUIF";

if($_COOKIE['login'] === login || $_COOKIE['token'] === password) {
    header('Location: /apanel');
}
?>
<?require_once "php/classes/Templates.php";?>
<html>
<? Templates::setHead("Вход | Sky Robux");?>
<body>
<? Templates::setHeader(); ?>
<!-- Main Container Start -->
<main class="container form-wrapper">
    <form id="login-form" class="login-form">
        <h2>Вход</h2>
        <input type="text" placeholder="Логин" name="login">
        <input type="password" placeholder="Пароль" name="token">
        <button class="line">Войти</button>
        <div class="status flex-container line">
            <img class="icon" src="/media/imgs/error.svg" alt="">
            <p></p>
        </div>
    </form>
</main>
    <? Templates::setFooter(); ?>
<script src="/js/pages/login.js">
</script>
<script>
    let loginForm = document.querySelector("#login-form");
    let status = loginForm.querySelector(".status");
    let login = new Login(loginForm,status);
</script>
</body>
</html>