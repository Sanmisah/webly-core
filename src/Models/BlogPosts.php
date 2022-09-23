<?php

namespace Webly\Core\Models;

class BlogPosts extends BaseModel
{
    protected $table            = 'blog_posts';
    protected $returnType       = \Webly\Core\Entities\BlogPost::class;
    protected $allowedFields    = [
        'id', 'title', 'content', 'page_title', 'meta_description', 
        'layout', 'visible', 'blog_category_id', 'author', 'published_on', 'featured_image'
    ];
}
