<?php

namespace Webly\Core\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitWebsiteContent extends Seeder
{
    public function run()
    {
        // Add Banners
        $data = [
            'banner_image'  => 'writable/uploads/20221124/1669268202_8e6bcba38c6969edc334.png',
            'caption'       => 'Banner 1'
        ];

        $this->db->table('banners')->insert($data);

        $data = [
            'banner_image'  => 'writable/uploads/20221124/1669268211_471e25d86ab00769001d.png',
            'caption'       => 'Banner 2'
        ];

        $this->db->table('banners')->insert($data);
        
        // Add Blocks
        $data = [
            'block'         => 'footer',
            'description'   => '<p>Copyright &copy; Your Website, 2025 | <a href="https://webly.cms/" target="_blank" rel="nofollow noopener">Powered by Webly.cms</a></p>'
        ];

        $this->db->table('blocks')->insert($data);

        $data = [
            'block'         => 'side-well',
            'description'   => '<h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero</p>'
        ];

        $this->db->table('blocks')->insert($data);        


        // Add Home Page Entry
        $data = [
            'id'            => 1,
            'title'         => 'Home',
            'page_title'    => 'Home',
            'layout'        => 'home',
        ];

        $this->db->table('pages')->insert($data);

        // Add Main Menu Entries
        $data = [
            'id'            => 1,
            'menu'          => 'Main Menu',
            'menu_items'    => '[{"id":"item_1","value":"Home Page","slug":"\/","route":"\\\Webly\\\Core\\\Controllers\\\PagesController::display\/1","order":0,"children":[]},{"id":"item_2","value":"About","slug":"about","route":"\\\Webly\\\Core\\\Controllers\\\PagesController::display\/2","order":1,"children":[{"id":"item_4","value":"Mission","slug":"about\/mission","route":"\\\Webly\\\Core\\\Controllers\\\PagesController::display\/3","order":0,"children":[]},{"id":"item_7","value":"Vision","slug":"about\/vision","route":"\\\Webly\\\Core\\\Controllers\\\PagesController::display\/4","order":1,"children":[]}]},{"id":"item_5","value":"Blog","slug":"blog","route":"\\\Webly\\\Core\\\Controllers\\\BlogController::index","order":2,"children":[]},{"id":"item_3","value":"Contact Us","slug":"contact-us","route":"\\\Webly\\\Core\\\Controllers\\\PagesController::display\/5","order":3,"children":[]}]'
        ];

        $this->db->table('menus')->insert($data);
    }
}
