<?php

namespace Webly\Core\Config;
use Webly\Core\Models\Menus;

// service('auth')->routes($routes);

$routes->group('admin', function ($routes) {
    $routes->get('register', '\CodeIgniter\Shield\Controllers\RegisterController::registerView');
    $routes->get('/', '\CodeIgniter\Shield\Controllers\LoginController::loginView', ['as' => 'login']);
    $routes->get('login/magic-link', '\CodeIgniter\Shield\Controllers\MagicLinkController::loginView', ['as' => 'magic-link']);
    $routes->get('login/verify-magic-link', '\CodeIgniter\Shield\Controllers\MagicLinkController::verify', ['as' => 'verify-magic-link']);
    $routes->get('logout', '\CodeIgniter\Shield\Controllers\LoginController::logoutAction');
    $routes->get('auth/a/show', '\CodeIgniter\Shield\Controllers\ActionController::show');

    $routes->post('register', '\CodeIgniter\Shield\Controllers\RegisterController::registerAction');    
    $routes->post('/', '\CodeIgniter\Shield\Controllers\LoginController::loginAction');
    $routes->post('login/magic-link', '\CodeIgniter\Shield\Controllers\MagicLinkController::loginAction');
    $routes->post('auth/a/handle', '\CodeIgniter\Shield\Controllers\ActionController::handle');
    $routes->post('auth/a/verify', '\CodeIgniter\Shield\Controllers\ActionController::verify');   

    $routes->get('dashboard', '\Webly\Core\Controllers\Admin\DashboardController::index', ['filter' => 'permission:admin.dashboard']);

    $routes->get('blocks', '\Webly\Core\Controllers\Admin\BlocksController::index', ['filter' => 'permission:admin.blocks']);
    $routes->match(['get', 'post'], 'blocks/create', '\Webly\Core\Controllers\Admin\BlocksController::create', ['filter' => 'permission:admin.blocks']);
    $routes->match(['get', 'post'], 'blocks/update/(:num)', '\Webly\Core\Controllers\Admin\BlocksController::update/$1', ['filter' => 'permission:admin.blocks']);
    $routes->get('blocks/delete/(:num)', '\Webly\Core\Controllers\Admin\BlocksController::delete/$1', ['filter' => 'permission:admin.blocks']);

    $routes->get('pages', '\Webly\Core\Controllers\Admin\PagesController::index', ['filter' => 'permission:admin.pages']);
    $routes->match(['get', 'post'], 'pages/create', '\Webly\Core\Controllers\Admin\PagesController::create', ['filter' => 'permission:admin.pages']);
    $routes->match(['get', 'post'], 'pages/update/(:num)', '\Webly\Core\Controllers\Admin\PagesController::update/$1', ['filter' => 'permission:admin.pages']);
    $routes->get('pages/delete/(:num)', '\Webly\Core\Controllers\Admin\PagesController::delete/$1', ['filter' => 'permission:admin.pages']);    

    $routes->get('menus', '\Webly\Core\Controllers\Admin\MenusController::index', ['filter' => 'permission:admin.menus']);
    $routes->match(['get', 'post'], 'menus/create', '\Webly\Core\Controllers\Admin\MenusController::create', ['filter' => 'permission:admin.menus']);
    $routes->match(['get', 'post'], 'menus/update/(:num)', '\Webly\Core\Controllers\Admin\MenusController::update/$1', ['filter' => 'permission:admin.menus']);
    $routes->get('menus/delete/(:num)', '\Webly\Core\Controllers\Admin\MenusController::delete/$1', ['filter' => 'permission:admin.menus']);

    $routes->get('users', '\Webly\Core\Controllers\Admin\UsersController::index', ['filter' => 'permission:admin.users']);
    $routes->match(['get', 'post'], 'users/create', '\Webly\Core\Controllers\Admin\UsersController::create', ['filter' => 'permission:admin.users']);
    $routes->match(['get', 'post'], 'users/update/(:num)', '\Webly\Core\Controllers\Admin\UsersController::update/$1', ['filter' => 'permission:admin.users']);
    $routes->get('users/delete/(:num)', '\Webly\Core\Controllers\Admin\UsersController::delete/$1', ['filter' => 'permission:admin.users']);

    $routes->get('settings', '\Webly\Core\Controllers\Admin\SettingsController::update', ['filter' => 'permission:admin.settings']);
    $routes->post('settings', '\Webly\Core\Controllers\Admin\SettingsController::update', ['filter' => 'permission:admin.settings']);  
});   


// $routes->get('/', '\Webly\Core\Controllers\PagesController::display/1', ['filter' => 'visits']);


$routes->set404Override(static function () {
    echo view($layout = service('settings')->get('App.template') . 'layouts/404');
});

$db = \Config\Database::connect();
$query = $db->query("SHOW TABLES LIKE 'menus'");

// Checks menus table exists before migration
if(!empty($query->getResult())) {
    $Menus = new Menus();
    $menus = $Menus->findAll();

    function getChildren($items, $slug, &$routes) {
        if(!empty($items)) {
            foreach($items as $item) {        
                $routes->get("$slug/{$item->slug}", "{$item->route}", ['filter' => 'visits']);
                getChildren($item->children, "$slug/{$item->slug}", $routes);
            }
        } else {
            return false;
        }
    }

    foreach($menus as $menu) {
        $menuItems = json_decode($menu->menu_items);
        foreach($menuItems as $item) {
            $routes->get("{$item->slug}", "{$item->route}", ['filter' => 'visits']);
            getChildren($item->children, $item->slug, $routes);
        }
    }
}


