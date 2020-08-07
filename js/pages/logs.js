let months = [
    "января",
    "февраля",
    "марта",
    "апреля",
    "мая",
    "июня",
    "июля",
    "августа",
    "сентября",
    "октября",
    "ноября",
    "декабря",
]
class Logs
{
    constructor(logsFullWrapper,logsContainer) {
        this.logsFullWrapper = logsFullWrapper;
        this.logsContainer = logsContainer;
        this.currentPage = 0;
        document.addEventListener("DOMContentLoaded",()=>{
            this.getLogs(0);
        });

    }
    async getLogs(page)
    {
        let button = this.logsFullWrapper.querySelector(".load-more");
        if(button) button.remove();
        let logs = JSON.parse(await asyncQuery.GET({page},"/api/admin/logs"));
        for(let log of logs)
        {
            this.appendLog(log);
        }
        if(logs.length===50)
        {
            this.logsFullWrapper
                .insertAdjacentHTML("beforeend",`<div class="load-more-wrapper">
                <button class="load-more">Загрузить больше</button>
            </div>`);
            this.logsFullWrapper.querySelector(".load-more").addEventListener("click",()=>{
                this.getLogs(++this.currentPage);
            });
        }
    }
    appendLog(log)
    {
        let logDate = new Date(log.date);
        let logHTML = `<div class="log" id="${log.id}">
            <div class="log__user">
                <p>Пользователь: <span>${log.login}</span></p>
            </div>
            <div class="log__amount">
                <p>Сумма: <span>${log.amount} R$</span></p>
            </div>
            <div class="log__number">
                <p>Номер: <span>${log.number}</span></p>
            </div>
            <div class="log__status">
                <p>Статус: <span>${log.message}</span></p>
            </div>
            <div class="log__time">
                <p>${logDate.getDate()} ${months[logDate.getMonth()]} ${logDate.getFullYear()} в ${logDate.toLocaleTimeString().slice(0,5)}</p>
            </div>
        </div>`;
        this.logsContainer.insertAdjacentHTML("afterbegin",logHTML);
    }
}