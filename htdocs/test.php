<?php
include "libs/load.php";

$p = new posts(1);
echo $p->getOwner() . "<br>";
echo $p->getLike_count(). "<br>";
echo $p->getImage_uri(). "<br>";
echo $p->getPost_text();

$user = Session::getUser();
echo $user->getEmail();
?>