<?php
/**
 * Created by PhpStorm.
 * User: Nobody
 * Date: 9/16/2019
 * Time: 9:02 PM
 */

namespace App\CustomClasses;
use Hashids\Hashids;

class Hasher
{
    public static function encode(...$args)
    {
        return app(Hashids::class)->encode(...$args);
    }
    public static function decode($enc)
    {
        if (is_int($enc)) {
            return $enc;
        }
        return app(Hashids::class)->decode($enc)[0];
    }
}