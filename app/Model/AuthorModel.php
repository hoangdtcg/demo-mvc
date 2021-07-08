<?php


namespace App\Model;

class AuthorModel //CRUD with Database
{
    private $dbConnect;

    public function __construct()
    {
        $this->dbConnect = new DBConnect();
    }

    //Lấy ra toàn bộ Author
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM `authors` ORDER BY `id` DESC";
            $stmt = $this->dbConnect->connect()->query($sql);
            $stmt->execute();
            return $this->convertAllToObj($stmt->fetchAll());
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }

    }

    //Lấy ra Author theo id
    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM `authors` where `id`= $id";
            $stmt = $this->dbConnect->connect()->query($sql);
            $stmt->execute();
            return $this->convertToObject($stmt->fetch());
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }

    }

    //Tạo Author
    public function create($request)
    {
//        var_dump($_FILES['fileToUpload']['name']);
//        die();
        $url = 'uploads/'.$_FILES['fileToUpload']['name'];
        try {
            $sql = "INSERT INTO `authors`(`first_name`,`last_name`,`email`,`birthdate`,`url_image`) VALUES (?,?,?,?,?)";
            $stmt = $this->dbConnect->connect()->prepare($sql);
            $stmt->bindParam(1, $request['first-name']);
            $stmt->bindParam(2, $request['last-name']);
            $stmt->bindParam(3, $request['email']);
            $stmt->bindParam(4, $request['birthdate']);
            $stmt->bindParam(5, $url);
            $stmt->execute();
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }

    }

    //Cập nhật thông tin Author
    public function update($request)
    {
        $author = $this->getById($_REQUEST['id']);
//        var_dump($_FILES['fileToUpload']['name']);
//        die();
        if ($_FILES['fileToUpload']['name'] == '') {
            $url = $author->getUrlImage();
        } else {
            $url = 'uploads/'.$_FILES['fileToUpload']['name'];
        }

        try {
            $sql = "UPDATE `authors` SET `first_name`=?,`last_name`=?,`email`=?,`birthdate`=?,`url_image`=? WHERE `id`=" . $request['id'];
            $stmt = $this->dbConnect->connect()->prepare($sql);
            $stmt->bindParam(1, $request['first-name']);
            $stmt->bindParam(2, $request['last-name']);
            $stmt->bindParam(3, $request['email']);
            $stmt->bindParam(4, $request['birthdate']);
            $stmt->bindParam(5, $url);
            $stmt->execute();
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    //Xoá Author theo id
    public function delete($id)
    {
        $sql = "DELETE FROM `authors` WHERE `id` = $id";
        $stmt = $this->dbConnect->connect()->query($sql);
        $stmt->execute();
    }

    public function convertToObject($data)
    {
        $author = new Author($data['first_name'], $data['last_name'], $data['email'], $data['birthdate']);
        $author->setId($data['id']);
        if ($data['url_image'] == null) {
            $author->setUrlImage('uploads/default/default-avatar.jpeg');
        } else {
            $author->setUrlImage($data['url_image']);
        }
        return $author;
    }

    public function convertAllToObj($data)
    {
        $objs = [];
        foreach ($data as $item) {
            $objs[] = $this->convertToObject($item);
        }
        return $objs;
    }
}