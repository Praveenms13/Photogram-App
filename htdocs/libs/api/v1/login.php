<?php

// Path: https://photogram.praveenms.site/api/v1/login
try {
    ${basename(__FILE__, ".php")} = function () {
        if ($this->get_request_method() == "POST") {
            try {
                if (isset($this->_request['username']) and isset($this->_request['password'])) {
                    $fingerprintJSid = $_COOKIE['fingerprintJSid'];
                    if (!$fingerprintJSid) { // TODO: This is only for API calls, not for web calls
                        $fingerprintJSid = uniqid();
                        setcookie('fingerprintJSid', $fingerprintJSid, time() + (86400 * 30), "/");
                    }
                    $sessionToken = usersession::authenticate($this->_request['username'], $this->_request['password'], $fingerprintJSid);
                    if (isset($this->_request['redirect'])) {
                        Session::set('_redirect', $this->_request['redirect']);
                    }
                    if ($sessionToken) {
                        $this->response($this->json(
                            [
                                'success' => 'Authentication successful',
                                'token' => $sessionToken,
                                'fingerPrintJSid' => $fingerprintJSid,
                            ]
                        ), 200);
                    } else {
                        $this->response($this->json(['message' => 'unAuthorised']), 401);
                    }
                } else {
                    $this->response($this->json(['message' => 'login_now']), 401);
                }
                // $token = Session::get('sessionToken');
                // if ($token) {
                //     $fingerprintJSid = Session::get('sessionFingerprintJSid');
                //     if (usersession::authorize($token, $fingerprintJSid)) {
                //         $username = Session::get('sessionUsername');
                //         $userclass = new user($username);
                //         if ($userclass) {
                //             $usersession = new usersession($token);
                //             $IsValid = $usersession->isValid();
                //             if ($IsValid) {
                //                 $redirectTo = Session::get('_redirect');
                //                 $defaultRedirect = Session::loadTemplate('index');
                //                 if ($redirectTo) {
                //                     $defaultRedirect = $redirectTo;
                //                     Session::delete('_redirect');
                //                 }
                //                 $this->response($this->json(['success' => 'login_success', 'redirect' => $defaultRedirect]), 200);
                //             } else {
                //                 $IsValid = null;
                //                 Session::delete('sessionUsername');
                //                 Session::delete('sessionToken');
                //                 $this->response($this->json(['error' => 'login_time_over']), 401);
                //             }
                //         } else {
                //             Session::delete('sessionUsername');
                //             $this->response($this->json(['error' => 'something_went_wrong']), 500);
                //         }
                //     } else {
                //         Session::delete('sessionUsername');
                //         $this->response($this->json(['error' => 'user_not_authorised']), 401);
                //     }
                // } else {
                //     Session::delete('sessionUsername');
                //     $this->response($this->json(['error' => 'login_now']), 401);
                // }
            } catch (Exception $e) {
                $error = $e->getMessage();
                Session::loadTemplate('_loginbody');
                $this->response($this->json(['error' => $error]), 401);
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
