<?php

namespace Webly\Core\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterVisitsTable extends Migration
{
    public function up()
    {
        $fields = [
            'browser' => ['type' => 'varchar', 'constraint' => 255, 'after' => 'user_agent', 'default' => ''],
            'mobile' => ['type' => 'varchar', 'constraint' => 255, 'after' => 'browser', 'default' => ''],
            'platform' => ['type' => 'VARCHAR', 'constraint' => 255, 'after' => 'mobile', 'default' => ''],            
        ];

        $this->forge->addColumn('visits', $fields);
    }

    public function down()
    {
        $fields = [
            'browser', 'mobile', 'platform'
        ];

        $this->forge->dropColumn('visits', $fields);
    }
}
