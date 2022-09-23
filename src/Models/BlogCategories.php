<?php

namespace Webly\Core\Models;

class BlogCategories extends BaseModel
{
    protected $table            = 'blog_categories';
    protected $returnType       = \Webly\Core\Entities\BlogCategory::class;
    protected $allowedFields    = ['id', 'block', 'category'];
}
