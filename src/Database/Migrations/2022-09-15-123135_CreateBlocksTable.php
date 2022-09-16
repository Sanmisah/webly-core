<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlocksTable extends Migration
{
    public function up()
    {
        // Blocks Table
        $this->forge->addField([
            'id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'block'       => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'description'         => ['type' => 'text', 'null' => true],
            'created_at'     => ['type' => 'datetime', 'null' => true],
            'updated_at'     => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('block');
        $this->forge->createTable('blocks', true);        
    }

    public function down()
    {
        $this->forge->dropTable('blocks', true);
    }
}
