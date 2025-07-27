<?php

// Path: https://photogram.praveenms.in/api/posts/like
${basename(__FILE__, ".php")} = function () {
    if ($this->get_request_method() == "POST") {
        try {
            if ($this->isAuthenticated() and isset($this->_request['id'])) {
                $post = new Posts($this->_request['id']);
                $like = new Like($post);
                $like->toggleLike();
                $data = [
                    "LoginStatus" => $this->isAuthenticated(),
                    "Post Id" => $this->_request['id'],
                    "Liked" => $like->isLiked(),
                    "msg" => "Like Toggled"
                ];
                $this->response($this->json($data), 200);
            } else {
                $data = [
                    "Post Id" => $this->_request['id'],
                    "msg" => "You are not logged in or some problem may occured with the post"
                ];
                $this->response($this->json($data), 401);
            }
        } catch (Exception $e) {
            $error = array('status' => "ERROR", "msg" => $e->getMessage());
            $error = $this->json($error);
            $this->response($error, 500);
            usersession::dispError("Error !!", $data);
        }
    } else {
        $error = array('status' => 'WRONG_CALL', "msg" => "The type of call cannot be accepted by our servers, by API: REST API");
        $error = $this->json($error);
        $this->response($error, 406);
    }
};
