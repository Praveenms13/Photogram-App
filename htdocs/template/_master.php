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
    <main id="main">
        <div id="modalsGarbage">
            <div class="modal fade animate__animated" id="dummy-dialog-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content blur" style="box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    Session::loadTemplate(Session::currentScript());
    Session::loadTemplate('_footer');
    Session::loadTemplate('_script');
    ?>
    <script>
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
            .then(FingerprintJS => FingerprintJS.load())
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                const visitorId = result.visitorId
                setCookie("fingerprintJSid", visitorId, 1);
            });
    </script>
</body>

</html>