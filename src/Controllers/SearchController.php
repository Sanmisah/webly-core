<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Pages;
use Webly\Core\Models\PageBlocks;
use Webly\Core\Models\Products;
use Webly\Core\Models\Collections;
use Webly\Core\Models\Menus;

class SearchController extends BaseController
{
    public function index()
    {
        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'search';

        $Menus = new Menus();
        $menus = $Menus->findAll();

        $pageIds = [];
        $result = [];
    
        foreach($menus as $menu) {        
            $menuItems = json_decode($menu->menu_items);
            foreach($menuItems as $item) {
                if($item->slug != "#") {
                    if(substr($item->route, 0, 1 ) != "/") {
                        if(str_contains($item->route, "\\Webly\\Core\\Controllers\\PagesController::display")) {
                            $id = explode("/", $item->route)[1];
                            $pageIds[$item->slug] = $id;
                        }
                    }
                }
                $this->getChildren($item->children, $pageIds);
            }
        }        

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
           
            $Collections = new Collections();


            $Products = new Products();
            $products = $Products
                ->where('MATCH (product, content, page_title) AGAINST ("'. $data['search'] .'"  IN NATURAL LANGUAGE MODE)')
                ->findAll();    

            foreach($products as $product) {
                $collection = $Collections->find($product->collection_id);
                $result[] = [
                    'url' => "/products/" . url_title($collection->collection, '-', true) . "/" . url_title($product->product, '-', true),
                    'title' => $product->product,
                    'content' => $product->content
                ];
            }            


            $Pages = new Pages();
            $pages = $Pages
                ->where('MATCH (title, content, page_title) AGAINST ("'. $data['search'] .'"  IN NATURAL LANGUAGE MODE)')
                ->findAll();    

            foreach($pages as $page) {
                $url = array_search($page->id,$pageIds);
                if(!empty($url)) {
                    $result[] = [
                        'url' => $url,
                        'title' => $page->title,
                        'content' => $page->content
                    ];                    
                }
            }

            print_r($result); exit;
        }

        return view($layout, [
            'title' => "Search", 
            'meta' => "",
            'page' => "",
            'result' => $result
        ]);             
     
    }

    function getChildren($items, &$pageIds) {
        if(!empty($items)) {
            foreach($items as $item) {        
                if($item->slug != "#") {
                    if(substr($item->route, 0, 1 ) != "/") {
                        if(str_contains($item->route, "\\Webly\\Core\\Controllers\\PagesController::display")) {
                            $id = explode("/", $item->route)[1];
                            $pageIds[$item->slug] = $id;
                        }
                    }
                }
                $this->getChildren($item->children, $pageIds);
            }
        } else {
            return false;
        }
    }    
}
