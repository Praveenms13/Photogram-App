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

        <div class="row" id="masonry-area">
            <?php
            $posts = posts::getAllPosts();

            use Carbon\Carbon;

            if ($posts == null) {
                echo "No Posts Yet";
            } else {
                foreach ($posts as $post) {
                    $postObj = new posts($post['id']);
                    $uploadedTime = Carbon::parse($postObj->getUploadedTime());
                    $uploadedTime = $uploadedTime->diffForHumans();
                    $authorEmail = $postObj->getAuthor();
                    $user = new user($authorEmail);
                    $author = $user->getUsername();
                    ?>
                    <div class="col-lg-4 mb-4" id="post-<?= $post['id'] ?>">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="<?php echo $postObj->getImageUri(); ?>" alt="image" width="100%" height="100%">
                            <div class="card-body">
                                <h7>@<?php echo $author ?></h7>
                                <p class="card-text"><?php echo $postObj->getPostText(); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" data-id="<?= $post['id'] ?>">
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
<a href="#" class="btn btn-primary scrollUp">
    <i class="fa fa-arrow-circle-o-up"></i>
</a>