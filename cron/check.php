<?php
    $path = realpath(__DIR__."/../php/classes/DataBase.php");
    require $path;
    $path = realpath(__DIR__."/../php/classes/Roblox.php");
    require $path;
    $path = realpath(__DIR__."/../php/classes/Qiwi.php");
    require $path;

    $Qiwi = new Qiwi();
    $pays = $Qiwi->getLastQiwiPays();
    $DataBase = new DataBase();
    $Roblox = new Roblox();

    foreach ($pays as $pay){
        try{
            if(strtotime('now') - strtotime($pay->date) > 300)
                continue;

            $sql = "INSERT INTO `donate` (id, number, amount,message,login) VALUES (?,?,?,?,?)";
            $data = [$pay->txnId,$pay->account,$pay->total->amount,"unexpected error",$pay->comment];
            $DataBase->query($sql,$data);

            $name = $pay->comment;
            $user = $Roblox->getUserByLogin($name);
            if($name !== $user->name)
                $status = "Wrong Username!";

            if(!isset($status)){
                $res = $Roblox->payout($user->id,$pay->total->amount * $Roblox->config['price']);
                if($res->errors){
                    $status = $res->errors[0]->message;
                }
            }

            if(!isset($status))
                $status = "success";

            $sql = "UPDATE `donate` SET message = ? WHERE id = ?";
            $data = [$status,$pay->txnId];
            $DataBase->query($sql,$data);
        }catch (Exception $e){
            echo "<hr>";
            echo $e;
            echo "<hr>";

        }
    }