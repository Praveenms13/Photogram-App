<?php


class Like
{
    use SQLGetterSetter;
    public $id;
    public $author;
    public $post_id;
    public $date;
    public $table;
    public $conn;

    public function __construct(posts $post)
    {
        $user_id = Session::getUser()->getId();
        $post_id = $post->getId();
        $this->id = md5($user_id . '_' . $post_id);
        $this->table = get_config('LikeTable');
        $this->conn = Database::getConnection();

        try {
            $this->checkIfLikeExists();
            $this->insertLike($post);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function checkIfLikeExists()
    {
        $query = "SELECT 1 FROM `$this->table` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            throw new Exception("Like Exists");
        }
    }

    private function insertLike($post)
    {
        $user_id = Session::getUser()->getId();
        $post_id = $post->getId();

        $query = "INSERT INTO `$this->table` (`id`, `user_id`, `post_id`, `like`, `timestamp`) 
              VALUES (?, ?, ?, 0, now())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->id, $user_id, $post_id);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            // Like Created
            echo "Like Created";
        } else {
            throw new Exception("Error in creating like");
        }
    }

    public function toggleLike()
    {
        $like = $this->getLike();
        if (boolval($like) == true) {
            $this->setLike(0);
        } else {
            $this->setLike(1);
        }
    }

    public function isLiked()
    {
        return boolval($this->getLike());
    }
}
