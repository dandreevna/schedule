<?php
class db
{
    private static $_instance = null;
    private $db; 
     
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new db();
        }
        return self::$_instance;
    }
    
    private function __construct() {}
    private function __sleep() {}
    private function __wakeup() {}
    private function __clone() {}
     
    public function Connect($user, $password, $base, $host = 'localhost', $port = 3306)
    {
        $connectString = "mysql:host=$host;port=$port;dbname=$base;charset=utf8";
        try {
            $this->db = new PDO($connectString, $user, $password,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
                ]
            );
            return ["status" => "Succes"];
        } catch (PDOException $e) {
            return [
                "status" => "Error",
                "message" => "Ошибка соединения с базой!",
                "PDOException_message" => $e->getMessage()
            ];
        }
    }
    
    public function Query($query_string, $params_query = array())
    {
        try {
            $readyQuery = $this->db->prepare($query_string);
        } catch (PDOException $e) {
            return [
                "status" => "Error",
                "message" => "Ошибка подготовки запроса!",
                "PDOException_message" => $e->getMessage()
            ];
        }
        if (!$readyQuery) {
            return [
                "status" => "Error",
                "message" => "Ошибка подготовки запроса!"
            ];
        }

        try {
            $execStatus = $readyQuery->execute($params_query);
        } catch (PDOException $e) {
            return [
                "status" => "Error",
                "message" => "Ошибка выполнения запроса!",
                "PDOException_message" => $e->getMessage()
            ];
        }
        if ($execStatus) {
            return [
                "status" => "Succes",
                "data" => $readyQuery
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка выполнения запроса!"
            ];
    }

}

