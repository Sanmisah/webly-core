<?php

declare(strict_types=1);

namespace Webly\Core\Models;

use CodeIgniter\Shield\Models\UserModel;

class Users extends UserModel
{
    protected $allowedFields  = [
        'name',
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'deleted_at',
    ];
}
