<?php

// Path: https://photogram.praveenms.site/api/posts/delete
try {
    ${basename(__FILE__, ".php")} = function () {
        if ($this->get_request_method() == "POST") {
            if (!$this->isAuthenticated()) {
                $data = [
                    "msg" => "User Not Logged In"
                ];
                $this->response($this->json($data), 401);
            }
            if (isset($this->_request['id'])) {
                $postObj = new posts($this->_request['id']);
                if ($postObj->getAuthor() == Session::getUser()->getEmail()) {
                    if ($postObj->delete()) {
                        $this->response($this->json(['success' => 'post_deleted']), 200);
                    } else {
                        $this->response($this->json(['error' => 'post_not_deleted']), 500);
                    }
                } else {
                    $this->response($this->json(['error' => 'unauthorized']), 401);
                }
            } else {
                $this->response($this->json(['error' => 'post_id_not_found']), 400);
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
    usersession::dispError("Error !!", $data);
}
