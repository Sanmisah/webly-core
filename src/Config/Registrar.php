<?php

declare(strict_types=1);

namespace Webly\Core\Config;

use Webly\Core\Filters\Permission;
use Webly\Core\Models\Pages;

use Webly\Core\Models\GalleryCategories;
use Webly\Core\Models\Albums;
use Webly\Core\Models\Collections;

class Registrar
{
    /**
     * Registers the Webly filters.
     */
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'permission'    => Permission::class,
            ],

            'filters' => [
                'session'   => ['before' => ['/filemanager/*']]
            ]
        ];
    }  
    
    public static function Content(): array
    {
        $items = [];

        $items['#'] = "#";

        // Add Page Links
        $Pages = new Pages();
        $pages = $Pages->where('visible', 1)->findAll();
        
        foreach($pages as $page) {
            $items['Pages']['\Webly\Core\Controllers\PagesController::display/'.$page->id] = $page->title;
        }

        // Add Blog Links
        $items['\Webly\Core\Controllers\BlogController::index'] = 'Blog';

        // Add Gallery Links
        $items['Gallery']['/gallery'] = 'All Categories';        

        $GalleryCategories = new GalleryCategories();
        $categories = $GalleryCategories->orderBy('sort_order', 'ASC')->findAll();

        foreach($categories as $category) {
            $items['Gallery']['/gallery/' . url_title($category->category, '-', true)] = $category->category;
        }

        $Albums = new Albums();
        $albums = $Albums->orderBy('sort_order', 'ASC')->findAll();

        foreach($albums as $album) {
            $category = $GalleryCategories->find($album->gallery_category_id);
            $items['Albums']["/gallery/" . url_title($category->category, '-', true) . "/" . url_title($album->album, '-', true)] = $album->album;
        }

        // Add Shop Links
        $Collections = new Collections();
        $collections = $Collections->findAll();
        
        foreach($collections as $collection) {
            $items['Shop']['/products/' . url_title($collection->collection)] = $collection->collection;
        }        

        return [
            'items' => $items
        ];
    }      
}
