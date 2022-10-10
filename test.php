<pre>
<?php
$name = "praveen";
$value = "Password";
setcookie($name, $value, time() + (86400 * 30));


$name_cookie = "userAgent";
$value_cookie = "Praveen@2003";
setcookie($name_cookie, $value_cookie, time() + (86400 * 30));


if (count($_COOKIE) > 0) {
    echo "Cookie is Enabled";
    echo "<br>";
    echo count($_COOKIE);
} else {
    echo "Cookie is Disabled";
}



echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
$conn = Database::getConnection();
echo "<br>";
echo "<br>";
echo "<br>";
class car
{
    public $carname;
    public $modelname;
    public $allprice;
    private $fueltype;
    private $seater;
    public static function testfunction($name)
    {
        printf("This is static function.....".$name);
    }
    public function setname($carname)
    {
        $this->carname = ucwords($carname);
    }
    public function changeletter($carname)
    {
        // $carname = "praveen kumar";  // for "//$cardetails_5->changeletter(" ");"
        $this->carname = ucwords($carname);
        //print($this->carname); // for "//$cardetails_5->changeletter(" ");"
    }
    private function setfuel($fueltype)
    {
        $this->fueltype = ucwords($fueltype);
    }
    public function setfuelproxy($fueltype)
    {
        return $this->setfuel($fueltype);
    }
    public function return_fueltype()
    {
        return $this->fueltype;
    }
    public function return_name()
    {
        return $this->carname;
    }
}
//public keyword assigning values
$cardetails_1 = new car();
$cardetails_2 = new car();
$cardetails_3 = new car();
$cardetails_4 = new car();
$cardetails_1->carname = "honda";
$cardetails_1->modelname = "a3";
//$cardetails_1->fueltype = "petrol";
echo $cardetails_1->carname . "<br>";
echo $cardetails_1->modelname . "<br>";
//echo $cardetails_1->fueltype . "<br>" . "<br>";
//public function accessing and printing
$cardetails_4 = new car();
$cardetails_5 = new car();
$cardetails_1->setname("artis");
$cardetails_2->setname("audi");
echo $cardetails_1->return_name();
echo "<br>";
echo $cardetails_2->return_name();
echo "<br>";

$cardetails_7 = new car();
$cardetails_7->setfuelproxy("silla neram petrol");
echo $cardetails_7->return_fueltype();
echo "<br>";

$cardetails_5 = new car();
$cardetails_5->changeletter("car model vandhu artis nu solluvanga");
echo $cardetails_5->return_name();
echo "<br>";
//$cardetails_5->changeletter(" ");

$cardetails_4->setfuelproxy("Electric");
echo $cardetails_4->return_fueltype();
//$cardetails_4->fueltype = "Petrol";


echo "<br>";
class mic
{
    private $light;
    public $controls;
    public $audio;
    public $a;
    public $b;
    public function __construct($light)
    {
        echo "Constructor is calling ..";
        $this->light = ucwords($light);
    }
    public function getlightconstructor()
    {
        return $this->light;
    }
    // public function add($a, $b){
    //   return $a+$b;
    // }
}
// $mic_3 = new mic();
// echo $mic_3->add(100,108);
$mic_1 = new mic("Hyper");
$mic_2 = new mic("boat");
echo $mic_1->getlightconstructor();
echo "<br>";
echo $mic_2->getlightconstructor();
?>
</pre>
?>
</pre>