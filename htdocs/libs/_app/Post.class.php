<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/libs/_traits/SQLGetterSetter.trait.php";
class posts
{
    use SQLGetterSetter;
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
            // TODO: To Change the ID GEN Method
            $imageName = md5($author . time()) . image_type_to_extension(exif_imagetype($imageTmp));
            $imagePath = get_config("ImgUploadPath") . $imageName;
            if (move_uploaded_file($imageTmp, $imagePath)) {
                $imageUri = "/images/$imageName";
                $multiImageUri = '0';
                $likeCount = 0;
                $text = mysqli_real_escape_string(Database::getConnection(), $text); //TODO: TO sanitize with other methods
                $table = get_config('PostTable');
                $query = "INSERT INTO `$table` (`post_text`, `multi_image_uri`, `image_uri`, `like_count`, `uploaded_time`, `owner`) 
                VALUES (?, ?, ?, ?, now(), ?)";
                $stmt = Database::getConnection()->prepare($query);
                $stmt->bind_param("sssis", $text, $multiImageUri, $imageUri, $likeCount, $author);

                if ($stmt->execute()) {
                    echo "Post Uploaded and Registered Successfully";
                    $id = mysqli_insert_id(Database::getConnection());
                    return new posts($id);
                } else {
                    throw new Exception("Database Error");
                }
            }
        } else {
            throw new Exception("image not uploaded or some problem with image....");
        }
    }
}
