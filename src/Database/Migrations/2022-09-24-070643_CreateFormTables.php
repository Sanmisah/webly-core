<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFormTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'form'                      => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'success_message'           => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'error_message'             => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'form_fields'               => ['type' => 'text', 'null' => true],            
            'email_to'                  => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'response_email_subject'    => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'response_email_body'       => ['type' => 'text', 'null' => true],
            'created_at'                => ['type' => 'datetime', 'null' => true],
            'updated_at'                => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('forms', true);        

        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'form_id'           => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'form_data'         => ['type' => 'text', 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('form_data', true);        
    }

    public function down()
    {
        $this->forge->dropTable('forms', true);
        $this->forge->dropTable('form_data', true);
    }
}
