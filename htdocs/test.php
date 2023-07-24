<?php
include "libs/load.php";
echo "From Test.php <br>";
echo "Email: " . Session::getUser()->getEmail() . "<br>";
$p = new posts(1);
echo "Username of an Post: " . $p->getOwner() . "<br>";
echo $p->getLike_count(). "<br>";
echo $p->getImage_uri(). "<br>";
echo $p->getPost_text();

$user = Session::getUser();
echo "User Email: " . $user->getEmail();
?>