<?php

namespace Webly\Core\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitWebsiteContent extends Seeder
{
    public function run()
    {
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
            'menu_items'    => '[{"id":"item_1","value":"Home Page","slug":"/","route":"\\\Webly\\\Core\\\Controllers\\\PagesController::display/1","order":0,"children":[]}]'
        ];

        $this->db->table('menus')->insert($data);
    }
}
