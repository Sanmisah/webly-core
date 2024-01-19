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
            if(!in_array($folder, ['adminlte3'.DIRECTORY_SEPARATOR])) {
                $templates[rtrim($folder,'/')] = humanize(str_replace(DIRECTORY_SEPARATOR, '', $folder));
            }            
        }

        return $templates;
    }

    public function getLayouts($folder = 'pages')
    {
        $path = config('Paths')->viewDirectory . DIRECTORY_SEPARATOR . service('settings')->get('App.template'). DIRECTORY_SEPARATOR . $folder;
        $files = get_filenames($path, false, false, false);

        $layouts = [];
        $exclude = ['error_404.php', 'blog.php'];
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

    public function getCollections()
    {
        $Collections = new \Webly\Core\Models\Collections();
        $collections = $Collections->orderBy('collection', 'asc')->findAll();

        foreach($collections as $i => $collection) {
            $collections[$i]->url = "/shop/" . url_title($collection->collection, '-', true);
        }

        return $collections;
    }    

    public function getCollectionsList($empty = false)
    {
        $Collections = new \Webly\Core\Models\Collections();
        // $collections = $Collections->orderBy('sort_order', 'asc')->findAll();
        $collections = $Collections->findAll();

        $collectionsList = [];

        if($empty) {
            $collectionsList[''] = '(select)';
        }

        foreach($collections as $collection) {
            $collectionsList[$collection->id] = $collection->collection;
        }

        return $collectionsList;
    }    

    function convertAmountToWords($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ucwords(($Rupees ? $Rupees . 'Rupees ' : '') . $paise);
    }    
}
