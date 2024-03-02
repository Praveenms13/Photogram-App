<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/libs/_traits/SQLGetterSetter.trait.php";

use Carbon\Carbon; // including a namespace

class posts
{
    use SQLGetterSetter; // including a trait
    public $id;
    public $author;
    public $text;
    public $imageTmp;
    public $date;
    public $table;
    public $conn;

    public function __construct($id)
    {
        $this->id = $id;
        $this->table = get_config('PostTable');
        $this->conn = Database::getConnection();
    }

    public static function registerPost($text, $imageTmp)
    {
        if (!Session::isAuthenticated()) {
            throw new Exception("User Not Logged In");
        }
        if (!isset($text) or !isset($imageTmp)) {
            throw new Exception("Invalid Parameters");
        }
        if (is_file($imageTmp) and exif_imagetype($imageTmp) != false) {
            $author = Session::getUser()->getEmail();
            $authorId =  Session::getUser()->getId();
            // TODO: To Change the ID GEN Method
            $imageName = md5($author . time()) . image_type_to_extension(exif_imagetype($imageTmp));
            $imagePath = get_config("ImgUploadPath") . $imageName;
            if (move_uploaded_file($imageTmp, $imagePath)) {
                $imageUri = "/files/$imageName";
                $multiImageUri = '0';
                $likeCount = 0;
                $text = mysqli_real_escape_string(Database::getConnection(), $text); // TODO: Sanitize with other methods
                $table = get_config('PostTable');
                $query = "INSERT INTO `$table` (`author`, `author_id`, `post_text`, `image_uri`, `multi_image_uri`, `like_count`, `uploaded_time`) 
                          VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
                $connection = Database::getConnection();
                $statement = $connection->prepare($query);
                $statement->bind_param("ssssii", $author, $authorId, $text, $imageUri, $multiImageUri, $likeCount);
                $result = $statement->execute();
                if ($result) {
                    return new posts($connection->insert_id);
                } else {
                    throw new Exception("Failed to register post");
                }
            } else {
                throw new Exception("Image not found or not uploaded properly");
            }
        } else {
            throw new Exception("Invalid Image or Image Type !!");
        }
    }

    public static function getAllPosts()
    {
        $table = get_config('PostTable');
        $query = "SELECT * FROM `$table` ORDER BY `uploaded_time` DESC";
        $result = Database::getConnection()->query($query);
        if ($result->num_rows > 0) {
            $posts = array();
            return iterator_to_array($result);
        } else {
            return null;
        }
    }

    public static function countAllPosts()
    {
        $table = get_config('PostTable');
        $query = "SELECT COUNT(*) as count FROM `$table` ORDER BY `uploaded_time` DESC";
        $result = Database::getConnection()->query($query);
        if ($result->num_rows > 0) {
            $posts = array();
            return iterator_to_array($result)[0]['count'];
        } else {
            return null;
        }
    }
}
