<?php

namespace Webly\Core\Config;

use CodeIgniter\Config\BaseConfig;

class Menu extends BaseConfig
{
    public $menu = [
        'item1' => [
            'menu' => 'Content',
            'url' => '#',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'permissions' => ['admin.blocks', 'admin.pages'],
            'submenu' => [                
                'Blocks' => [
                    'menu' => 'Blocks',
                    'url' => '/admin/blocks',
                    'icon' => 'nav-icon fas fa-th',
                    'permissions' => ['admin.blocks']
                ],
                'Banners' => [
                    'menu' => 'Banners',
                    'url' => '/admin/banners',
                    'icon' => 'nav-icon fas fa-th',
                    'permissions' => ['admin.banners']
                ],
                'Pages' => [
                    'menu' => 'Pages',
                    'url' => '/admin/pages',
                    'icon' => 'nav-icon fas fa-th',
                    'permissions' => ['admin.pages']
                ],
                'Menus' => [
                    'menu' => 'Menus',
                    'url' => '/admin/menus',
                    'icon' => 'nav-icon fas fa-th',
                    'permissions' => ['admin.menus']
                ]                                
            ]
        ],
        'item95' => [
            'menu' => 'Settings',
            'url' => '/admin/settings',
            'icon' => 'nav-icon fas fa-cogs',
            'permissions' => ['admin.settings']
        ],
        'item96' => [
            'menu' => 'Users',
            'url' => '/admin/users',
            'icon' => 'nav-icon fas fa-cogs',
            'permissions' => ['admin.users']
        ]        
    ];
}
