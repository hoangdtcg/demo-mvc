<?php

//die(__DIR__.'/vendor/autoload.php');
require __DIR__ . '/vendor/autoload.php';

use App\Controller;

$dbconnect = new \App\Model\DBConnect();
$controller = new Controller\AuthorController();
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
include_once 'app/View/backend/layouts/header.php';
try {
    switch ($page){
        case 'author-list':
            $controller->showAllAuthors();
            break;
        case 'create-author':
            $controller->createAuthor();
            break;
        case 'delete-author':
            $controller->deleteAuthor();
            break;
        case 'update-author':
            $controller->updateAuthor();
            break;
        default:
            $controller->showAllAuthors();
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}
include_once 'app/View/backend/layouts/footer.php';
