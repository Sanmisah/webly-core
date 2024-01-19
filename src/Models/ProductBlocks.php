<?php

namespace Webly\Core\Models;

class ProductBlocks extends BaseModel
{
    protected $table            = 'product_blocks';
    protected $returnType       = \Webly\Core\Entities\ProductBlock::class;
    protected $allowedFields    = ['id', 'product_id', 'block', 'content'];
}
