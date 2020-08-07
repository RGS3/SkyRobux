class Apanel {
    constructor(groupIdObject,courseObject,qiwiTokenObject,robloxAccForm,qiwiNumber) {
        // Получаем объекты настроек, состоящие из инпута и кнопки
        this.groupIdObject = groupIdObject;
        this.courseObject = courseObject;
        this.qiwiTokenObject = qiwiTokenObject;
        this.robloxAccForm = robloxAccForm;
        this.qiwiNumberObject = qiwiNumber;
        this.robloxAccStatus = new Status(this.robloxAccForm);

        // Устанавливаем инпутам значение
        this.setGroupInputVal();
        this.setPriceInputVal();
        this.setQiwiNumber();

        // Определяем сабмит формы
        this.robloxAccForm.addEventListener("submit",async (e)=>
        {
            e.preventDefault();
            let data = getFormData(this.robloxAccForm);
            let response = await asyncQuery.POST(data,"/api/admin/set/robloxAccount",true);
            if(response.code===0)
            {
                this.robloxAccStatus.show(response.message);
            }
            else this.robloxAccStatus.hide();
        })

        // Определяем событие клика для кнопок
        this.groupIdObject.button.addEventListener("click",()=>
        {
            let response = asyncQuery.POST({groupId:this.groupIdObject.input.value},
                "/api/admin/set/groupId");
        });
        this.courseObject.button.addEventListener("click",()=>
        {
            let response = asyncQuery.POST({price:this.courseObject.input.value},
                `/api/admin/set/price`);
        });
        this.qiwiNumberObject.button.addEventListener("click",()=>{
            let response = asyncQuery.POST({qiwiNumber:this.qiwiNumberObject.input.value},
                `/api/admin/set/qiwiNumber`);
        });
        this.qiwiTokenObject.button.addEventListener("click",()=>{
            let response = asyncQuery.POST({qiwiToken:this.qiwiTokenObject.input.value},
                `/api/admin/set/qiwiToken`);
        });
    }
    async setGroupInputVal()
    {
        this.groupIdObject.input.value = await getGroupId();
    }
    async setPriceInputVal()
    {
        this.courseObject.input.value = await getPrice();
    }
    async setQiwiNumber()
    {
        this.qiwiNumberObject.input.value = await getQIWINumber();
    }
}