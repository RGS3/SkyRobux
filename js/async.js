const asyncQuery = {
    /**
     *
     * @param data JSON объект
     * @param url STRING адрес ссылки
     * @param json Нужно ли конвертировать в JSON-объект
     * @returns {Promise}
     */
    POST(data, url = "/", json = false) {
        return new Promise(async (resolve, reject) => {
            let xhr = new XMLHttpRequest();

            xhr.open("POST", url);

            xhr.onload = (res) => {
                resolve(json ? JSON.parse(res.target.response) : res.target.response);
            };
            xhr.send(this.createFormData(data));
        });
    },
    GET(data, url = "/", json = false) {
        return new Promise(async (resolve) => {
            let res = await fetch(url + `?${this.httpBuildQuery(data)}`);
            resolve(json ? await res.json() : await res.text());
        });
    },
    httpBuildQuery($object) {
        $str = "";
        Object.keys($object).map((key) => {
            $str += `${key}=${$object[key]}&&`;
        });
        return $str;
    },
    createFormData(data) {
        let formData = new FormData();
        Object.keys(data).map((unit) => {
            formData.append(unit, data[unit]);
        });

        return formData;
    },
};

