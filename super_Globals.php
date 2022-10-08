<pre>
<?php
include "libs/load.php";
print_r($_SESSION);
if(isset($_GET['clear'])){
    printf("Session clearing...\n");
    Session::unset();
}
if(Session::isset($a)){
    printf("A is assigned, value of A : ".Session::get($a)."..");
}else{
    Session::set($a, time());
    printf("Value of a is assigning now, value is : $_SESSION[$a]");
}
if(isset($_GET['destroy'])){
    printf("Session destroy...\n");
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