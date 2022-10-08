<?php

include "_Includes/User.class.php";
include "_Includes/Database.class.php";
include "_Includes/Session.class.php";
Session::start();
function loadAccess($file_form)
{
    // include __DIR__ . "/../template/$file_form.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/photogram/template/$file_form.php";
}
function loadAc($file)
{
    include $_SERVER['DOCUMENT_ROOT'] . "/photogram/album/$file.php";
}
