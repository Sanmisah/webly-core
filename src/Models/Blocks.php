<?php

namespace Webly\Core\Models;

class Blocks extends BaseModel
{
    protected $table            = 'blocks';
    protected $returnType       = \Webly\Core\Entities\Block::class;
    protected $allowedFields    = ['id', 'block', 'description'];
}
