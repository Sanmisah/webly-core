<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBanners extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'banner_image'  => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'caption'       => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'description'   => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'link'          => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'sort_order'    => ['type' => 'int', 'default' => 0],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('banners', true);        
    }

    public function down()
    {
        $this->forge->dropTable('banners', true);
    }
}
