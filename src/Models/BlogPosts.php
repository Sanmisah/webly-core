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

    public function get($blog_category_id = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('blog_posts');

        if(!empty($blog_category_id)) {
            $this->builder()
                ->select(['blog_posts.*', 'blog_categories.category'])
                ->join('blog_categories', 'blog_posts.blog_category_id = blog_categories.id')
                ->where('blog_category_id', $blog_category_id);
        } else {
            $this->builder()
                ->select(['blog_posts.*', 'blog_categories.category'])
                ->join('blog_categories', 'blog_posts.blog_category_id = blog_categories.id');
        }

        return $this;
    }
}
