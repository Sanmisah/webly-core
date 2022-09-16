<?php

namespace Webly\Core\Models;

class Pages extends BaseModel
{
    protected $table            = 'pages';
    protected $returnType       = \Webly\Core\Entities\Page::class;
    protected $allowedFields    = ['id', 'title', 'content', 'page_title', 'meta_description', 'layout', 'visible', 'featured_image'];
}
