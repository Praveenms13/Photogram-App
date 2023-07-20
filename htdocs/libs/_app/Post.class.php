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
        if (isset($_FILES['up_image'])) {
            $author = Session::getUser()->getEmail();
            $imageFileType = strtolower(pathinfo($imageTmp["name"], PATHINFO_EXTENSION));
            $imageName = md5($author.time()) . "." . $imageFileType; #TODO: To Change the ID GEN Method
            $imagePath = get_config("ImgUploadPath") . $imageName;
            if (move_uploaded_file($imageTmp, $imagePath)) {
                $query = "INSERT INTO `posts` (`post_text`, `image_uri`, `like_count`, `uploaded_time`, `owner`) #TODO: To Sanitize
                VALUES (
                    '$text', 
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/HelloWorld.svg/1280px-HelloWorld.svg.png', 
                    '0', 
                    now(), 
                    '$author'
                )";
                $result = Database::getConnection()->query($query);
                if ($result) {
                    $id = mysqli_insert_id(Database::getConnection());
                    return new posts($id);
                } else {
                    throw new Exception("Database Error");
                }
            } else {
                throw new Exception("image not uploaded");
            }
        } else {
            throw new Exception("image not uploaded");
        }
    }
}
