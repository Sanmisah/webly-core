<?php

namespace Webly\Core\Config;

use CodeIgniter\Config\BaseConfig;

class Menu extends BaseConfig
{
    public $menu = [
        'item00' => [
            'menu' => 'Dashboard',
            'url' => '/admin/dashboard',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'permissions' => ['admin.dashboard']
        ],             
        'item01' => [
            'menu' => 'Pages',
            'url' => '#',
            'icon' => 'nav-icon fa fa-file',
            'permissions' => ['admin.blocks', 'admin.pages', 'admin.banners', 'admin.menus'],
            'submenu' => [                
                'Blocks' => [
                    'menu' => 'Blocks',
                    'url' => '/admin/blocks',
                    'icon' => 'nav-icon fas fa-cube',
                    'permissions' => ['admin.blocks']
                ],
                'Banners' => [
                    'menu' => 'Banners',
                    'url' => '/admin/banners',
                    'icon' => 'nav-icon fas fa-sign',
                    'permissions' => ['admin.banners']
                ],
                'Pages' => [
                    'menu' => 'Pages',
                    'url' => '/admin/pages',
                    'icon' => 'nav-icon fas fa-file',
                    'permissions' => ['admin.pages']
                ],
                'Menus' => [
                    'menu' => 'Menus',
                    'url' => '/admin/menus',
                    'icon' => 'nav-icon fas fa-bars',
                    'permissions' => ['admin.menus']
                ]                                
            ]
        ],
        'item02' => [
            'menu' => 'Blog',
            'url' => '#',
            'icon' => 'nav-icon fas fa-blog',
            'permissions' => ['admin.blogs'],
            'submenu' => [                
                'Categories' => [
                    'menu' => 'Category',
                    'url' => '/admin/blog-categories',
                    'icon' => 'nav-icon fas fa-th-list',
                    'permissions' => ['admin.blogs']
                ],
                'Posts' => [
                    'menu' => 'Posts',
                    'url' => '/admin/blog-posts',
                    'icon' => 'nav-icon fas fa-blog',
                    'permissions' => ['admin.blogs']
                ],
            ]
        ],
        'item03' => [
            'menu' => 'Gallery',
            'url' => '#',
            'icon' => 'nav-icon fa fa-images',
            'permissions' => ['admin.gallery'],
            'submenu' => [                
                'Categories' => [
                    'menu' => 'Category',
                    'url' => '/admin/gallery-categories',
                    'icon' => 'nav-icon fas fa-th-list',
                    'permissions' => ['admin.gallery']
                ],
                'Albums' => [
                    'menu' => 'Albums',
                    'url' => '/admin/albums',
                    'icon' => 'nav-icon fas fa-images',
                    'permissions' => ['admin.blogs']
                ],
            ]
        ],        
        'item04' => [
            'menu' => 'Forms',
            'url' => '/admin/forms',
            'icon' => 'nav-icon fas fa-id-card',
            'permissions' => ['admin.forms']
        ],             
        'item91' => [
            'menu' => 'Settings',
            'url' => '/admin/settings',
            'icon' => 'nav-icon fas fa-cog',
            'permissions' => ['admin.settings']
        ],
        'item92' => [
            'menu' => 'Users',
            'url' => '/admin/users',
            'icon' => 'nav-icon fas fa-user',
            'permissions' => ['admin.users']
        ]        
    ];
}
