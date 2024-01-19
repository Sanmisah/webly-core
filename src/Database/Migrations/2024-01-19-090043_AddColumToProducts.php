<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumToProducts extends Migration
{
    public function up()
    {
        $fields = [
            'rate' => [
                'type'       => 'decimal',
                'constraint'    => "10,2",
                'after'      => 'featured_image'
            ],
        ];

        $this->forge->addColumn('products', $fields);        
    }

    public function down()
    {
        $fields = [
            'name'
        ];

        $this->forge->dropColumn('products', $fields);
    }
}
