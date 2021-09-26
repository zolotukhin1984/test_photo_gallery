<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Controller;

class AuthController extends Controller
{
    protected $errors = [];
    protected $statuses = [];

    protected $login;
    protected $pass;

    public function __construct()
    {
        parent::__construct();
        $this->login = trim($_POST['login']);
        $this->pass = trim($_POST['pass']);
        $this->statuses = $_SESSION['statuses'] ?? [];
        unset($_SESSION['statuses']);
    }

    protected function actionIndex()
    {
        foreach ($this->errors as $errorName => $errorValue) {
            $this->view->$errorName = $errorValue;
        }
        foreach ($this->statuses as $statusName => $statusValue) {
            $this->view->$statusName = $statusValue;
        }
        $this->view->login = $this->login;
        $this->view->pass = $this->pass;
        $this->view->display(__DIR__ . '/../../templates/auth.php');
    }

    protected function actionIndexPost()
    {
        if ('' === $this->login) {
            $this->errors['error_login'] = true;
        }
        if ('' === $this->pass) {
            $this->errors['error_pass'] = true;
        }

        if ( 0 !== count( $this->errors )) {
            $this->actionIndex();
        }

        if ( 0 === count($this->errors) ) {
            if ( Auth::check($this->login, $this->pass) ) {
                // Не знаю, насколько правильно хранить объект в сессии, но пусть пока побудет
                // Если что, можно массив свойств сохранить
                $_SESSION['user'] = Auth::$user;
                header('Location: /photo');
            }

            $this->errors['error_verify'] = true;
            $this->login = null;
            $this->pass = null;

            $this->actionIndex();
        }

    }

    protected function actionLogout()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: /');
    }
}