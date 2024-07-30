<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <p class="jumbotron-heading jumbotron-heading-custom">Hi, <?php echo Session::getUser()->getUsername(); ?><br> Welcome To Photogram</p>
            <hr class="my-3">
            <form action="/" method="post" enctype="multipart/form-data">
                <label for="formFileLg" class="form-label">
                    <h5>What's on your Mind? Upload Your Memories Here !!</h5>
                </label>
                <textarea name="post_text" id="post_text" placeholder="What are you upto ?" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                <input type="file" name="post_image" id="post_image" class="form-control form-control-lg" accept="image/*">
                <hr class="my-3">
                <button type="button" class="btn btn-primary" name="submit" id="share-memory" value="Share Memory">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" style="display: none;"></span>
                    <span role="status" class="post-status">Share Memory</span>
                </button>
            </form>
            <script>
                const shareMemoryBtn = document.getElementById('share-memory');
                const spinner = shareMemoryBtn.querySelector('.spinner-border');
                const statusText = shareMemoryBtn.querySelector('.post-status');
                shareMemoryBtn.addEventListener('click', () => {
                    spinner.style.display = 'inline-block';
                    statusText.textContent = 'Sharing memory...';
                    setTimeout(() => {
                        spinner.style.display = 'none';
                        statusText.textContent = 'Share Memory';
                    }, 1500);
                });
            </script>
        </div>
    </div>
</section>