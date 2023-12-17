<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="collection-heading">
                <span>Photogram Collections</span>
            </div>
            <div class="col-md-12" id="collection-heading">
                <h3 id="total-posts">Total Posts: N/A</h3>
            </div>
        </div>
        <div class="row" id="masonry-area" style="position: relative; height: 1160px;">
            <?php
            use Carbon\Carbon;
            $posts = posts::getAllPosts();

            if ($posts == null) {
                echo "No Posts Yet";
            } else {
                foreach ($posts as $post) {
                    $postObj = new posts($post['id']);
                    $uploadedTime = Carbon::parse($postObj->getUploadedTime())->diffForHumans();
                    $authorEmail = $postObj->getAuthor();
                    $user = new user($authorEmail);
            ?>
                    <div class="col-lg-3 mb-4" id="post-<?= $post['id'] ?>" style="position: absolute; left: 0%; top: 0px;">
                        <div class="card">
                            <img class="bd-placeholder-img card-img-top" src="<?php echo $postObj->getImageUri(); ?>">
                            <div class="card-body">
                                <h7>@<?php echo $user->getUsername(); ?></h7>
                                <p class="card-text"><?php echo $postObj->getPostText(); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" data-id="80">
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-like">Like</button>
                                        <button type="button" class="btn btn-sm btn-outline-success btn-share">Share</button>
                                        <?php
                                        if (Session::isOwner($user->getEmail())) { ?>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                        <?php } ?>
                                    </div>
                                    <small class="text-muted"><?php echo $uploadedTime; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
