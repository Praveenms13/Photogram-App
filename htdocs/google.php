<?php
include "libs/load.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
loadTemplate('_head')
?>

<body>
    <div class="loader"></div>
    <?php
    loadTemplate('_header');
    ?>
    <section class="jumbotron text-center" id="mainBanner">
        <div class="container">
            <h2 class="jumbotron-heading">Google Authentication will be available soon.</h2>
            <h2 class="jumbotron-heading">You can, </h2>
            <p>
                <a href="../login.php" class="btn btn-outline-secondary my-2">Continue with Email &nbsp;<i class="fa-regular fa-envelope"></i></a>

            </p>
        </div>
    </section>
    <?php
    loadTemplate('_footer');
    loadTemplate('_script');
    ?>
    <style>
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</body>

</html>