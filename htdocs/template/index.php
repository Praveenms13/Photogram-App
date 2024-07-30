<main id="main" role="main">
    <?php
    if (Session::isAuthenticated()) {
        Session::loadTemplate('index/photogram');
    } else {
        Session::loadTemplate('index/login');
    }
    Session::loadTemplate('index/cards');
    ?>
</main>