<?php

if (Session::isAuthenticated()) {
    try{
        if (Session::get('_redirectInfo') == "/settings.php"){
            $redirectPage = explode("/", Session::get('_redirectInfo'))[1];
            $redirectPage = explode(".php", $redirectPage)[0];
            Session::delete('_redirectInfo');
            usersession::dispError("Redirect Info", "Successfully redirected to " . $redirectPage . " Page");
        } else {
            usersession::dispError("Info", "Settings Page !!");
        }
    } catch (Exception $e){
        usersession::dispError("Notification Error", $e->getMessage());
    }
    print("You are logged in as " . Session::getUser()->getUsername() . "<br>");
    print("Your email is " . Session::getUser()->getEmail() . "<br>");
    print("Your phone is " . Session::getUser()->getPhone() . "<br>");
    print("This is Settings Page<br>");
} else {
    print("You are not logged in<br>");
}
