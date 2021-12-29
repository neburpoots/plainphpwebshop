<?php
if(!isset($_SESSION)) 
{ 
    session_start();     
}

require 'autoload.php';

class PatternRouter {

    private function stripParameters($uri) {
        if(str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }

    public function route($uri) {

        $uri = $this->stripParameters($uri);
        $explodedUri = explode('/', $uri);


        //REDIRECT TO THE API ROUTER IN CASE OF api in url
        if($explodedUri[0] == "api") {
            
            require __DIR__ . '/api/apirouter.php';

            $apirouter = new ApiRouter();

            $apirouter->route();
            die();
        }
        
        //Clears the user session
        if($explodedUri[0] == "logout") {
            unset($_SESSION["user"]);
            header('Location: /');
        }

        //Clears the shoppingcart session
        if($explodedUri[0] == "clearshoppingcart") {
            unset($_SESSION["shoppingcart"]);
            header('Location: /');
        }

        //FOR THE USERS
        if($explodedUri[0] == "login") {
            if(isset($_SESSION["user"])) {
                try {
                    require __DIR__ . '/controllers/' . 'usercontroller' . '.php';
                    $userController = new UserController();
                    $userController->myaccount();
                    die();
                } catch (Exception $e) {
                    http_response_code(404);
                }
            } else {
                try {
                    require __DIR__ . '/controllers/' . 'usercontroller' . '.php';
                    $userController = new UserController();
                    $userController->login();
                    die();
                } catch (Exception $e) {
                    http_response_code(404);
                }
            }

        } else if($explodedUri[0] == "register") {
            try {
                require __DIR__ . '/controllers/' . 'usercontroller' . '.php';
                $userController = new UserController();
                $userController->register();
                die();
            } catch (Exception $e) {
                http_response_code(404);
            }
        }

        if(!isset($explodedUri[0]) || empty($explodedUri[0])) {
            $explodedUri[0] = 'home';
        }
        $controllerName = $explodedUri[0] . "controller";

        if(!isset($explodedUri[1]) || empty($explodedUri[1])) {
            $explodedUri[1] = 'index';
        }

        $methodName = $explodedUri[1];

        try {
            require __DIR__ . '/controllers/' . $controllerName . '.php';
            $controllerObj = new $controllerName();
            $controllerObj->$methodName();
        } catch (Exception $e) {
            http_response_code(404);
        }
    }
}