<pre>
<?php
include "libs/load.php";
if (isset($_GET['clear'])) {
    printf("Session clearing...\n");
    Session::unset();
}


if(Session::isset($_SESSION[$a])){
    echo "A is already exist, the value of a is : ".Session::get($a);
}else{
    Session::set($a, 200);
    echo "Fixing now, A is not set, the value of a is ".Session::get($a);
}


if (isset($_GET['destroy'])) {
    echo "Session destroy...\n";
    Session::destroy();
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
print_r($_SERVER);
?>
</pre>