<?php

require_once("REST-API.class.php");
class API extends REST
{
    private $current_call;
    public $data = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function isAuthenticated()
    {
        return session::isAuthenticated();
    }

    public function getUsername()
    {
        return $_SESSION['username'];
    }

    public function die($e)
    {
        $data = [
            "Error" => $e->getMessage(),
        ];
        $response_code = 400;
        if ($e->getMessage() == ("Owner Not Found" or
            "Database Error"
        )) {
            $response_code = 404;
        }
        if ($e->getMessage() == "Access token expired, Login Again") {
            $response_code = 403;
        }
        $this->response($this->json($data), $response_code);
    }
    public function processApi()
    {
        //ALERT!!...   to prevent the sql injection here
        $func = strtolower(trim(str_replace("", "", $_REQUEST['method']))); // TODO: If api doesnt works remove / from the line
        if ((int)method_exists($this, $func) > 0) {
            $this->$func();
        } else {
            if (isset($_GET['namespace'])) {
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/libs/api/' . $_GET['namespace'];
                $file = $dir . '/' . $func . '.php';
                if (file_exists($file)) {
                    include $file;
                    $this->current_call = Closure::bind(${$func}, $this, get_class());
                    $this->$func();
                } else {
                    $this->response($this->json(['error' => 'method_not_found...']), 404);
                }
            }
        }
    }


    public function __call($method, $args)
    {
        if (is_callable($this->current_call)) {
            $this->current_call;
            return call_user_func_array($this->current_call, $args);
        } else {
            echo "Method called not if : $method is not presesnt as external function.......\n";
            $data = [
                "Error" => "Method not Callable"
            ];
            $this->response($this->json($data), 405);
        }
    }

    /*************API SPACE START*******************/

    private function about()
    {
        if ($this->get_request_method() != "POST") {
            $error = array('status' => 'WRONG_CALL', "msg" => "The type of call cannot be accepted by our servers, by File Name : Advanced API");
            $error = $this->json($error);
            $this->response($error, 406);
        }
        $data = array('version' => $this->_request['version'], 'desc' => 'This API is created by Praveen, by File Name : Advanced API');
        $data = $this->json($data);
        $this->response($data, 200);
    }

    private function verify()
    {
        include "verify.php";
    }


    /*************API SPACE END*********************/

    /*
                Encode array into JSON
            */
    private function json($data)
    {
        if (is_array($data)) {
            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            return "{}";
        }
    }
}

// Initiiate Library
function stringStart($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
