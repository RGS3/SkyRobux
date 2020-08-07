<footer>
    <div>
        <a class="apanel-link" href="/login">Вход</a>
    </div>
</footer>
<script>
    let link = document.querySelector(".apanel-link");
    if(location.href.includes("/apanel"))
    {
        link.href = "/logs";
        link.textContent = "Логи";
    }
    else if(location.href.includes("/logs"))
    {
        link.href = "/apanel";
        link.textContent = "Админ-Панель";
    }
</script>