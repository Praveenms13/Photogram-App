<?php

try {
    echo "From Test.php <br>";
    echo "Email: " . Session::getUser()->getEmail() . "<br>";
    echo "Username: " . Session::getUser()->getUsername() . "<br>";
    echo "------------------------------------------------------------------------";
    echo "<br>";
    $posts = Posts::getAllPosts();
    foreach ($posts as $post) {
        $post = new Posts($post['id']);
        $like = new Like($post);
        $like->toggleLike();
        echo $like->isLiked();
        echo ", Post ID: " . $post->getId() . "<br>";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
