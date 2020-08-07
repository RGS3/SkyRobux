<?php
const login = "adminSkyRbx";
const password = "NCVjwdvrQWEHUIF";

if($_COOKIE['login'] !== login || $_COOKIE['token'] !== password) {
    header('Location: /');
}
?>

<?require_once "php/classes/Templates.php";?>
<html>
    <? Templates::setHead("Админ-Панель | Sky Robux");?>
    <body>
        <? Templates::setHeader(); ?>
        <main class="container apanel">
            <div class="apanel__block apanel__groupId-block">
                <label for="groupId">Введите айди группы</label>
                <div class="flex-container">
                    <input type="number" name="groupId" id="groupId">
                    <button>OK</button>
                </div>
            </div>
            <div class="apanel__block apanel__course-block">
                <label for="groupId">Введите курс робаксов (Робаксы за рубль)</label>
                <div class="flex-container">
                    <input type="number" name="course" id="course">
                    <button>OK</button>
                </div>
            </div>
            <div class="apanel__block apanel__qiwi">
                <label for="qiwi">Введите номер QIWI кошелька</label>
                <div class="flex-container">
                    <input type="number" name="qiwi" id="qiwi">
                    <button>OK</button>
                </div>
            </div>
            <div class="apanel__block apanel__qiwi-token-block">
                <label for="qiwi-token">Введите токен от QIWI</label>
                <div class="flex-container">
                    <input type="text" name="qiwi-token" id="qiwi-token">
                    <button>OK</button>
                </div>
            </div>
            <div class="apanel__block apanel__roblox-account">
                <h2>Введите данные от аккаунта Roblox</h2>
                <form class="apanel__roblox-account-form">
                    <input name="login" type="text" placeholder="Логин">
                    <input name="password" type="password" placeholder="Пароль">
                    <div class="line">
                        <button type="submit">Ок</button>
                    </div>
                </form>
            </div>
        </main>
        <script src="/js/pages/apanel.js"></script>
        <script>
            let groupIdObject = {
                    input:document.querySelector(".apanel__groupId-block").querySelector("input"),
                    button:document.querySelector(".apanel__groupId-block").querySelector("button")
                }
            let courseObject = {
                input:document.querySelector(".apanel__course-block").querySelector("input"),
                button:document.querySelector(".apanel__course-block").querySelector("button")
                }
            let qiwiNumber = {
                input:document.querySelector(".apanel__qiwi").querySelector("input"),
                button:document.querySelector(".apanel__qiwi").querySelector("button")
            }
            let qiwiTokenObject = {
                input:document.querySelector(".apanel__qiwi-token-block").querySelector("input"),
                button:document.querySelector(".apanel__qiwi-token-block").querySelector("button")
            }
            let robloxAccForm = document.querySelector(".apanel__roblox-account-form");
            let apanel = new Apanel(groupIdObject,courseObject,qiwiTokenObject,robloxAccForm,qiwiNumber);
        </script>
        <? Templates::setFooter("admin-footer"); ?>
    </body>
</html>
