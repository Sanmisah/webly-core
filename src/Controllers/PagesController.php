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

        return view($layout, [
            'title' => 'Pages', 
            'page' => $page,
        ]);        
    }
}
