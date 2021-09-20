<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 9/19/2021
 * Time: 07:20 PM
 */

namespace App\Helper;


class General
{

    public static function quickRandom($length = 4)
    {
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

}
