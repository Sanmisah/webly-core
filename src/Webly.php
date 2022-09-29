<?php

declare(strict_types=1);

namespace Webly\Core;

class Webly
{
    public function getTemplates()
    {
        $folders = directory_map(config('Paths')->viewDirectory, 1);

        $templates = [];
        foreach($folders as $folder) {
            if(!in_array($folder, ['adminlte3/'])) {
                $templates[$folder] = humanize(str_replace('/', '', $folder));
            }
        }
        return $templates;
    }

    public function getLayouts()
    {
        $path = config('Paths')->viewDirectory . '/' . service('settings')->get('App.template') . 'layouts';
        $files = get_filenames($path, false, false, false);

        $layouts = [];
        $exclude = ['404.php', 'blog.php'];
        foreach($files as $file) {
            if(!in_array($file, $exclude)) {
                $layouts[str_replace('.php', '', $file)] = str_replace('.php', '', $file);
            }
        }

        return $layouts;
    } 

    public function getMenu($menu)
    {
        $Menus = new \Webly\Core\Models\Menus();
        return json_decode($Menus->where('menu', $menu)->first()->menu_items);
    }

    public function getBanners()
    {
        $Banners = new \Webly\Core\Models\Banners();
        return $Banners->orderBy('sort_order', 'asc')->findAll();
    }

    public function getBlogCategoriesList()
    {
        $BlogCategories = new \Webly\Core\Models\BlogCategories();
        $blogCategories = $BlogCategories->orderBy('category', 'asc')->findAll();

        $categories = [];
        foreach($blogCategories as $category) {
            $categories[$category->id] = $category->category;
        }

        return $categories;
    }

    public function getBlogCategories()
    {
        $BlogCategories = new \Webly\Core\Models\BlogCategories();
        $blogCategories = $BlogCategories->orderBy('category', 'asc')->findAll();

        foreach($blogCategories as $i => $category) {
            $blogCategories[$i]->url = "/blog/" . url_title($category->category, '-', true);
        }

        return $blogCategories;
    }
    
    public function getGalleryCategoriesList($empty = false)
    {
        $GalleryCategories = new \Webly\Core\Models\GalleryCategories();
        $galleryCategories = $GalleryCategories->orderBy('sort_order', 'asc')->findAll();

        $categories = [];

        if($empty) {
            $categories[''] = '(select)';
        }

        foreach($galleryCategories as $category) {
            $categories[$category->id] = $category->category;
        }

        return $categories;
    }    
}
