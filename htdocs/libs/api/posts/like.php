<?php

// Path: https://photogram.praveenms.site/api/posts/like
try {
    ${basename(__FILE__, ".php")} = function () {
        if ($this->get_request_method() == "POST") {
            if ($this->isAuthenticated() and isset($this->_request['id'])) {
                $post = new Posts($this->_request['id']);
                $like = new Like($post);
                $like->toggleLike();
                $data = [
                    "LoginStatus" => $this->isAuthenticated(),
                    "PostStatus" => isset($this->_request['id']),
                    "Liked" => $like->isLiked(),
                    "msg" => "Like Toggled"
                ];
                $this->response($this->json($data), 200);
            } else {
                $data = [
                    "msg" => "You are not logged in or some problem may occured with the post"
                ];
                $this->response($this->json($data), 401);
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
