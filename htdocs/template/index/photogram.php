<section class="jumbotron text-center" id="mainBanner">
    <div class="container">
        <h2 class="jumbotron-heading">Hi, <?php echo Session::getUser()->getUsername(); ?>, Welcome To Photogram</h2>
        <hr class="my-3">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="formFileLg" class="form-label"><h5>What's on your Mind?  Upload Your Memories Here !!</h5></label>
            <textarea name="up_text" placeholder="What are you upto ?" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            <input type="file" id="up_image" name="up_image" class="form-control form-control-lg" accept="image/*">
            <hr class="my-3">
            <input type="submit" name="submit" value="Upload" class="btn btn-success">
        </form>
    </div>
</section>