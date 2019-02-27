<?php

class ControllerAjax
{
    private $utm_source = '';
    private $controllerBd;

    function __construct()
    {
        $this->controllerBd = new ControllerBd();
    }

//----------------------------------------------------------------------------

    public function get_Groups($course) {
        $res = $this->controllerBd->getGroups($course);
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function get_Schedule($arr) {
        $res = $this->controllerBd->getSchedule($arr);
        if ($res["status"] === "Succes") {
              return $res["data"];
        } else {
            //здесь обработка в случае ошибки
            return $res["message"];
        }
    }

// ---------------------------------------------------------------------------
}