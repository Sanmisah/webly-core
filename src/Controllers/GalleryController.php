<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\GalleryCategories;
use Webly\Core\Models\Albums;
use Webly\Core\Models\AlbumImages;

class GalleryController extends BaseController
{
    public function categories()
    {
        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . 'categories';

        $GalleryCategories = new GalleryCategories();

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value=''>

            <!-- Open Graph data -->
            <meta property='og:title' content='Gallery' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='' />            
        ";               
        
        $categories = $GalleryCategories->orderBy('sort_order', 'asc')->findAll(); 
        foreach($categories as $i => $category) {
            $categories[$i]->url = "/gallery/" . url_title($category->category, '-', true);
        }

        return view($layout, [
            'title' => 'Gallery', 
            'meta' => $meta,
            'galleryCategories' => $categories,
        ]);
    }

    public function albums($category_id = null)
    {
        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . 'albums';

        $Albums = new Albums();

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value=''>

            <!-- Open Graph data -->
            <meta property='og:title' content='Album' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='' />            
        ";                

        $db = \Config\Database::connect();
        $builder = $db->table('albums');

        $albums = $builder
            ->select(['albums.*', 'gallery_categories.category'])
            ->where('gallery_category_id', $category_id)
            ->join('gallery_categories', 'albums.gallery_category_id = gallery_categories.id', 'left')
            ->orderBy('albums.sort_order', 'asc')
            ->get()
            ->getResult();

        foreach($albums as $i => $album) {
            $albums[$i]->url = "/gallery/" . url_title($album->category, '-', true) . "/" . url_title($album->album, '-', true);
        }

        $GalleryCategories = new GalleryCategories();
        $galleryCategory = $GalleryCategories->find($category_id);

        return view($layout, [
            'title' => 'Album', 
            'meta' => $meta,
            'albums' => $albums,
            'galleryCategory' => $galleryCategory
        ]);        
    }

    public function display_albums($album_id = null)
    {
        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . 'images';

        $AlbumImages = new AlbumImages();

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value=''>

            <!-- Open Graph data -->
            <meta property='og:title' content='Gallery' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='' />            
        ";               
        
        $images = $AlbumImages->orderBy('sort_order', 'asc')->where('album_id', $album_id)->findAll(); 

        $Albums = new Albums();
        $album = $Albums->find($album_id);

        $GalleryCategories = new GalleryCategories();
        $galleryCategory = $GalleryCategories->find($album->gallery_category_id);

        return view($layout, [
            'title' => 'Gallery', 
            'meta' => $meta,
            'images' => $images,
            'album' => $album,
            'galleryCategory' => $galleryCategory            
        ]);
    }
}
