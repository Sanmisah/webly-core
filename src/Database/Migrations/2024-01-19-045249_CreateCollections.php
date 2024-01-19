<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCollections extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'collection'        => ['type' => 'varchar', 'constraint' => 250, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],            
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['collection']);
        $this->forge->createTable('collections', true);  
    }

    public function down()
    {
        $this->forge->dropTable('collections', true);
    }
}
