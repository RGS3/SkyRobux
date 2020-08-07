<? require_once "./php/classes/Templates.php";?>
<html>
<? Templates::setHead("Добро Пожаловать | Sky Robux");?>
<body>
<? Templates::setHeader(); ?>
<!-- Main Container Start -->
<main class="container form-wrapper">
    <form class="main-form">
        <div class="main-form__title line">
            <h2>Покупка робаксов</h2>
        </div>
        <div class="main-form__robux-aviable-block line">
            <p>В наличии <span class="main-form__robux-aviable"><span class="loading"></span></span> шт.</p>
        </div>
        <div class="main-form__warning-block line flex-container">
            <img class="icon margined-icon_right" src="/media/imgs/warning.svg" alt="">
            <p>Для получения <span class="robux">R$</span> нужно присоединиться к <a class="blue-link group-link" target="_blank" href="#">группе</a></p>
        </div>
        <div class="main-form__input-wrapper line flex-container main-form__nickname">
            <img class="icon margined-icon_right" src="/media/imgs/user.svg" alt="">
            <input name="name" type="text" placeholder="Введите ваш ник">
        </div>
        <div class="main-form__converter flex-container line">
            <div class="main-form__rubles-wrapper main-form__values-wrapper flex-container">
                <img class="icon margined-icon_right animated-icon" src="/media/imgs/ruble.svg" alt="">
                <input name="rubles" id="rubles" type="number">
            </div>
            <div class="main-form__spinning-arrows">
                <img class="icon" src="/media/imgs/arrows.svg" alt="">
            </div>
            <div class="main-form__robux-wrapper main-form__values-wrapper flex-container">
                <input name="robux" id="robux" type="number">
                <img class="icon margined-icon_left animated-icon" src="/media/imgs/robux.svg" alt="">
            </div>
        </div>
        <div class="line main-form__robux-course-wrapper">
            <p>Курс на робаксы <span class="main-form__robux-course">1/3</span></p>
        </div>
        <div class="line main-form__payment-method">
            <p>Способ оплаты:</p>
            <img src="/media/imgs/qiwi.png" alt="">
        </div>
        <div class="line main-form__agreement flex-container">
            <div class="checkbox">
                <input type="checkbox" name="agree" id="agreement">
                <label for="agreement"></label>
            </div>
            <p>Я согласен с условиями <a href="/user-agreement">пользовательского соглашения</a></p>
        </div>
        <div class="line main-form__submit-block">
            <button type="submit">Купить</button>
        </div>
    </form>
</main>
<!-- Main Container End -->
<? Templates::setFooter(); ?>
</body>
<script src="/js/pages/index.js"></script>
<script>
    let form = document.querySelector(".main-form");
    let rublesInput = form.querySelector("#rubles");
    let robuxInput = form.querySelector("#robux");
    let robuxAviable = form.querySelector(".main-form__robux-aviable");
    let groupLink = form.querySelector(".group-link");
    let robuxCourseText = form.querySelector(".main-form__robux-course");
    let mainForm = new MainForm(form,rublesInput,robuxInput,robuxAviable,groupLink,robuxCourseText);
</script>
</html>