<?php

// Path: https://photogram.praveenms.in/api/posts/count
try {
    ${basename(__FILE__, ".php")} = function () {
        $postObj = new posts($this->$_REQUEST["id"]);
        $data = [
            // "Login_Status" => $this->isAuthenticated(),
            "Post_Count" => posts::countAllPosts(),
            // "Author" => $postObj->getAuthor(),
            // "Username" => Session::getUser()->getEmail()
        ];
        $this->response($this->json($data), 200);
    };
} catch (Exception $e) {
    $data = [
        "Error" => $e->getMessage()
    ];
    $this->response($this->json($data), 404);
}
