<?php

class App
{
    protected static $data = [];
    public static function Init()
    {
        date_default_timezone_set('Europe/Moscow');
        if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
            if (isset($_POST['action']) && $_POST['action'] === "ajax") {
                self::ajax($_POST['func'], $_POST['func_parm']);
            } else {
                 self::web(isset($_GET['path']) ? $_GET['path'] : 'main/');
            }
        }
    }
    
    protected static function ajax($name_func, $func_parm) {
        $controller = new ControllerAjax;
            if (!method_exists($controller, $name_func)) {
                $res["status"] = "Error";
            } else {
                $res["status"] = "Succes";
                $res["data"] = $controller->$name_func($func_parm);
            }       
        echo json_encode($res);
    }
    
    protected static function web($url)
    {
        $url = explode("/", $url);

        if (isset($url[0])) {
            $_GET['page'] = $url[0];  
        }
        else{
            $_GET['page'] = 'main';
        }

        $controllerName = 'ControllerPage_'.ucfirst($_GET['page']);
        $methodName = ucfirst($_GET['page']);     
        $fileNameController = '../controller/' . $controllerName . '.class.php';

		if ($url[0] == 'logout') {
			$controllerAuth = new ControllerAuth();
			$controllerAuth->unsetAuth();

			header('Location: /');
		} else if (!file_exists($fileNameController)) {
            $controllerName = 'ControllerPage_Error404';
            $methodName = 'Error404';
            $controller = new $controllerName();
        } else {
            $controller = new $controllerName();
            if (!method_exists($controller, $methodName)) {
                $controllerName = 'ControllerPage_Error404';
                $methodName = 'Error404';
                $controller = new $controllerName();
            }
        }

        $content_page =  $controller->$methodName();
        echo $content_page;
        
    }
}