<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProducts extends Migration
{
    public function up()
    {
        // Pages Table
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product'           => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'content'           => ['type' => 'text', 'null' => true],
            'page_title'        => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'meta_description'  => ['type' => 'varchar', 'constraint' => 160, 'null' => true],
            'layout'            => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'visible'           => ['type' => 'tinyint', 'default' => 1],
            'collection_id'     => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'featured_image'    => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['product', 'page_title']);
        $this->forge->createTable('products', true);        
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
