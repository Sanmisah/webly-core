<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleryTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category'          => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'category_image'    => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'description'       => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'sort_order'        => ['type' => 'int', 'default' => 0],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('category');
        $this->forge->createTable('gallery_categories', true);        

        $this->forge->addField([
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'album'                 => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'album_image'           => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'description'           => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'gallery_category_id'   => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'sort_order'            => ['type' => 'int', 'default' => 0],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('album');
        $this->forge->createTable('albums', true);        

        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'album_id'          => ['type' => 'int', 'constraint' => 11],
            'image'             => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'caption'           => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'description'       => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'sort_order'        => ['type' => 'int', 'default' => 0],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('album_images', true);                
    }

    public function down()
    {
        $this->forge->dropTable('gallery_categories', true);
        $this->forge->dropTable('albums', true);
        $this->forge->dropTable('album_images', true);
    }
}
