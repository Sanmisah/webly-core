<?php

namespace Webly\Core\Models;

class Collections extends BaseModel
{
    protected $table            = 'collections';
    protected $returnType       = \Webly\Core\Entities\Collection::class;
    protected $allowedFields    = ['id', 'collection'];
}
