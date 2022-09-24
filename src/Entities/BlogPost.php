<?php

namespace Webly\Core\Entities;

use CodeIgniter\Entity\Entity;

class BlogPost extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $castHandlers = [
        'date' => \Webly\Core\Entities\Cast\CastDate::class,
    ];

    protected $casts   = [
        'published_on' => 'date'
    ];
}
