<div class="album py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12" id="collection-heading">
                <h2>Photogram Collections</h2>
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
                    Session::loadTemplate("index/postcard", [
                        "post" => $post,
                        "postObj" => $postObj,
                        "user" => $user,
                        "uploadedTime" => $uploadedTime
                    ]);
                }
            } ?>
        </div>
    </div>
</div>
