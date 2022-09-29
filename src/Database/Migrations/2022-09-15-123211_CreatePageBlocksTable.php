<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePageBlocksTable extends Migration
{
    public function up()
    {
        // Pages Table
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'page_id'           => ['type' => 'int', 'constraint' => 11],
            'block'             => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'content'           => ['type' => 'text', 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['block']);
        $this->forge->createTable('page_blocks', true);        
    }

    public function down()
    {
        $this->forge->dropTable('page_blocks', true);
    }
}
