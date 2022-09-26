<?php

namespace Webly\Core\Entities;

use CodeIgniter\Entity\Entity;

class Form extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];

    protected $casts   = [
        'form_fields' => 'json'
    ];
}
