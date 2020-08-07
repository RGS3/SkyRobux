class MainForm
{
    constructor(form,rublesInput,robuxInput,robuxAviable,groupLink,robuxCourseText) {
        // Получаем все нужные элементыф
        this.form = form;
        this.rublesInput = rublesInput;
        this.robuxInput = robuxInput;
        this.groupLink = groupLink;
        this.robuxCourseText = robuxCourseText;
        this.robuxAviable = robuxAviable;
        this.status = new Status(this.form);
        this.aviablity = true;
        // Добавляем события для кеонвертации робаксов в рубли и ноборот
        this.rublesInput.addEventListener("input",()=>
        {
            this.robuxInput.value = Math.floor(this.rublesInput.value*this.course);
            this.checkAviablity(+this.robuxInput.value);
        });
        this.robuxInput.addEventListener("input",()=>
        {
            this.rublesInput.value = Math.ceil(this.robuxInput.value/this.course);
            this.checkAviablity(+this.robuxInput.value);
        });

        // Добавляем событие при отправке формы
        this.form.addEventListener("submit", async (e)=>{
            e.preventDefault();
            this.status.hide();
            if(this.aviablity)
            {
                let data = getFormData(this.form);
                if(data.agree)
                {
                    let qiwiNumber = await getQIWINumber();
                    location.href = `https://qiwi.com/payment/form/99?currency=RUB&amount=${data.rubles}&extra%5B%27account%27%5D=${qiwiNumber}&extra%5B%27comment%27%5D=${data.name}`;
                }
                else
                {
                    this.status.show("Вы должны принять пользовательское соглашение, чтобы продолжить");
                }
            }
            else
            {
                this.status.show("В наличии нет столько робаксов");
            }
        });

        // Получаем необходимые значения
        this.setGroupLink();
        this.getRobuxCount();
        this.setPrice();
    }
    async getRobuxCount()
    {
        let response = JSON.parse(await asyncQuery.GET({},"/api/robuxAmount"));
        if(response.code===1)
        {
            // Устанваливаем доступное кол-во робаксов
            this.robuxAviable.innerText = response.amount;
        }
    }
    async setGroupLink()
    {
        // Устанавливаем ссылку на группу
        this.groupLink.href = `https://www.roblox.com/groups/${await getGroupId()}`;
    }
    async setPrice()
    {
        this.course = await getPrice();
        this.robuxCourseText.innerText = `1/${this.course}`;
    }
    checkAviablity(value)
    {
        if(value>+this.robuxAviable.innerText)
        {
            this.aviablity = false;
            this.robuxInput.style.borderColor = "red";
        }
        else
        {
            this.aviablity = true;
            this.robuxInput.style.borderColor = "var(--border-color)";
        }
    }
}