<?php

namespace Webly\Core\Entities;

use CodeIgniter\Entity\Entity;

class GalleryCategory extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];
}
