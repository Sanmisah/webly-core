<?php

namespace Webly\Core\Models;

class Banners extends BaseModel
{
    protected $table            = 'banners';
    protected $returnType       = \Webly\Core\Entities\Banner::class;
    protected $allowedFields    = ['id', 'banner_image', 'caption', 'description', 'link', 'sort_order'];
}
