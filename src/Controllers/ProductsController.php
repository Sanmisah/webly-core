<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Products;
use Webly\Core\Models\ProductBlocks;
use Webly\Core\Models\Collections;

class ProductsController extends BaseController
{
    public function index($collection_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('products');

        $Products = new Products();
        $Collections = new Collections();

        $currentCollection = $Collections->find($collection_id);

        $products = $Products->get($collection_id)->paginate();

        foreach($products as $i => $product) {
            $collection = $Collections->find($product->collection_id);
            $products[$i]->collection = "";
            if($collection) {
                $products[$i]->url = "/products/" . url_title($collection->collection, '-', true) . "/" . url_title($product->product, '-', true);
                $products[$i]->collection = $collection->collection;
                $products[$i]->category_url = "/products/" . url_title($collection->collection, '-', true);
            }
        }

        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'shop';

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
            'title' => 'Collection', 
            'meta' => $meta,
            'products' => $products,
            'pager' => $Products->pager,
            'collection' => isset($currentCategory) ? $currentCategory : null
        ]); 
    }

    public function display($id)
    {
        $Products = new Products();
        $product = $Products->find($id);

        $Collections = new Collections();
        $collection = $Collections->find($product->collection_id);
        $product->collection = $collection->collection;
        $product->collection_url = "/products/" . url_title($collection->collection, '-', true);        

        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $product->layout;

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='{$product->meta_description}' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value='{$product->meta_description}'>

            <!-- Open Graph data -->
            <meta property='og:title' content='{$product->page_title}' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='{$product->meta_description}' />            
        ";

        if(!empty($product->featured_image)) {
            $image = site_url($product->featured_image);
            $meta .= "<meta property='og:image' content='{$image}' />";
        }

        $ProductBlocks = new ProductBlocks();
        $productBlocks = $ProductBlocks->where('product_id', $product->id)->findAll();
        
        $blocks = [];
        foreach($productBlocks as $block) {
            $blocks[$block->block] = $block->content;
        }

        return view($layout, [
            'title' => $product->page_title, 
            'meta' => $meta,
            'page' => $product,
            'blocks' => $blocks
        ]);        
    }
}
