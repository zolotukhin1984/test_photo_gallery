<?php

namespace App\Models;

use App\Db;
use App\Model;

class User extends Model
{
    const TABLE = 'users';

    public $first_name;
    public $second_name;
    public $email;
    public $login;
    public $pass;

    /**
     * @param string $first_name
     * @param string $second_name
     * @param string $email
     * @param string $login
     * @param string $pass
     */
    public function setData(string $first_name, string $second_name, string $email, string $login, string $pass)
    {
        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->email = $email;
        $this->login = $login;
        $this->pass = $this->hashPass($pass);
    }

    /**
     * @param $login
     * @return mixed|null
     */
    public static function getByLogin($login)
    {
        $db = new Db();
        $sql = 'SELECT * FROM `' . static::TABLE . '` WHERE `login` = :login';
        $resArray = $db->query(
            $sql,
            [
                ':login' => $login,
            ],
            static::class
        );
        return $resArray ? $resArray[0] : null;
    }

    /**
     * @param string $pass
     * @return false|string|null
     */
    protected function hashPass(string $pass)
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

}