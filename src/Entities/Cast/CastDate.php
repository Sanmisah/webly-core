<?php

namespace Webly\Core\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

// The class must inherit the CodeIgniter\Entity\Cast\BaseCast class
class CastDate extends BaseCast
{
    public static function get($value, array $params = [])
    {
        if(empty($value)) {
            return null;
        }
        return \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public static function set($value, array $params = [])
    {
        if(empty($value)) {
            return null;
        }
        return \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}