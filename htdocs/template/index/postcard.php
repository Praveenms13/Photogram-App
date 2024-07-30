<div class="col-lg-3 mb-4" id="post-<?= $postObj->getId(); ?>" style="position: absolute; left: 0%; top: 0px;">
    <div class="card">
        <img class="bd-placeholder-img card-img-top" src="<?php echo $postObj->getImageUri(); ?>">
        <div class="card-body">
            <h7>@<?php echo $user->getUsername(); ?></h7>
            <p class="card-text"><?php echo $postObj->getPostText(); ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group" >
                    <button type="button" data-id="<?= $postObj->getId(); ?>" class="btn btn-sm btn-outline-primary btn-like-noChange"><span class="btn-like">Like</span>&nbsp;&#x2764;&nbsp;<?php echo $postObj->getLike_count(); ?></button>
                    <button type="button" data-id="<?= $postObj->getId(); ?>" class="btn btn-sm btn-outline-success btn-share">Share</button>
                    <?php
                    if (Session::isOwner($user->getEmail())) { ?>
                        <button type="button" data-id="<?= $postObj->getId(); ?>" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                    <?php } ?>
                </div>
            </div>
            <small class="text-muted"><?php echo "Posted " . $uploadedTime; ?></small>
        </div>
    </div>
</div>