<?php

namespace Webly\Core\Models;

class AlbumImages extends BaseModel
{
    protected $table            = 'album_images';
    protected $returnType       = \Webly\Core\Entities\AlbumImage::class;
    protected $allowedFields    = ['id', 'album_id', 'image', 'caption', 'description', 'sort_order'];
}
