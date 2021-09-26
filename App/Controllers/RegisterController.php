<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Register;
use App\Models\User;

class RegisterController extends Controller
{
    protected $errors = [];

    protected $first_name;
    protected $second_name;
    protected $email;
    protected $login;
    protected $pass;
    protected $confirm_pass;

    public function __construct()
    {
        parent::__construct();
        $this->first_name = trim($_POST['first_name']);
        $this->second_name = trim($_POST['second_name']);
        $this->email = trim($_POST['email']);
        $this->login = trim($_POST['login']);
        $this->pass = trim($_POST['pass']);
        $this->confirm_pass = trim($_POST['confirm_pass']);
    }

    protected function actionIndex()
    {
        foreach ($this->errors as $errorName => $errorValue) {
            $this->view->$errorName = $errorValue;
        }
        $this->view->first_name = $this->first_name;
        $this->view->second_name = $this->second_name;
        $this->view->email = $this->email;
        $this->view->login = $this->login;
        $this->view->pass = $this->pass;
        $this->view->confirm_pass = $this->confirm_pass;
        $this->view->display(__DIR__ . '/../../templates/register.php');
    }

    protected function actionIndexPost()
    {
        if ('' === $this->first_name) {
            $this->errors['error_first_name'] = true;
        }
        if ('' === $this->second_name) {
            $this->errors['error_second_name'] = true;
        }
        if ('' === $this->email) {
            $this->errors['error_email'] = true;
        } elseif ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
            $this->errors['error_validate_email'] = true;
        }
        if ('' === $this->login) {
            $this->errors['error_login'] = true;
        }
        if ('' === $this->pass) {
            $this->errors['error_pass'] = true;
        }

        if (0 !== count($this->errors)) {
            $this->actionIndex();
        }

        if (0 === count($this->errors)) {
            if ( Register::checkMatchingPass($this->pass, $this->confirm_pass) ) {
                $user = new User();
                $user->setData($this->first_name, $this->second_name, $this->email, $this->login, $this->pass);
                $user->save();
                $_SESSION['statuses']['new_registration'] = true;
                header('Location: /');
            }

            $this->errors['error_matching_pass'] = true;
            $this->pass = null;
            $this->confirm_pass = null;

            $this->actionIndex();
        }
    }
}