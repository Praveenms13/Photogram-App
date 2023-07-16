<?php

class post{
    public $id, $author, $text, $image, $date;
    public function __construct($id, $author, $text, $image, $date)
    {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->image = $image;
        $this->date = $date;
    }
}
