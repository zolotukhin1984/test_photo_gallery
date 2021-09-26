<?php

namespace App\Models;

class Register
{
    const TABLE = 'users';

    public static $user;

    /**
     * @param $pass1
     * @param $pass2
     * @return bool
     */
    public static function checkMatchingPass($pass1, $pass2): bool
    {
        if ($pass1 === $pass2) {
            return true;
        }
        return false;
    }
}