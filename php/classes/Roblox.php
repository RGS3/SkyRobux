<?php


class Roblox
{
    public $config;
    public $cookie;

    public function __construct()
    {
        $this->config = (array)json_decode(file_get_contents("./data/config.json"));
        $this->cookie = (array)json_decode(file_get_contents("./data/cookie.json"));
    }

    public function setAccount(string $login,string $password){
        return $this->getAccountCookie($login,$password);
    }

    private function getHttpCookie()
    {
        $cookie = "";

        $keys = array_keys($this->cookie);
        foreach ($keys as $key) {
            $cookie .= $key . "=" . $this->cookie[$key] . ";";
        }
        return $cookie;
    }

    private function getAccountCookie(string $login,string $password){
        $curl = curl_init('https://auth.roblox.com/v2/login');

        $headers = ['Content-Type: text/json', 'X-CSRF-TOKEN:' . $this->getLoginXCRFToken()];
        $post =
            [
                'ctype' => "Username",
                'cvalue' => $login,
                'password' => $password
            ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_getinfo($curl, CURLINFO_COOKIELIST);

        $res = curl_exec($curl);
        $code = curl_getinfo($curl,CURLINFO_RESPONSE_CODE);

        curl_close($curl);

        preg_match_all("/set-cookie: (\S+)=(\S+);/m", $res, $matches, PREG_SET_ORDER, 0);

        $cookies = [];
        foreach ($matches as $match) {
            $cookies[$match[1]] = $match[2];
        }
        $this->cookie = $cookies;
        $this->saveCookie();

        if($code != 200){
            preg_match('/"message":"([a-zA-Z .]+)/m',$res,$message);
            $message = $message[1];
            return ['code'=>0,'message'=>$message];
        }

        return ['cookie'=>$cookies,'code'=>1];
    }

    private function getLoginXCRFToken(){
        $curl = curl_init('https://api.roblox.com/sign-out/v1');

        $headers = ['Content-Type: text/json'];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, []);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $res = curl_exec($curl);
        curl_close($curl);

        preg_match("/x-csrf-token: (\S+)/m", $res, $match);

        return $match[1];
    }

    public function payout(string $id, int $amount)
    {
        $groupId = $this->config['groupId'];

        if(!$groupId)
            return ['code'=>0,'message'=>'Set group id in ./data/config.json'];

        $curl = curl_init("https://groups.roblox.com/v1/groups/" . $this->config['groupId'] . "/payouts");
        $headers =
            [
                "Content-Type: application/json;charset=UTF-8",
                "X-CSRF-TOKEN: ".$this->getXCRFToken()
            ];

        $post =
            [
                "PayoutType" => "FixedAmount",
                "Recipients" => [['recipientId' => (int)$id, 'recipientType' => "User", 'amount' => $amount]]
            ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_COOKIE, $this->getHttpCookie());
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($curl);

        curl_close($curl);

        return json_decode($res);
    }

    public function getRobuxAmount(){
        $groupId = $this->config['groupId'];
        if(!$groupId)
            return ['code'=>0,'message'=>'Set `groupId` in ./data/config.json'];

        $curl = curl_init("https://economy.roblox.com/v1/groups/$groupId/currency");

        curl_setopt($curl,CURLOPT_HTTPHEADER,["Content-Type" => "application/json;charset=UTF-8"]);
        curl_setopt($curl,CURLOPT_POST,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($curl);
        curl_close($curl);

        return ['code'=>1,'amount'=>json_decode($res)];
    }

    public function userInGroup(string $id){
        $curl = curl_init("https://groups.roblox.com/v2/users/$id/groups/roles");

        curl_setopt($curl,CURLOPT_COOKIE,$this->getHttpCookie());
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json;charset=UTF-8"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($curl);
        curl_close($curl);

        $groups = json_decode($res)->data;
        foreach ($groups as $group){
            $group = $group->group;
            if($group->id == $this->config['groupId'])
                return true;
        }

        return false;
    }

    public function getUserByLogin(string $login){
        $curl = curl_init("https://users.roblox.com/v1/usernames/users");
        $post = json_encode(['usernames'=>[$login],'excludeBannedUsers'=>false]);

        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json;charset=UTF-8"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($curl);
        curl_close($curl);

        return json_decode( $res )->data[0];
    }

    private function getXCRFToken()
    {
        $curl = curl_init('https://api.roblox.com/sign-out/v1');

        $cookie = $this->getHttpCookie();

        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json;charset=UTF-8"]);
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, []);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $res = curl_exec($curl);
        preg_match("/x-csrf-token: (\S+)/m", $res, $match);

        curl_close($curl);

        return $match[1];
    }

    function saveConfig()
    {
        $ft = fopen("./data/config.json", "w");
        fwrite($ft, json_encode($this->config));
        fclose($ft);
    }

    function saveCookie()
    {
        $ft = fopen("./data/cookie.json", "w");
        fwrite($ft, json_encode($this->cookie));
        fclose($ft);
    }
}