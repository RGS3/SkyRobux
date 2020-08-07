<?php

class DataBase{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset = 'utf8';
    private $conn;

    var $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    # конструктор
    public function __construct()
    {
        if($_SERVER['SERVER_ADDR']=='127.0.0.1')
        {
            $this->host 	 = '127.0.0.1';
            $this->db   	 = 'skyrbx';
            $this->user 	 = 'root';
            $this->pass 	 = '';
        }else{
            $this->host 	 = '127.0.0.1';
            $this->db   	 = 'm69112_db';
            $this->user 	 = 'm69112_dbuser';
            $this->pass 	 = '28qbb5qq1d0ctx0p3q';
        }
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->conn = new PDO($dsn, $this->user, $this->pass, $this->opt);
        if($this->conn==false)
        {
            echo 'Не удалось подключиться к базе данных!<br>';
        }
    }

    # <-- ФУНКЦИИ -->

    /**
     * Обращается к базе данных
     * @param string $sql запрос
     * @param array $args массив аргументов
     * @return bool|PDOStatement
     */
    public function query(string $sql,array $args)
    {
        $query = $this->conn->prepare($sql);
        $query->execute($args);
        return $query;
    }
}
