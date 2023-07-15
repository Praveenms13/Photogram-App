<?php

if (Session::isAuthenticated()) {
    print("You are logged in as " . Session::getUser()->getUsername() . "<br>");
    print("Your email is " . Session::getUser()->getEmail() . "<br>");
    print("Your phone is " . Session::getUser()->getPhone() . "<br>");
    print("This is Settings Page<br>");
} else {
    print("You are not logged in<br>");
}
