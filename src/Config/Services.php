<?php

declare(strict_types=1);

namespace Webly\Core\Config;

use Config\Services as BaseService;
use Webly\Core\Webly;

class Services extends BaseService
{
    public static function webly(bool $getShared = true): Webly
    {
        if ($getShared) {
            return self::getSharedInstance('webly');
        }

        return new Webly();
    }
}
