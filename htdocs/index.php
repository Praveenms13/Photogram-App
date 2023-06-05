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
    loadTemplate('_body');
    loadTemplate('_footer');
    loadTemplate('_script');
    ?>
</body>

</html>