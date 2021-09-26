<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Photo;
use App\Models\User;

class PhotoController extends Controller
{
    protected $errors = [];
    protected $statuses = [];

    public function __construct()
    {
        parent::__construct();
        $this->statuses = $_SESSION['statuses'] ?? [];
        unset($_SESSION['statuses']);
        $this->errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);
    }

    protected function actionIndex()
    {;
        foreach ($this->errors as $errorName => $errorValue) {
            $this->view->$errorName = $errorValue;
        }
        unset($this->errors);
        foreach ($this->statuses as $statusName => $statusValue) {
            $this->view->$statusName = $statusValue;
        }
        unset($this->statuses);

        $user_id = $_SESSION['user']->id;
        $this->view->photos = Photo::findAllByUserId($user_id);
        $this->view->login = $_SESSION['user']->login;
        $this->view->display(__DIR__ . '/../../templates/photo.php');
    }

    protected function actionIndexPost()
    {
        if (0 !== $_FILES['img']['error'] && 4 !== $_FILES['img']['error']) {
            $this->errors['error_upload'] = true;
            $this->actionIndex();
        }
        if (4 !== $_FILES['img']['error']
            && 'image/jpg' !== $_FILES['img']['type']
            && 'image/png' !== $_FILES['img']['type']
            && 'image/gif' !== $_FILES['img']['type']) {
            $_SESSION['errors']['error_type'] = true;
            header('Location: /photo');
        }
        $photo = new Photo(
            $_FILES['img']['tmp_name'],
            $_FILES['img']['type'],
            $_FILES['img']['size'],
            $_SESSION['user']
        );
        $res = $photo->save();
        if (true === $res) {
            $_SESSION['statuses']['added_photo'] = true;
        }
        header('Location: /photo');
    }

    protected function actionDeletePost()
    {
        Photo::delete( (int)$_POST['delete'] );
        header('Location: /photo');
    }
}