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
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            include_once 'app/View/backend/author/create.php';
        }else{
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
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $id = $_REQUEST['id'];
            $author = $this->authorModel->getById($id);
            include_once 'app/View/backend/author/update.php';
        }else{
            $this->authorModel->update($_REQUEST);
            header('location:index.php');
        }
    }
}