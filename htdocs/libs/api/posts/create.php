<?php

use Carbon\Carbon;

// Path: https://photogram.praveenms.site/api/posts/add
${basename(__FILE__, ".php")} = function () {
    if ($this->get_request_method() == "POST") {
        try {
            if (!$this->isAuthenticated()) {
                $data = [
                    "msg" => "User Not Logged In"
                ];
                $this->response($this->json($data), 401);
            }
            if (isset($this->_request['post_text']) and isset($_FILES['post_image'])) {
                $imageTmp = $_FILES['post_image']['tmp_name'];
                $text = $this->_request['post_text'];
                $post = posts::registerPost($text, $imageTmp);
                if ($post) {
                    Session::loadtemplate(
                        "index/postcard",
                        [
                            "msg" => "Post Uploaded successfully",
                            "postObj" => $post,
                            "user" => Session::getUser(),
                            "uploadedTime" => Carbon::parse($post->getUploadedTime())->diffForHumans(),
                        ]
                    );
                } else {
                    Session::loadTemplate("index/postcard.php", [
                        "msg" => "Post Upload Failed"
                    ]);
                }
            } else {
                $data = [
                    "Post Id" => $this->_request['id'],
                    "msg" => "Some problem have occured with the post",
                    "datas got" => print_r($this->_request, true)
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
