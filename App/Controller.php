<?php

namespace App;

abstract class Controller
{
    /**
     * @var View
     */
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Проверка на залогиненность
     * @return bool
     */
    protected function isAccess(): bool
    {
        if ( isset($_SESSION['user']) ) {
            return true;
        }
        return false;
    }

    /**
     * Определяет какой экшен контроллера вызвать
     * Контроллеры, кроме Auth и Register, не должны отрабатывать, если клиент не авторизован, поэтому редирект на /
     * Контроллеры Auth и Register не должны отрабатывать, если клиент авторизован, поэтому редирект на /photo
     * @param $action
     * @param $method
     * @return mixed
     */
    public function action($action, $method)
    {
        if ( !$this->isAccess()
            && 'App\Controllers\AuthController' !== static::class
            && 'App\Controllers\RegisterController' !== static::class ) {
            header('Location: /');
        }
        if ( $this->isAccess()
            && ('App\Controllers\AuthController' === static::class
                || 'App\Controllers\RegisterController' === static::class) ) {
            header('Location: /photo');
            }
        $methodName = 'action' . $action;
        if ('POST' === $method) {
            $methodName .= ucfirst(strtolower($method));
        }
        return $this->$methodName();
    }
}