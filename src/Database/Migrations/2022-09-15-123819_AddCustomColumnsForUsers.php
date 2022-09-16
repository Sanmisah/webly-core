<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomColumnsForUsers extends Migration
{
    public function up()
    {
        $fields = [
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'id'
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $fields = [
            'name'
        ];

        $this->forge->dropColumn('users', $fields);
    }
}
