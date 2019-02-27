<?php

class ControllerBd
{
    function __construct()
    {
        $resInfo = db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'), Config::get('db_host'), Config::get('db_port'));
        if ($resInfo["status"] === "Error") {
            echo $resInfo["message"];
            echo " - " . $resInfo["PDOException_message"];
            exit;
        }

    }

//----------------------------------------------------------------------------

    public function getGroups($course) {
        $sql_query = "SELECT groups FROM course WHERE course = $course ORDER BY groups";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getSchedule($arr) {
        $group = $arr[0];
        $day = $arr[1];
        $sql_query = "SELECT * FROM `$group` WHERE (`day` = 'time') OR (`day` = '$day')";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }
    
//----------------------------------------------------------------------------
    
}