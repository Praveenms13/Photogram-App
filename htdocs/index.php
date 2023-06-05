<?php
include "libs/load.php";
error_reporting(0);
ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<?php
loadstarterTemplate('head')
?>

<body>
    <div class="loader"></div>
    <?php
    loadstarterTemplate('header');
    loadstarterTemplate('main');
    loadstarterTemplate('footer');
    ?>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="dist/jquery/jquery.min.js"></script>
    <script src="dist/popper/popper.min.js" integrity=""></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.min.js"></script>
</body>

</html>