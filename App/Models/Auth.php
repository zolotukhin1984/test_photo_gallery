<?php

namespace App\Models;

use App\Db;

class Auth
{
    const TABLE = 'users';

    public static $user;

    /**
     * @param $login
     * @param $pass
     * @return User|false
     */
    public static function check($login, $pass)
    {
        $user = static::getPassByLogin($login);
        $pass_verify = password_verify($pass, $user['pass']);
        if ($pass_verify) {
            static::$user = User::findById($user['id']);
            return static::$user;
        }
        return false;
    }

    /**
     * @param $login
     * @return mixed|null
     */
    protected static function getPassByLogin($login)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `login` = :login';
        $res_array = $db->query(
            $sql,
            [
                ':login' => $login,
            ]
        );
        return $res_array ? $res_array[0] : null;
    }

}