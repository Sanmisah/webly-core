<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category'          => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('blog_categories', true);        

        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'             => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'content'           => ['type' => 'text', 'null' => true],
            'page_title'        => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'meta_description'  => ['type' => 'varchar', 'constraint' => 160, 'null' => true],
            'layout'            => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'visible'           => ['type' => 'tinyint', 'default' => 1],
            'blog_category_id'  => ['type' => 'int', 'constraint' => 11],
            'author'            => ['type' => 'varchar', 'constraint' => 100],
            'published_on'      => ['type' => 'date', null => true],
            'featured_image'    => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('blog_posts', true);        
    }

    public function down()
    {
        $this->forge->dropTable('blog_categories', true);
        $this->forge->dropTable('blog_posts', true);
    }
}