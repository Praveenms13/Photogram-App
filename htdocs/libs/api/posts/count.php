<?php

try {
    ${basename(__FILE__, ".php")} = function () {
        $data = [
            "Login_Status" => $this->isAuthenticated(),
            "Post_Count" => posts::countAllPosts()
        ];
        $this->response($this->json($data), 200);
    };
} catch (Exception $e) {
    $data = [
        "Error" => $e->getMessage()
    ];
    $this->response($this->json($data), 404);
}
