<?php

namespace Webly\Core\Models;

class GalleryCategories extends BaseModel
{
    protected $table            = 'gallery_categories';
    protected $returnType       = \Webly\Core\Entities\GalleryCategory::class;
    protected $allowedFields    = ['id', 'category', 'category_image', 'description', 'sort_order'];
}
