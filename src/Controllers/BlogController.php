<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\BlogCategories;
use Webly\Core\Models\BlogPosts;

class BlogController extends BaseController
{

    public function index($category_id = null)
    {
        $BlogCategories = new BlogCategories();
        $BlogPosts = new BlogPosts();

        if(!empty($category_id)) {
            $posts = $BlogPosts->where('blog_category_id', $category_id)->paginate();
            $currentCategory = $BlogCategories->find($category_id);
        } else {
            $posts = $BlogPosts->paginate();
        }
        
        foreach($posts as $i => $post) {
            $category = $BlogCategories->find($post->blog_category_id);
            $posts[$i]->category = "";
            if($category) {
                $posts[$i]->url = "/blog/" . url_title($category->category, '-', true) . "/" . url_title($post->title, '-', true);
                $posts[$i]->category = $category->category;
                $posts[$i]->category_url = "/blog/" . url_title($category->category, '-', true);
            }
        }

        $layout = service('settings')->get('App.template') . 'layouts/blog';

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value=''>

            <!-- Open Graph data -->
            <meta property='og:title' content='Blog' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='' />            
        ";        

        return view($layout, [
            'title' => 'Blog', 
            'meta' => $meta,
            'posts' => $posts,
            'pager' => $BlogPosts->pager,
            'category' => isset($currentCategory) ? $currentCategory : null
        ]); 
    }

    public function display($id)
    {
        $BlogPosts = new BlogPosts();
        $post = $BlogPosts->find($id);

        $BlogCategories = new BlogCategories();
        $category = $BlogCategories->find($post->blog_category_id);
        $post->category = $category->category;
        $post->category_url = "/blog/" . url_title($category->category, '-', true);

        $layout = service('settings')->get('App.template') . 'layouts/' . $post->layout;

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='{$post->meta_description}' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value='{$post->meta_description}'>

            <!-- Open Graph data -->
            <meta property='og:title' content='{$post->page_title}' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='{$post->meta_description}' />            
        ";

        if(!empty($post->featured_image)) {
            $image = site_url($post->featured_image);
            $meta .= "<meta property='og:image' content='{$image}' />";
        }

        return view($layout, [
            'title' => $post->page_title, 
            'meta' => $meta,
            'post' => $post
        ]);        
    }
}
