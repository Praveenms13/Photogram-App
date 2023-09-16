<?php

// Path: https://photogram.praveenms.site/api/v1/signup
try {
    ${basename(__FILE__, ".php")} = function () {
        if ($this->get_request_method() == "POST") {
            try { 
                if (isset($this->_request['username']) and isset($this->_request['password']) and isset($this->_request['email'])) {
                    $error = user::signup($this->_request['username'], $this->_request['phone'], $this->_request['email'], $this->_request['password']);
                    if ($error == null) {
                        $data = [
                            "Message" => "signup_success",
                            "Status" => "200",
                            "Auth state" => "Authenticated",
                            "Any error" => $error
                        ];
                        $this->response($this->json($data), 200);
                    } else {
                        $data = [
                            "message" => $error
                        ];
                        $this->response($this->json($data), 401);
                    }
                } else {
                    $this->response($this->json(['message' => 'signup_now']), 401);
                }
            } catch (Exception $e) {
                $data = [
                    "Error" => $e->getMessage()
                ];
                $this->response($this->json($data), 404);
            }
        } else {
            $error = array('status' => 'WRONG_CALL', "msg" => "The type of call cannot be accepted by our servers, by API: REST API");
            $error = $this->json($error);
            $this->response($error, 406);
        }
    };
} catch (Exception $e) {
    $data = [
        "Error" => $e->getMessage()
    ];
    $this->response($this->json($data), 404);
}
