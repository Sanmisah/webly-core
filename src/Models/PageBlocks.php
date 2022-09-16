<?php

namespace Webly\Core\Models;

class PageBlocks extends BaseModel
{
    protected $table            = 'page_blocks';
    protected $returnType       = \Webly\Core\Entities\PageBlock::class;
    protected $allowedFields    = ['id', 'page_id', 'block', 'content'];
}
