<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePagesTable extends Migration
{
    public function up()
    {
        // Pages Table
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'             => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'content'           => ['type' => 'text', 'null' => true],
            'page_title'        => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'meta_description'  => ['type' => 'varchar', 'constraint' => 160, 'null' => true],
            'layout'            => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'visible'           => ['type' => 'tinyint', 'default' => 1],
            'featured_image'    => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pages', true);        
    }

    public function down()
    {
        $this->forge->dropTable('pages', true);
    }
}
