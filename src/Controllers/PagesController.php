<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Pages;
use Webly\Core\Models\PageBlocks;

class PagesController extends BaseController
{
    public function display($id)
    {
        $Pages = new Pages();
        $page = $Pages->find($id);

        $layout = service('settings')->get('App.template') . 'pages' . DIRECTORY_SEPARATOR . $page->layout;

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='{$page->meta_description}' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value='{$page->meta_description}'>

            <!-- Open Graph data -->
            <meta property='og:title' content='{$page->page_title}' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='{$page->meta_description}' />            
        ";

        if(!empty($page->featured_image)) {
            $image = site_url($page->featured_image);
            $meta .= "<meta property='og:image' content='{$image}' />";
        }

        $PageBlocks = new PageBlocks();
        $pageBlocks = $PageBlocks->where('page_id', $page->id)->findAll();
        
        $blocks = [];
        foreach($pageBlocks as $block) {
            $blocks[$block->block] = $block->content;
        }

        return view($layout, [
            'title' => $page->page_title, 
            'meta' => $meta,
            'page' => $page,
            'blocks' => $blocks
        ]);        
    }
}
