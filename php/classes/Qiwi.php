<?php

class Qiwi{
    private $token;
    public $number;
    public function __construct()
    {
        $path = realpath(__DIR__."/../../data/config.json");
        $config = (array)json_decode(file_get_contents($path));
        $this->token = $config['qiwiToken'];
        $this->number = $config['qiwiNumber'];
    }

    public function getLastQiwiPays(int $page = 0){
        $url = "https://edge.qiwi.com/payment-history/v2/persons/".$this->number."/payments?rows=10&operation=IN&sources%5B0%5D=QW_RUB";

        $curl = curl_init();
        $headers = [
            'Authorization: Bearer '.$this->token,
            'Accept: application/json',
            'Content-type: application/json',
            'Host: edge.qiwi.com'
        ];

        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);

        $result = curl_exec ($curl);//выполнение запроса
        curl_close($curl);

        return json_decode($result)->data;
    }
}