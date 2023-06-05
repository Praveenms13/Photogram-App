<!DOCTYPE html>
<html lang="en">
<?php
Session::loadTemplate('_head')
?>

<body>
    <div class="loader"></div>
    <?php
    Session::loadTemplate('_header');
    Session::loadTemplate(Session::currentScript());
    Session::loadTemplate('_footer');
    Session::loadTemplate('_script');
    ?>
</body>

</html>