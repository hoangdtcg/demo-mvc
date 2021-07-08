<?php


namespace App\Controller;

use App\Model\AuthorModel;

class AuthorController
{
    protected $authorModel;

    public function __construct()
    {
        $this->authorModel = new AuthorModel();
    }

    public function showAllAuthors()
    {
        $authors = $this->authorModel->getAll();
        include_once 'app/View/backend/author/list.php';
    }

    public function createAuthor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'app/View/backend/author/create.php';
        } else {
//            var_dump(basename($_FILES["fileToUpload"]["name"]));
//            die();
            $this->uploadImage();
            $this->authorModel->create($_REQUEST);
            header('location:index.php');
        }
    }

    public function deleteAuthor()
    {
        $id = $_REQUEST['id'];
        $this->authorModel->delete($id);
        header('location:index.php');
    }

    public function updateAuthor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_REQUEST['id'];
            $author = $this->authorModel->getById($id);
            include_once 'app/View/backend/author/update.php';
        } else {
//            var_dump($_REQUEST['fileToUpload']);
//            die();
            if($_REQUEST['fileToUpload'] !== ''){
                $this->uploadImage();
            }
            $this->authorModel->update($_REQUEST);
            header('location:index.php');
        }
    }

    public function uploadImage()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
//        if ($_FILES["fileToUpload"]["size"] > 500000) {
//            echo "Sorry, your file is too large.";
//            $uploadOk = 0;
//        }

// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}