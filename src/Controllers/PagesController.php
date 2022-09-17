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

        $layout = service('settings')->get('App.template') . 'layouts/' . $page->layout;

        /*
            <meta name="description" content="Page description. No longer than 155 characters." />

            <!-- Twitter Card data -->
            <meta name="twitter:card" value="summary">

            <!-- Open Graph data -->
            <meta property="og:title" content="Title Here" />
            <meta property="og:type" content="article" />
            <meta property="og:url" content="http://www.example.com/" />
            <meta property="og:image" content="http://example.com/image.jpg" />
            <meta property="og:description" content="Description Here" />        
        */

        return view($layout, [
            'title' => 'Pages', 
            'page' => $page,
        ]);        
    }
}
