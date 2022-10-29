<pre>
<?php
echo "Test Password Hashing<br>";
$time = microtime(true);

$options = ['cost' => 17];
echo password_hash("Praveen", PASSWORD_BCRYPT, $options);
echo "<br>";
echo "Time To Calculate : ".microtime(true) - $time . "Seconds";


// echo "<br><br><br>";
// $data = "Praveen";
// foreach (hash_algos() as $F){
//     $r = hash($F, $data, false);
//     printf("%-12s %3d %s\n", $F, strlen($r), $r);
// }
?>
</pre>