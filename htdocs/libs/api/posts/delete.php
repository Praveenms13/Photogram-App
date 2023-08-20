<?php

try {
    ${basename(__FILE__, ".php")} = function () {
        $data = [
            "Status" => "Method allowed....",
            "Method" => $this->get_request_method(),
            "Auth" => $this->isAuthenticated()
        ];
        $this->response($this->json($data), 200);
    };
} catch (Exception $e) {
    $data = [
        "Error" => $e->getMessage()
    ];
    $this->response($this->json($data), 404);
}
