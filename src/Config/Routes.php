<?php

namespace Webly\Core\Config;
use Webly\Core\Models\Menus;
use Webly\Core\Models\BlogCategories;
use Webly\Core\Models\BlogPosts;
use Webly\Core\Models\Forms;
use Webly\Core\Models\GalleryCategories;
use Webly\Core\Models\Albums;

use Webly\Core\Models\Collections;
use Webly\Core\Models\Products;

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

    $routes->get('banners', '\Webly\Core\Controllers\Admin\BannersController::index', ['filter' => 'permission:admin.banners']);
    $routes->post('banners/sort', '\Webly\Core\Controllers\Admin\BannersController::sort', ['filter' => 'permission:admin.banners']);
    $routes->match(['get', 'post'], 'banners/create', '\Webly\Core\Controllers\Admin\BannersController::create', ['filter' => 'permission:admin.banners']);
    $routes->match(['get', 'post'], 'banners/update/(:num)', '\Webly\Core\Controllers\Admin\BannersController::update/$1', ['filter' => 'permission:admin.banners']);
    $routes->get('banners/delete/(:num)', '\Webly\Core\Controllers\Admin\BannersController::delete/$1', ['filter' => 'permission:admin.banners']);

    $routes->get('pages', '\Webly\Core\Controllers\Admin\PagesController::index', ['filter' => 'permission:admin.pages']);
    $routes->match(['get', 'post'], 'pages/create', '\Webly\Core\Controllers\Admin\PagesController::create', ['filter' => 'permission:admin.pages']);
    $routes->match(['get', 'post'], 'pages/update/(:num)', '\Webly\Core\Controllers\Admin\PagesController::update/$1', ['filter' => 'permission:admin.pages']);
    $routes->get('pages/delete/(:num)', '\Webly\Core\Controllers\Admin\PagesController::delete/$1', ['filter' => 'permission:admin.pages']);    

    $routes->get('menus', '\Webly\Core\Controllers\Admin\MenusController::index', ['filter' => 'permission:admin.menus']);
    $routes->match(['get', 'post'], 'menus/create', '\Webly\Core\Controllers\Admin\MenusController::create', ['filter' => 'permission:admin.menus']);
    $routes->match(['get', 'post'], 'menus/update/(:num)', '\Webly\Core\Controllers\Admin\MenusController::update/$1', ['filter' => 'permission:admin.menus']);
    $routes->get('menus/delete/(:num)', '\Webly\Core\Controllers\Admin\MenusController::delete/$1', ['filter' => 'permission:admin.menus']);

    $routes->get('blog-categories', '\Webly\Core\Controllers\Admin\BlogCategoriesController::index', ['filter' => 'permission:admin.blogs']);
    $routes->match(['get', 'post'], 'blog-categories/create', '\Webly\Core\Controllers\Admin\BlogCategoriesController::create', ['filter' => 'permission:admin.blogs']);
    $routes->match(['get', 'post'], 'blog-categories/update/(:num)', '\Webly\Core\Controllers\Admin\BlogCategoriesController::update/$1', ['filter' => 'permission:admin.blogs']);
    $routes->get('blog-categories/delete/(:num)', '\Webly\Core\Controllers\Admin\BlogCategoriesController::delete/$1', ['filter' => 'permission:admin.blogs']);

    $routes->get('blog-posts', '\Webly\Core\Controllers\Admin\BlogPostsController::index', ['filter' => 'permission:admin.blogs']);
    $routes->match(['get', 'post'], 'blog-posts/create', '\Webly\Core\Controllers\Admin\BlogPostsController::create', ['filter' => 'permission:admin.blogs']);
    $routes->match(['get', 'post'], 'blog-posts/update/(:num)', '\Webly\Core\Controllers\Admin\BlogPostsController::update/$1', ['filter' => 'permission:admin.blogs']);
    $routes->get('blog-posts/delete/(:num)', '\Webly\Core\Controllers\Admin\BlogPostsController::delete/$1', ['filter' => 'permission:admin.blogs']);

    $routes->get('gallery-categories', '\Webly\Core\Controllers\Admin\GalleryCategoriesController::index', ['filter' => 'permission:admin.gallery']);
    $routes->post('gallery-categories/sort', '\Webly\Core\Controllers\Admin\GalleryCategoriesController::sort', ['filter' => 'permission:admin.gallery']);
    $routes->match(['get', 'post'], 'gallery-categories/create', '\Webly\Core\Controllers\Admin\GalleryCategoriesController::create', ['filter' => 'permission:admin.gallery']);
    $routes->match(['get', 'post'], 'gallery-categories/update/(:num)', '\Webly\Core\Controllers\Admin\GalleryCategoriesController::update/$1', ['filter' => 'permission:admin.gallery']);
    $routes->get('gallery-categories/delete/(:num)', '\Webly\Core\Controllers\Admin\GalleryCategoriesController::delete/$1', ['filter' => 'permission:admin.gallery']);

    $routes->get('albums', '\Webly\Core\Controllers\Admin\AlbumsController::index', ['filter' => 'permission:admin.gallery']);
    $routes->post('albums/sort', '\Webly\Core\Controllers\Admin\AlbumsController::sort', ['filter' => 'permission:admin.gallery']);
    $routes->post('albums/image_sort', '\Webly\Core\Controllers\Admin\AlbumsController::image_sort', ['filter' => 'permission:admin.gallery']);
    $routes->match(['get', 'post'], 'albums/create', '\Webly\Core\Controllers\Admin\AlbumsController::create', ['filter' => 'permission:admin.gallery']);
    $routes->match(['get', 'post'], 'albums/update/(:num)', '\Webly\Core\Controllers\Admin\AlbumsController::update/$1', ['filter' => 'permission:admin.gallery']);
    $routes->post('albums/upload', '\Webly\Core\Controllers\Admin\AlbumsController::upload', ['filter' => 'permission:admin.gallery']);
    $routes->get('albums/delete/(:num)', '\Webly\Core\Controllers\Admin\AlbumsController::delete/$1', ['filter' => 'permission:admin.gallery']);    
    $routes->get('albums/delete_image/(:num)/(:num)', '\Webly\Core\Controllers\Admin\AlbumsController::delete_image/$1/$2', ['filter' => 'permission:admin.gallery']);    

    $routes->get('forms', '\Webly\Core\Controllers\Admin\FormsController::index', ['filter' => 'permission:admin.forms']);
    $routes->match(['get', 'post'], 'forms/create', '\Webly\Core\Controllers\Admin\FormsController::create', ['filter' => 'permission:admin.forms']);
    $routes->match(['get', 'post'], 'forms/update/(:num)', '\Webly\Core\Controllers\Admin\FormsController::update/$1', ['filter' => 'permission:admin.forms']);
    $routes->get('forms/data/(:num)', '\Webly\Core\Controllers\Admin\FormsController::showData/$1', ['filter' => 'permission:admin.forms']);
    $routes->get('forms/export/(:num)', '\Webly\Core\Controllers\Admin\FormsController::exportData/$1', ['filter' => 'permission:admin.forms']);
    $routes->get('forms/delete/(:num)', '\Webly\Core\Controllers\Admin\FormsController::delete/$1', ['filter' => 'permission:admin.forms']);

    $routes->get('collections', '\Webly\Core\Controllers\Admin\CollectionsController::index', ['filter' => 'permission:admin.shop']);
    $routes->match(['get', 'post'], 'collections/create', '\Webly\Core\Controllers\Admin\CollectionsController::create', ['filter' => 'permission:admin.shop']);
    $routes->match(['get', 'post'], 'collections/update/(:num)', '\Webly\Core\Controllers\Admin\CollectionsController::update/$1', ['filter' => 'permission:admin.shop']);
    $routes->get('collections/delete/(:num)', '\Webly\Core\Controllers\Admin\CollectionsController::delete/$1', ['filter' => 'permission:admin.shop']);

    $routes->get('products', '\Webly\Core\Controllers\Admin\ProductsController::index', ['filter' => 'permission:admin.shop']);
    $routes->match(['get', 'post'], 'products/create', '\Webly\Core\Controllers\Admin\ProductsController::create', ['filter' => 'permission:admin.shop']);
    $routes->match(['get', 'post'], 'products/update/(:num)', '\Webly\Core\Controllers\Admin\ProductsController::update/$1', ['filter' => 'permission:admin.shop']);
    $routes->get('products/delete/(:num)', '\Webly\Core\Controllers\Admin\ProductsController::delete/$1', ['filter' => 'permission:admin.shop']);

    $routes->get('users', '\Webly\Core\Controllers\Admin\UsersController::index', ['filter' => 'permission:admin.users']);
    $routes->match(['get', 'post'], 'users/create', '\Webly\Core\Controllers\Admin\UsersController::create', ['filter' => 'permission:admin.users']);
    $routes->match(['get', 'post'], 'users/update/(:num)', '\Webly\Core\Controllers\Admin\UsersController::update/$1', ['filter' => 'permission:admin.users']);
    $routes->get('users/delete/(:num)', '\Webly\Core\Controllers\Admin\UsersController::delete/$1', ['filter' => 'permission:admin.users']);

    $routes->get('settings', '\Webly\Core\Controllers\Admin\SettingsController::update', ['filter' => 'permission:admin.settings']);
    $routes->post('settings', '\Webly\Core\Controllers\Admin\SettingsController::update', ['filter' => 'permission:admin.settings']);      
});

$routes->match(['get', 'post'], 'search', "\Webly\Core\Controllers\SearchController::index", ['filter' => 'visits']);

$routes->post('/shop/add_to_cart', '\Webly\Core\Controllers\ShopController::add_to_cart');  
$routes->get('/shop/delete', '\Webly\Core\Controllers\ShopController::delete');  
$routes->get('/shop/cart', '\Webly\Core\Controllers\ShopController::cart');  

$routes->post('/orders/add', '\Webly\Core\Controllers\OrdersController::create');  
$routes->get('/orders/payment/(:num)', '\Webly\Core\Controllers\OrdersController::payment/$1');  


$db = \Config\Database::connect();
// Blog Routes
$query = $db->query("SHOW TABLES LIKE 'blog_posts'");
if(!empty($query->getResult())) {
    $BlogCategories = new BlogCategories();    

    $categories = $BlogCategories->findAll();
    foreach($categories as $category) {
        $slug = "blog/" . url_title($category->category, '-', true);
        $routes->get($slug, "\Webly\Core\Controllers\BlogController::index/{$category->id}", ['filter' => 'visits']);
    }

    $BlogPosts = new BlogPosts();
    $posts = $BlogPosts->findAll();

    foreach($posts as $post) {
        $category = $BlogCategories->find($post->blog_category_id);
        $slug = "blog/" . url_title($category->category, '-', true) . "/" . url_title($post->title, '-', true);
        $routes->get($slug, "\Webly\Core\Controllers\BlogController::display/{$post->id}", ['filter' => 'visits']);
    }
}

// Forms Routes
$query = $db->query("SHOW TABLES LIKE 'forms'");
if(!empty($query->getResult())) {
    $Forms = new Forms();    

    $forms = $Forms->findAll();
    foreach($forms as $form) {
        $routes->post("form/{$form->form}", "\Webly\Core\Controllers\FormsController::form/{$form->form}", ['filter' => 'visits']);
    }
}

// Forms Routes
$query = $db->query("SHOW TABLES LIKE 'gallery_categories'");
if(!empty($query->getResult())) {
    $routes->get('gallery', "\Webly\Core\Controllers\GalleryController::categories", ['filter' => 'visits']);


    $GalleryCategories = new GalleryCategories();
    $categories = $GalleryCategories->orderBy('sort_order', 'ASC')->findAll();

    foreach($categories as $category) {
        $slug = "gallery/" . url_title($category->category, '-', true);
        $routes->get($slug, "\Webly\Core\Controllers\GalleryController::albums/{$category->id}", ['filter' => 'visits']);
    }

    $Albums = new Albums();
    $albums = $Albums->orderBy('sort_order', 'ASC')->findAll();

    foreach($albums as $album) {
        $category = $GalleryCategories->find($album->gallery_category_id);
        $slug = "gallery/" . url_title($category->category, '-', true) . "/" . url_title($album->album, '-', true);
        $routes->get($slug, "\Webly\Core\Controllers\GalleryController::display_albums/{$album->id}", ['filter' => 'visits']);
    }
}

// Products Routes
$query = $db->query("SHOW TABLES LIKE 'products'");
if(!empty($query->getResult())) {
    $Collections = new Collections();    

    $collections = $Collections->findAll();
    foreach($collections as $collection) {
        $slug = "products/" . url_title($collection->collection, '-', true);
        // debug("\Webly\Core\Controllers\ProductsController::index/{$collection->id}");
        // debug($slug);
        $routes->get($slug, "\Webly\Core\Controllers\ProductsController::index/{$collection->id}", ['filter' => 'visits']);
    }

    $Products = new Products();
    $products = $Products->findAll();

    foreach($products as $product) {
        $collection = $Collections->find($product->collection_id);
        $slug = "products/" . url_title($collection->collection, '-', true) . "/" . url_title($product->product, '-', true);
        $routes->get($slug, "\Webly\Core\Controllers\ProductsController::display/{$product->id}", ['filter' => 'visits']);
    }
}

// Pages Routes
$query = $db->query("SHOW TABLES LIKE 'menus'");

// Checks menus table exists before migration
if(!empty($query->getResult())) {
    $Menus = new Menus();
    $menus = $Menus->findAll();

    function getChildren($items, &$routes) {
        if(!empty($items)) {
            foreach($items as $item) {        
                if($item->slug != "#") {
                    if(substr($item->route, 0, 1 ) != "/") {
                        $routes->get("{$item->slug}", "{$item->route}", ['filter' => 'visits']);
                    }
                }
                getChildren($item->children, $routes);
            }
        } else {
            return false;
        }
    }

    foreach($menus as $menu) {        
        $menuItems = json_decode($menu->menu_items);
        foreach($menuItems as $item) {
            if($item->slug != "#") {
                if(substr($item->route, 0, 1 ) != "/") {
                    $routes->get("{$item->slug}", "{$item->route}", ['filter' => 'visits']);
                }
            }
            getChildren($item->children, $routes);
        }
    }
}



$routes->set404Override(static function () {
    echo view($layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'errors' . DIRECTORY_SEPARATOR . 'error_404');
});
