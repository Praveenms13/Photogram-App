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
?>
<section class="jumbotron text-center" id="mainBanner">
            <div class="container">
                <h2 class="jumbotron-heading">Google Authentication will be available soon.</h2>
                <h2 class="jumbotron-heading">You can, </h2>
                <p>
                    <a href="../login.php" class="btn btn-outline-secondary my-2">Continue with Email &nbsp;<i
                            class="fa-regular fa-envelope"></i></a>

                </p>
            </div>
        </section>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="dist/jquery/jquery.min.js"></script>
    <script src="dist/popper/popper.min.js" integrity=""></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.min.js"></script>
</body>

</html>