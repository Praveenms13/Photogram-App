<?php

try {
    $imageTmp = $_FILES['up_image'];
    $text = $_POST['up_text'];
    if (isset($imageTmp) and isset($text)) {
        $imageTmp = $_FILES['up_image']['tmp_name'];
        if (posts::registerPost($text, $imageTmp)) {
            ?>
            <script>
                console.log("Post Uploaded Successfully");
            </script>
            <?php
        } else {
            ?>
            <script>
                console.log("Post Upload Failed");
            </script>
            <?php
        }
    }
    ?>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="jumbotron-heading">Hi, <?php echo Session::getUser()->getUsername(); ?><br> Welcome To Photogram</h1>
                <p class="lead text-body-secondary">Photogram helps you connect and share with the people in your life. <br>You can Post photos here!!, For that you need to join us..</p>
                <hr class="my-3">
                <form action="/" method="post" enctype="multipart/form-data">
                    <label for="formFileLg" class="form-label"><h5>What's on your Mind?  Upload Your Memories Here !!</h5></label>
                    <textarea name="up_text" placeholder="What are you upto ?" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="file" id="up_image" name="up_image" class="form-control form-control-lg" accept="image/*">
                    <hr class="my-3">
                    <input type="submit" name="submit" value="Share Memory" class="btn btn-success">
                </form>
            </div>
        </div>
    </section>
<?php
} catch (Exception $e) {
    ?>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="jumbotron-heading">Hi, <?php echo Session::getUser()->getUsername(); ?><br> Welcome To Photogram</h1>
                <p class="lead text-body-secondary">Photogram helps you connect and share with the people in your life. <br>You can Post photos here!!, For that you need to join us..</p>
                <hr class="my-3">
                <form action="/" method="post" enctype="multipart/form-data">
                    <label for="formFileLg" class="form-label"><h5>What's on your Mind?  Upload Your Memories Here !!</h5></label>
                    <?php
                        if (isset($e)) {?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $e; ?>
                            </div>
                    <?php
                    } ?>
                    <textarea name="up_text" placeholder="What are you upto ?" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="file" id="up_image" name="up_image" class="form-control form-control-lg" accept="image/*">
                    <hr class="my-3">
                    <input type="submit" name="submit" value="Share Memory" class="btn btn-success">
                </form>
            </div>
        </div>
    </section> <?php }
