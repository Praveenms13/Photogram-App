<!DOCTYPE html>
<html lang="en">
<?php
loadTemplate('_head')
?>

<body>
    <div class="loader"></div>
    <?php
    loadTemplate('_header');
    loadTemplate(Session::currentScript());
    loadTemplate('_footer');
    loadTemplate('_script');
    ?> 
</body>

</html>