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
        
        // Add Blog Categories
        $data = [
            'category'  => 'First Category',
        ];

        $this->db->table('blog_categories')->insert($data);

        // Add Blog Post
        $data = [
            'title'  => 'First Post',
            'content' => '<p style="box-sizing: border-box; line-height: 24px; font-size: 16px; margin: 0px 0px 12px; font-family: Raleway, Helvetica, Arial, sans-serif; color: #404040; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #fcfcfc; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;">This function will extract $radius number of characters before and after the central $phrase with an ellipsis before and after.</p>
            <p style="box-sizing: border-box; line-height: 24px; font-size: 16px; margin: 0px 0px 12px; font-family: Raleway, Helvetica, Arial, sans-serif; color: #404040; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #fcfcfc; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;">The first parameter is the text to extract an excerpt from, the second is the central word or phrase to count before and after. The third parameter is the number of characters to count before and after the central phrase. If no phrase passed, the excerpt will include the first $radius characters with the ellipsis at the end.</p>
            <p>&nbsp;</p>',
            'page_title' => 'First Post',
            'meta_description' => 'First Post',
            'layout' => 'post',
            'visible' => 1,
            'blog_category_id' => 1,
            'author' => 'James Bond',
            'published_on' => '2022-09-21',
            'featured_image' => 'writable/uploads/20221124/1669269778_32a0505f305e0bd00e2e.png'
        ];

        $this->db->table('blog_posts')->insert($data);

        // Add Forms
        $data = [
            'form'  => 'contact-us',
            'success_message' => 'Thank you for Contacting Us',
            'error_message' => 'Something went wrong. Try Again.',
            'form_fields' => '[{"field":"name","validations":"required"},{"field":"email","validations":"required|valid_email"},{"field":"mobile","validations":"required|valid_mobile"}]',
            'email_to' => 'sanjeev@sanmisha.com, sanjeevdivekar@gmail.com',
            'response_email_subject' => 'Welcome {name}',
            'response_email_body' => '<p>Dear <strong>{name},</strong></p>
            <p>Thank you for Contacting Us.</p>
            <p>Your email is <strong>{email}</strong>,</p>
            <p>Regards,</p>'
        ];

        $this->db->table('forms')->insert($data);        


        // Add Page Entry
        $data = [
            'title'             => 'Home',
            'content'           => '<div class="col-md-4"> <div class="panel panel-default"> <div class="panel-heading"> <h4>Bootstrap v3.3.7</h4> </div> <div class="panel-body"> <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p> <a class="btn btn-default" href="#">Learn More</a></div> </div> </div> <div class="col-md-4"> <div class="panel panel-default"> <div class="panel-heading"> <h4>Free &amp; Open Source</h4> </div> <div class="panel-body"> <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p> <a class="btn btn-default" href="#">Learn More</a></div> </div> </div> <div class="col-md-4"> <div class="panel panel-default"> <div class="panel-heading"> <h4>Easy to Use</h4> </div> <div class="panel-body"> <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p> <a class="btn btn-default" href="#">Learn More</a></div> </div> </div>',
            'page_title'        => 'Home',
            'meta_description'  => 'This meta',
            'layout'            => 'home',
            'visible'           => 1,
            'featured_image'    => 'writable/uploads/20220917/1663419429_4197e48d60b3a59fc5dd.png'
        ];

        $this->db->table('pages')->insert($data);

        $data = [
            'title'             => 'About',
            'content'           => '<p>This is about us</p>',
            'page_title'        => 'About',
            'meta_description'  => 'This is about us',
            'layout'            => 'about',
            'visible'           => 1,
            'featured_image'    => 'writable/uploads/20220922/1663836179_575ddb169e6faddbe3d3.jpg'
        ];

        $this->db->table('pages')->insert($data);


        $data = [
            'title'             => 'Misson',
            'content'           => '<p>This is Mission Page</p>',
            'page_title'        => 'Misson',
            'meta_description'  => 'This is mission page',
            'layout'            => 'about',
            'visible'           => 1,
            'featured_image'    => 'writable/uploads/20221124/1669269337_2eefc614fc9936acbbb6.png'
        ];

        $this->db->table('pages')->insert($data);

        $data = [
            'title'             => 'Vision',
            'content'           => '<p>This is Vision</p>',
            'page_title'        => 'Vision',
            'meta_description'  => 'This is Vision',
            'layout'            => 'about',
            'visible'           => 1,
            'featured_image'    => 'writable/uploads/20221124/1669269344_1e81b0a432782e33b3b0.png'
        ];

        $this->db->table('pages')->insert($data);


        $data = [
            'title'             => 'Contact Us',
            'content'           => '<p>This is contact us Page</p>',
            'page_title'        => 'Contact Us',
            'meta_description'  => 'This is contact us Page',
            'layout'            => 'contact',
            'visible'           => 1,
            'featured_image'    => null
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
