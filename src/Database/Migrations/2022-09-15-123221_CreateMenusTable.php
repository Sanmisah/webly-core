<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'menu'          => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'menu_items'    => ['type' => 'text', 'null' => true],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('menu');
        $this->forge->createTable('menus', true);        
    }

    public function down()
    {
        $this->forge->dropTable('menus', true);
    }
}
