async function getGroupId() {
    return JSON.parse(await asyncQuery.GET({}, "/api/groupId")).id;
}
async function getPrice() {
    return JSON.parse(await asyncQuery.GET({},"/api/price")).price;
}
async function getQIWINumber() {
    return JSON.parse(await asyncQuery.GET({},"/api/number")).number;
}
function getFormData(form) {
    let formObj = typeof form === "string" ? document.getElementById(form) : form;
    let inputs = formObj.querySelectorAll("input");
    let data = {};
    inputs.forEach(input=>
    {
        if(input.type==="checkbox")
        {
            data[input.name] = input.checked;
        }
        else data[input.name] = input.value;

    });
    return data;
}
class Status
{
    constructor(container) {
        this.container = container;
        this.statusHTML = ` <div class="status flex-container line">
            <img class="icon" src="/media/imgs/error.svg" alt="">
            <p></p>
        </div>`;
        this.container.insertAdjacentHTML("beforeend",this.statusHTML)
        this.status = this.container.querySelector(".status");
    }
    show(text)
    {
        this.status.querySelector("p").innerText = text;
        this.status.classList.add("active");
    }
    hide()
    {
        this.status.classList.remove("active");
    }
}