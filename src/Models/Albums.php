<?php

namespace Webly\Core\Models;

class Albums extends BaseModel
{
    protected $table            = 'albums';
    protected $returnType       = \Webly\Core\Entities\Album::class;
    protected $allowedFields    = ['id', 'album', 'album_image', 'description', 'gallery_category_id', 'sort_order'];
}
