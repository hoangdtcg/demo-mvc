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
        }catch (\PDOException $exception){
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
        }catch (\PDOException $exception){
            die($exception->getMessage());
        }

    }

    //Tạo Author
    public function create($request)
    {
        try {
            $sql = "INSERT INTO `authors`(`first_name`,`last_name`,`email`,`birthdate`) VALUES (?,?,?,?)";
            $stmt = $this->dbConnect->connect()->prepare($sql);
            $stmt->bindParam(1,$request['first-name']);
            $stmt->bindParam(2,$request['last-name']);
            $stmt->bindParam(3,$request['email']);
            $stmt->bindParam(4,$request['birthdate']);
            $stmt->execute();
        }catch (\PDOException $exception){
            echo $exception->getMessage();
        }

    }

    //Cập nhật thông tin Author
    public function update($request)
    {
        try {
            $sql = "UPDATE `authors` SET `first_name`=?,`last_name`=?,`email`=?,`birthdate`=? WHERE `id`=". $request['id'];
            $stmt = $this->dbConnect->connect()->prepare($sql);
            $stmt->bindParam(1,$request['first-name']);
            $stmt->bindParam(2,$request['last-name']);
            $stmt->bindParam(3,$request['email']);
            $stmt->bindParam(4,$request['birthdate']);
            $stmt->execute();
        }catch (\PDOException $exception){
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
        $author =  new Author($data['first_name'],$data['last_name'],$data['email'],$data['birthdate']);
        $author->setId($data['id']);
        return $author;
    }

    public function convertAllToObj($data)
    {
        $objs = [];
        foreach ($data as $item){
            $objs[] = $this->convertToObject($item);
        }
        return $objs;
    }
}