<?php

declare(strict_types=1);

namespace Webly\Core\Config;

use Webly\Core\Filters\Permission;
use Webly\Core\Models\Pages;

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
        $Pages = new Pages();
        $pages = $Pages->where('visible', 1)->findAll();
        $items = [];

        foreach($pages as $page) {
            $items['Pages']['\Webly\Core\Controllers\PagesController::display/'.$page->id] = $page->title;
        }
        return [
            'items' => $items

        ];
    }      
}
