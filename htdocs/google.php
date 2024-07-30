<?php
include "libs/load.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
Session::loadTemplate('_head')
?>

<body>
    <div class="loader"></div>
    <?php
    Session::loadTemplate('_header');
    ?>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
            <h2 class="jumbotron-heading">Google Authentication will be available soon.</h2>
            <h2 class="jumbotron-heading">You can, </h2>
            <p>
                <a href="../login.php" class="btn btn-outline-secondary my-2">Continue with Email &nbsp;<i class="fa-regular fa-envelope"></i></a>

            </p>
            </div>
        </div>
    </section>     <?php
    Session::loadTemplate('_footer');
    Session::loadTemplate('_script');
    ?>
</body>

</html>