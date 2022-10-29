<pre>
<?php
echo "Test Password Hashing<br>";
$time = microtime(true);

$options = ['cost' => 8];
echo password_hash("Praveen", PASSWORD_BCRYPT, $options);
echo "<br>";
echo "Time To Calculate : ".microtime(true) - $time . "Seconds";
echo "<br>";
if(password_verify("Praveen", '$2y$12$k9NaHtyBj6GhtLG12PfUNOQfmOXI/5PskgvuV89HGqDedQiTyUGYS')){
    echo "Password Matched";
}else{
    echo "Failed";
}


// echo "<br><br><br>";
// $data = "Praveen";
// foreach (hash_algos() as $F){
//     $r = hash($F, $data, false);
//     printf("%-12s %3d %s\n", $F, strlen($r), $r);
// }
?>
</pre>